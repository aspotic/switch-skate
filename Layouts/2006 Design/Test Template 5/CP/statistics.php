<?php
	 
	 

	 $todaydash = date("Y-m-d");
	 $today = date("Ymd");
	 
	 $textsubmissions = 0;
	 $imagesubmissions = 0;
	 $textcontent = 0;
	 $forummembers = 0;
	 $sitemembers = 0;
	 $privateposts = 0;
	 $publicposts = 0;
	 $imagecontent = 0;
	 $textcontent = 0;
	 $tricktips = 0;
	 $tutorials = 0;
	 $uniquehits = 0;
	 
	 
	 
	 
	 $Query = "select * from textsubmissions";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array ($Result)) { $textsubmissions++; }
	 	 
	 $Query = "select * from image";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array ($Result)) { $imagesubmissions++; }
 
	 $Query = "select * from textcontent";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array ($Result)) { $textcontent++; }
 
 	 $content = $imagecontent + $textcontent;
 
 
 
 
     print ("$sitemembers Site Member(s) <br /> ");
	 print ("$forummembers Forum Member(s) <br /> ");
	 print ("$uniquehits Unique hit(s) today <br /> ");
	 print ("$privateposts Private Post(s) <br /> ");
	 print ("$publicposts Public Post(s) <br /> ");
	 print ("$textsubmissions Textual Submission(s) <br /> ");  //
	 print ("$imagesubmissions Image Submission(s) <br /> ");   //
	 print ("$content Content Article(s) <br /> ");
	 print ("$textcontent Text Aritcle(s) <br /> ");            //
	 print ("$imagecontent Image Article(s) <br /> ");
	 print ("$tricktips Trick Tip(s) <br /> ");
	 print ("$tutorials Tutorial(s) ");

?>
