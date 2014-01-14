<?php include_once("../../etc/constants.php"); ?>
<?php include_once("../../php/inc.db.php"); ?>
<?php include_once("../../php/helpers.php"); ?>

<?php

	$id	= $_POST['id'];
	
	$sql = "DELETE FROM article WHERE id = $id";	//END OF QUERY FOR AN DELETE FORM	
	
	if ($stmt = $DB->prepare($sql)) {
		//echo "prepare completed"; //No output cause there should be no Problem
	} else {
		alertDanger('$DB->prepare failed');
		//var_dump($stmt);
	}
	$stmt->bind_param("i",$type,$content,$images,$imagefolder,$header,$subHeader,$category,$subCategory);
	if ($stmt->execute()) {
		alertSuccess("Deletion Successful");
	} else {
		alertDanger("Writing to Database failed");
	}

?>
