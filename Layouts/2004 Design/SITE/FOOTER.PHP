<?php

// Constant Variables

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 
$LinkUp = mysql_connect ($host, $user, $pass);


// Connect to News Ticker Tape

$SBLinksDB="switchsk_cucont";
$SBLinksQuery = "SELECT * from sblinks";
$SBLinksResult = mysql_db_query ($SBLinksDB, $SBLinksQuery, $LinkUp);


mysql_close ($LinkUp);  //Close Database Connection

?>

<!--
<TABLE BGCOLOR=#888888 WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=1><TR VALIGN=TOP><TD><TABLE BGCOLOR=white BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=100%><TR VALIGN=TOP><TD>
<script>
listings = new Array ();
</script>
<script src="http://www.searchfeed.com/rd/feed/JavaScriptFeed.jsp?cat=web+hosting&trackID=F1437867538&pID=31163&nl=5&excID="></script>
<script>
if (listings != null && listings.length > 0) {
document.write("<table border=0 cellpadding=0 cellspacing=0 width=100%>");
document.write("<tr><td colspan=3><img src='http://www.searchfeed.com/Images/pixel.gif' height=4></td></tr>");
document.write("<tr>");
document.write("<td><img src='http://www.searchfeed.com/Images/pixel.gif' width=4></td>");

document.write("<td width='100%'>");
for (i = 0; i < listings.length; i++) {
var title = listings[i].title;
if (listings[i].title.length > 150)
title = listings[i].title.substring(0, 150) + "...";

document.write("<a href='" + listings[i].uri +"'><font face='verdana,sans-serif' size='1'><b>" + title + "</b></font></a><br>");


var desc = listings[i].description;
if (listings[i].description.length > 550)
desc = listings[i].description.substring(0, 550) + "...";
document.write("<font face='verdana,sans-serif' size='1'> " + desc + "</font><br>");




if (i < listings.length-1)
document.write("<br>");
}
document.write("</td>");
document.write("<td><img src='http://www.searchfeed.com/Images/pixel.gif' width=1 height=1></td>");
document.write("</tr>");
document.write("<tr><td colspan=3><img src='http://www.searchfeed.com/Images/pixel.gif' height=4></td></tr>");
document.write("</table>");
}
</script>
</TD></TR></TABLE></TD></TR></TABLE>
<br>
-->

<table style="width:<?php echo $StyleRow[tablew] ?>; background-color:<?php echo $StyleRow[alt2] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" align="center" ><tr>
<td align="center"> &copy; 2004 <a href="http://www.switchskate.net/temp/copyright.php">SwitchSkate.net</a></td>
</tr></table>
