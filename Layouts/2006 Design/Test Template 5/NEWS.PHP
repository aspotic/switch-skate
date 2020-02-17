	  <?php
	  	   
		   if ($page == "") {$page = 1;}
	  	   $max_results = 3;
		   $start = (($page * $max_results) - $max_results); 
	  	  
	  	   $Query = "select * from sitenews ORDER BY date DESC LIMIT $start, $max_results";
		   $Result = mysql_db_query ($Database, $Query, $DBLink);
		   while ($row = mysql_fetch_array ($Result)) {
				 	   
				print ("<table> <tr> <td>");
				print ("$row[date] - $row[title]");
				print ("</td> </tr> <tr> <td>");
				print ("$row[text]</a>");
				print ("</td> </tr> <tr> <td>");
				print ("<a href='mailto:$row[email]'>$row[user]");
				print ("</td> </tr> </table><br /><br />");
					   
		   }
		   
		   $total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM sitenews"),0); 
		   $total_pages = ceil($total_results / $max_results); 
	  ?>
