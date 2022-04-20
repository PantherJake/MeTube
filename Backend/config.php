<?php
session_start();
$host = "mysql1.cs.clemson.edu"; /* Host name */
$user = "Fnl4620Dtbs_zpz5"; /* User */
$password = "0ur_P4ssword"; /* Password */
$dbname = "Final_4620_Database_ia8e"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
