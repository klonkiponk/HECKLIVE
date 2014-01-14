<!DOCTYPE html>
<html>
  <head>
    <title>HECKLIFE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
	<meta name="apple-mobile-web-app-capable" content="yes" />    
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet"> 
    <link href="css/style.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  </head>
  <body>
	  <div id="wrapper">
	    <nav id="sideBarMenu" class="navbar col-md-2">
	    	<span class="navbar-brand pull-right"><img class="pull-right" src="images/logo.png"></span>
	    	<div class="clearfix"></div>
			<ul class="list-group">
	            <li class="list-group-item"><span data-href="newsfeed">Newsfeed</span></li>
	            <li class="list-group-item"><span data-href="testForm">TestForm</span></li>	            
	            <li class="list-group-item"><span data-href="chat">Chat</span></li>
	            <li class="list-group-item"><span data-href="newPost">new Post</span></li>
	            <li class="list-group-item"><span data-href="newPost">editPost</span></li>
			</ul>
			<div class="swiper"></div>
	    </nav>
	    <div id="pusher" class="pusher col-md-11 col-md-offset-1">
			<div id="innerPusher">
	        <article id="main">       
				<section class="heckliveSection testForm">
					<form id="myForm" method="post"> 
					    Name: <input type="text" name="name" /> 
					    Comment: <textarea name="comment"></textarea> 
					    <input type="submit" value="Submit Comment" />
					    <input type="file" name="file">
					</form>
				</section>
				<section class="newsfeed heckliveSection">
					<?php include("newsfeed.php"); ?>
				</section>
				<section class="chat heckliveSection">Chat</section>
				<section class="newPost heckliveSection" id="newPost">
					<?php //include("newPost.php"); ?>
				</section>
				<section class="editPost heckliveSection">

				</section>
			</article>
			</div>
	    </div>
	  </div>  
	    
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.lightBox.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/hecklive.js"></script>
	<?php //INCLUDE ADDITIONAL SCRIPTS DEPENDING ON THE BROWSER
	if (preg_match("/\biPhone\b/i",$_SERVER['HTTP_USER_AGENT']) OR preg_match("/\biPad\b/i",$_SERVER['HTTP_USER_AGENT'])) {
		$iOS = true;
	}
	if($iOS == true) {
		echo '<script type="text/javascript" src="js/swipe.jquery.js"></script>';
		echo '<script type="text/javascript" src="js/iOS.js"></script>';
	} else {
		echo '<script type="text/javascript" src="js/desktop.js"></script>';		
	}
		
	?>			 
  </body>
</html>