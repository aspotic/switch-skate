<form name="textsubmissions" action="process.php" method="post">
	  
	  		<?php
				 
				 $dnum = 1;
	  	   		 
				 $Query = "select * from textcontent ORDER BY date ASC";
				 $Result = mysql_db_query ($Database, $Query, $DBLink);
				 while ($row = mysql_fetch_array ($Result)) {
					   if ($row[cat] == $type) {   
					   	  	if ($subcat != "") {
							     if ($row[subcat] == $subcat) {
								 	  print ("<table> <tr> <td> <input type='checkbox' name='delete[$dnum]' value='$row[id]' /> $row[cat] - $row[subcat] </td> </tr> <tr> <td> $row[date] </td> </tr> <tr> <td> $row[title] - $row[writer]</td> </tr> <tr> <td> $row[text] </td> </tr> <tr> <td> $row[image] </td> </tr> <tr> <td> $row[url] </td> </tr> </table><br /><br />");
					   				  $dnum++;
								 }
							} elseif ($subcat == "") {
							     print ("<table> <tr> <td> <input type='checkbox' name='delete[$dnum]' value='$row[id]' /> $row[cat] - $row[subcat] </td> </tr> <tr> <td> $row[date] </td> </tr> <tr> <td> $row[title] - $row[writer]</td> </tr> <tr> <td> $row[text] </td> </tr> <tr> <td> $row[image] </td> </tr> <tr> <td> $row[url] </td> </tr> </table><br /><br />");
					   			 $dnum++;
						    }
					   }
					   
				 }
				 
				 print (" <input type='text' name='writer' value='Name' onclick='javascript:select()' /> <br /> ");
				 print (" <input type='text' name='title' value='Title' onclick='javascript:select()' /> <br />");
				 print (" <input type='text' name='url' value='Site URL (If needed)' onclick='javascript:select()' /> <br />");
				 print (" <input type='text' name='image' value='Image URL (Optional)' onclick='javascript:select()' /> <br />");
				 print (" <textarea name='Message' style='width:450; height:200;' ></textarea> <br /> ");
				 	  			 
				 print (" <input type='hidden' name='category' value='$type' /> ");
				 print (" <input type='hidden' name='subcat' value='$subcat' /> ");
				 print (" <input type='hidden' name='type' value='$type' /> ");
				 print (" <input type='hidden' name='dnum' value='$dnum' /> ");
				 print (" <input type='hidden' name='CatID' value='textcontent' /> ");
	  	    ?>
				  	  
	  <input type="submit" value="Submit" />
	  
	  </form>
