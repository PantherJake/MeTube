<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'mysql1.cs.clemson.edu');
define('DB_USERNAME', 'Fnl4620Dtbs_zpz5');
define('DB_PASSWORD', '0ur_P4ssword');
define('DB_NAME', 'Final_4620_Database_ia8e');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
