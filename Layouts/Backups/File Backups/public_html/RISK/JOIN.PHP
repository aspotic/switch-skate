<?php

session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$result = mysql_query("SELECT CurrentGame FROM risk_config");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

if ($row['CurrentGame'] == "Starting")
{
 $_SESSION['launch'] = true;
}
elseif ($row['CurrentGame'] == "Deploying" || $row['CurrentGame'] == "Active")
{
 $result = mysql_query("SELECT turnorder FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 if ($row['turnorder'] > 0)
 {
  $result = mysql_query("UPDATE risk_players SET rejoinflag='1' WHERE num='".$_SESSION['RISK_USERNUM']."'");
  $_SESSION['launch'] = true; 
 }
 else
  $_SESSION['msg'] = "There is no match starting.";
}

else
 $_SESSION['msg'] = "There is no match starting.";

header ("Location: index.php");
?>
