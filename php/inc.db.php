<?php
	/**
	 * connects to database, returns Message or Object
	 *
	 * @return void
	 * @author Kevin Siegerth
	 */
	function db_connectToDb ()
	{
	    $mysqli = new mysqli(DBHOST, DBUSER , DBPASSWORD , DATABASE);
	    if (mysqli_connect_errno()) {
	        exit();
	    }
	    return $mysqli;
	}	
    $DB = db_connectToDb();
    mysqli_set_charset($DB, 'utf8');
    
?>