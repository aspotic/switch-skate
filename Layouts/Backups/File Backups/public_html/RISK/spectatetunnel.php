<?php
session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$result = mysql_query("UPDATE risk_players SET stamp='".time()."' WHERE num='".$_SESSION['RISK_USERNUM']."'");

// GET CURRENT TURN

$result = mysql_query("SELECT num, username, armies, color FROM risk_players WHERE turnflag='1'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$cuser = $row['username'];
// SET TURN COLORS & CHECK FOR NEW TURN

$fgcolor = $row['color'];

// CHECK FOR VICTORY

$result = mysql_query("SELECT CurrentGame, TurnStatus FROM risk_config");
$row = mysql_fetch_array($result, MYSQL_ASSOC);
if ($row['CurrentGame'] == "Complete")
{
 $evt = "window.top.document.location.href('win.php');";
}
elseif ($row['CurrentGame'] == 'Inactive')
{
 $evt = "alert('The game has been ended by TheWulf.\\n\\nClick Ok to close the window.');
         window.top.close();";
}

echo "<html>
<head>
<META HTTP-EQUIV='Refresh' content='10;URL=http://$server/spectatetunnel.php'>
<script language='javascript'>
 window.parent.document.main.cturn.value = '$cuser';
 window.parent.document.main.cturn.style.color = '$fgcolor';
 window.parent.document.overlay.location.replace('mapoverlay.php');
 $evt
</script>
<body>
</body></html>";
?>
