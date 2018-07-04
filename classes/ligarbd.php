<?php
// File for database connection configuration
// If you change the database in use, you should update this file
$db_server="db.fe.up.pt";
$db_name="si06";			// database name
$db_username="si06";		// username
$db_password="Tw6Cfx5R";		    // password

$conn = mysql_connect($db_server, $db_username, $db_password);

if (!$conn) {
   echo "Impossible to connect to database: " . mysql_error();
   exit;
}

if (!mysql_select_db($db_name)) {
   echo "Impossible to connect to database: " . mysql_error();
   exit;
}
?>
