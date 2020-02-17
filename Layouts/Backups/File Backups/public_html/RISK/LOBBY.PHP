<?php

session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$result = mysql_query("SELECT 1 FROM risk_colors WHERE assigned='".$_SESSION['RISK_USERNUM']."'");

if (mysql_num_rows($result) == 0) // ** IF NOT ALREADY LOGGED IN **
{
 $result = mysql_query("SELECT colornum, color FROM risk_colors WHERE assigned='0' ORDER BY colornum LIMIT 1");

 if (mysql_num_rows($result) == '0')
 {
   header("Location: matchfull.php");
 }

 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 $mycolor = $row['color'];
 $result = mysql_query("UPDATE risk_colors SET assigned='".$_SESSION['RISK_USERNUM']."' WHERE colornum='".$row['colornum']."'");
}
else
{
 $result = mysql_query("SELECT color FROM risk_colors WHERE assigned='".$_SESSION['RISK_USERNUM']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 $mycolor = $row['color'];
}

$result = mysql_query("INSERT INTO risk_dialog VALUES('1', '".date("H:i:s")."', '<font color=\'$mycolor\'>* ".$_SESSION['RISK_USERNAME']." has joined the lobby.</font>')");

$result = mysql_query("UPDATE risk_players SET stamp='".time()."', status='5' WHERE num='".$_SESSION['RISK_USERNUM']."'");
$result = mysql_query("SELECT StartedBy FROM risk_config");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

echo "
<html>
 <head>
  <title>Lobby @ PHP Risk</title>
  <style>
   .cell {font-family:Tahoma; background-color:#444444; border:1px #DDDDDD solid; font-size:16px; color:DDDDDD;};
   table {border:0px;};
   .link {color: blue; text-decoration:none; font-size:12px; font-family:Tahoma;}
   a {color: blue; text-decoration:none; font-size:12px; font-family:Tahoma;}
   a:visited {color: blue; text-decoration:none; font-size:12px; font-family:Tahoma;}
   a:hover {color: blue; text-decoration:underline; font-size:12px; font-family:Tahoma;}
   input {font-family:Tahoma; background-color:black; border:1px ridge #DDDDDD; color:#DDDDDD; font-size:14px; text-align:center; cursor:default};
   .p1 { color:blue; background-color:black; cursor:hand }
   .p2 { color:red; background-color:black; cursor:hand }
   .p3 { color:yellow; background-color:black; cursor:hand }
   .p4 { color:green; background-color:black; cursor:hand }
   .p5 { color:gray; background-color:black; cursor:hand }
   .p6 { color:pink; background-color:black; cursor:hand }

   .hp1 { color:black; background-color:blue; cursor:hand }
   .hp2 { color:black; background-color:red; cursor:hand }
   .hp3 { color:black; background-color:yellow; cursor:hand }
   .hp4 { color:black; background-color:green; cursor:hand }
   .hp5 { color:black; background-color:gray; cursor:hand }
   .hp6 { color:black; background-color:pink; cursor:hand }
  </style>
<script language=\"JavaScript\"><!--
var RiskWindow;

document.onkeydown = keyhandler;

function keyhandler(e) {
    if (document.layers)
        Key = e.which;
    else
        Key = window.event.keyCode;
    if (Key == 13)
        SendMsg();
    if (Key == 116)
        Key = 0;
}

function SendMsg()
{
 dtunnel.f1.msg.value = document.msg.msg.value;
 dtunnel.f1.to.value = document.msg.to.value;
 dtunnel.f1.submit();
 document.msg.msg.value = '';
 document.msg.msg.focus();
}

function SpeakTo(player)
{
 player.blur();
 if (player.className.substr(0, 1) == 'p')
 {
  if (player.id == '')
   return false;
  if (document.msg.to.value != '1')
  {
    var old = document.getElementById(document.msg.to.value);
    old.className = old.className.substr(1);
  }
  document.msg.to.value = player.id;
  document.msg.sTo.value = 'To ' + player.value;
  document.msg.sTo.className = player.className;
  player.className = 'h' + player.className;
 }
 else 
 {
  document.msg.to.value = '1';
  document.msg.sTo.value = 'To Everyone';
  document.msg.sTo.className = ''; 
  player.className = player.className.substr(1);
 }
}

function StartRisk(page)
{
 RiskWindow = window.open(page, 'risk', 'toolbar=no,menubar=no,status=no,location=no,height=485,width=900');
 document.playerlist.start.disabled=true;
}

//--></script>

 </head>
 <body bgcolor='black' onunload='RiskWindow.close();'>
 <table width='100%' cellspacing='8' cellpadding='5'>
  <tr><td colspan='2' align='center' class='cell'>PHP RiSK :: Lobby</td></tr>
  <tr>
   <td>
    <table width='100%' cellpadding='3'>
      <form name='playerlist' onsubmit='return false'>
       <table width='750' align='center'>
        <tr>
         <td><input type='text' name='p1' class='p1' size='10' onclick='SpeakTo(this)'></td>
         <td><input type='text' name='p2' class='p2' size='10' onclick='SpeakTo(this)'></td>
         <td><input type='text' name='p3' class='p3' size='10' onclick='SpeakTo(this)'></td>
         <td><input type='text' name='p4' class='p4' size='10' onclick='SpeakTo(this)'></td>
         <td><input type='text' name='p5' class='p5' size='10' onclick='SpeakTo(this)'></td>
         <td><input type='text' name='p6' class='p6' size='10' onclick='SpeakTo(this)'></td>
         <td><input type='button' name='quit' value=':: Quit ::' onclick=\"ptunnel.location.href='quit.php'\" style='color:red'\">";

if ($row['StartedBy'] == $_SESSION['RISK_USERNAME'])
{
  echo " &nbsp; <input type='button' name='start' value='Start' style='color:green' 
                 onclick='StartRisk(\"risk_start.php\");'>";
}

echo "</td></tr></table>

     <tr><td align='center'>
      <iframe name='dialog' width='700' height='245' src='dialog.php' frameborder='0' style='border:1px solid silver'></iframe>
      <br></form>
      <form name='msg' onsubmit='return false'>
       <input type='text' name='sTo' value='To Everyone' size='10' style='border:0px none'> &nbsp;
       <input type='text' size='85' name='msg' style='text-align:left'> &nbsp;
       <input type='hidden' name='to' value='1'> &nbsp;
       <input type='button' value='Send' onclick='SendMsg()'>
      </form>

     </td></tr>
    </table>
   </td>
  </tr>
  </table>
  <iframe name='ptunnel' src='ptunnel.php' width='0' height='0'></iframe>
  <iframe name='dtunnel' src='dialogtunnel.php' width='0' height='0'></iframe>
  </body></html>";
?>
