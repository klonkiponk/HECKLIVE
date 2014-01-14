<div class="page-header">
	<h1>Newsfeed</h1>
</div>
<?php include_once("etc/constants.php"); ?>
<?php include_once("php/helpers.php"); ?>
<?php include_once("php/inc.db.php"); ?>
<?php
	$sql = "SELECT * FROM article ORDER BY type";
	$sqlNumberOfSmallItems = "SELECT * FROM article WHERE type='smallItem'";	
	$articles = $DB->query($sql);
	$numberOfSmallItems = $DB->query($sqlNumberOfSmallItems);
	$numberOfSmallItems->num_rows;
	$bigItems = 0;
	$smallItems = 0;
	while ($article = $articles->fetch_array()){
		//preFormat($article);
		$id = $article['id'];
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
		$output = "";








//$content = html_entity_decode($content);















$imageArray = explode(",",$imageArray);
$imageCount = count($imageArray);
//preFormat($imageArray);	
if ($imageCount == "0"){
	$images = "";
} elseif($imageCount == "1"){
	$images = "<img src='images/".$imagefolder.$imageArray[0]."'>";
} else {
	$images = "<a href=\"images/$imagefolder"."$imageArray[1]\" data-lightbox=\"$identifier\" title=\"$header / $subHeader\">";
	$images .= "<img src='images/".$imagefolder.$imageArray[0]."'>";
	$images .= "</a>";
    unset($imageArray[0]);
    unset($imageArray[1]);
	foreach($imageArray as $image){
		$images .= "<a href=\"images/$imagefolder$image\" data-lightbox=\"$identifier\" title=\"$header / $subHeader\"></a>";		
	}
}



if ($type=="smallItem"){
$smallItems++;
if ($smallItems === 1){
	$output .= "<hr>";
	$output .= "<div class=\"row\">";
}
//preFormat($smallItems);
$output .= <<<ARTICLE
	<div class="col-md-3 $type">
		$images
		<h2>$header /</h2>
		<h3>$subHeader</h3>
		<section class="details">
			<div class="toggled" data-id="$identifier">
				$content
			</div>
			<span class="toggler" data-id="$identifier">+ / - <span class="more"></span></span> <br>
		</section>
		<div class='imageControlButtons'>
			<span class="btn btn-default fa fa-wrench editAnExitingPostButton" data-id="$id"></span>
		</div>
	</div>

ARTICLE;

if ($smallItems%4 === 0){
	$output .= '</div><div class="row">';
}
if($smallItems == $numberOfSmallItems->num_rows){
	$output .= "</div>";
}
	
} elseif ($type=="bigItem") {
$bigItems++;
$output .= <<<ARTICLE
<hr>
<div class="row">
	<div class="item $type">
		<div class="col-md-6 medImg">
			$images
		</div>
		<div class="col-md-6 medTxt">
			<h2>$header / <small>$subHeader</small></h2>
			<section class="details">
			<div class="toggled" data-id="$identifier">
				$content
			</div>
			 <span class="toggler" data-id="$identifier">+ / - <span class="more"></span></span> </section>
		</div>
		<div class='imageControlButtons'>
				<span class="btn btn-default fa fa-wrench editAnExitingPostButton" data-id="$id"></span>		
		</div>
		<div class="clearfix"></div>
	</div>
</div>
ARTICLE;
}
	echo $output;
	}
?>