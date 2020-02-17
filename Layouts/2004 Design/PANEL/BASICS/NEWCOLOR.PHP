<?php require ("http://www.switchskate.net/panel/header.php");

$host = "localhost";
$user = "switchsk_adam";
$pass = "drummer";

$FixDB="switchsk_style";
$LinkUp = mysql_connect ($host, $user, $pass);
$FixQuery = "INSERT INTO colors VALUES ('0', '$title', '$bg', '$alt1', '$alt2', '$border', '$header', '$headertxt', '$toptable', '$catagory', '$cattxt', '$tabletxt', '$text', '$borderw', '$tablew', '$tablespace', '$font', '$fontsize', '$link', '$roll', '$rawcss', '$base', '$track', '$arrow', '$color', '$highlight', '$dark', '$shadow', '$light', '$imagedir', '$catback')";
$FixResult = mysql_db_query ($FixDB, $FixQuery, $LinkUp);

if ($FixResult)
{
print ("<br><br><center>the color scheme was added");
print ("<script>\n");
print ("function redirect()\n");
print ("{window.location.replace('http://www.switchskate.net/panel/index.php');}\n");
print ("setTimeout('redirect();', 1250);\n");
print ("</script>\n");

exit;
}
else
{print ("<br><br><center>the color scheme was not changed due to errors<br><br>\n"); echo mysql_error ();}

mysql_close ($LinkUp);
?>
<br>