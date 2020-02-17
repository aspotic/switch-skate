<?php
session_start();
require("config.inc.php");

if ($_SESSION['RISK_USERNUM'] == NULL)
{
 header("Location: index.php");
}

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

echo "
<html>
 <head>
  <title>The object of war is not to die for your country... it's to make the other bastard die for his.</title>
  <style>
   .text {font-family:Tahoma; color:#DDDDDD; font-size:12px;}
   table {border:0px;};
   .taboff {font-family:Tahoma; font-size:12px; color:darkgray; background-color:black; text-align:center; border:solid 1px #EEEEEE};
   .tabon {font-family:Tahoma; font-size:12px; color:black; background-color:darkgray; text-align:center; border:solid 1px #EEEEEE};
   .thover {font-family:Tahoma; font-size:12px; color:black; background-color:#444444; text-align:center; border:solid 1px #EEEEEE; cursor:hand};
   select, input {font-family:Tahoma; background-color:black; border:1px ridge #DDDDDD; color:#DDDDDD; font-size:12px;};
  </style>
 </head>
 <body bgcolor='black'>
  <table valign='top'>
   <tr>
    <td background='map.jpg' style='background-repeat:no-repeat' width=680 valign='top'>
      <iframe name='overlay' src='mapoverlay.php' height=423 width=677 
         allowtransparency='true' background-color='transparent' frameborder='0'>
      </iframe>
    </td>
    <td align='center' class='text'>Log<br><br>
     <iframe name='log' src='log.php' width='190' height='350' frameborder='0'></iframe><br>
     <form name='main' onsubmit='return false'>
      <input type='text' name='cturn' style='text-align:center; font-weight:bold'>
     </form>
     <iframe src='spectatetunnel.php' width='0' height='0'></iframe>
    </td>
   </tr>
   <tr><td colspan='2' class='text' align='center'>
    <font color='red' style='font-weight:bold'>You are currently in SPECTATOR mode. Enjoy the game.</font>
   </td></tr>
  </table><br><center>
 </body>
</html>";
?>
