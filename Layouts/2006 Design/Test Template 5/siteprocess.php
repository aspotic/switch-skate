<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Process</title>
</head>

<body>
	  <?php
	  
	  	   $today = date ("Ymd");
	  
	  	   $webmastername = "Adam K";
		   $webmasteremail = "switchskate@gmail.com";

	 	   $ipaddress =  $_SERVER['REMOTE_ADDR'];
	 
	 	   $Database = "switchsk_switch2006";
	 	   $DBUser = "switchsk_adam";
	 	   $DBPass = "drummer";
	 	   $Host = "localhost";
	 
	 	   $DBLink = mysql_connect ($Host, $DBUser, $DBPass);
	  
	  	   if ($CatID == "poll") {
		   	    $Query = "select * from monthlypoll ORDER BY date DESC";
	 			$Result = mysql_db_query ($Database, $Query, $DBLink);
	 			if ($row = mysql_fetch_array ($Result)) { $updatepoll = $row[$poll] + 1; $ipss = $row[ips];}
				$totalips = "$ipaddress:$ipss";
					 	
		   	    $QueryNew = "UPDATE monthlypoll SET $poll = '$updatepoll', ips = '$totalips' WHERE id = '$ID'";
				     $Result = mysql_db_query ($Database, $QueryNew, $DBLink);
				     if ($Result) {
						  print ("Your answer was added");
				     } else {
						  echo "MySQL Error <br /> ".mysql_error();
				     }
				
				$Query = "select * from monthlypoll ORDER BY date DESC";
	 			$Result = mysql_db_query ($Database, $Query, $DBLink);
	 			if ($row = mysql_fetch_array ($Result)) { 
		   		     $Results = $row[result1] + $row[result2] + $row[result3] + $row[result4] + $row[result5];
			  
			  		 if ($Results != 0) {$multiplier = 100/$Results;} else {$multiplier = 0;}
			  
			  		 $Result1 = $row[result1]*$multiplier;
			  		 $Result2 = $row[result2]*$multiplier;
			  		 $Result3 = $row[result3]*$multiplier;
			  		 $Result4 = $row[result4]*$multiplier;
			  		 $Result5 = $row[result5]*$multiplier;
					 
					 $EndResult1 = round($Result1, 1);
					 $EndResult2 = round($Result2, 1);
					 $EndResult3 = round($Result3, 1);
					 $EndResult4 = round($Result4, 1);
					 $EndResult5 = round($Result5, 1);
			  
			  		 echo "<br /><h5>Poll Results</h5>";
			  		 echo "$row[question]<br /><br />";
			  
			  		 echo "$row[answer1]: $EndResult1% : $row[result2] votes<br />";
			  		 echo "$row[answer2]: $EndResult2% : $row[result2] votes<br />";
			  		 echo "$row[answer3]: $EndResult3% : $row[result3] votes<br />";
			  		 echo "$row[answer4]: $EndResult4% : $row[result4] votes<br />";
			  		 echo "$row[answer5]: $EndResult5% : $row[result5] votes<br />";
				}
				  
		   } elseif ($CatID == "newsletter") {
		   	     $totalemailtitle = "Switchskate Email Form - $emailtitle";
				 
		   	     if ( mail($webmasteremail, $totalemailtitle ,$emailtext, "From: $email") ) {
					  	  print ("Letter was succsefully sent <br />");
			         } else {
					      echo "MySQL Error <br /> ".mysql_error();
					 } 
		   
		   } elseif ($CatID == "submitsotw") {
				$Query = "insert into weeklysite values ('','$Date', '$Title', '$URL', '$Email')";
				if (mysql_db_query ($Database, $Query, $DBLink)){
				   	  echo "$Title was submitted<br />";
				} else{
				      echo "MySQL Error <br /> ".mysql_error();
				}
				
		   } elseif ($CatID == "submittopsite") {
				$Query = "insert into topsites values ('','$xmbuser', '$Title', '$URL', '$ImageURL', '$Description')";
				if (mysql_db_query ($Database, $Query, $DBLink)){
				   	  echo "Your site was added<br />";
				} else{
				      echo "MySQL Error <br /> ".mysql_error();
				}
				
		   }
								 	  
	  ?>

			  
			  <a href="http://www.switchskate.net/2006/site/">Return</a>
	  
	  <?php mysql_close($DBLink); 
	  
	  if ($CatID != "poll") {
	  	   echo "<script> window.location.replace ('http://www.switchskate.net/2006/site/'); </script>";
	   } ?>
</body>
</html>

























