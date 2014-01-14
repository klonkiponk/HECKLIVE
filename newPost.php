<div class="page-header">
	<h1>New Article for heckhaus.de</h1>
</div>
<div id="message"></div>
<?php include_once("etc/constants.php"); ?>
<?php include_once("php/helpers.php"); ?>
<?php include_once("php/inc.db.php"); ?>
<?php
$id = $_GET['id'];

if(!empty($id)){
	$sql = "SELECT * FROM article WHERE id = '$id'";
	$article = $DB->query($sql);
	$article = $article->fetch_array();
	//preFormat($article);
	$header= $article['header'];
	$subHeader= $article['subHeader'];
	$text= $article['text'];
	$category= $article['category'];
	$subCategory= $article['subCategory'];
	$type = $article['type'];
	$imageArray = $article['images'];
	$content = $article['content'];
	$imagefolder = $article['imagefolder'];
	$identifier = $imagefolder;
	$identifier = str_replace(' ', '', $identifier);


	$imageArray = explode(",",$imageArray);
	foreach($imageArray as $image){
		$images .= "<div class='image'><input type='hidden' name='imageOrder[]' value='$image'><input type='hidden' value='$image' name='images[]'><img src=\"images/$imagefolder$image\">".'
				<div class="imageControlButtons">
					<span class="btn btn-default fa fa-trash-o removeImage"></span>
					<span class="btn btn-default fa fa-chevron-up switchOrderUp"></span>
					<span class="btn btn-default fa fa-chevron-down switchOrderDown"></span>				
				</div>
</div>';		
	}


	
} else {
	//echo "NEW";
}







$categories = '<label for="category">Category</label><select type="text" class="form-control" name="category" id="category">';			
$categoryList = array(
	"we" => "We",
	"work" => "Work",
	"forYou" => "For You"
);
foreach ($categoryList as $key=>$value){
	if ($category == $key){
		$selected = "selected";
	} else {
		$selected = "";
	}
	$categories .= "<option value='$key' $selected>$value</option>";
}
$categories .= '</select>';


$subCategories = '<label for="subCategory">SubCategory</label><select type="text" class="form-control" name="subCategory" id="subCategory">';
$subCategoryList = array(
	"press" => "Press",
	"retail" => "Retail",
	"shopInShop" => "Shop in Shop",
	"home" => "Home",
	"bestOf" => "Best Of",
	"showroom" => "Showroom"
);
foreach ($subCategoryList as $key=>$value){
	if ($subCategory == $key){
		$selected = "selected";
	} else {
		$selected = "";
	}
	$subCategories .= "<option value='$key' $selected>$value</option>";
}
$subCategories .= '</select>';

$itemSizeChooser = '<label for="type">Type</label><select type="text" class="form-control" name="type" id="type">';
$itemSizeList = array(
	"smallItem" => "Small",
	"bigItem" => "Big"
);
foreach ($itemSizeList as $key=>$value){
	if ($type == $key){
		$selected = "selected";
	} else {
		$selected = "";
	}
	$itemSizeChooser .= "<option value='$key' $selected>$value</option>";
}
$itemSizeChooser .= '</select>';









$output = <<<FORM
<form method="post" id="insertArticleIntoDBForm">
	<input type="hidden" name="id" value="$id">
	<div class="col-md-4">
		<label for="header">Header</label>
		<input type="text" class="form-control" name="header" id="header" placeholder="KICKZ.COM" value="$header">
		
		<label for="subHeader">SubHeader</label>
		<input type="text" class="form-control" name="subHeader" id="subHeader" placeholder="K1X / SHOP SYSTEM - BERLIN" value="$subHeader">
	</div>
	<div class="col-md-3">
		$categories
		$subCategories
		$itemSizeChooser
	</div>
	<div class="col-md-5">	
		<label for="images">Images (FIRST ONE IS THUMBNAIL)</label>
		<div class="imageContainer">
			$images
			<div class="image">
				<input type="hidden" name="imageOrder[]" value="newUpload">
				<input type="file" class="form-control" name="images[]" id="images">
				<div class='imageControlButtons'>
					<span class="btn btn-default fa fa-trash-o removeImage"></span>
					<span class="btn btn-default fa fa-chevron-up switchOrderUp"></span>
					<span class="btn btn-default fa fa-chevron-down switchOrderDown"></span>				
				</div>
			</div>
		</div>
		<span class="btn btn-default fa fa-plus addImageFormField"></span>
	</div>
	<div class="col-md-12">
		<label for="content">Content</label>
		<textarea type="text" class="form-control" rows="3" name="content" id="content" placeholder="Insert content here">$content</textarea>
	</div>
	<div class="col-md-12">
		<div class='imageControlButtons'>
			<input type="submit" value="Save" class="btn btn-default pull-right">
		</div>
	</div>
</form>
FORM;
echo $output;
?>