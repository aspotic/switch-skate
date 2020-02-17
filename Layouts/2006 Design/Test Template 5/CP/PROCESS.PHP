<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Process</title>
</head>

<body>
	  <center>
	  <?php
	  	   	 
	  	   $todaydash = date ("Y-m-d");
	  	   $today = date ("Ymd");
	  
	  	   $webmastername = "Adam K";
		   $webmasteremail = "switchskate@gmail.com";

	 	   $ipaddress =  $_SERVER['REMOTE_ADDR'];
	 
	 	   $Database = "switchsk_switch2006";
	 	   $DBUser = "switchsk_adam";
	 	   $DBPass = "drummer";
	 	   $Host = "localhost";
		   
		   if ($url == "Site URL (If needed)") { $url = ""; }
		   if ($image == "Image URL (Optional)") { $image = ""; }
		   if ($writer == "Name") { $writer = ""; }
	 
	 	   $DBLink = mysql_connect ($Host, $DBUser, $DBPass);
	  
	  	   if ($CatID == "news") {
		   	    
				$Query = "insert into sitenews values ('','$Date', '$User', '$Email', '$Title', '$Message')";
				if (mysql_db_query ($Database, $Query, $DBLink)){
				   	  echo "News Updated<br />";
				} else{
				      echo "MySQL Error <br /> ".mysql_error();
				}
				
		   } elseif ($CatID == "weeklysite") {
		   
		   	    for ($totalsites = 1; $totalsites < $dnum; $totalsites++) {

					if ($delete[$totalsites] != 0) {
					     $QueryRemove = "DELETE FROM weeklysite WHERE id = $delete[$totalsites] LIMIT 1;";
						 $Result = mysql_db_query ($Database, $QueryRemove, $DBLink);
						 if ($Result) {
						 	  print ("Site $delete[$totalsites] was deleted <br />");
						 } else {
						      echo "MySQL Error <br /> ".mysql_error();
						 }
					}
					
					if ($winner != 0) {
					      $newwin = TRUE;
					}
					
				}
				
				
				if ($newwin = TRUE) {
				     $QueryNew = "UPDATE weeklysite SET date = '$today' WHERE id = '$winner'";
				     $Result = mysql_db_query ($Database, $QueryNew, $DBLink);
				     if ($Result) {
						  print ("Site of the week updated<br />");
				     } else {
						  echo "MySQL Error <br /> ".mysql_error();
				     }
				}
				
		   } elseif ($CatID == "monthlypoll") {
		   
				$Query = "insert into monthlypoll values ('','$today', '$Question', '$Answer1', '$Answer2', '$Answer3', '$Answer4', '$Answer5', '', '', '', '', '')";
				if (mysql_db_query ($Database, $Query, $DBLink)){
				   	  echo "Poll Updated<br />";
				} else{
				      echo "MySQL Error <br /> ".mysql_error();
				} 
				   	   
		   } elseif ($CatID == "usercomments") {
		   
		   
		   	    for ($totalcomments = 1; $totalcomments < $dnum; $totalcomments++) {

					if ($delete[$totalcomments] != 0) {
					     $QueryRemove = "DELETE FROM usercomments WHERE id = $delete[$totalcomments] LIMIT 1;";
						 $Result = mysql_db_query ($Database, $QueryRemove, $DBLink);
						 if ($Result) {
						 	  print ("Comment $delete[$totalcomments] was deleted <br />");
						 } else {
						      echo "MySQL Error <br /> ".mysql_error();
						 }
					}
										
				}
				
		   } elseif ($CatID == "newsletter") {
		   
		   	    $totalemailtitle = "Switchskate Newsletter - $emailtitle";
							  
				$Query = "SELECT * FROM memberlist";
				$Result = mysql_db_query ($database, $Query, $dblink);
								 
				while ($row = mysql_fetch_array ($Result)) {
							  
					 if ( mail($row[email], $totalemailtitle ,$emailtext, "From: $webmasteremail") ) {
					  	  print ("Letter was succsefully sent <br />");
			         } else {
					      echo "MySQL Error <br /> ".mysql_error();
					 } 
				}	
			
		   } elseif ($CatID == "textsubmissions") {
		   
		   
		   	    for ($totalcomments = 1; $totalcomments < $dnum; $totalcomments++) {

					if ($delete[$totalcomments] != 0) {
					     $QueryRemove = "DELETE FROM textsubmissions WHERE id = $delete[$totalcomments] LIMIT 1;";
						 $Result = mysql_db_query ($Database, $QueryRemove, $DBLink);
						 if ($Result) {
						 	  print ("Text Submission $delete[$totalcomments] was deleted <br />");
						 } else {
						      echo "MySQL Error <br /> ".mysql_error();
						 }
					}
										
				}
				
		   } elseif ($CatID == "textcontent") {
		   
		   	    if ((($Message != "") && ($writer != "") && ($title != "")) || (($title != "") && ($url != ""))) {
				
				   	  $Query = "insert into textcontent values ('','$today', '$category', '$subcat', '$title', '$Message', '$url', '$image', '$writer')";
					  if (mysql_db_query ($Database, $Query, $DBLink)){
				   	  	   echo "Content Added<br />";
					  } else{
				      	  echo "MySQL Error <br /> ".mysql_error();
					  } 
				
				}
		   
		   	    for ($totalcomments = 1; $totalcomments < $dnum; $totalcomments++) {

					if ($delete[$totalcomments] != 0) {
					     $QueryRemove = "DELETE FROM textcontent WHERE id = $delete[$totalcomments] LIMIT 1;";
						 $Result = mysql_db_query ($Database, $QueryRemove, $DBLink);
						 if ($Result) {
						 	  print ("Text Content $delete[$totalcomments] was deleted <br />");
						 } else {
						      echo "MySQL Error <br /> ".mysql_error();
						 }
					}
										
				}
				
		   }
								 	  
	  ?>

	  		  <br />Processing Complete... <br />
			  <a href="http://www.switchskate.net/2006/site/cp/index.php">Return</a>
	  </center>
	  
	  <?php mysql_close($DBLink); ?>
	  
	  <script> window.location.replace ("http://www.switchskate.net/2006/site/cp/index.php"); </script>

</body>
</html>