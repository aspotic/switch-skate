<?php
session_start();
require("config.inc.php");
require("calcs.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

if ($_POST['numarmies'] != $null)
{ 
 // SET FROM
 $result = mysql_query("SELECT armies FROM risk_countries WHERE num='".$_POST['from']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);

 $newnumarmies = $row['armies'] - $_POST['numarmies'];
 $result = mysql_query("UPDATE risk_countries SET armies='$newnumarmies' WHERE num='".$_POST['from']."'");

 // SET TO  // Get Defender Num
 $result = mysql_query("SELECT owner FROM risk_countries WHERE num='".$_POST['to']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 $defender = $row['owner'];

 $result = mysql_query("UPDATE risk_countries SET armies='".$_POST['numarmies']."', owner='".$_SESSION['RISK_USERNUM']."' WHERE num='".$_POST['to']."'");

 // RESET CONTINENTS
 SetContinentOwners();

 // DONE
 $result = mysql_query("SELECT name, continent, color, risk_countries.armies FROM risk_countries LEFT JOIN risk_players ON risk_countries.owner = risk_players.num WHERE risk_countries.num='".$_POST['to']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 $mycolor = $row['color'];

 $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
        \"<b><font color='$mycolor'>* ".$_SESSION['RISK_USERNAME']." has taken <font class='c".$row['continent']."'>".$row['name']."</font> and moved in <font color='gray'>".$row['armies']."</font> armies.</font>\")");

 $result = mysql_query("UPDATE risk_config SET TurnStatus='Attacking'");
 $result = mysql_query("UPDATE risk_players SET bottomsrc='attack.php' WHERE num='".$_SESSION['RISK_USERNUM']."'");
 $result = mysql_query("UPDATE risk_players SET cardflag='1' WHERE num='".$_SESSION['RISK_USERNUM']."'");

 $ok = "window.parent.document.location.replace('attack.php');";

 // CHECK FOR DEFENDER DEATH
 if ($defender != 1)
 {
  $result = mysql_query("SELECT 1 FROM risk_countries WHERE owner='$defender'");
  if (mysql_num_rows($result) == 0)
  {
   RemovePlayer($defender);
   $result = mysql_query("UPDATE risk_players SET status='1' WHERE num='$defender'");
   $result = mysql_query("SELECT 1 FROM risk_cards WHERE owner='$defender'");
   $numcards = mysql_num_rows($result);  
   $result = mysql_query("UPDATE risk_cards SET owner='".$_SESSION['RISK_USERNUM']."' WHERE owner='$defender'");
   $ok .= "window.top.players.document.location.replace('players.php');";

   $result = mysql_query("SELECT losses FROM risk_players WHERE num='$defender'");
   $row = mysql_fetch_array($result, MYSQL_ASSOC);
   $losses = $row['losses'] + 1;
   $result = mysql_query("UPDATE risk_players SET losses='$losses' WHERE num='$defender'");

   // LOG
   $result = mysql_query("SELECT username FROM risk_players WHERE num='$defender'");
   $row = mysql_fetch_array($result, MYSQL_ASSOC);
   $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
          \"<b><font color='gray'>* ".$row['username']." died.</font>\")");

   if ($numcards > 0)
   {
    $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
           \"<b><font color='$mycolor'>* ".$_SESSION['RISK_USERNAME']." swiped
                <font color='gray'>$numcards</font> cards.</font>\")");
   }

   // CHECK FOR VICTORY
   $result = mysql_query("SELECT num FROM risk_players WHERE status='10'");
   if (mysql_num_rows($result) == 1)   $win = Victory();
  }
 }
}

echo "
<html><body>
 <form name='takeover' method='POST' action='takeovertunnel.php'>
  <input type='hidden' name='from'>
  <input type='hidden' name='to'>
  <input type='hidden' name='numarmies'>
 </form>
 <script language='javascript'>
  $ok
  $win
  window.parent.document.takeover.send.disabled = false;
 </script>
</body></html>";

?>