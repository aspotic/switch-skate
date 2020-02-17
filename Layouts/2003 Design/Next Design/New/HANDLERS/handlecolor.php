<?php
$host = "localhost";
$user = "switchsk_adam";
$password = "drummer";
$dbname = "switchsk_fother";
$tablename = "schemes";

$link = mysql_connect ($host, $user, $password);

$query = "insert into $tablename values ('0', '$scheme[bgo]', '$scheme[bgt]', '$scheme[bo]', '$scheme[bt]', '$scheme[fo]', '$scheme[ft]', '$scheme[l]', '$scheme[lr]')";


if (mysql_db_query ($dbname, $query, $link)){

       header("Location: http://www.switchskate.net/index.php");

   	   exit;
}
else{
 	   print ("Your information was not sent<br>\n");
	   print (" please email webmaster@switchskate.net if this is an error<br>\n");
	   print ("<br>\n");
	   print ("<br>\n");
	   print ("Background 1: $scheme[bgo]<br>\n");
	   print ("Background 2: $scheme[bgt]<br>\n");
	   print ("Border 1: $scheme[bo]<br>\n");
	   print ("Border 2: $scheme[bt]<br>\n");
	   print ("Text 1: $scheme[fo]<br>\n");
	   print ("Text 2: $scheme[ft]<br>\n");
	   print ("Link: $scheme[r]<br>\n");
	   print ("Link Rollover: $scheme[lr]<br>\n");
}

mysql_close ($link);
?>