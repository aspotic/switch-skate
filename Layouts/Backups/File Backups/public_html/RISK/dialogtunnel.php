<?php
session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

if ($_POST['msg'] != $null)
{ 
 if ($_POST['to'] != 1)
 {
  $result = mysql_query("SELECT username, risk_colors.color FROM risk_colors LEFT JOIN risk_players ON risk_colors.assigned = risk_players.num WHERE assigned='".$_POST['to']."'");
  $row = mysql_fetch_array($result, MYSQL_ASSOC);

  $message = "<font color=\'".$row['color']."\'><b>[=>".$row['username']."]</b></font> ";

  $result = mysql_query("SELECT color FROM risk_colors WHERE assigned='".$_SESSION['RISK_USERNUM']."'");
  $row = mysql_fetch_array($result, MYSQL_ASSOC);

  if (substr($_POST['msg'], 0, 4) == "/me ")
   $message .= "<font color=\'".$row['color']."\'>* ".$_SESSION['RISK_USERNAME']. substr($_POST['msg'], 3) . "</font>"; 
  else
   $message .= "<font color=\'".$row['color']."\'>".$_SESSION['RISK_USERNAME']." : </font>". $_POST['msg']; 

  $result = mysql_query("INSERT INTO risk_dialog VALUES('".$_SESSION['RISK_USERNUM']."', '".date("H:i:s")."', '$message')");
 }

  $result = mysql_query("SELECT color FROM risk_colors WHERE assigned='".$_SESSION['RISK_USERNUM']."'");
  $row = mysql_fetch_array($result, MYSQL_ASSOC);

  if (substr($_POST['msg'], 0, 4) == "/me ")
   $message = "<font color=\'".$row['color']."\'>* ".$_SESSION['RISK_USERNAME']. substr($_POST['msg'], 3) . "</font>"; 
  else
   $message = "<font color=\'".$row['color']."\'>".$_SESSION['RISK_USERNAME']." : </font>". $_POST['msg']; 

  $result = mysql_query("INSERT INTO risk_dialog VALUES('".$_POST['to']."', '".date("H:i:s")."', '$message')");
}

echo "
<html><body>
 <form name='f1' method='POST' action='dialogtunnel.php'>
  <input type='hidden' name='to'>
  <input type='hidden' name='msg'>
 </form>
 <script language='javascript'>
  window.parent.document.dialog.location.replace('dialog.php');
 </script>
</body></html>";

?>
