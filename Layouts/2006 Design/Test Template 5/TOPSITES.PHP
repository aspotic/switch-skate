<?php

	 if ($page == "") {$page = 1;}
	 if ($page == 1) {$countup = 1;}
	 
	 $Query = "SELECT * FROM topsites ORDER BY hitsin DESC";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array($Result)) {
	 
	 	  if ($countup == 1) {
		  	    print ("$countup. <a href='leavesite.php?address=$row[siteurl]'>$row[sitetitle]</a><br />");
				if ($row[imageurl] != "") {print ("<img src='$row[imageurl]' width='88' height='31'>$row[sitedescription]<br /><br />");}
				else {print ("$row[sitedescription]<br /><br />");}
		  } elseif ($countup == 2) {
		  	    print ("$countup. <a href='leavesite.php?address=$row[siteurl]'>$row[sitetitle]</a><br />");
				if ($row[imageurl] != "") {print ("<img src='$row[imageurl]' width='88' height='31'>$row[sitedescription]<br /><br />");}
				else {print ("$row[sitedescription]<br /><br />");}
		  } elseif ($countup == 3) {
		  	    print ("$countup. <a href='leavesite.php?address=$row[siteurl]'>$row[sitetitle]</a><br />");
				if ($row[imageurl] != "") {print ("<img src='$row[imageurl]' width='88' height='31'>$row[sitedescription]<br /><br />");}
				else {print ("$row[sitedescription]<br /><br />");}
		  } elseif ($countup == 4) {
		  	    print ("$countup. <a href='leavesite.php?address=$row[siteurl]'>$row[sitetitle]</a><br />");
				if ($row[imageurl] != "") {print ("<img src='$row[imageurl]' width='88' height='31'>$row[sitedescription]<br /><br />");}
				else {print ("$row[sitedescription]<br /><br />");}
		  } elseif ($countup == 5) {
		  	    print ("$countup. <a href='leavesite.php?address=$row[siteurl]'>$row[sitetitle]</a><br />");
				if ($row[imageurl] != "") {print ("<img src='$row[imageurl]' width='88' height='31'>$row[sitedescription]<br /><br />");}
				else {print ("$row[sitedescription]<br /><br />");}
		  } elseif (($countup > 5) && ($countup < 21)) {
		  	    print ("$countup. <a href='leavesite.php?address=$row[siteurl]'>$row[sitetitle]</a><br />");
				print ("$row[sitedescription]<br /><br />");
		  } else {
		  	    print ("$countup. <a href='leavesite.php?address=$row[siteurl]'>$row[sitetitle]</a><br />");
		  }
	 
	 }

?>