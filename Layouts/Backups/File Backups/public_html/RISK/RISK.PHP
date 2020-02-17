<?php
session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$result = mysql_query("UPDATE risk_players SET status='10' WHERE num='".$_SESSION['RISK_USERNUM']."'");
$result = mysql_query("SELECT color, turnorder FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$_SESSION['RISK_TURNORDER'] = $row['turnorder'];
$result = mysql_query("INSERT INTO risk_log VALUES(\"\", \"".date("H:i:s")."\", 
           \"<b><font color=".$row['color'].">* ".$_SESSION['RISK_USERNAME']." has joined.</font></b>\")");

$result = mysql_query("SELECT bottomsrc FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

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
  <form name='main' onsubmit='return false'>
  <table>
   <tr>
    <td background='map.jpg' style='background-repeat:no-repeat' width=680>
      <iframe name='overlay' src='mapoverlay.php' height=423 width=677 
         allowtransparency='true' background-color='transparent' frameborder='0'>
      </iframe>
    </td>
    <td align='center' valign='top' class='text';>
     <iframe name='players' src='players.php' width='200' height='22' frameborder='0' scrolling='no'></iframe>
     <br><hr>
     <iframe name='stats' src='stats.php?player=".$_SESSION['RISK_USERNUM']."' width='200' height='170' frameborder='0' scrolling='no'> 
     </iframe><hr>
     <iframe name='tabs' src='tabs.php?t=1' width='200' height='40' frameborder='0' scrolling='no'></iframe><br>
     <iframe name='tabsource' src='tabsource.php?t=1' width='200' height='150' frameborder='no' scrolling='no'></iframe>
    </td>
   </tr>
   <tr>
    <td >
     <iframe name='bottom' src='".$row['bottomsrc']."' width='670' height='25' frameborder='0' scrolling='no'>
     </iframe>
    </td>
    <td align='center'>
     <input type='text' name='cturn' style='text-align:center; font-weight:bold'>
     <iframe name='status' src='statustunnel.php' width='0' height='0'></iframe>
    </td>
   </tr>
  </table><br>
  <input type='hidden' name='myturn' value='0'>
  </form>
 </body>
</html>";
?>
