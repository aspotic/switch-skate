<?php

	 	 $dnum = 1;
	  	 
		 if ($trickid == ""){  		
		  
				 if ($page == "") {$page = 1;}
	  	   		 $max_results = 25;
		   		 $start = (($page * $max_results) - $max_results); 
		   
				 $Query = "SELECT * FROM textcontent WHERE cat = '$type' ORDER BY date ASC LIMIT $start, $max_results";
				 $Result = mysql_db_query ($Database, $Query, $DBLink);
				 while ($row = mysql_fetch_array ($Result)) { 
					   	  	if ($subcat != "") {
							     if ($row[subcat] == $subcat) {
								 	  print ("<a href='?category=sviewtext&type=$type&subcat=$subcat&conttitle=$row[title]&trickid=$row[id]'>$row[title]</a><br />");
					   				  $dnum++;
								 }
							} elseif ($subcat == "") {
							     if (($type == "skatelink") || ($type == "comlinks")){
								 	  print ("<a href='leavesite.php?address=$row[url]' target='_blank'>$row[title]</a><br />");
					   			 $dnum++;
								 } elseif ($type == "script") {
								      print ("<a href='$row[url]' target='_blank'>$row[title]</a> - $row[writer]<br /> $row[text] <br /><br />");
								 } else {
							     	  print ("<a href='?category=sviewtext&type=$type&conttitle=$row[title]&trickid=$row[id]'>$row[title]</a><br />");
								 }
						    }					   
				 }
				 
				 $Query = "SELECT * FROM textcontent WHERE cat = '$type'";
	 			 $Result = mysql_db_query ($Database, $Query, $DBLink);
				 while ($row = mysql_fetch_array ($Result)) { 
					   	  	if ($subcat != "") {
							     if ($row[subcat] == $subcat) { $total_results++; }
							} elseif ($subcat == "") { $total_results++; }
	 			 }
		   		 $total_pages = ceil($total_results / $max_results); 
				 
		 } elseif ($trickid != "") {
		   if (($type == "skatelink") || ($type == "comlinks")) {
		   	  $Query = "SELECT * FROM textcontent WHERE id = '$trickid'";
	 		  $Result = mysql_db_query ($Database, $Query, $DBLink);
			  if ($row = mysql_fetch_array ($Result)) {
			  	   print ("<center><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />To view $conttitle popups must be enabled<br /><a href='index.php'>Home</a></center>");
			  }
		   } else {
		   	   $Query = "SELECT * FROM textcontent WHERE id = '$trickid'";
		   	   $Result = mysql_db_query ($Database, $Query, $DBLink);
		   	   
			   if ($row = mysql_fetch_array ($Result)) {
			   $conttitle = $row[title];
		 	   		 print ("<br /><br />");
					 if ($row[subcat] == "website") {print ("<a href='leavesite.php?address=$row[url]' target='_blank'>$row[title]</a> <br />");}
					 print ("<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $row[text]<br /><br />");
		 	   		 print ("$row[writer] <br /> <br />");
		 			 if ($row[image] != "") {
					 	   if ($row[cat] == "tricktip") { print ("<a href=\"$row[image]\" onClick=\"return popup(this,'dependentpopup')\">Sequence</a>"); }
						   elseif ($row[cat] == "skatereview") {
						   		  print ("<img src='$row[image]' width='200' height='200' alt='$row[title]' border='0'>");
						   } elseif ($row[cat] == "skatearticle") {
						   		  print ("<img src='$row[image]' alt='$row[title]' border='0'>");
						   }
		 			 	   
					 }
		 	   }
		   }
		 }

?>
