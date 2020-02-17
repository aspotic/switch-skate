<?php

session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

if($_POST['currentpassword'] == '' || $_POST['newpassword'] == '' || $_POST['confirmpassword'] == '')
 $_SESSION['msg'] = "You must fill out all the fields.";
else
{
 $result = mysql_query("SELECT 1 FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."' 
                                                     AND password=password('".$_POST['currentpassword']."')");
 if (mysql_num_rows($result) == 0)
  $_SESSION['msg'] = "Current password does not match.";
 else
  if ($_POST['newpassword'] == $_POST['confirmpassword'])
   $result = mysql_query("UPDATE risk_players SET password=password('".$_POST['newpassword']."') 
                                              WHERE num='".$_SESSION['RISK_USERNUM']."'");
  else
   $_SESSION['msg'] = "New passwords do not match.";
}

if ($_SESSION['msg'] == NULL)
{
  $_SESSION['msg'] = "Password changed successfully.";
  header("Location: index.php");
}
else
  header("Location: changepw.php");
?>
