<?php

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 

$ColorDB = "switchsk_fcontent";
$LinkUp = mysql_connect ($host, $user, $pass);
$ColorQuery = "insert into colors values ('$person', '$email', '0', '$name', '$bg', '$alt1', '$alt2', '$tablecolor', '$border', '$link', '$roll', '$text', '$font')";

if (mysql_db_query ($ColorDB, $ColorQuery, $LinkUp)){

       header("Location: http://www.switchskate.net/index.php");

   	   exit;
  
}else{

 	   print ("Your information was not sent<br>\n");
	   print (" please email webmaster@switchskate.net about is an error<br>\n");
}

mysql_close ($LinkUp);
?>
