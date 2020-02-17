<?php
session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$t = $_GET['t']; 

switch ($t)
{
  case 1: $t1 = 'tabon'; $t2 = 'taboff'; $t3 = 'taboff'; break;
  case 2: $t2 = 'tabon'; $t1 = 'taboff'; $t3 = 'taboff'; break;
  case 3: $t3 = 'tabon'; $t1 = 'taboff'; $t2 = 'taboff'; break;
}

echo "
<html>
 <head>
  <title>The object of war is not to die for your country... it's to make the other bastard die for his.</title>
  <style>
   .text {font-family:Tahoma; color:#DDDDDD; font-size:12px;}
   table {border:0px;};
   .taboff {font-family:Tahoma; font-size:12px; color:darkgray; background-color:black; text-align:center; border:solid 1px #EEEEEE};
   .tabon  {font-family:Tahoma; font-size:12px; color:black; background-color:darkgray; text-align:center; border:solid 1px #EEEEEE};
   .thover {font-family:Tahoma; font-size:12px; color:black; background-color:#444444; text-align:center; border:solid 1px #EEEEEE; cursor:hand};
  </style>
 </head>
 <body bgcolor='black' onLoad='scrollTo(0,10)'>
 <table width='100%' cellpadding='5' cellspacing='5'>
  <tr>
   <td class='$t1' width='33%' onmouseover=this.className='thover' onmouseout=this.className='$t1' onclick=document.location.replace('tabs.php?t=1')>Armies</td>    
   <td class='$t2' width='33%' onmouseover=this.className='thover' onmouseout=this.className='$t2' onclick=document.location.replace('tabs.php?t=2')>Cards </td>
   <td class='$t3' width='33%' onmouseover=this.className='thover' onmouseout=this.className='$t3' onclick=document.location.replace('tabs.php?t=3')>Log</td>
  </tr>
 </table>
 <script language='javascript'>
  window.parent.document.tabsource.location.replace('tabsource.php?t=$t');
 </script>
 <form name='source' onsubmit='return false'>
  <input type='hidden' name='t' value='$t'>
 </form>
 </body>
</html>";

?>
