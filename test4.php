<?php include_once("etc/constants.php"); ?>
<?php include_once("php/inc.db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HECKHAUS DB Access</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">     	
</head>
<div id="message"></div>

<form method="post" action="php/db/insertIntoDB.php" id="insertArticleIntoDBForm" class="smallImg" enctype="multipart/form-data">

	<div class="col-md-4">
		<label for="header">Header</label>
		<input type="text" class="form-control" name="header" id="header" placeholder="KICKZ.COM">
		
		<label for="subHeader">SubHeader</label>
		<input type="text" class="form-control" name="subHeader" id="subHeader" placeholder="K1X / SHOP SYSTEM - BERLIN">
	</div>
	<div class="col-md-4">
		<label for="category">Category</label>
		<select type="text" class="form-control" name="category" id="category">
			<option value="we">We</option>
			<option value="work">Work</option>
			<option value="foryou">For You</option>		
		</select>
		
		<label for="subCategory">SubCategory</label>
		<select type="text" class="form-control" name="subCategory" id="subCategory">
			<option value="retail">Retail</option>
			<option value="shopInShop">Shop-in-Shop</option>
			<option value="press">Press</option>		
		</select>
		<label for="type">Type</label>
		<select type="text" class="form-control" name="type" id="type">
			<option value="smallImg">smallImg</option>
			<option value="bigImg">bigImg</option>	
		</select>
	</div>
	<div class="col-md-4">	
		<label for="images">Images</label>
		<div class="imageContainer">
			<input type="file" class="form-control" name="images" id="images">
		</div>
		<span class="btn btn-default addImageFormField">+</span>
	</div>
	<div class="col-md-12">
		<label for="content">Content</label>
		<textarea type="text" class="form-control" rows="3" name="content" id="content" placeholder="Insert content here"></textarea>
	</div>

	
	
	<input type="submit" value="Save" class="btn btn-info pull-right">

</form>