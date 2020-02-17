<?php

function SetContinentOwners()
{
 $result     = mysql_query("SELECT owner, continent FROM risk_countries WHERE owner > '0' ORDER BY continent");
 $row        = mysql_fetch_array($result, MYSQL_ASSOC);
 $pcontinent = $row['continent'];
 $powner     = $row['owner'];
 $same       = true;

 while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
 {
  if ($row['continent'] == $pcontinent)
  {
   if ($row['owner'] != $powner) $same = false;
  }
  else
  {
   if ($same)
    $result2 = mysql_query("UPDATE risk_continents SET owner='$powner' WHERE num='$pcontinent'"); 
   else
    $result2 = mysql_query("UPDATE risk_continents SET owner='0' WHERE num='$pcontinent'"); 

   $pcontinent = $row['continent'];
   $powner     = $row['owner'];
   $same       = true;
  }
 }
 if ($same)
  $result2 = mysql_query("UPDATE risk_continents SET owner='$powner' WHERE num='$pcontinent'");
}


function NextPlayersTurn()
{
 $result = mysql_query("SELECT CurrentGame FROM risk_config");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 if ($row['CurrentGame'] != "Deploying")
  $result = mysql_query("UPDATE risk_config SET TurnStatus='NewTurn'");
 $result = mysql_query("SELECT num, turnorder FROM risk_players WHERE turnflag='1'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 $nextturn = $row['turnorder'] + 1;

 $result = mysql_query("UPDATE risk_players SET turnflag='0' WHERE num='".$row['num']."'");
 $result = mysql_query("SELECT 1 FROM risk_players WHERE turnorder='$nextturn'");
 if (mysql_num_rows($result) == 0)
  $result = mysql_query("UPDATE risk_players SET turnflag='1' WHERE turnorder='1'");
 else
  $result = mysql_query("UPDATE risk_players SET turnflag='1' WHERE turnorder='$nextturn'");
 $result = mysql_query("SELECT username FROM risk_players WHERE turnflag='1'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
            \"<b><font color='gray'>* ".$row['username']."'s turn.</font></b>\")");
}


function CommonBorder($c1, $c2)
{
  $result = mysql_query("SELECT borders FROM risk_countries WHERE num='$c1'");
  $row = mysql_fetch_array($result, MYSQL_ASSOC);

  if (in_array($c2, explode(",",$row['borders'])))
   return true;
  else
   return false;
}

function EOTCheckForCard()
{
 // CHECK FOR CARD
 $result = mysql_query("SELECT cardflag FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 if ($row['cardflag'] == 1)
 {
  $result = mysql_query("SELECT num FROM risk_cards WHERE owner='0'");
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
   $Cards[] = $row['num'];
  shuffle($Cards);
  $result = mysql_query("UPDATE risk_cards SET owner='".$_SESSION['RISK_USERNUM']."' WHERE num='".$Cards[0]."'");
  $result = mysql_query("UPDATE risk_players SET cardflag='0' WHERE num='".$_SESSION['RISK_USERNUM']."'");
       
  // LOG
  $result = mysql_query("SELECT color FROM risk_colors WHERE assigned='".$_SESSION['RISK_USERNUM']."'");
  $row = mysql_fetch_array($result, MYSQL_ASSOC);
  $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\" ,
           \"<b><font color='".$row['color']."'>* ".$_SESSION['RISK_USERNAME']." got a card.</font></b>\")"); 
 }
}

function TradeCards($sCards)
{
  $result = mysql_query("SELECT symbol FROM risk_cards WHERE num IN ($sCards)");
  $row = mysql_fetch_array($result, MYSQL_ASSOC);
  $s1 = $row['symbol'];
  $row = mysql_fetch_array($result, MYSQL_ASSOC);
  $s2 = $row['symbol'];
  $row = mysql_fetch_array($result, MYSQL_ASSOC);
  $s3 = $row['symbol'];


  if ($s1 == "W" || $s2 == "W" || $s3 == "W") { $ok = true; }
  elseif ($s1 == $s2 && $s2 == $s3) { $ok = true; }
  elseif ($s1 != $s2 && $s1 != $s3 && $s2 != $s3) { $ok = true; }
  else { $ok = false; }

  if ($ok)
  {
   global $armytrades;
   // GET NUM ARMIES
   $result = mysql_query("SELECT TradeIndex FROM risk_config");
   $row = mysql_fetch_array($result, MYSQL_ASSOC);
   $numarmies = $armytrades[$row['TradeIndex']];
   $nextindex = $row['TradeIndex'] + 1;
   $result = mysql_query("UPDATE risk_config SET TradeIndex='$nextindex'");

   // SET NUM ARMIES
   $result = mysql_query("SELECT armies FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
   $row = mysql_fetch_array($result, MYSQL_ASSOC);
   $newnumarmies = $numarmies + $row['armies'];
   $result = mysql_query("UPDATE risk_players SET armies='$newnumarmies' WHERE num='".$_SESSION['RISK_USERNUM']."'");
   $result = mysql_query("UPDATE risk_cards SET owner='1' WHERE num IN (".$_POST['cards'].")");

   // LOG
   $result = mysql_query("SELECT color FROM risk_colors WHERE assigned='".$_SESSION['RISK_USERNUM']."'");
   $row = mysql_fetch_array($result, MYSQL_ASSOC);
   $mycolor = $row['color'];
   $result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
              \"<b><font color='$mycolor'>* ".$_SESSION['RISK_USERNAME']." traded in cards for 
                   <font color='gray'>$numarmies</font> armies.</font></b>\")");

   // CHECK FOR COUNTRY BONUS
   $result = mysql_query("SELECT num, name, owner, armies, continent FROM risk_countries WHERE num IN ($sCards)");
   while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
   {
    if ($row['owner'] == $_SESSION['RISK_USERNUM'])
    {
     $countryarmies = $row['armies'] + 2;
     $result2 = mysql_query("UPDATE risk_countries SET armies='$countryarmies' WHERE num='".$row['num']."'");
     $result2 = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\",
                \"<b><font color='$mycolor'>* ".$_SESSION['RISK_USERNAME']." got a <font color='gray'>2</font>
                     army bonus for <font class='c".$row['continent']."'>".$row['name']."</font>.</font></b>\")");
    }
   }
    return true;
  }
  else return false;
}

function Victory()
{
 $result = mysql_query("UPDATE risk_config SET CurrentGame='Complete', TurnStatus='".$_SESSION['RISK_USERNUM']."'");
 $result = mysql_query("SELECT victories FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 $victories = $row['victories'] + 1;
 $result = mysql_query("UPDATE risk_players SET victories='$victories' WHERE num='".$_SESSION['RISK_USERNUM']."'");
 return "window.top.document.location.replace('win.php');";
}

function RemovePlayer($who)
{
 $result = mysql_query("SELECT turnflag, turnorder FROM risk_players WHERE num='$who'");
 if (mysql_num_rows($result) != 0)
 {
  $row = mysql_fetch_array($result, MYSQL_ASSOC);
  $cturn = $row['turnorder'];
  if ($row['turnflag'] == 1)
   NextPlayersTurn();

  // RE-ORDER TURNS
  $result = mysql_query("UPDATE risk_players SET turnflag='0', turnorder='0' WHERE num='$who'");

  $moreplayers = true;
  while($moreplayers)
  {
   $nextturn = $cturn+1;
   $result = mysql_query("SELECT num FROM risk_players WHERE turnorder='$nextturn'");
   if (mysql_num_rows($result) == 0)
    $moreplayers = false;
   else
   {
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
    $result = mysql_query("UPDATE risk_players SET turnorder='$cturn' WHERE num='".$row['num']."'");
    $cturn++;
   }
  }
  return true;
 }
 else return false;
}

function ForceTradeCards($limit)
{
 $result = mysql_query("SELECT 1 FROM risk_cards WHERE owner='".$_SESSION['RISK_USERNUM']."'");
 if (mysql_num_rows($result) >= $limit) return true;
 else return false;
}

?>