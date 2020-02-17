<?php

// Make sure you change all 6 options to correspond with your server
// #BEGIN EDIT

$server = "http://www.switchskate.net/risk"; // Server & path to the risk game
$path   = "/home/user/public_html/risk";  // Physical path

$dbhost  = "localhost";          // Database Host 
$dbuname = "switchsk_adam";                    // Database Username
$dbpass  = "drummer";                    // Database Password
$dbname  = "risk";               // Database Name

// #END EDIT
// Don't edit anything below this line!

$armytrades[0] = 4;
$armytrades[1] = 6;
$armytrades[2] = 8;
$armytrades[3] = 10;
$armytrades[4] = 12;
$armytrades[5] = 15;
$armytrades[6] = 20;
$armytrades[7] = 25;
$armytrades[8] = 30;
$armytrades[9] = 35;
$armytrades[10] = 40;
$armytrades[11] = 45;
$armytrades[12] = 50;
$armytrades[13] = 55;

$log_header = "
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

   HTML, BODY {
   scrollbar-3dlight-color : #000000;
   scrollbar-arrow-color : #C0C0C0;
   scrollbar-base-color : #808080;
   scrollbar-darkshadow-color : #000000;
   scrollbar-face-color : #000000;
   scrollbar-highlight-color : #C0C0C0;
   scrollbar-shadow-color : #000000;
   scrollbar-track-color : #202020;
   margin: 0% 0% 0% 0%;
   }
  </style>
 </head>
 <body bgcolor='black'>
  <table width='100%'>";

$log_footer = "</table></body></html>";
?>
