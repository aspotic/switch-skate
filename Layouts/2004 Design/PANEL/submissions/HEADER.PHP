<html>
<head>
		
<title>Switch Skate -The ultimate skateboarding experience-</title>
<meta name="resource-type" content="documen">
<meta name="Generator" content="switchsk Tag Generator">
<meta name="revisit-after" content="5">
<meta name="classification" content="Sports">
<meta name="description" content="Get great skateboarding trick tips here even if you aren"t a beginner.  We have a thriving community for you to chat with other skaters and so much more.">
<meta name="keywords" content="skateboard, trick tips, tricks, skateboard shop, pictures, ramp plans, message board, stories, free ramp plans, skateboard trick tips, building ramps,  trick help, trick tutorials, how to videos, how to do skateboarding tricks, snowboard tricks, learning bmx, extreme sports discussion, skateboard ramps, sports message board, ramprage, snowboarding, the boarder source, skate games">
<meta name="robots" content="ALL">
<meta name="rating" content="General">
<meta name="copyright" content="switchskate.net 2004">
<meta name="author" content="adam k">
<meta http-equiv="reply-to" content="webmaster@switchskate.net">
<meta http-equiv="Content-Language" content="english">


<?php

// Constant Variables

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 
$LinkUp = mysql_connect ($host, $user, $pass);
$ip = $_SERVER['REMOTE_ADDR']; 

// On or Not

$PickDB="switchsk_other";
$PickQuery = "SELECT * from logged WHERE id = 1";
$PickResult = mysql_db_query ($PickDB, $PickQuery, $LinkUp);
$PickRow = mysql_fetch_array($PickResult);

if (($PickRow[status] == 1) || ($ip == "69.11.111.8" ))
{

// Pick the Color Scheme

$PickDB="switchsk_style";
$PickQuery = "SELECT * from choice WHERE id = 1";
$PickResult = mysql_db_query ($PickDB, $PickQuery, $LinkUp);
$PickRow = mysql_fetch_array($PickResult);


// Connect to Styles Database

$StyleDB="switchsk_style";
$StyleQuery = "SELECT * from colors WHERE id = $PickRow[scheme]";
$StyleResult = mysql_db_query ($StyleDB, $StyleQuery, $LinkUp);
$StyleRow = mysql_fetch_array($StyleResult);


// Connect to Amount Finished

$DoneDB="switchsk_other";
$DoneQuery = "SELECT * from partdone";
$DoneResult = mysql_db_query ($DoneDB, $DoneQuery, $LinkUp);
$DoneRow = mysql_fetch_array($DoneResult);


// Connect to News Ticker Tape

$TickerDB="switchsk_other";
$TickerQuery = "SELECT * from upscroll WHERE id = 1";
$TickerResult = mysql_db_query ($TickerDB, $TickerQuery, $LinkUp);
$TickerRow = mysql_fetch_array($TickerResult);


mysql_close ($LinkUp);  //Close Database Connection



print ("<style type='text/css'>\n");
print ("a {text-decoration:none; color:$StyleRow[link]; }\n");
print ("a:hover {text-decoration:none; color:$StyleRow[roll];}\n");
print ("body {\n");
print ("font-family:$StyleRow[font];\n");
print ("color:$StyleRow[text];\n");
print ("background-color:$StyleRow[bg];\n");
print ("scrollbar-base-color:$StyleRow[base];\n");
print ("scrollbar-dark-color:$StyleRow[dark];\n");
print ("scrollbar-shadow-color:$StyleRow[shadow];\n");
print ("scrollbar-highlight-color:$StyleRow[highlight];\n");
print ("scrollbar-3dlight-color:$StyleRow[light];\n");
print ("scrollbar-arrow-color:$StyleRow[arrow];\n");
print ("scrollbar-track-color:$StyleRow[track];\n");
print ("scrollbar-color:$StyleRow[color];}\n");

print ("$StyleRow[rawcss]\n");

print ("</style>\n");

print ("</head>\n");


print ("<body topmargin='0' leftmargin='0' marginwidth='0' marginheight='0' >\n");
print ("<font face='$StyleRow[font]' color='$StyleRow[text]' >\n");


print ("<table style='width:$StyleRow[tablew]; background-color:$StyleRow[header]; border:$StyleRow[borderw]px solid $StyleRow[border];' align='center' ><tr>\n");
print ("<td><img src='$StyleRow[imagedir]logo1.gif'></td>\n");
print ("<td align='right' valign='top'>\n");

while ($DoneRow = mysql_fetch_array($DoneResult)){$numdone++;}
if ($numdone <= 100){
print ("<table border=1 align=right width=102 height=15 bordercolorlight=ffffff bordercolordark=ffffff bgcolor=ffffff cellspacing=0 cellpadding=0><tr><td>\n");
print ("<table width=$numdone height=13 bgcolor=#066d98><tr><td></td></tr></table>\n");
print ("</td></tr></table>\n");
print ("<br><font face='arial' size='2'>$numdone% COMPLETE</font>\n");
}
else{print ("SITE DONE");}
print("<table><tr><td>");
print("<a href='http://www.switchskate.net/panel/logout.php'>LOG OUT</a>");
print("</td></tr></table>");


print ("</td></tr></table>\n");




print ("<table height='$StyleRow[tablespace]'><tr><td></td></tr></table>\n");

print ("<TABLE style='width:$StyleRow[tablew]; border:$StyleRow[borderw]px solid $StyleRow[border];' cellspacing='$StyleRow[borderw]' cellPadding='6' align='center'>\n");

    print ("<TR>\n");
      print ("<TD class=mediumtxt bgcolor='$StyleRow[catback]' background='$StyleRow[catagory]' >\n");
        print ("<TABLE>\n");
	      print ("<TR class=tablerow>\n");
	        print ("<TD width='15'>\n");
print ("UPDATES:\n");
	        print ("</TD>\n");
            print ("<TD class=mediumtxt bgcolor='$StyleRow[catback]' background='$StyleRow[catagory]' align='center'width='100%'>\n");
print ("<marquee>$TickerRow[updates]</marquee>\n");
	        print ("</TD>\n");
	      print ("</TR>\n");
	    print ("</TABLE>\n");
	  print ("</TD>\n");
    print ("</TR>\n");
    print ("<TR>\n");
      print ("<TD bgcolor='$StyleRow[header]' align='center'>\n");
	    print ("<TABLE>\n");
          print ("<TR class=smalltxt>\n");
	        print ("<TD width='30'>\n");
print ("BASICS:\n");
	        print ("</TD>\n");
            print ("<TD class=smalltxt align='center' width='100%'>\n");
			print ("[ <a href='http://www.switchskate.net/panel/basics/news.php'>NEWS</a> | <a href='http://www.switchskate.net/panel/basics/scroll.php'>SCROLLER</a> | <a href='http://switchskate.net/v-web/vzpoll/admin.php'>POLL</a>]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n");
			print ("[ <a href='http://www.switchskate.net/panel/basics/color.php'>COLOR SCHEME</a> | <a href='http://www.switchskate.net/panel/basics/table.php'>ADD TABLE</a>]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n");
			print ("[ <a href='http://host215.ipowerweb.com:8080/phpMyAdmin/index.php'>PHP ADMIN</a> | <a href='http://www.switchskate.net/forums/cp.php'>FORUM ADMIN</a> | <a href='http://host215.ipowerweb.com/vdeck'>CPANEL</a> | <a href='http://host215.ipowerweb.com/webmail'>EMAIL</a> ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n");
			print ("[ <a href='http://www.switchskate.net/panel/basics/add.php'>%++</a>]\n");
	        print ("</TD>\n");
		  print ("</TR>\n");
	    print ("</TABLE>\n");
	  print ("</TD>\n");
    print ("</TR>\n");
	 print ("<TR>\n");
      print ("<TD bgcolor='$StyleRow[header]'>\n");
	    print ("<TABLE>\n");
          print ("<TR class=smalltxt width='100%'>\n");
	        print ("<TD width='100' align='left'>\n");
print ("ADD CONTENT:\n");

	        print ("</TD>\n");
            print ("<TD class=smalltxt align='center'>\n");
			print ("[ <a href='http://www.switchskate.net/panel/content/addlink.php'>Links</a> | <a href='http://www.switchskate.net/panel/content/addtrick.php'>Trick Tips</a> | <a href='http://www.switchskate.net/panel/content/addtutorial.php'>Tutorials</a> | <a href='http://www.switchskate.net/panel/content/addsbreview.php'>SB Reviews</a> | <a href='http://www.switchskate.net/panel/content/addcoreview.php'>CO Reviews</a> | <a href='http://www.switchskate.net/panel/content/addarticle.php'>Articles</a> ]\n");
	        print ("</TD>\n");
		  print ("</TR>\n");
	    print ("</TABLE>\n");
	  print ("</TD>\n");
    print ("</TR>\n");
print ("</TABLE>\n");

print ("<br>\n");

print ("<TABLE style='width:$StyleRow[tablew]; border:$StyleRow[borderw]px solid $StyleRow[border];' cellspacing='$StyleRow[borderw]' cellPadding='6' align='center'>\n");
  print ("<TBODY>\n");
  
    print ("<TR>\n");
	  print ("<TD bgolor='$StyleRow[catagory]' background='$StyleRow[catagory]' align='center'>\n");
	  print ("<b>Submissions</b>\n");
	  print ("</TD>\n");
	  print ("<TD bgolor='$StyleRow[catagory]' background='$StyleRow[catagory]' align='center'>\n");
	  print ("<b>Current Content</b>\n");
	  print ("</TD>\n");
	print ("</TR>\n");
	
	print ("<TR class=smalltxt>\n");
	  print ("<TD bgcolor='$StyleRow[alt1]' align='left'>\n");
	  print ("[ COMPUERS &nbsp; <a href='http://www.switchskate.net/panel/submissions/tutorials.php'>Tutorials</a> | <a href='http://www.switchskate.net/panel/submissions/coreviews.php'>Reviews</a> | <a href='http://www.switchskate.net/panel/submissions/colinks.php'>Links</a> ] <br>\n");
	  print ("[ OTHER STUFF &nbsp; <a href='http://www.switchskate.net/panel/submissions/resumes.php'>Resumes</a> | <a href='http://www.switchskate.net/panel/submissions/themes.php'>Themes</a> | <a href='http://www.switchskate.net/panel/submissions/comments.php'>Comments</a> ] <br>\n");
	  print ("[ SKATE &nbsp; <a href='http://www.switchskate.net/panel/submissions/tricktips.php'>Trick Tips</a> | <a href='http://www.switchskate.net/panel/submissions/articles.php'>Articles</a> | <a href='http://www.switchskate.net/panel/submissions/reviews.php'>Reviews</a> | <a href='http://www.switchskate.net/panel/submissions/storys.php'>Storys</a> | <a href='http://www.switchskate.net/panel/submissions/links.php'>Links</a> | <a href=''><strike>Pictures</strike></a> ]\n");
	  print ("</TD>\n");
	  print ("<TD bgcolor='$StyleRow[alt1]' align='left'>\n");
	  print ("[ COMPUERS &nbsp; <a href='http://www.switchskate.net/panel/content/tutorials.php'>Tutorials</a> | <a href='http://www.switchskate.net/panel/content/coreviews.php'>Reviews</a> | <a href='http://www.switchskate.net/panel/content/colinks.php'>Links</a> ] <br>\n");
	  print ("[ SKATE &nbsp; <a href='http://www.switchskate.net/panel/content/tricktips.php'>Trick Tips</a> | <a href='http://www.switchskate.net/panel/content/articles.php'>Articles</a> | <a href='http://www.switchskate.net/panel/content/sbreviews.php'>Reviews</a> | <a href='http://www.switchskate.net/panel/content/links.php'>Links</a> | <a href=''><strike>Pictures</strike></a> ]\n");
	  print ("</TD>\n");
	print ("</TR>\n");
	
  print ("</TBODY>\n");
print ("</TABLE>\n");

print ("<br>\n");

}else{
print ("<br><br><center>PLEASE LOG IN</center><br><br>");}
?>