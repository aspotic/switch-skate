	  <center><h3>Submissions</h3></center>
	  	  &nbsp;&nbsp;S&nbsp;&nbsp;&nbsp; D<br />
	  <form name="weeklysite" action="process.php" method="post">
	  
	  		<?php
				 
				 $dnum = 1;
	  	   		 
				 $Query = "select * from weeklysite ORDER BY title ASC";
				 $Result = mysql_db_query ($Database, $Query, $DBLink);
				 while ($row = mysql_fetch_array ($Result)) {
				 	   
					   if ( ($row[date] == "") || ($row[date] == 00000000) ) {
	  	   		 	   	    print (" <input name='winner' type='radio' value='$row[id]'> <input type='checkbox' name='delete[$dnum]' value='$row[id]' /> <a href='$row[url]' target='_blank'>$row[title]</a> - $row[email]<br /> ");
					   		$dnum++;
					   }
					   
				 }
	  			 
				 print (" <input type='hidden' name='dnum' value='$dnum' /> ");
				 print (" <input type='hidden' name='CatID' value='weeklysite' /> ");
	  	    ?>
				  	  
	  <input type="submit" value="Submit" />
	  
	  </form>

