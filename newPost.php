
<?php include_once("etc/constants.php"); ?>
<?php include_once("php/helpers.php"); ?>
<?php include_once("php/inc.db.php"); ?>
<?php










$id = $_GET['id'];


if(!isset($id)){
	
	$sql = "INSERT INTO article (type) VALUES ('')";
	$test = $DB->query($sql);
	$sql = "SELECT id FROM article ORDER BY id DESC LIMIT 1";
	$test2 = $DB->query($sql);
	$test3 = $test2->fetch_array();
	$id = $test3['id'];
	
} //DO THIS, so SQL IS MAKING AN UPDATE QUERY AND IS DECIDING BY ITSELF WHICH ID TO GET

//preFormat($id);

if(!empty($id)){
	$sql = "SELECT * FROM article WHERE id = '$id'";
	$article = $DB->query($sql);
	$article = $article->fetch_array();
	$header= $article['header'];
	$header_EN=$article['header_EN'];
	$subHeader= $article['subHeader'];
	$subHeader_EN= $article['subHeader_EN'];	
	$text= $article['text'];
	$category= $article['category'];
	$subCategory= $article['subCategory'];
	$type = $article['type'];
	$imageArray = $article['images'];
	$content = $article['content'];
	$content_EN = $article['content_EN'];	
	$EN_active = $article['en_active'];		
	$imagefolder = $article['imagefolder'];
	$identifier = $imagefolder;
	$identifier = str_replace(' ', '', $identifier);

	$imageArray = explode(",",$imageArray);
	//preFormat($imageArray);
	if($imageArray[0] === ""){
		
	} else {
		foreach($imageArray as $image){
			$images .= "
			<div class='image well'>
				<input type='hidden' name='imageOrder[]' value='$image'>
				<input type='hidden' value='$image' name='images[]'>
				<div class='imageAlignment'>
					<img src=\"images/$imagefolder$image\">
				</div>
				".'
				<div class="imageControlButtons">
					<span class="btn btn-default fa fa-trash-o removeImage"></span>
					<span class="btn btn-default fa fa-chevron-up switchOrderUp"></span>
					<span class="btn btn-default fa fa-chevron-down switchOrderDown"></span>				
				</div>
			</div>
			';		
		}
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


$subCategories = '<select type="text" class="form-control" name="subCategory" id="subCategory">';
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
<div class="page-header">
		<span class="btn btn-default btn-language pull-right addEnglishLanguage"><i class="fa fa-plus"></i><img src="/img/en.png" class="languageFlag"></span>
	<h1>New Article for heckhaus.de</h1>

</div>
<div id="message"></div>
<form method="post" id="insertArticleIntoDBForm">
	<input type="hidden" name="id" value="$id">
	<input type="hidden" name="EN_active" id="EN_active" value="$EN_active">
	<div class="row">
		<div class="col-xs-7 noPadding">
			<div class="col-xs-8">
				<div class="headerInputFormFields minHeight101">
					<label for="header">Header</label>
					<div class="input-group"><span class="input-group-addon"><img src="/img/de.png" class="languageFlag"></span><input type="text" class="form-control" name="header" id="header" placeholder="KICKZ.COM" value="$header"></div>
					<div class="language_toggle_EN displayNone">
						<div class="input-group language_toggle_EN"><span class="input-group-addon"><img src="/img/en.png" class="languageFlag"></span><input type="text" class="form-control" name="header_EN" placeholder="" value="$header_EN"></div>					
					</div>
				</div>
				<div class="subHeaderInputFormFields minHeight101">
					<label for="subHeader">SubHeader</label>
					<div class="input-group"><span class="input-group-addon"><img src="/img/de.png" class="languageFlag"></span><input type="text" class="form-control" name="subHeader" id="subHeader" placeholder="K1X / SHOP SYSTEM - BERLIN" value="$subHeader">
					</div>
					<div class="language_toggle_EN displayNone">
						<div class="input-group language_toggle_EN"><span class="input-group-addon"><img src="/img/en.png" class="languageFlag"></span><input type="text" class="form-control" name="subHeader_EN" id="subHeader_EN" placeholder="" value="$subHeader_EN">
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-4 selectHolder">
				$categories
				$subCategories
				$itemSizeChooser
			</div>
			<div class="col-xs-12">
				<div class="contentInputFormFields">
					<label for="content">Content</label>
					<textarea type="text" class="form-control languageTextareaDE" rows="10" name="content" id="content_DE">$content</textarea>
					<textarea type="text" class="form-control language_toggle_EN displayNone" rows="10" name="content_EN" id="content_EN">$content_EN</textarea>
				</div>
			</div>		
		</div>
		<div class="col-xs-5">	
			<label for="images">Images (FIRST ONE IS THUMBNAIL)</label>
			<div class="imageContainer">
				$images
			</div>
			<label class="noMarginTop" for="images"><span class="btn btn-default fa fa-plus addImageFormField"></span></label>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
				<span class="btn btn-danger" id="saveNewArticleToDB">SAVE</span>
		</div>
	</div>
<div class="clearfix"></div>
<!-- WITHOUT THE NEXT LINE, NO SUBMIT IS AVAILABLE -->
<input type="file" style="display:none;">
</form>

FORM;

$output .= <<<FORM2
<div class="clearfix"></div>
<form class="singleImageUploadForm" id="singleImageUploadForm$id">
		<input type="hidden" name="subHeader" value="$subHeader">
		<input type="hidden" name="header" value="$header">
		<input type="hidden" name="subCategory" value="$subCategory">
		<input type="hidden" name="id" value="$id">						
		<input type="file" class="form-control" name="images[]" id="images">
</form>
FORM2;

echo $output;
?>