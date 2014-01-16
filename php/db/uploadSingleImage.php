<?php include_once("../../etc/constants.php"); ?>
<?php include_once("../../php/inc.db.php"); ?>
<?php include_once("../../php/helpers.php"); ?>

<?php

$header 		= $_POST['header'];
$subHeader 		= $_POST['subHeader'];
$subCategory 	= $_POST['subCategory'];
$id				= $_POST['id'];

if($_FILES['images']['error'][0] == 4){
	alertInfo("keine Datei gewählt");

} else {		
	$tmp 		= $_FILES['images']['tmp_name'][0];
	$imageType 	= $_FILES['images']['type'][0];
	$size		= $_FILES['images']['size'][0];
	$name		= $_FILES['images']['name'][0];
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
	
	//alertInfo($filename);
	
	$path = "/home2/admn1772/public_html/heckhaus/images/".$filename.$imageType;
	if(move_uploaded_file($tmp, $path)){
		$thumb = "<img src='images/$filename$imageType'>";
		//alertSuccess("Uploaded The Image Successfully".$thumb);
	} else {
		//alertDanger("failed to Upload Image");
	}
}


$return = <<<RETURN
		<div class='image well' style="display:none;">
			<input type='hidden' name='imageOrder[]' value='$filename$imageType'>
			<input type='hidden' value='$filename$imageType' name='images[]'>
			<div class='imageAlignment'>
				$thumb
			</div>
			<div class="imageControlButtons">
				<span class="btn btn-default fa fa-trash-o removeImage"></span>
				<span class="btn btn-default fa fa-chevron-up switchOrderUp"></span>
				<span class="btn btn-default fa fa-chevron-down switchOrderDown"></span>				
			</div>
		</div>
RETURN;
echo $return;
?>
