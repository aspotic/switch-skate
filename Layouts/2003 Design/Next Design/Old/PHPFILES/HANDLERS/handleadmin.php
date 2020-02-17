<?php
$text["fname"] = trim ($text[fname]);
$text["email"] = trim ($text[email]);
$text["title"] = trim ($text[title]);

$host = "localhost"; 
$user = "switchsk_adam"; 
$password = "drummer"; 
$dbname = "switchsk_fother";

$link = mysql_connect ($host, $user, $password);

$query = "insert into resumes values ('0', '$resume[fname]', '$resume[email]', '$resume[title]', '$resume[textw]', '$resume[comnt]')";

					

if (mysql_db_query ($dbname, $query, $link)){

       header("Location: http://www.switchskate.net/index.php");
   	   exit;
}

else{
 	   print ("Your information was not sent<br>\n");
	   print (" please email webmaster@switchskate.net if this is an error<br>\n");
	   print ("<br>\n");
	   print ("<br>\n");
	   print ("Name: $resume[fname]<br>\n");
	   print ("Email: $resume[email]<br>\n");
	   print ("MSN/AOL: $resume[title]<br>\n");
	   print ("Reason: $resume[textw]<br>\n");
	   print ("Comments: $resume[comnt]<br>\n");
}

mysql_close ($link);
?>