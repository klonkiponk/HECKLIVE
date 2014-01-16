<?php
include_once("etc/constants.php");
$message = $_POST['text'];
$sender = $_POST['sender'];
$query = "INSERT INTO message (message, sender) VALUES ('$message','$sender')";
$mysqli = new mysqli(DBHOST, DBUSER, DBPASSWORD, DATABASE);
$mysqli->query($query);
$mysqli->close();
?>