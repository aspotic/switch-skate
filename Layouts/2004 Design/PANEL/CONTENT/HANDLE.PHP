<?php

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 

$ResumeDB = "switchsk_cucont";
$LinkUp = mysql_connect ($host, $user, $pass);
$ResumeQuery = "insert into $type values ('0', '$title', '$text')";

if (mysql_db_query ($ResumeDB, $ResumeQuery, $LinkUp)){

       header("Location: http://www.switchskate.net/panel/index.php");

   	   exit;
	   
}else{

 	   print ("ERROR<br><br>\n");
	   mysql_error();
}

mysql_close ($LinkUp);
?>
