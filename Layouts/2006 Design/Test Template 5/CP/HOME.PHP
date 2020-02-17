<?php
	 
	 

	 $todaydash = date("Y-m-d");
	 $today = date("Ymd");
	 $usercomments = 0;
	 $textsubmissions = 0;
	 $imagesubmissions = 0;
	 $tricktips = 0;
	 $skateglossary = 0;
	 $skatereviews = 0;
	 $skatearticles = 0;
	 $skatelinks = 0;
 	 $webtutorials = 0;
	 $webreviews = 0;
	 $webarticles = 0;
	 $weblinks = 0;
	 $resumes = 0;
	 
	 $tricktipsimg = 0;
	 $skatepictures = 0;
	 $wallpaper = 0;
	 $rampplans = 0;
	  	 
	 $Query = "select * from usercomments";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 if ($row = mysql_fetch_array ($Result)) { $usercomments++; }
	 
	 $Query = "select * from textsubmissions";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array ($Result)) { 
	 
	 	if ($row[category] == "Trick Tip") { $tricktips++;
		} elseif ($row[category] == "Glossary Term") { $skateglossary++;
		} elseif ($row[category] == "Skate Review") { $skatereviews++;
		} elseif ($row[category] == "Skate Article") { $skatearticles++;
		} elseif ($row[category] == "Skate Link") { $skatelinks++;
		} elseif ($row[category] == "Tutorial") { $webtutorials++;
		} elseif ($row[category] == "Tech Review") { $webreviews++;
		} elseif ($row[category] == "Tech Article") { $webarticles++;
		} elseif ($row[category] == "Tech Script") { $webscripts++;
		} elseif ($row[category] == "Tech Link") { $weblinks++;
		} elseif ($row[category] == "Resume") { $resumes++;
		}
		
		$textsubmissions++;
	 
	 }
	 
	 
	 
	 $Query = "select * from imagesubmissions";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array ($Result)) { 
	 
	 	if ($row[category] == "Trick Tip Img") { $tricktipsimg++;
		} elseif ($row[category] == "Skate Picture") { $skatepictures++;
		} elseif ($row[category] == "Wallpaper") { $wallpaper++;
		} elseif ($row[category] == "Ramp Plan") { $rampplans++;
		}
		
		$imagesubmissions++;
	 
	 }
	 	 
	 $submissions = $textsubmissions + $imagesubmissions;
	 
	
	 
	 $Query = "select * from newsletter ORDER BY date DESC";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 if ($row = mysql_fetch_array ($Result)) { 
	 	  $splitdate = explode("-", $row[date]);
		  $splitcudate = explode("-", $todaydash);
		  
	 	  if ((($splitdate[1] < $splitcudate[1]) || ($splitdate[0] < $splitcudate[0])) && ($splitdate[2] <= $splitcudate[2])) {
		  	   print ("<a href='?category=newsletter'><b>Send monthly newsletter</b></a><br />");
		  }  	 
	 }
	 
	 
	 
	 $Query = "select * from monthlypoll ORDER BY date DESC";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 if ($row = mysql_fetch_array ($Result)) { 
	 	  $splitdate = explode("-", $row[date]);
		  $splitcudate = explode("-", $todaydash);
		  
	 	  if ((($splitdate[1] < $splitcudate[1]) || ($splitdate[0] < $splitcudate[0])) && ($splitdate[2] <= $splitcudate[2])) {
		  	   print ("<a href='?category=monthlypoll'><b>Update the monthly poll</b></a><br />");
		  }  	 
	 }
	 
	 
	 
	 $Query = "select * from weeklysite ORDER BY date DESC";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 if ($row = mysql_fetch_array ($Result)) { 
	 	  $splitdate = explode("-", $row[date]);
		  $splitcudate = explode("-", $todaydash);
		  
	 	  if ((($splitdate[1] < $splitcudate[1]) || ($splitdate[0] < $splitcudate[0])) && (30 - $splitdate[2] + $splitcudate[2]  >= 6)) {
		  	   print ("<a href='?category=weeklysite'><b>Pick new site of the week</b></a><br />");
		  } elseif ((($splitdate[1] == $splitcudate[1]) && ($splitdate[0] == $splitcudate[0])) && ($splitdate[2] + 6 < $splitcudate[2])) {
		  	   print ("<a href='?category=weeklysite'><b>Pick new site of the week</b></a><br />");
		  }
	 }		 

	 
	 	  	   		 
	 $Query = "select * from sitenews ORDER BY date DESC";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 if ($row = mysql_fetch_array ($Result)) { 
	 	  if ($row[date] < $todaydash) {
		  	 print ("<a href='?category=updatenews'><b>Add today's news</b></a><br />");
		  }
	 }
	 
	 print ("<br />");
	 
	 	 
	 if ($submissions != 0) {
	 	  print ("<b>$submissions new Submission(s)</b> <br />");
	 }
	 
	 if ($tricktips != 0) {
	 	  print ("<a href='?category=textsubmissions&cattype=Trick Tip'>$tricktips new trick tip(s)</a> <br />");
	 }
	 
	 if ($skateglossary != 0) {
	 	  print ("<a href='?category=textsubmissions&cattype=Glossary Term'>$skateglossary new skateboarding term(s)</a> <br />");
	 }
	 
	 if ($skatereviews != 0) {
	 	  print ("<a href='?category=textsubmissions&cattype=Skate Review'>$skatereviews new skateboard review(s)</a> <br />");
	 }
	 
	 if ($skatearticles != 0) {
	 	  print ("<a href='?category=textsubmissions&cattype=Skate Article'>$skatearticles new skateboard article(s)</a> <br />");
	 }
	 
	 if ($skatelinks != 0) {
	 	  print ("<a href='?category=textsubmissions&cattype=Skate Link'>$skatelinks new skateboard link (s)</a> <br />");
	 }
	 
	 if ($webtutorials != 0) {
	 	  print ("<a href='?category=textsubmissions&cattype=Tutorial'>$webtutorials new web design tutorial(s)</a> <br />");
	 }
	 
	 if ($webreviews != 0) {
	 	  print ("<a href='?category=textsubmissions&cattype=Tech Review'>$webreviews new web design review(s)</a> <br />");
	 }
	 
	 if ($webarticles != 0) {
	 	  print ("<a href='?category=textsubmissions&cattype=Tech Article'>$webarticles new web design article(s)</a> <br />");
	 }
	 
	 if ($webscripts != 0) {
	 	  print ("<a href='?category=textsubmissions&cattype=Tech Script'>$webscripts new web design script(s)</a> <br />");
	 }
	 
	 if ($weblinks != 0) {
	 	  print ("<a href='?category=textsubmissions&cattype=Tech Link'>$weblinks new web design link(s)</a> <br />");
	 }
	 
	 if ($resumes != 0) {
	 	  print ("<a href='?category=textsubmissions&cattype=Resume'>$resumes new resume(s)</a> <br />");
	 }
	 
	 if ($tricktipsimg != 0) {
	 	  print ("<a href='?category=imagesubmissions&cattype=tricktipsimg'>$tricktipsimg new trick tip image(s)</a> <br />");
	 }
	 
	 if ($skatepictures != 0) {
	 	  print ("<a href='?category=imagesubmissions&cattype=Skate Picture'>$skatepictures new skateboarding image(s)</a> <br />");
	 }
	 
	 if ($wallpaper != 0) {
	 	  print ("<a href='?category=imagesubmissions&cattype=Wallpaper'>$wallpaper new wallpaper(s)</a> <br />");
	 }
	 
	 if ($rampplans != 0) {
	 	  print ("<a href='?category=imagesubmissions&cattype=Ramp Plan'>$rampplans new ramp plan(s)</a> <br />");
	 }
	 	 
	 print ("<br />");
	 
	 
	 if ($usercomments != 0) {
	 	  print ("<a href='?category=usercomments'>$usercomments new comment(s)</a> <br />");
	 }
	 
	 
?>

