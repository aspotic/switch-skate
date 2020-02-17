<?php

$host = "localhost"; 
$user = "switchsk_adam"; 
$password = "drummer"; 
$dbname = "switchsk_fcontsb";

$link = mysql_connect ($host, $user, $password);

switch ($array[type]){

	   case 1:
	        $query = "insert into tricktips values ('0', '$array[fname]', '$array[email]', '$array[title]', '$array[textw]')";
			break;
			
	   case 2:
	   		$query = "insert into reviews values ('0', '$array[fname]', '$array[email]', '$array[title]', '$array[textw]');";
			break;
			
	   case 3:
	   		$query = "insert into articles values ('0', '$array[fname]', '$array[email]', '$array[title]', '$array[textw]');";
			break;
			
	   case 4:
	   		$query = "insert into storys values ('0', '$array[fname]', '$array[email]', '$array[title]', '$array[textw]');";
			break;
}
					
$database = "switchsk_fcontco"; 
mysql_select_db($database, $link);

switch ($array[type]){

		case 5:
			$query = "insert into tutorials values ('0', '$array[fname]', '$array[email]', '$array[email]', '$array[textw]');";
			break;
			
		case 6:
			$query = "insert into reviewscomp values ('0', '$array[fname]', '$array[email]', '$array[title]', '$array[textw]');";
			break;
			
		case 7:
			$query = "insert into links values ('0', '$array[fname]', '$array[email]', '$array[title]', '$array[textw]');";
			break;
}

if (($array[type] != 0) &&(mysql_db_query ($dbname, $query, $link))){
	   print ("Your submission was successful\n");
	   print ("<br>\n");
	   print ("<br>\n");
	   print ("Name: $array[fname]<br>\n");
	   print ("Email: $array[email]<br>\n");
	   print ("Title: $array[title]<br>\n");
	   print ("Text: $array[textw]<br>\n");
}

elseif ($array[type] == 0){
	   print ("Please pick a type of content<br>\n");
}

else{
 	   print ("Your information was not sent<br>\n");
	   print (" please email webmaster@switchskate.net about this problem<br>\n");
	   print ("<br>\n");
	   print ("<br>\n");
	   print ("Name: $array[fname]<br>\n");
	   print ("Email: $array[email]<br>\n");
	   print ("Title: $array[title]<br>\n");
	   print ("Text: $array[textw]<br>\n");
}

mysql_close ($link);
?>