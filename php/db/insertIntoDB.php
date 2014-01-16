<?php include_once("../../etc/constants.php"); ?>
<?php include_once("../../php/inc.db.php"); ?>
<?php include_once("../../php/helpers.php"); ?>

<?php

$type 			= $_POST['type'];
$header 		= $_POST['header'];
$subHeader 		= $_POST['subHeader'];
$content 		= $_POST['content'];
$header_EN 		= $_POST['header_EN'];
$subHeader_EN 	= $_POST['subHeader_EN'];
$content_EN 	= $_POST['content_EN'];
$EN_active 		= $_POST['EN_active'];
$category 		= $_POST['category'];
$subCategory 	= $_POST['subCategory'];
$content 		= $_POST['content'];
$id				= $_POST['id'];
$imageOrder		= $_POST['imageOrder'];

//preFormat($_SERVER);
/*foreach($_FILES as $image){
	echo "<pre>";
	echo "FOREACH OF FILES: <br>";
	print_r($image);
	echo "</pre>";
}*/


$images = "";
if($_FILES['images']['error'][0] == 4){
	alertInfo("keine Datei gewählt");

} else {
	$uploadedFile = 0;
	foreach($imageOrder as $file){
		if($file == "newUpload"){
			
			$tmp 		= $_FILES['images']['tmp_name'][$uploadedFile];
			$imageType 	= $_FILES['images']['type'][$uploadedFile];
			$size		= $_FILES['images']['size'][$uploadedFile];
			$name		= $_FILES['images']['name'][$uploadedFile];
			switch ($imageType) {
			    case "image/png":
			        $imageType = ".png";
			        break;
			    case "image/jpeg":
			        $imageType = ".jpg";
			        break;
			}
			$filename = explode(".",$name);
			$filename = $filename[0];
			//CLEAN FILENAME FROM VOWEL MUTUATIONS OR UNDERSCORES ETC !!
			$filename = post_slug($subCategory)."_".post_slug($header)."_".post_slug($subHeader)."_".post_slug($filename);
			//CLEANED BY A FUNCTION IN HELPERS
			
			alertInfo($filename);
			
			$path = "/home2/admn1772/public_html/heckhaus/images/".$filename.$imageType;
			
			
			
			if(move_uploaded_file($tmp, $path)){
				$thumb = "<img style='width:100px;' src='images/$filename$imageType'>";
				alertSuccess("Uploaded The Image Successfully".$thumb);
			} else {
				alertDanger("failed to Upload Image");
			}
			$file = $filename.$imageType;
			$uploadedFile++;		
		} else {
			$file = $file;
		}
		//alertInfo($file);
		$images .= $file.",";
	}
	$images = rtrim($images,",");	
}






$sql = "UPDATE article SET type=?, en_active=?, content=?, content_EN=?, images=?, header=?,header_EN=?, subHeader=?,subHeader_EN=?, category=?, subCategory=? WHERE id = $id";
if ($stmt = $DB->prepare($sql)) {
	//echo "prepare completed"; //No output cause there should be no Problem
} else {
	alertDanger($DB->error);
	//var_dump($stmt);
}
$stmt->bind_param("sssssssssss",$type,$EN_active,$content,$content_EN,$images,$header,$header_EN,$subHeader,$subHeader_EN,$category,$subCategory);
if ($stmt->execute()) {
	alertSuccess("Wrote Successful to Database");
} else {
	alertDanger($stmt->error);
}

?>
