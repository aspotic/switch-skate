<?php
session_start();
require("config.inc.php");
require("calcs.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$player = $_GET['player']; 

$result = mysql_query("SELECT kickflag FROM risk_players WHERE num='$player'");
$row = mysql_fetch_array($result);
if ($row['kickflag'] != NULL)
{
 echo "<html><body bgcolor='black'><center><br><br><span style='font-family:Tahoma; color:#DDDDDD; font-size:12px; font-weight:bold'>This player is not active.</span></body></html>";
}
else
{

SetContinentOwners();

$result = mysql_query("SELECT sum(armies) as sArmies, count(*) AS nCountries FROM risk_countries WHERE owner='$player'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

$NumCountries = $row['nCountries'];
$NumArmies = $row['sArmies'];

$result = mysql_query("SELECT count(*) as nCards FROM risk_cards WHERE owner='$player'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

$NumCards = $row['nCards'];

echo "
<html>
 <head>
  <style>
   .text {font-family:Tahoma; color:#DDDDDD; font-size:12px; text-align:center}
   .stats {font-family:Tahoma; color:#DDDDDD; font-size:12px; font-weight:bold;}
   .c1 {color: darkorange};
   .c2 {color: turquoise};
   .c3 {color: saddlebrown};
   .c4 {color: blue};
   .c5 {color: forestgreen};
   .c6 {color: mediumpurple};
   select, input {font-family:Tahoma; background-color:black; border:1px ridge #DDDDDD; color:#DDDDDD; font-size:10px;};
   .kick {color: blue; text-decoration:none; font-size:10px; font-family:Tahoma;};
   .kickhover {color: blue; text-decoration:underline; font-size:10px; font-family:Tahoma; cursor:hand};
   a {color: blue; text-decoration:none; font-size:10px; font-family:Tahoma;};
   a:visited {color: blue; text-decoration:none; font-size:10px; font-family:Tahoma;};
   a:hover {color: blue; text-decoration:underline; font-size:10px; font-family:Tahoma;};
   input {color:#DDDDDD; background-color:black; border:none; font-size:12px; text-align:right; cursor:default};
  </style>
 </head>
 <body bgcolor='black' topmargin=0><center>";

if ($_SESSION['RISK_USERLEVEL'] == 3)
{
 echo "<span class='kick' onmouseover=this.className='kickhover' onmouseout=this.className='kick' 
        onclick='poke()'>PoKe</span> <font color='blue'>::</font> 
       <span class='kick' onmouseover=this.className='kickhover' onmouseout=this.className='kick' 
        onclick='conf()'>KiCK</span> <font color='blue'>::</font>

 <script language='javascript'>
  function conf()
  {
   var agree=confirm('Are you sure you want to kick this player? This can not be undone!');
   if (agree)
   {
    var w = prompt('Enter a reason for kicking this player.', '');
    if (w != null)
      document.admin.location.replace('admin.php?c=kick&p=$player&w='+w);
   }
  }

  function poke()
  {
   document.admin.location.replace('admin.php?c=poke&p=$player');
  }

 </script><iframe name='admin' width='0' height='0'></iframe>";
}

echo "
  <a href='stats.php?player=$player'>ReFReSH</a> </center>
  <form name='pstats'>
  <table width='95%' align='center' cellspacing='0' cellpadding='0'>
   <tr>
    <td class='stats'>Armies :</td>
    <td class='text' align='right'><input type='text' name='numarmies' value='$NumArmies' size='6'></td>
   </tr>
   <tr>
    <td class='stats'>Cards :</td>
    <td class='text' align='right'><input type='text' name='numcards' value='$NumCards' size='6'></td>
   </tr>
   <tr>
    <td class='stats'>Countries :</td>
    <td class='text' align='right'><input type='text' name='numcountries' value='$NumCountries' size='6'></td>
   </tr>
   <tr>
    <td colspan='2' align='center'>
     <br><select>";

$result = mysql_query("SELECT num, name, continent FROM risk_countries WHERE owner='$player'");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
 echo "<option class='c".$row['continent']."'>".$row['name']."</option>";
}

$result = mysql_query("SELECT sum(bonus) as sBonus FROM risk_continents WHERE owner='$player'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

$minANT = floor($NumCountries / 3);
if ($minANT < 3)
  $minANT = 3;
$minANT += $row['sBonus'];

if ($NumCards >= 3)
{
 global $armytrades;
 $result = mysql_query("SELECT TradeIndex FROM risk_config");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 $nextindex = $row['TradeIndex'];

 $result = mysql_query("SELECT NextTrade FROM risk_config");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 $Trade = $row['NextTrade'];
 while ($NumCards >= 5)
 {
  $minANT += $armytrades[$nextindex++];
  $NumCards -= 3;
 }
 $maxANT = $minANT;

 // GET NUM ARMIES

 while ($NumCards >= 3)
 {
  $maxANT += $armytrades[$nextindex++];
  $NumCards -= 3;
 }
}

if ($minANT < 3) $minANT = 3;
if ($maxANT > $minANT) $minANT = $minANT . " to " . $maxANT;

echo "
    </select><br><br>
   </td></tr>
   <tr>
    <td class='stats'>Armies next turn :</td>
    <td class='text'><input type='text' name='ant' value='$minANT' size='6'></td>
   </tr>
  </table>
 </form>
 </body>
</html>";
}
?>
