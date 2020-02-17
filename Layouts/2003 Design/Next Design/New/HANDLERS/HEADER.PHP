<head>
<title>Switch Skate -your top skateboarding resource-</title>
<style type="text/css">
a {text-decoration:none; color=#fbf943; }
a:hover {text-decoration:none; color=#fef11e;  filter:glow(color=#0575a5,offX=5, offY=5); height:12; }
</style>
</head>
<body topmargin="0" leftmargin="0" marginwidth="0" marginheight="0" bgcolor="#0a4c68"  text="#ffffff">

<!--Title/% complete-->
<table width=100% align="center" bgcolor="667b8d"><tr>
<td><img src="http://www.switchskate.net/images/logo1.gif"></td>
<td align="right" valign="top">
<?php
$host = "localhost";
$username = "switchsk_adam";
$password = "drummer";
$dbname="switchsk_other";

$link = mysql_connect ($host, $username, $password);
$query = "SELECT * from complete";
$result = mysql_db_query ($dbname, $query, $link);
$row = mysql_fetch_array($result);
while ($row = mysql_fetch_array($result)){$numdone++;}
if ($numdone <= 100){
print ("<table border=1 align=right width=102 height=15 bordercolorlight=ffffff bordercolordark=ffffff bgcolor=ffffff cellspacing=0 cellpadding=0><tr><td>\n");
print ("<table width=$numdone height=13 bgcolor=#066d98><tr><td></td></tr></table>\n");
print ("</td></tr></table>\n");
print ("<br><font face='arial' size='2'>$numdone% COMPLETE</font>\n");
}
else{print ("DONE");}


mysql_close ($link);
?>
</td></tr></table>

<table width="100%" style="border-bottom: thin solid #086280;border-top: thin solid #086280" bgcolor="#086280" valign="top"><tr bgcolor="#086280">
<td width="15" bgcolor="#0a4c68">UPDATES:</td>
<td>
<?php
// NEWS TICKER
$host = "localhost";
$username = "switchsk_adam";
$password = "drummer";
$dbname="switchsk_other";

$link = mysql_connect ($host, $username, $password);
$query = "SELECT * from news";
$result = mysql_db_query ($dbname, $query, $link);
$row = mysql_fetch_array($result);

print ("<marquee><font face='arial'> $row[marquee] </font></marquee>\n");

mysql_close ($link);
// END NEWS TICKER
?>
</td></tr></table>

<!-- end Title/% complete-->