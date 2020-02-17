<?php

session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$result = mysql_query("UPDATE risk_players SET stamp='".time()."' WHERE num='".$_SESSION['RISK_USERNUM']."'");

// CHECK FOR ENDED GAME OR REJOIN

$result = mysql_query("SELECT CurrentGame, TurnStatus FROM risk_config");
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$CurrentGame = $row['CurrentGame'];
if ($CurrentGame == "Inactive") 
{
  echo "<html><body><script language='javascript'>
          if (window.top.RiskWindow) window.top.RiskWindow.close();
          alert(\"The game was ended by ".$row['TurnStatus'].".\\n\\nClick Ok to close the window.\");
          window.top.close();
        </script></body></html>";

} // !ENDGAME
elseif ($CurrentGame == "Deploying" || $CurrentGame == "Active")
{
 $result = mysql_query("SELECT rejoinflag FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 if ($row['rejoinflag'] == 1)
 {
  $result = mysql_query("UPDATE risk_players SET rejoinflag='0' WHERE num='".$_SESSION['RISK_USERNUM']."'");
  $evt = "window.top.StartRisk('risk.php');";
 }
 else
 {
  if ($CurrentGame == "Deploying")
  {
   // CHECK FOR LAUNCH
   $result = mysql_query("SELECT status FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
   $row = mysql_fetch_array($result, MYSQL_ASSOC);

   if($row['status'] == 6)
   {
    $result = mysql_query("UPDATE risk_players SET status='10' WHERE num='".$_SESSION['RISK_USERNUM']."'");
    $evt = "window.top.StartRisk('risk.php');";
   }
  }
 }
}

$result = mysql_query("SELECT risk_players.num, colornum, username FROM risk_colors
                        LEFT JOIN risk_players ON (risk_colors.assigned = risk_players.num)
                        ORDER BY colornum");
echo "
<html>
 <head>
  <META HTTP-EQUIV='Refresh' content='5;URL=http://$server/ptunnel.php'>
 </head>
 <body>

  <script language='javascript'>";

while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
 echo "window.parent.document.playerlist.p".$row['colornum'].".value = '".$row['username']."';
       window.parent.document.playerlist.p".$row['colornum'].".id = '".$row['num']."';";
}

echo "$evt
  </script>
 </body>
</html>";

?>
