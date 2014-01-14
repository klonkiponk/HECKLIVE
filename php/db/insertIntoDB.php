<?php include_once("../../etc/constants.php"); ?>
<?php include_once("../../php/inc.db.php"); ?>
<?php include_once("../../php/helpers.php"); ?>

<?php

$type 			= $_POST['type'];
$header 		= $_POST['header'];
$subHeader 		= $_POST['subHeader'];
$category 		= $_POST['category'];
$subCategory 	= $_POST['subCategory'];
$content 		= $_POST['content'];
$id				= $_POST['id'];
$imageOrder		= $_POST['imageOrder'];
//var_dump($DB);
//print_r($DB);
//echo "<pre>";
//var_dump($_POST);
//echo "FILES: <br>";
//var_dump($_FILES);
//var_dump($_REQUEST);
//echo "</pre>";


//preFormat($_POST);

//preFormat($_SERVER);

/*foreach($_FILES as $image){
	echo "<pre>";
	echo "FOREACH OF FILES: <br>";
	print_r($image);
	echo "</pre>";
}*/

$content = htmlentities($content);
$content = stripslashes($content);

$header = htmlentities($header);
$header = stripslashes($header);

$subHeader = htmlentities($subHeader);
$subHeader = stripslashes($subHeader);

if($_FILES['images']['error'][0] == 4){
	alertInfo("keine Datei gewählt");
	$images = "";
	$imagefolder = "";
	} else {	
	$folder = $category."/".$subCategory."/".$header."/".$subHeader.date("Ym")."/";
	$folder = str_replace(' ','',$folder);
	$structure = "../../images/".$folder;
	$imagefolder = $folder;
	if (file_exists($structure)){
		//alertInfo('Already Existing');
	} else {
		if (!mkdir($structure, 0777, true)) { //true = recursive
			//alertDanger('Tried to create');
		} else {
			//alertSuccess("creation Successful");
		}
	}
	$k = 0;
	$images = "";
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
			$path = "/home2/admn1772/public_html/heckhaus/images/".$folder.$filename.$imageType;
			
			if(move_uploaded_file($tmp, $path)){
				$thumb = "<img style='width:100px;' src='images/$folder$filename$imageType'>";
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










if(!empty($id)){
	$sql = "UPDATE article SET type=?, content=?, images=?, imagefolder=?, header=?, subHeader=?, category=?, subCategory=? WHERE id = $id";	//END OF QUERY FOR AN EDIT FORM	
} else {
	$sql = "INSERT INTO article (type, content, images, imagefolder, header, subHeader, category, subCategory) VALUES (?,?,?,?,?,?,?,?)";
}//END OF QUERIE FOR A NEW FORM!!!
if ($stmt = $DB->prepare($sql)) {
	//echo "prepare completed"; //No output cause there should be no Problem
} else {
	alertDanger('$DB->prepare failed');
	//var_dump($stmt);
}
$stmt->bind_param("ssssssss",$type,$content,$images,$imagefolder,$header,$subHeader,$category,$subCategory);
if ($stmt->execute()) {
	alertSuccess("Wrote Successful to Database");
} else {
	alertDanger("Writing to Database failed");
}
echo $return;
?>
