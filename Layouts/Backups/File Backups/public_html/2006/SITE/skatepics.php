<?php
	 $imagecount = 1;
	 if ($page == "") {$page = 1;}
	 $max_results = 4;
	 $start = (($page * $max_results) - $max_results); 
	 	 
	 $Query = "SELECT * FROM imagecontent WHERE category = '$type' ORDER BY date ASC LIMIT $start, $max_results";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	
	 while ($row = mysql_fetch_array ($Result)) {
	 	   	    if ($imagecount == 1 ) { $image[1] = $row[id]; if ($type != "wallpaper") {$title[1] = $row[title];} $writer[1] = $row[writer];
		   		} elseif ($imagecount == 2) { $image[2] = $row[id]; if ($type != "wallpaper") {$title[2] = $row[title];} $writer[2] = $row[writer];
		   		} elseif ($imagecount == 3) { $image[3] = $row[id]; if ($type != "wallpaper") {$title[3] = $row[title];} $title[3] = $row[title]; $writer[3] = $row[writer];
		   		} elseif ($imagecount == 4) { $image[4] = $row[id]; if ($type != "wallpaper") {$title[4] = $row[title];} $title[4] = $row[title]; $writer[4] = $row[writer];
		   		}
		   $imagecount++;	   
	 }
	 
	 
	 $Query = "SELECT * FROM imagecontent WHERE category = '$type'";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array ($Result)) {
	 	   $total_results++;
	 }
	 $total_pages = ceil($total_results / $max_results); 

?>




<table>
	   <tr>
	   	   <td>
		   	   
		   	   <?php
			   		if ($image[1] != "") {
					     print ("<table>");
	   	   	   		     print ("<tr><td style='border:2 solid #3A4A69;' bgcolor='#666666'><a href='image.php?table=imagecontent&iid=$image[1]' target='_blank'><img src='image.php?table=imagecontent&iid=$image[1]' width='200' height='200' border='0' /></a> </td></tr>");
		   	   			 if ($type != "wallpaper") { print ("<tr><td style='border:2 solid #3A4A69;' bgcolor='#777777'>$title[1] </td></tr>");}
		   	   			 print ("<tr><td style='border:2 solid #3A4A69;' bgcolor='#888888'>$writer[1] </td></tr>");
						 print ("</table>");
					}
			   ?>
	   	   </td>
		   <td>
		   	   
		   	   <?php
			   		if ($image[2] != "") {
					     print ("<table>");
	   	   	   		     print ("<tr><td style='border:2 solid #3A4A69;' bgcolor='#666666'><a href='image.php?table=imagecontent&iid=$image[2]' target='_blank'><img src='image.php?table=imagecontent&iid=$image[2]' width='200' height='200' border='0' /></a> </td></tr>");
		   	   			 if ($type != "wallpaper") { print ("<tr><td style='border:2 solid #3A4A69;' bgcolor='#777777'>$title[2]</td></tr>"); }
		   	   			 print ("<tr><td style='border:2 solid #3A4A69;' bgcolor='#888888'>$writer[2]</td></tr>");
						 print ("</table>");
					}
			   ?>
	   	   </td>
	   </tr>
	   <tr>
	   	   <br />
	   </tr>
	   <tr>
	   	   <td>
		   	   <?php
			   		if ($image[3] != "") {
					     print ("<table>");
	   	   	   		     print ("<tr><td style='border:2 solid #3A4A69;' bgcolor='#666666'><a href='image.php?table=imagecontent&iid=$image[3]' target='_blank'><img src='image.php?table=imagecontent&iid=$image[3]' width='200' height='200' border='0' /></a> </td></tr>");
		   	   			 if ($type != "wallpaper") { print ("<tr><td style='border:2 solid #3A4A69;' bgcolor='#777777'>$title[3]</td></tr>"); }
		   	   			 print ("<tr><td style='border:2 solid #3A4A69;' bgcolor='#888888'>$writer[3]</td></tr>");
						 print ("</table>");
					}
			   ?>
	   	   </td>
		   <td>
		   	   <?php
			   		if ($image[4] != "") {
					     print ("<table>");
	   	   	   		     print ("<tr><td style='border:2 solid #3A4A69;' bgcolor='#666666'><a href='image.php?table=imagecontent&iid=$image[4]' target='_blank'><img src='image.php?table=imagecontent&iid=$image[4]' width='200' height='200' border='0' /></a> </td></tr>");
		   	   			 if ($type != "wallpaper") { print ("<tr><td style='border:2 solid #3A4A69;' bgcolor='#777777'>$title[4]</td></tr>"); }
		   	   			 print ("<tr><td style='border:2 solid #3A4A69;' bgcolor='#888888'>$writer[4]</td></tr>");
						 print ("</table>");
					}
			   ?>
	   	   </td>
	   </tr>
</table>
