<?php
/*
Made by Adam K (switchskate@gmail.com)
Setup File
Please do not redistribute this merchandise because you and the person you give the file(s) to will be prosecuted.

Please edit the following information as it is called for, if this isn't filled out properly your site will not work.
*/

$username = "switchsk_adam";                            // The username for your database
$password = "drummer";                            // The password for your database
$hostname = "localhost";                   // The hostname for your database (usually localhost)
$database = "switchsk_switch";                            // The name of your database
 
$webmaster = "Adam";                           // Your first name
$webmail = "switchskate@gmail.com";                             // Your email address

$sitename = "Switch Skate";                            // The name of your site   
$siteurl = "http://www.switchskate.net/2004/";   // The address to your site (with a / at the end)
$cmsurl = "http://www.switchskate.net/2004/";    // The address to the folder of th VME Panel (with a / at the end) (probably your site URL)
$defaulttheme = 1;                         // Set the default theme, automatically set to theme 1.

$setnewssize = 3;



/*

DO NOT EDIT PAST HERE

*/


$imgfolder = "images/";
$themefolder = "themes/";
$ipaddress =  $_SERVER['REMOTE_ADDR'];
$dblink = mysql_connect ($hostname, $username, $password);
$db2user = "switchsk_vmeuser";
$db2pass = "freepass";
$db2host = "localhost";
$database2 = "switchsk_vmepanel";
$dbtable2 = "vmecpstatus";
$dbtable3 = "vmeusers";

?>