<?php
session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

echo "
<html>
 <head>
 <META HTTP-EQUIV='Refresh' content='10;URL=http://$server/dialog.php'>  
  <style>

   HTML, BODY {
   scrollbar-3dlight-color : #000000;
   scrollbar-arrow-color : #C0C0C0;
   scrollbar-base-color : #808080;
   scrollbar-darkshadow-color : #000000;
   scrollbar-face-color : #000000;
   scrollbar-highlight-color : #C0C0C0;
   scrollbar-shadow-color : #000000;
   scrollbar-track-color : #202020;

   font-family:Tahoma; color:gray; font-size:12px;

   }
  </style>
 </head>
 <body bgcolor='black' onLoad='scrollTo(10000,10000)'>";

 $result = mysql_query("SELECT * FROM risk_dialog");
 while ($row = mysql_fetch_array($result))
 {
   if ($row['num'] == $_SESSION['RISK_USERNUM'])
    if (strpos($row['log'], "><b>[=>") != false)
     echo $row['stamp'], " ", $row['log'], "<br>";
    else
     echo $row['stamp'], " <b>[Private] </b>", $row['log'], "<br>";
   elseif ($row['num'] == "1")
    echo $row['stamp'], " ", $row['log'], "<br>";
 }

echo "</body></html>";

?>
