  
<?php

	 $counter = 1;

	 
	 if ($remove != "") {
	 
	 	   $Query = "DELETE FROM imagesubmissions where id = '$remove' LIMIT 1";
		   $Result = mysql_db_query ($Database, $Query, $DBLink);
		   if ($Result) {} 
		   else {
				echo "MySQL Error <br /> ".mysql_error();
		   }
	 
	 
	 }
	 
	 
	 if ($image != "") {
	 	   print ("<img src='image.php?table=imagesubmissions&iid=$image' width='200' height='200' /><br /><br />");
	 }
	 
	 
	 $Query = "SELECT * FROM imagesubmissions ORDER BY date DESC";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array ($Result)) {
	 	   
		   if ($type == $row[category]) {
	 	   	    echo "$counter. <a href='?category=viewimage&type=$type&image=$row[id]'>$row[title]</a> by <a href='mailto:$row[email]'>$row[name]</a> [<a href='?category=viewimage&type=$type&remove=$row[id]'>Delete</a>] ";
		   		$counter++;
		   }
	 
	 }
	 


?>	  
