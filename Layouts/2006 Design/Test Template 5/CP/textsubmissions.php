	  <form name="textsubmissions" action="process.php" method="post">
	  
	  		<?php
				 
				 $dnum = 1;
	  	   		 
				 $Query = "select * from textsubmissions ORDER BY date ASC";
				 $Result = mysql_db_query ($Database, $Query, $DBLink);
				 while ($row = mysql_fetch_array ($Result)) {
	  	   		 	   
					   if ($row[category] == $cattype) {   
							print (" <table> <tr> <td> <input type='checkbox' name='delete[$dnum]' value='$row[id]' /> $row[category] </td> </tr> <tr> <td> $row[date] - $row[ip] </td> </tr> <tr> <td> $row[title] - <a href='mailto:$row[email]'>$row[name]</a> </td> </tr> <tr> <td> $row[message] <br />$row[url]</td> </tr></table><br /><br />");
					   		$dnum++;
					   }
					   
				 }
	  			 
				 print (" <input type='hidden' name='dnum' value='$dnum' /> ");
				 print (" <input type='hidden' name='CatID' value='textsubmissions' /> ");
	  	    ?>
				  	  
	  <input type="submit" value="Submit" />
	  
	  </form>