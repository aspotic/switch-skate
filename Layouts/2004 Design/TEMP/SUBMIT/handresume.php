<?php

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 

$ResumeDB = "switchsk_other";
$LinkUp = mysql_connect ($host, $user, $pass);
$ResumeQuery = "insert into resume values ('0', '$name', '$email', '$talk', '$help', '$comment')";

if (mysql_db_query ($ResumeDB, $ResumeQuery, $LinkUp)){

       header("Location: http://www.switchskate.net/index.php");

   	   exit;
	   
}else{

 	   print ("Your information was not sent<br>\n");
	   print (" please email webmaster@switchskate.net if this is an error<br>\n");
	   print ("<br>\n");
	   print ("<br>\n");
	   print ("Name: $name<br>\n");
	   print ("Email: $email<br>\n");
	   print ("MSN/AOL: $talk<br>\n");
	   print ("How you can help: $help<br>\n");
	   print ("Comments: $comment<br>\n");
}

mysql_close ($LinkUp);
?>
