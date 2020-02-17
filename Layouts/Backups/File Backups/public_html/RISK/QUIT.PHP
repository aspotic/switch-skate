<?php
session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$result = mysql_query("SELECT color FROM risk_colors WHERE assigned='".$_SESSION['RISK_USERNUM']."'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$mycolor = $row['color'];
$result = mysql_query("SELECT dialog FROM risk_dialog");
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$msgs = $row['dialog'] . "<font color='$mycolor'>* ".$_SESSION['RISK_USERNAME']." has left the lobby.</font><br>";
$result = mysql_query("UPDATE risk_dialog SET dialog=\"$msgs\"");

$result = mysql_query("UPDATE risk_players SET status='1' WHERE num='".$_SESSION['RISK_USERNUM']."'");
$result = mysql_query("UPDATE risk_colors SET assigned='0' WHERE assigned='".$_SESSION['RISK_USERNUM']."'");

echo "<html><body><script language='javascript'>window.top.close();</script></body></html>";
?>
