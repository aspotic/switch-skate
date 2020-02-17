<?php require ("http://www.switchskate.net/cp/handlers/header3.php");?>
<?php
$host = "localhost";
$username = "switchsk_adam";
$password = "drummer";
$dbname="switchsk_other";

$link = mysql_connect ($host, $username, $password);
$sql = "UPDATE news SET marquee='$medit' WHERE id='1'";
$result = mysql_db_query ($dbname, $sql, $link);

if ($result)
{print ("the news was changed to '$medit'");}

mysql_close ($link);
?>
