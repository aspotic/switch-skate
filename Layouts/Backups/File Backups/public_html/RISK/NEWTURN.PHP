<?php
session_start();
require("config.inc.php");
require("calcs.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

SetContinentOwners();

$cb[0] = 0; $cb[1] = 0; $cb[2] = 0; $cb[3] = 0; $cb[4] = 0; $cb[5] = 0; $cb[6] = 0;

$result = mysql_query("SELECT TurnStatus FROM risk_config");
$row = mysql_fetch_array($result, MYSQL_ASSOC);
if ($row['TurnStatus'] == "NewTurn")
{
 $result = mysql_query("UPDATE risk_config SET TurnStatus='Deploying'");

 // STANDARD ARMY BONUS
 $result = mysql_query("SELECT 1 FROM risk_countries WHERE owner='".$_SESSION['RISK_USERNUM']."'");
 $NumCountries = mysql_num_rows($result);

 // CHECK FOR CONTINENT BONUS
 $result = mysql_query("SELECT sum(bonus) as sBonus FROM risk_continents WHERE owner='".$_SESSION['RISK_USERNUM']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 if ($NumCountries < 9)
  $newarmies = 3;
 else
  $newarmies = floor($NumCountries / 3);

 $newarmies += $row['sBonus'];

 $result = mysql_query("UPDATE risk_players SET armies='$newarmies' WHERE num='".$_SESSION['RISK_USERNUM']."'");

 // SET BONUSES IN SESSION
 $result = mysql_query("SELECT num, bonus FROM risk_continents WHERE owner='".$_SESSION['RISK_USERNUM']."' ORDER BY num");
 while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
 {
  $_SESSION['cb'][$row['num']] = $row['bonus'];
 }
}

echo "<html><body>
 <script language='javascript'>
 window.parent.document.main.myturn.value='1';
 document.location.replace('deploy.php');
 </script>
 </body></html>";
?>
