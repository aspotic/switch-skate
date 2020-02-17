<?php
$host = "localhost";
$user = "switchsk_adam";
$password = "drummer";
$dbname = "switchsk_contco";
$link = mysql_connect ($host, $user, $password);

$query = "CREATE table links (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, title TEXT, textw TEXT);";
if (mysql_db_query ($dbname, $query, $link)){print ("links was added successfully<br>\n");}else{print ("links failed to be added<br>\n");}
$query = "CREATE table reviews (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, title TEXT, textw TEXT);";
if (mysql_db_query ($dbname, $query, $link)){print ("reviews was added successfully<br>\n");}else{print ("reviews failed to be added<br>\n");}
$query = "CREATE table games (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, fname TEXT, email TEXT, title TEXT, textw TEXT);";
if (mysql_db_query ($dbname, $query, $link)){print ("games was added successfully<br>\n");}else{print ("games failed to be added<br>\n");}
$query = "CREATE table tutorials (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, title TEXT, textw TEXT);";
if (mysql_db_query ($dbname, $query, $link)){print ("tutorials was added successfully<br>\n");}else{print ("tutorials failed to be added<br>\n");}
mysql_close($link);
?>


