<?php
session_start();
require("config.inc.php");

echo "
<html>
 <head>
  <title>Read Logs @ PHP RiSK</title>
  <style>
   .cell {font-family:Tahoma; background-color:#444444; border:1px #DDDDDD solid; font-size:16px; color:DDDDDD;};
   .msg {font-family:Tahoma; font-size:12px; font-weight:bold;  color:red;};
   .head {font-family:Tahoma; font-size:12px; font-weight:bold;  color:blue;};
   .head2 {font-family:Tahoma; font-size:12px; font-weight:bold;  color:white;};
   table {border:0px;};
   .link {color: blue; text-decoration:none; font-size:12px; font-family:Tahoma;}
   .stats {font-family:Tahoma; color:#DDDDDD; font-size:12px; font-weight:bold; text-align:right}
   .text {font-family:Tahoma; color:#DDDDDD; font-size:12px; text-align:center;}
   input, select {font-family:Tahoma; background-color:black; border:1px ridge #DDDDDD; color:#DDDDDD; font-size:12px};
   a {color: blue; text-decoration:none; font-size:12px; font-family:Tahoma;}
   a:visited {color: blue; text-decoration:none; font-size:12px; font-family:Tahoma;}
   a:hover {color: blue; text-decoration:underline; font-size:12px; font-family:Tahoma;}

   HTML, BODY {
   scrollbar-3dlight-color : #000000;
   scrollbar-arrow-color : #C0C0C0;
   scrollbar-base-color : #808080;
   scrollbar-darkshadow-color : #000000;
   scrollbar-face-color : #000000;
   scrollbar-highlight-color : #C0C0C0;
   scrollbar-shadow-color : #000000;
   scrollbar-track-color : #202020;
   }
  </style>

 </head>

 <body bgcolor='black'>
  <table width='800' cellspacing='8' cellpadding='5' align='center'>
   <tr><td colspan='2' align='center' class='cell'>PHP RiSK</td></tr>
    <tr>
     <td class='head' colspan='2' align='center'>
      <br>Read previous match logs.<br><br>
     </td>
    </tr>
    <tr>
     <td width='30%' class='head2' align='center'>
      <br>Match List<br><br>
     </td>
     <td width='70%' class='head2' align='center'>
      <br>Log<br><br>
     </td>
    </tr>
    <tr>
     <td width='33%' valign='top' align='center'>";

if ($dir = @opendir($path."/risklogs"))
{
 while (($file = readdir($dir)) !== false)
  if ($file != ".." && $file != ".")
   if(!is_dir($file)) 
     echo "<a href='risklogs/$file' target='logsource'>".DisplayLog($file)."</a><br>";
 closedir($dir);
}

echo "</td>
     <td width='70%' valign='top' align='right'>
      <iframe name='logsource' width='400' height='300' src='blank.html' frameborder='0'>
      </iframe><br>
     </td>
    </tr>
    <tr><td colspan='2' align='center' class='cell'>&copy;2003 TheWulf</td></tr>
   </table>
 </body>
</html>";

function DisplayLog($file)
{
 return substr($file, 0, 4) . "/" . substr($file, 4, 2) . "/" . substr($file, 6, 2) . " @ ". 
        substr($file, 9, 2) . ":" . substr($file, 11, 2);
}
?>
