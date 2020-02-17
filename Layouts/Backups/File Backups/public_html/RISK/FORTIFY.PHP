<?php
session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$result = mysql_query("UPDATE risk_config SET TurnStatus='Fortify'");
$result = mysql_query("UPDATE risk_players SET bottomsrc='fortify.php' WHERE num='".$_SESSION['RISK_USERNUM']."'");

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

document.onkeydown = keyhandler;

function keyhandler(e) {
    if (document.layers)
        Key = e.which;
    else
        Key = window.event.keyCode;
    if (Key == 13)
        Fortify();
    if (Key == 116)
        Key = 0;
}
//--></script>

 </head>
 <body bgcolor='black' onLoad='scrollTo(0,15)'>
 <form name='fortify'>
 <table width='100%'>
  <tr>
   <td class='text'><b>Fortify</b></td>
   <td align='center'> <input type='text' name='numarmies' size='5' style='text-align:center' value='0'></td>
   <td align='center' class='text'><b>armies from</b></td>
   <td align='center'>
    <select name='from'>";

$result = mysql_query("SELECT num, name, continent FROM risk_countries WHERE owner='".$_SESSION['RISK_USERNUM']."'");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
 echo "<option class='c".$row['continent']."' value='".$row['num']."'>".$row['name']."</option>";
}

echo "
    </select>
   </td>
   <td align='center' class='text'><b>to</b></td>
   <td align='center'>
    <select name='to'>";

$result = mysql_query("SELECT num, name, continent FROM risk_countries WHERE owner='".$_SESSION['RISK_USERNUM']."'");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
 echo "<option class='c".$row['continent']."' value='".$row['num']."'>".$row['name']."</option>";
}

echo "
    </select>
   </td>
   <td align='center' width='100'>
    <input type='button' style='color:Green' name='send' value='Fortify' onclick='Fortify()'> 
    <input type='button' style='color:Red' name='skip' value='Skip' onclick='Skip()'>&nbsp;
   </td>
  </tr>
 </table>
 <input type='hidden' name='flag' value='0'>
 </form>
 <iframe name='fortifytunnel' src='fortifytunnel.php' width='100' height='100'></iframe>
 <script language='javascript'>
  function Fortify()
  {
   if (isNaN(document.fortify.numarmies.value) || document.fortify.numarmies.value < 1)
   {
    alert('This is not a valid amount of armies.');
    document.fortify.numarmies.focus();
   }
   else
   {
    fortifytunnel.fortify.from.value = document.fortify.from.value;
    fortifytunnel.fortify.to.value = document.fortify.to.value;
    fortifytunnel.fortify.numarmies.value = document.fortify.numarmies.value;
    fortifytunnel.fortify.submit();
    document.fortify.send.disabled = true;
   }
  }
  function Skip()
  {
   document.fortify.send.disabled = true;
   fortifytunnel.skip.submit();
  }
 </script>
</body></html>";

?>
