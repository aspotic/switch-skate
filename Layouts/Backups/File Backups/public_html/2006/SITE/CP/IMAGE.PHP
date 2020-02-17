<?php

  $Database = "switchsk_switch2006";
  $DBUser = "switchsk_adam";
  $DBPass = "drummer";
  $Host = "localhost";
	 
  $DBLink = mysql_connect ($Host, $DBUser, $DBPass);

  if ($iid == "") {} else {
	 
	 $Query = "SELECT * FROM $table WHERE id=$iid";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 
	 if ($row = mysql_fetch_array ($Result)) {
	   		
  		  print ("$row[content]");
	 
	 }
	 
  }
		 

  
  mysql_close ($DBLink);

?>
