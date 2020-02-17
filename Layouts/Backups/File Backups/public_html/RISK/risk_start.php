<?php
session_start();
require("config.inc.php");
require("calcs.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

// CHANGE PLAYER STATUS

$result = mysql_query("UPDATE risk_players SET status='6', bottomsrc='deploy.php' WHERE status='5'");

// SET RANDOM ORDER AND COLORS

$result = mysql_query("SELECT num FROM risk_players WHERE status='6'");

$numplayers = mysql_num_rows($result);

for ($i=0; $row = mysql_fetch_array($result, MYSQL_ASSOC); $i++)
{
 $order[$i] = $row['num'];
}

srand((float)microtime()*1000000);
shuffle($order);

for ($i=0; $i < $numplayers; $i++)
{
 $result = mysql_query("SELECT color FROM risk_colors WHERE assigned='".$order[$i]."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 $j = $i + 1;
 $result = mysql_query("UPDATE risk_players SET turnorder='$j', color='".$row['color']."' WHERE num='".$order[$i]."'");
}

// DETERMINE NUMBER OF ARMIES

switch($numplayers)
{
  case '1': $numarmies = 45; break;
  case '2': $numarmies = 35; break;
  case '3': $numarmies = 35; break;
  case '4': $numarmies = 30; break;
  case '5': $numarmies = 25; break; 
  case '6': $numarmies = 20; break;
}

if ($numplayers == 2)
{
 $order[] = 1;
 $numplayers ++;
}
// DISTRIBUTE COUNTRY CARDS

$result = mysql_query("SELECT num FROM risk_cards WHERE num <= '42'");
for ($i=0; $row = mysql_fetch_array($result, MYSQL_ASSOC); $i++)
{
 $cards[$i] = $row['num'];
}

srand((float)microtime()*1000000);
shuffle($cards);

$cardsperplayer = floor(42 / $numplayers);

$c = 0;

for ($i=0; $i < $numplayers; $i++)
{
 for ($j=0; $j < $cardsperplayer; $j++)
 {
  $result = mysql_query("UPDATE risk_countries SET owner='".$order[$i]."', armies='1' WHERE num='".$cards[$c]."'");
  $c++;
 }
}

// CHECK CONTINENTS

SetContinentOwners();

// SET ALLIES

$result = mysql_query("UPDATE risk_countries SET owner='1', armies='2' WHERE owner <= '1'");

// DEPLOY

$numarmies -= $cardsperplayer;

$result = mysql_query("UPDATE risk_players SET armies='$numarmies' WHERE status='6'");
$result = mysql_query("UPDATE risk_players SET turnflag='1' WHERE turnorder='1'");
$result = mysql_query("UPDATE risk_config SET CurrentGame='Deploying', TurnStatus='Deploying'");

echo "<html><body><script language='javascript'> window.location.replace('risk.php');</script></body></html>";

?>
