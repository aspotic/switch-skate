<?php
session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$from = $_GET['from']; 
$to = $_GET['to']; 
$numarmies = $_GET['numarmies']; 

$result = mysql_query("SELECT name, continent FROM risk_countries WHERE num='$to'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

echo "
<html>
 <head>
  <style>
   .c1 {color: darkorange};
   .c2 {color: turquoise};
   .c3 {color: saddlebrown};
   .c4 {color: blue};
   .c5 {color: forestgreen};
   .c6 {color: mediumpurple};
   .text {font-family:Tahoma; color:#DDDDDD; font-size:12px;}
   table {border:0px;};
   select, input {font-family:Tahoma; background-color:black; border:1px ridge #DDDDDD; color:#DDDDDD; font-size:12px;};
  </style>
<script language=\"JavaScript\"><!--
document.takeover.send.disabled = true;
document.onkeydown = keyhandler;

function keyhandler(e) {
    if (document.layers)
        Key = e.which;
    else
        Key = window.event.keyCode;
    if (Key == 13)
        Takeover();
    if (Key == 116)
        Key = 0;
}
//--></script>

 </head>
 <body bgcolor='black' onLoad='scrollTo(0,15)'>
 <form name='takeover'>
 <table width='100%' >
  <tr>
   <td class='text' align='justify'><b>Conquered <font class='c".$row['continent']."'>".$row['name']."</font>! &nbsp;Move &nbsp;";

$result = mysql_query("SELECT name, armies, continent FROM risk_countries WHERE num='$from'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

echo "<select name='numarmies'>";

while ($numarmies < $row['armies'])
{
 echo "<option value='$numarmies'>$numarmies</option>";
 $numarmies++;
}

echo "
    </select>
    &nbsp; from <font class='c".$row['continent']."'>".$row['name']."</font> </b></td>
   <td align='center' width='150'>
    <input type='hidden' name='from' value='$from'>
    <input type='hidden' name='to' value='$to'>
    <input type='button' name='send' value=':: Move armies ::' onclick='Takeover()'>
   </td>
  </tr>
 </table>
 <iframe name='takeovertunnel' src='takeovertunnel.php' width='0' height='0'></iframe>
 <script language='javascript'>
  function Takeover()
  {
   takeovertunnel.takeover.from.value = document.takeover.from.value;
   takeovertunnel.takeover.to.value   = document.takeover.to.value;
   takeovertunnel.takeover.numarmies.value = document.takeover.numarmies.value;
   takeovertunnel.takeover.submit();
   document.takeover.send.disabled = true;
  }
 </script>
 </form>
</body></html>";

?>
