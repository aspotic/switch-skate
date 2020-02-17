<?php

session_start();
require("config.inc.php");
require("calcs.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

if ($_POST['numarmies'] != $null)
{ 
 // CHECK TO SEE IF IT IS THE PLAYER'S TURN
 $result = mysql_query("SELECT turnflag FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 if ($row['turnflag'] == 1)
 {
  // CHECK FOR COMMON BORDER
  if (CommonBorder($_POST['from'], $_POST['to']))
  {
   // ENSURE PLAYER DOESN'T ATTACK HIMSELF
   $result = mysql_query("SELECT owner FROM risk_countries WHERE num='".$_POST['to']."'");
   $row = mysql_fetch_array($result, MYSQL_ASSOC);

   if ($row['owner'] != $_SESSION['RISK_USERNUM'])
   {
    if (ForceTradeCards(6))
     $cant = "You must trade in cards.";
    else
    {
     // CHECK NUM ARMIES
     $result = mysql_query("SELECT armies FROM risk_countries WHERE num='".$_POST['from']."'");
     $row = mysql_fetch_array($result, MYSQL_ASSOC);
 
     if ($row['armies'] > $_POST['numarmies'])
     {
      $AttArmies = $row['armies'];
      $AttDice = $_POST['numarmies'];
      // GET NUM DEFENSE
      $result = mysql_query("SELECT armies FROM risk_countries WHERE num='".$_POST['to']."'");
      $row = mysql_fetch_array($result, MYSQL_ASSOC);
      $DefArmies = $row['armies'];
      if ($DefArmies > 1)
       $DefDice = 2;
      else
       $DefDice = 1;
 
      // ROLL
      while($AttDice > 0)
      {
       srand((float)microtime()*1000000);
       $AttRolls[] = rand(1,6);
       $AttDice --;
      }
      while($DefDice > 0)
      {
       srand((float)microtime()*1000000);
       $DefRolls[] = rand(1,6);
       $DefDice --;
      }

      // COMPARE ROLLS
      rsort($AttRolls);
      rsort($DefRolls);

      // LOG
      $result = mysql_query("SELECT name, continent, color FROM risk_countries LEFT JOIN risk_players ON risk_countries.owner = risk_players.num WHERE risk_countries.num='".$_POST['from']."'");
      $row = mysql_fetch_array($result, MYSQL_ASSOC);
      $from = $row['name'];
      $fromc = $row['continent'];
      $fromcol = $row['color'];
 
      $result = mysql_query("SELECT name, continent, username, color FROM risk_countries LEFT JOIN risk_players ON risk_countries.owner = risk_players.num WHERE risk_countries.num='".$_POST['to']."'");
      $row = mysql_fetch_array($result, MYSQL_ASSOC);
      $to = $row['name'];
      $toc = $row['continent'];
      $tou = $row['username'];
      $tocol = $row['color'];

      $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
              \"<b><font color='$fromcol'>* ".$_SESSION['RISK_USERNAME']." is attacking <font class='c".$toc."'>$to</font>
               from <font class='c".$fromc."'>$from</font>
               with <font color='gray'>".$_POST['numarmies']."</font> armies.</font></b>\")"); 

      $strAttRolls = "";
      $strDefRolls = "";

      foreach($AttRolls as $roll) $strAttRolls .= "<font color='gray'>, </font>" . $roll;
      foreach($DefRolls as $roll) $strDefRolls .= "<font color='gray'>, </font>" . $roll;
      $strAttRolls = substr($strAttRolls, 28, strlen($strAttRolls));
      $strDefRolls = substr($strDefRolls, 28, strlen($strDefRolls));

      $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\", 
              \"<b><font color='$tocol'>* $tou : $strDefRolls.</b></font>\")");

      $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
              \"<b><font color='$fromcol'>* ".$_SESSION['RISK_USERNAME']." : $strAttRolls.</b></font>\")");

      $aLost = 0;
      $dLost = 0;

      // COMPARE ROLL 1
      if ($AttRolls[0] > $DefRolls[0])
      {
       $DefArmies --;
       $dLost ++;
      }
      else
      {
       $AttArmies --;
       $aLost ++;
      }

      // IF 2 ROLLS
      if ($AttRolls[1] != $null && $DefRolls[1] != $null)
      {
       // COMPARE ROLL 2
       if ($AttRolls[1] > $DefRolls[1])
       {
        $DefArmies --;
        $dLost ++;
       }
       else
       {
        $AttArmies --;
        $aLost ++;
       }
      }

      // CHECK FOR TAKEOVER
      if ($DefArmies == 0)  $takeover = true;

      $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
              \"<b><font color='$tocol'>* $tou lost <font color='gray'>$dLost</font>.</b></font>\")");

      $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
              \"<b><font color='$fromcol'>* ".$_SESSION['RISK_USERNAME']." lost <font color='gray'>$aLost</font>.</b></font>\")");

      $result = mysql_query("UPDATE risk_countries SET armies='$AttArmies' WHERE num='".$_POST['from']."'");
      $result = mysql_query("UPDATE risk_countries SET armies='$DefArmies' WHERE num='".$_POST['to']."'");
     }
     else
     {
      $cant = "You don\'t have enough armies.";
     }
    }
   }
   else
   {
    $cant = "You can\'t attack yourself.";
   }
  }
  else
  {
   $cant = "You can\'t attack that country.";
  }
 }
 else
 {
  $cant = "It\'s not your turn.";
 }
}

echo "<html><body>";

if ($cant != $null)
{
  echo "<script language='javascript'>alert('$cant');</script>";
}

echo"
 <form name='attack' method='POST' action='attacktunnel.php'>
  <input type='hidden' name='from'>
  <input type='hidden' name='to'>
  <input type='hidden' name='numarmies'>
 </form>

 <script language='javascript'>
  window.top.document.stats.location.replace('stats.php?player='+window.top.players.document.main.player.value);
  window.parent.document.attack.send.disabled = false;
  window.top.document.status.location.replace('statustunnel.php');";

if ($takeover)
{
 $takeover = "takeover.php?from=".$_POST['from']."&to=".$_POST['to']."&numarmies=".$_POST['numarmies'];
 $result = mysql_query("UPDATE risk_config SET TurnStatus='Takeover'");
 $result = mysql_query("UPDATE risk_players SET bottomsrc='$takeover' WHERE num='".$_SESSION['RISK_USERNUM']."'");
 echo "window.parent.document.location.replace('$takeover')";
}

echo "</script></body></html>";

?>
