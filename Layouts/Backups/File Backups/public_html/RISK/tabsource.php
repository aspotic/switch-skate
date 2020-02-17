<?php
session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$t = $_GET['t']; 

$result = mysql_query("SELECT color FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

echo "
<html>
 <head>
  <style>
   table {border:0px;};
   input, select {font-family:Tahoma; background-color:black; border:1px ridge #DDDDDD; color:#DDDDDD; font-size:12px};
   .stats {font-family:Tahoma; color:#DDDDDD; font-size:12px; font-weight:bold};
   .text {font-family:Tahoma; color:#DDDDDD; font-size:12px};
   td {text-align:center};
   .c1 {color: darkorange};
   .c2 {color: turquoise};
   .c3 {color: saddlebrown};
   .c4 {color: blue};
   .c5 {color: forestgreen};
   .c6 {color: mediumpurple};
  </style>
 </head>
 <body bgcolor='black'>";

if ($t == 1)
{
 $result = mysql_query("SELECT color, armies FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);

 echo "
 <div align='center' class='stats'> You have<br>
  <form name='alform'>
   <input type='text' name='armiesleft' style='font-size:42; text-align:center; color:".$row['color']."' size='1' value='".$row['armies']."'>
  <br><br>armies left.
  </form>";
}
if ($t == 2)
{
 $result = mysql_query("SELECT num, symbol, name FROM risk_cards WHERE owner='".$_SESSION['RISK_USERNUM']."'");

 echo "
 <div align='center' class='stats'>
  <form name='cards'>
   <select name='inhand' multiple size='6'>";

 if (mysql_num_rows($result) == 0)
 {
  echo "<option>You have no cards.</option>";
 }
 else
 {
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
  {
   echo "<option value='".$row['num']."'>{".$row['symbol']."} ".$row['name']."</option>";
  }
 }

 echo "
   </select>
   <br><br><input type='button' name='trade' value='Trade In' onclick='Trade()'>
   <iframe name='cardtunnel' src='cardtunnel.php' width='0' height='0'></iframe>
   <script language='javascript'>
    function Trade()
    {
     var sel = getSelected(document.cards.inhand.options);
     if (sel.length == 3)
     {
      var strSel = '';
      for (var item in sel)
       strSel += sel[item].value + ',';
      document.cardtunnel.cardform.cards.value = strSel.substring(0, strSel.length-1);
      document.cards.trade.disabled = true;
      document.cardtunnel.cardform.submit();
     }
     else
     {
      alert('Please choose exactly 3 cards.');
     }
    }

    function getSelected(opt) 
    {
     var selected = new Array();
     var index = 0;
     for (var intLoop = 0; intLoop < opt.length; intLoop++)
     {
      if (opt[intLoop].selected)
      {
       index = selected.length;
       selected[index] = new Object;
       selected[index].value = opt[intLoop].value;
       selected[index].index = intLoop;
      }
     }
     return selected;
    }
   </script>
  </form>"; 
}
if ($t == 3)
{
 echo "<iframe name='log' src='log.php' width='190' height='150' frameborder='0'></iframe>";
}
echo "</div></body></html>";
