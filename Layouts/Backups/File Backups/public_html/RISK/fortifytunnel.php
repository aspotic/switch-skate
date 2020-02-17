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
  if ($_POST['numarmies'] > 0)
  {
   // CHECK FOR COMMON BORDER
   if (CommonBorder($_POST['from'], $_POST['to']))
   {
    if (ForceTradeCards(6))
     $cant = "You must trade in cards.";
    else
    {
     // ENSURE PLAYER OWNS BOTH COUNTRIES
     $result = mysql_query("SELECT owner FROM risk_countries WHERE num='".$_POST['to']."'");
     $row = mysql_fetch_array($result, MYSQL_ASSOC);

     if ($row['owner'] == $_SESSION['RISK_USERNUM'])
     {
      // CHECK NUM ARMIES
      $result = mysql_query("SELECT armies FROM risk_countries WHERE num='".$_POST['from']."'");
      $row = mysql_fetch_array($result, MYSQL_ASSOC);

      if ($row['armies'] > $_POST['numarmies'])
      {
       $newnumarmiesFrom = $row['armies'] - $_POST['numarmies'];
       $result = mysql_query("UPDATE risk_countries SET armies='$newnumarmiesFrom' WHERE num='".$_POST['from']."'");

       $result = mysql_query("SELECT armies FROM risk_countries WHERE num='".$_POST['to']."'");
       $row = mysql_fetch_array($result, MYSQL_ASSOC);
       $newnumarmiesTo = $row['armies'] + $_POST['numarmies'];
       $result = mysql_query("UPDATE risk_countries SET armies='$newnumarmiesTo' WHERE num='".$_POST['to']."'");

       // LOG

       $result = mysql_query("SELECT name, continent, color FROM risk_countries LEFT JOIN risk_players ON risk_countries.owner = risk_players.num WHERE risk_countries.num='".$_POST['from']."'");
       $row = mysql_fetch_array($result, MYSQL_ASSOC);
       $from = $row['name'];
       $fromc = $row['continent'];
       $fromcol = $row['color'];

       $result = mysql_query("SELECT name, continent FROM risk_countries WHERE num='".$_POST['to']."'");
       $row = mysql_fetch_array($result, MYSQL_ASSOC);
       $to = $row['name'];
       $toc = $row['continent'];

       $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
               \"<b><font color='$fromcol'>* ".$_SESSION['RISK_USERNAME']." moved 
               <font color='gray'>".$_POST['numarmies']."</font> from
               <font class='c".$fromc."'>$from</font> to <font class='c".$toc."'>$to</font>.</font></b>\")");

       EOTCheckForCard();

       $ok = "window.parent.document.location.replace('deploy.php');
              window.top.document.main.myturn.value = 0;";
       NextPlayersTurn();
      }
      else
      {
       $cant = "You don\'t have enough armies.";
      }
     }
     else
     {
      $cant = "You don\'t own these 2 countries.";
     }
    } // !FORCE TRADE
   }
   else
   {
    $cant = "These countries have no common borders.";
   }
  }
  else
  {
   // NO FORTIFY

   $result = mysql_query("SELECT color FROM risk_colors WHERE assigned='".$_SESSION['RISK_USERNUM']."'");
   $row = mysql_fetch_array($result, MYSQL_ASSOC);
   $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
            \"<b><font color='".$row['color']."'>* ".$_SESSION['RISK_USERNAME']." moved 
            <font color='gray'>nothing</font>.</font></b>\")");

   EOTCheckForCard();

   $ok = "window.parent.document.location.replace('deploy.php');
          window.top.document.main.myturn.value = 0;";
   NextPlayersTurn();

   // !NO FORTIFY
  }
 }
 else
  $cant = "It\'s not your turn.";
}

echo "<html><body>";

if ($cant != NULL)
  echo "<script language='javascript'>alert('$cant');</script>";
elseif ($ok != NULL)
  $result = mysql_query("UPDATE risk_players SET bottomsrc='deploy.php' WHERE num='".$_SESSION['RISK_USERNUM']."'");

echo"
 <form name='fortify' method='POST' action='fortifytunnel.php'>
  <input type='hidden' name='from'>
  <input type='hidden' name='to'>
  <input type='hidden' name='numarmies'>
 </form>

 <form name='skip' method='POST' action='fortifytunnel.php'>
  <input type='hidden' name='numarmies' value='0'>
 </form>

 <script language='javascript'>
  window.top.document.stats.location.replace('stats.php?player='+window.top.players.document.main.player.value);
  window.parent.document.fortify.send.disabled = false;
  window.top.document.status.location.replace('statustunnel.php');
  $ok;
 </script>
</body></html>";
?>