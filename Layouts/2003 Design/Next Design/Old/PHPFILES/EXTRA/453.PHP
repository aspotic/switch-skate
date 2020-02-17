<?php
$host = "localhost";
$username = "switchsk_adam";
$password = "drummer";
$dbname="switchsk_other";

$link = mysql_connect ($host, $username, $password);
$query = "SELECT * from complete";
$result = mysql_db_query ($dbname, $query, $link);
$row = mysql_fetch_array($result);
while ($row = mysql_fetch_array($result)){$perc++;}
$perc++;$perc++;
$query = "INSERT INTO complete ( id ) VALUES ( '$perc' ); ";
$result = mysql_db_query ($dbname, $query, $link);

print ("$perc");

mysql_close ($link);
?>