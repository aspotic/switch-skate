<?php
require ("functions.php");

$host = "localhost";
$user = "switchsk_adam";
$password = "drummer";
$dbname = "switchsk_other";

$link = mysql_connect ($host, $user, $password);

$tablename = "feedback";
$query = "CREATE table $tablename (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, firstname TEXT, lastname TEXT, emailaddress TEXT, comments TEXT);";
if (mysql_db_query ($dbname, $query, $link)){print ("$tablename was added successfully<br>\n");}else{print ("$tablename failed to be added<br>\n");}

$tablename = "ticker";
$query = "CREATE table $tablename (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, fname TEXT, email TEXT, title TEXT, textw TEXT);";
if (mysql_db_query ($dbname, $query, $link)){print ("$tablename was added successfully<br>\n");}else{print ("$tablename failed to be added<br>\n");}

mysql_close($link);
?>