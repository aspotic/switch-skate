<?php

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 

$FContDB = "switchsk_fcontent";
$LinkUp = mysql_connect ($host, $user, $pass);


switch ($type){

	   case 1:
	        $FContQuery = "insert into tricktips values ('0', '$name', '$email', '$title', '$text')";
			break;
			
	   case 2:
	   		$FContQuery = "insert into reviews values ('0', '$name', '$email', '$title', '$text');";
			break;
			
	   case 3:
	   		$FContQuery = "insert into articles values ('0', '$name', '$email', '$title', '$text');";
			break;
			
	   case 4:
	   		$FContQuery = "insert into storys values ('0', '$name', '$email', '$title', '$text');";
			break;

	   case 5:
			$FContQuery = "insert into tutorials values ('0', '$name', '$email', '$title', '$text');";
			break;
			
	   case 6:
			$FContQuery = "insert into coreviews values ('0', '$name', '$email', '$title', '$text');";
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
	   print ("Title: $title<br>\n");
	   print ("Text: $text<br>\n");
}

mysql_close ($LinkUp);
?>
