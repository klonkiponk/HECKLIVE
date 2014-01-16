<?php
include_once("etc/constants.php");

$con = mysql_connect(DBHOST,DBUSER,DBPASSWORD);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db(DATABASE, $con);

$result = mysql_query("SELECT * FROM message ORDER BY id ASC");


while($row = mysql_fetch_array($result))
  {
		  $user = $row['sender'];
		  $message = $row['message'];

		  echo <<<CHATMESSAGE
		  
		  <span class="chatUser">$user</span> :: $message<br>

CHATMESSAGE;

  }

mysql_close($con);
?>
