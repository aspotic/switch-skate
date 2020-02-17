<?php

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 

$FContDB = "switchsk_fcontent";
$LinkUp = mysql_connect ($host, $user, $pass);


switch ($type){

	   case 1:
	        $FContQuery = "insert into sblinks values ('0', '$name', '$email', '$site', '$url')";
			break;
			
	   case 2:
	   		$FContQuery = "insert into colinks values ('0', '$name', '$email', '$site', '$url');";
			break;
			
}

if (($type != 0) &&(mysql_db_query ($FContDB, $FContQuery, $LinkUp))){

       header("Location: http://www.switchskate.net/index.php");

   	   exit;
}

elseif ($type == 0){
	   print ("Please pick a type of content<br>\n");
}

else{
 	   print ("Your information was not sent<br>\n");
	   print (" please email webmaster@switchskate.net if this is an error<br>\n");
	   print ("<br>\n");
	   print ("<br>\n");
	   print ("Name: $name<br>\n");
	   print ("Email: $email<br>\n");
	   print ("Site Name: $site<br>\n");
	   print ("Site URL: $url<br>\n");
}

mysql_close ($LinkUp);
?>
