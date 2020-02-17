<?php
session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

echo "
<html>
<head><style>
  select{font-family:Tahoma; background-color:black; border:1px ridge #DDDDDD; color:#DDDDDD; font-size:12px;};
</style></head>
<body bgcolor='black' onLoad='scrollTo(0,15)'>
<center>
<form name='main' onsubmit='return false'>
<select name='player' onchange=\"window.parent.document.stats.location.replace('stats.php?player='+this.value)\">";

$result = mysql_query("SELECT num, color, username FROM risk_players WHERE status > '5' ORDER BY turnorder");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
  echo "<option style='background-color:".$row['color']."' value='".$row['num']."'";
  if ($_SESSION['RISK_USERNUM'] == $row['num']) 
  {
   echo " selected";
   $mycolor = $row['color'];
  }
  echo ">".$row['username']."</option>";
}

echo "</select></form></body></html>";

?>