<?php

 session_start();
 require("config.inc.php");

 mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
 mysql_select_db($dbname);

 $result = mysql_query("UPDATE risk_players SET status='0' WHERE num='".$_SESSION['RISK_USERNUM']."'");

 $_SESSION['RISK_USERNUM']     = $null;
 $_SESSION['RISK_USERNAME']    = $null;
 $_SESSION['RISK_USERLEVEL']   = $null;
 $_SESSION['RISK_CURRENTGAME'] = $null;

 header ("Location: index.php");

?>
