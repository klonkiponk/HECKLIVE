<?php
function alertDanger($alert){
	echo <<<ALERT
		<div class="alert alert-danger"><span class="">$alert</span></div>
ALERT;
}
function alertInfo($alert){
	echo <<<ALERT
		<div class="alert alert-info"><span class="">$alert</span></div>
ALERT;
}
function alertSuccess($alert){
	echo <<<ALERT
		<div class="alert alert-success"><span class="">$alert</span></div>
ALERT;
}
function preFormat($content){
	echo "<pre>";
	print_r($content);
	echo "</pre>";
}
?>