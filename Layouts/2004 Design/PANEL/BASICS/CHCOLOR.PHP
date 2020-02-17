<?php require ("http://www.switchskate.net/panel/header.php");

$host = "localhost";
$user = "switchsk_adam";
$pass = "drummer";

$FixDB="switchsk_style";
$LinkUp = mysql_connect ($host, $user, $pass);
$FixQuery = "UPDATE colors SET bg = '$bg', alt1 = '$alt1', alt2 = '$alt2', border = '$border', header = '$header', headtxt = '$headtxt', toptable = '$toptable', catagory = '$catagory', cattxt = '$cattxt', tabletxt = '$tabletxt', text = '$text', borderw = '$borderw', tablew = '$tablew', tablespace = '$tablespace', font = '$font', fontsize = '$fontsize', link = '$link', roll = '$roll', rawcss = '$rawcss', base = '$base', track = '$track', arrow = '$arrow', color = '$color', highlight = '$highlight', dark = '$dark', shadow = '$shadow', light = '$light', imagedir = '$imagedir', catback = '$catback', title = '$title' WHERE id='$edit'";
$FixResult = mysql_db_query ($FixDB, $FixQuery, $LinkUp);

if ($FixResult)
{
print ("<br><br><center>the color scheme was changed");
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