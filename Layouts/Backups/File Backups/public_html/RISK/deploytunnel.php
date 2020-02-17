<?php

session_start();
require("config.inc.php");
require("calcs.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

if ($_POST['country'] != $null)
{ 
 // CHECK TO SEE IF IT IS THE PLAYER'S TURN
 $result = mysql_query("SELECT turnflag FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 if ($row['turnflag'] == 1)
 {
  // CHECK FOR INITIAL DEPLOYMENT
  $result = mysql_query("SELECT CurrentGame FROM risk_config");
  $row = mysql_fetch_array($result, MYSQL_ASSOC);
  if ($row['CurrentGame'] == 'Deploying' && $_POST['numarmies'] > 1)
  {
   $cant = "You can only deploy 1 army during the initial deployment.";
  }
  else
  {
   $CG = ($row['CurrentGame'] == 'Deploying');
   // CHECK TO SEE IF PLAYER HAS ENOUGH ARMIES
   $result = mysql_query("SELECT armies, color FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
   $row = mysql_fetch_array($result, MYSQL_ASSOC);
   $mycolor = $row['color'];
   $playernumarmies = $row['armies'];
   if ($playernumarmies >= $_POST['numarmies'])
   {
    // GET CURRENT NUM ARMIES ON COUNTRY
    $result = mysql_query("SELECT armies FROM risk_countries WHERE num='".$_POST['country']."'");
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
    $numarmies = $row['armies'];

    if ($CG)
    {
     $DeployNextTurn = true;
     $ok = true;
    }
    else
    {
     // CHECK CARDS / FORCE TRADE
     if (ForceTradeCards(5))
     {
      $cant = "You must trade in cards.";
     }
     else
     {
      // ENSURE PLAYER RESPECTS BONUS ARMIES => CONTINENTS
      $result = mysql_query("SELECT continent FROM risk_countries WHERE num='".$_POST['country']."'");
      $row = mysql_fetch_array($result, MYSQL_ASSOC);

      // If deploying to continent with bonus, adjust bonuses
      $restore = $_SESSION['cb'][$row['continent']];
      if ($_SESSION['cb'][$row['continent']] > 0)
      {
        $_SESSION['cb'][$row['continent']] -= $_POST['numarmies'];
        if ($_SESSION['cb'][$row['continent']] < 0) $_SESSION['cb'][$row['continent']] = 0;
      }
      if (($playernumarmies - $_POST['numarmies']) < array_sum($_SESSION['cb']))
      {
       // If deploying to continent with bonus, re-adjust bonuses
       $_SESSION['cb'][$row['continent']] = $restore;
      
       $cant = "You need to deploy your continent bonuses on the same continent.\\nHere are your remaining bonuses:\\n";
       foreach ($_SESSION['cb'] as $key => $value)
       {
        if ($value > 0)
        {
         $result = mysql_query("SELECT name FROM risk_continents WHERE num='$key'");
         $row = mysql_fetch_array($result, MYSQL_ASSOC);
         $cant .= "\\n". $row['name'] . ": ". $_SESSION['cb'][$key];
        }
       } //!foreach
      }
      else $ok = true;
     } // !ELSE - TRADE CARDS
    } // ! CHECK CONTINENT BONUSES

    if ($ok)
    {
     // ADD ARMIES TO COUNTRY, REMOVE ARMIES FROM PLAYER
     $numarmies += $_POST['numarmies']; 
     $result = mysql_query("UPDATE risk_countries SET armies='$numarmies' WHERE num='".$_POST['country']."'");
     $result = mysql_query("SELECT armies FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
     $row = mysql_fetch_array($result, MYSQL_ASSOC);
     $newnumarmies = $row['armies'] - $_POST['numarmies'];
     $result = mysql_query("UPDATE risk_players SET armies='$newnumarmies' WHERE num='".$_SESSION['RISK_USERNUM']."'");   

     // LOG
     $result = mysql_query("SELECT name, continent FROM risk_countries WHERE num='".$_POST['country']."'");
     $row = mysql_fetch_array($result, MYSQL_ASSOC);
     $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
             \"<b><font color='$mycolor'>* ".$_SESSION['RISK_USERNAME']." deployed 
             <font color='gray'>".$_POST['numarmies']."</font>
             armies in <font class='c".$row['continent']."'>".$row['name']."</font>.</b></font>\")");
    }
   }
   else
   {
    $cant = "You don\'t have that many armies.";
    $newnumarmies = 1;
   }
  }
 }
 else
 {
  $cant = "It isn\'t your turn.";
  $newnumarmies = 1;
 }
}

if ($cant != NULL)
{
  echo "<script language='javascript'>alert('$cant');</script>";
}

echo "<html><body>

 <form name='deploy' method='POST' action='deploytunnel.php'>
  <input type='hidden' name='country'>
  <input type='hidden' name='numarmies'>
 </form>

 <script language='javascript'>
  window.top.document.stats.location.replace('stats.php?player='+window.top.players.document.main.player.value);
  window.parent.document.deploy.send.disabled = false;";
// INIT DEPLOY - NEXT PLAYER'S TURN

if ($_POST['country'] != $null)
{
 if ($DeployNextTurn)
 {
  // CHECK TO SEE IF INIT DEPLOY IS OVER
  $result = mysql_query("SELECT sum(armies) as sArmies FROM risk_players");
  $row = mysql_fetch_array($result, MYSQL_ASSOC);
 
  if ($row['sArmies'] == 0)
  {
   $result = mysql_query("UPDATE risk_config SET CurrentGame='Active'");
  }
  NextPlayersTurn();
 }
 else // NOT INIT DEPLOY
 {
  if ($newnumarmies == 0 && $ok)
  {
   $result = mysql_query("UPDATE risk_config SET TurnStatus='Attacking'");
   $result = mysql_query("UPDATE risk_players SET bottomsrc='attack.php' WHERE num='".$_SESSION['RISK_USERNUM']."'");
   echo "window.parent.document.location.replace('attack.php');";
  }
 }
}

echo "
  window.top.document.status.location.replace('statustunnel.php');
 </script>
</body></html>";

?>
