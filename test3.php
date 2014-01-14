<?php include_once("etc/constants.php"); ?>
<?php include_once("php/inc.db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HECKHAUS DB Access</title>
    <link rel="stylesheet" href="css/style.css">	
</head>
<body>
<div id="wrapper">


<?php
	$sql = "SELECT * FROM article";
	$articles = $DB->query($sql);
	while ($article = $articles->fetch_array()){
//		echo "<pre>";
//		print_r($article);
//		echo "</pre>";
		$header= $article['header'];
		$subHeader= $article['subHeader'];
		$text= $article['text'];
		$category= $article['category'];
		$subCategory= $article['subCategory'];
		$type = $article['type'];
		$imageArray = explode(",",$article['images']);
		
		foreach($imageArray as $singleImage) {
			echo $singleImage;
		}
		$identifier = $category.$subCategory.$header.$subHeader.
		$identifier = str_replace(' ', '', $identifier);
			
		$output = <<<ARTICLE
	<div class="col-md-3 $type">
		<a href="/images/$category/$subCategory/$header/$subHeader$monthYear/$image.jpg" data-lightbox="$identifier" title="$header / $subHeader">
			 <img src="/images/$category/$subCategory/$header$subHeader$monthYear/s1.jpg">
		</a>
		<a href="/images/$category/$subCategory/$header/$subHeader$monthYear/$image.jpg" data-lightbox="$identifier" title="$header / $subHeader"></a>
		<h2>$header /</h2>
		<h3>$subHeader</h3>
		<section class="details">
			<div class="toggled" data-id="$identifier">
				$text
			</div>
			<span class="toggler" data-id="$identifier">+ / - <span class="more"></span></span> <br>
		</section>
	</div>
ARTICLE;
		echo $output;
	}
?>



</div>
</body>
</html>