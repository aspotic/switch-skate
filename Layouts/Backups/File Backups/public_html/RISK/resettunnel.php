<?php

session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

if($_POST['username'] == '' || $_POST['email'] == '')
 $_SESSION['msg'] = "You must fill out all the fields.";
else
{
 $result = mysql_query("SELECT num, username, email FROM risk_players 
                        WHERE username='".$_POST['username']."'  AND email='".$_POST['email']."'");
 if (mysql_num_rows($result) == 0)
  $_SESSION['msg'] = "No user found with this name and e-mail address";
 else
 {
  $row = mysql_fetch_array($result, MYSQL_ASSOC);
  $password = mt_rand(10000000, 99999999);
  $reset = "Hello ". $row['username'] .",\n\nYour RiSK password was successfully reset.\nHere is your new password : $password\n\n-- http://$server";
  if(mail($row['email'], "PHP RiSK Password Reset", $reset))
   $result = mysql_query("UPDATE risk_players SET password=password('$password') WHERE num='".$row['num']."'");
  else
   $_SESSION['msg'] = "An error occured while sending mail, password not reset.";
 }
}

if ($_SESSION['msg'] == NULL)
{
  $_SESSION['msg'] = "Password reset successfully.";
  header("Location: index.php");
}
else
  header("Location: resetpw.php");
?>
