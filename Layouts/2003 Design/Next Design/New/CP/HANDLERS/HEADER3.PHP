<head>
<title>Switch Skate -your top skateboarding resource-</title>

<script language="javascript">
<!--


function movein(which,html){
if (document.getElementById)
document.getElementById("boxdescription").innerHTML=html
else
boxdescription.innerHTML=html
}

function moveit(which,html){
if (document.getElementById)
document.getElementById("boxdescription2").innerHTML=html
else
boxdescription.innerHTML=html
}

//-->
</script>

<SCRIPT src="rightmenu.js" type=text/javascript>

//Right-click menu- By Eyecon (http://www.webteam.ro)
//Slight modifications by JK
//Visit JavaScript Kit (http://javascriptkit.com) for script

</SCRIPT>

<style type="text/css">

a {text-decoration:none; color=#fbf943; }
a:hover {text-decoration:none; color=#fef11e;  filter:glow(color=#0575a5,offX=5, offY=5); height:12; }

<!--
#men {
BORDER-RIGHT: 2px outset; BORDER-TOP: 2px outset; Z-INDEX: 1; LEFT: 0px; VISIBILITY: hidden; BORDER-LEFT: 2px outset; BORDER-BOTTOM: 2px outset; POSITION: absolute; TOP: 0px
}
#men A {
PADDING-RIGHT: 1px; PADDING-LEFT: 1px; PADDING-BOTTOM: 4px; MARGIN: 1px 1px 1px 16px; FONT: 12px sans-serif; WIDTH: 100%; PADDING-TOP: 3px; HEIGHT: 100%; TEXT-DECORATION: none
}
.ico {
BORDER-RIGHT: medium none; BORDER-TOP: medium none; FLOAT: left; BORDER-LEFT: medium none; BORDER-BOTTOM: medium none
}
//-->
</style>

</head>
<body topmargin="0" leftmargin="0" marginwidth="0" marginheight="0" bgcolor="#0a4c68"  text="#ffffff">

<SCRIPT type=text/javascript>
//MENU TITLE
eyesys_title="Navigation Menu"
//TITLE BACKGROUND COLORS
eyesys_titlecol1="086280"
eyesys_titlecol2="0a4c68"
//TITLE COLOR
eyesys_titletext="white"
//MENU & ITEM BACKGROUND COLOR
eyesys_bg="#667b8d"
//ITEM BACKGROUND COLOR ON MOUSE OVER
eyesys_bgov="#006699"
//MENU COLOR
eyesys_cl="white"
//MENU COLOR ON MOUSE OVER
eyesys_clov="white"
//MENU WIDTH
eyesys_width=160
//menu starts here
eyesys_init()
//menu item sintax:  eyesys_item(text,icon,link)
//for no icon use 'null'
eyesys_item('PHPMyAdmin',null,'http://host215.ipowerweb.com:8080/phpMyAdmin/index.php')
eyesys_item('CPanel',null,'http://www.switchskate.net/vdeck')
eyesys_item('E-mail',null,'http://www.switchskate.net/webmail')
eyesys_item('Forum Admin CP',null,'http://www.switchskate.net/forums/cp.php')
eyesys_item('Change Poll',null,'http://')
eyesys_item('Color Scheme',null,'extra/764.php')
eyesys_item('Change News',null,'extra/283.php')
eyesys_item('Add %',null,'extra/453.php')
eyesys_item('Add Database',null,'')
eyesys_item('Add Table to DB',null,'')
//mene closes here
eyesys_close()
</SCRIPT>


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

<table width="100%" style="border-bottom:thin solid #086280; border-top:thin solid #086280" bgcolor="#086280" valign="top"><tr bgcolor="#086280">
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
<table bgcolor="086280" width="100%"><tr><td>
<center><a href="http://www.switchskate.net/cp/index.php">Go Home</a>
</td></tr></table>




<!-- end Title/% complete-->