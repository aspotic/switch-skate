<?php

// Constant Variables

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 
$LinkUp = mysql_connect ($host, $user, $pass);

$PickDB="switchsk_other";
$PickQuery = "SELECT * from logstatus";
$PickResult = mysql_db_query ($PickDB, $PickQuery, $LinkUp);

while ($PickRow = mysql_fetch_array($PickResult)){
if (($username == $PickRow[username]) && ($password == $PickRow[password])){

$host = "localhost";
$user = "switchsk_adam";
$pass = "drummer";
$ValDB="switchsk_other";
$LinkUp = mysql_connect ($host, $user, $pass);
$ValSQL = "UPDATE logged SET status = '1' WHERE id='1'";
$ValResult = mysql_db_query ($ValDB, $ValSQL, $LinkUp);

if ($ValResult)
{
print ("<br><br><center>You have been logged in");
print ("<script>\n");
print ("function redirect()\n");
print ("{window.location.replace('http://www.switchskate.net/panel/index.php');}\n");
print ("setTimeout('redirect();', 1250);\n");
print ("</script>\n");

exit;
}

}else{

$host = "localhost";
$user = "switchsk_adam";
$pass = "drummer";
$ValDB="switchsk_other";
$LinkUp = mysql_connect ($host, $user, $pass);
$ValSQL = "UPDATE logged SET status = '0' WHERE id='1'";
$ValResult = mysql_db_query ($ValDB, $ValSQL, $LinkUp);

if ($ValResult){
print ("<br><br><center>Wrong username or password");
print ("<script>\n");
print ("function redirect()\n");
print ("{window.location.replace('http://www.switchskate.net/panel/login.html');}\n");
print ("setTimeout('redirect();', 1250);\n");
print ("</script>\n");
exit;
}}}

mysql_close ($LinkUp);
?>