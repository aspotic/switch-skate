<?php require ("http://www.switchskate.net/panel/header.php");

$host = "localhost";
$username = "switchsk_adam";
$password = "drummer";
$dbname="switchsk_other";
$linki = mysql_connect ($host, $username, $password);
$sql = "UPDATE upscroll SET updates = '$updates' WHERE id='1'";
$result = mysql_db_query ($dbname, $sql, $linki);

if ($result)
{
print ("<br><br><center>The updates ticker was changed");
print ("<script>\n");
print ("function redirect()\n");
print ("{window.location.replace('http://www.switchskate.net/panel/index.php');}\n");
print ("setTimeout('redirect();', 1250);\n");
print ("</script>\n");

exit;
}

mysql_close ($linki);
?>
