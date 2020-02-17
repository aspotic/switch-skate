<?php require ("http://www.switchskate.net/cp/handlers/header2.php");?>

<?php

$host = "localhost"; 
$user = "switchsk_adam"; 
$password = "drummer"; 
$dbname = "switchsk_fcontsb"; 


$link = mysql_connect ($host, $user, $password);

if ($what == "sblinks"){

$query = "SELECT * from $what";
$result = mysql_db_query ($dbname, $query, $link);

// get results
while ($row = mysql_fetch_array($result)){
$id++;
print ("<table width='100%' align=center >\n");
print ("<tr align=center valign=top>\n");

print ("<form action='delete.php'>\n");
print ("<input type='hidden' name='what' value=$what>\n");
print ("<input type='hidden' name='id' value=$id>\n");
print ("<input type='hidden' name='host' value=$host>\n");
print ("<input type='hidden' name='user' value=$user>\n");
print ("<input type='hidden' name='password' value=$password>\n");
print ("<input type='hidden' name='dbname' value=$dbname>\n");
print ("<input type='hidden' name='title' value=$title>\n");
print ("<input type='submit' value='Delete' style='border:thin #0a4c68 solid; background-color:#0a4c68;color:#ffffff;'>\n");
print ("</form>\n");

print ("<tr align=center valign=top>\n");
print ("<td style='border:thin #ffffff solid;' align=center valign=top>$row[email]</td></tr>\n");
print ("<tr align=center valign=top>\n");
print ("<td style='border:thin #ffffff solid;' align=center valign=top>$row[fname]</td></tr>\n");
print ("<tr align=center valign=top>\n");
print ("<td style='border:thin #ffffff solid;' align=center valign=top>$row[title]</td></tr>\n");
print ("<tr align=center valign=top>\n");
print ("<td style='border:thin #ffffff solid;' align=center valign=top><a href='$row[title]' target='_blank'>$row[fname]</td>\n");
print ("</tr></table><br><br>\n");

}

mysql_close ($link);


}
else
{

$query = "SELECT * from $what";
$result = mysql_db_query ($dbname, $query, $link);


// get results
while ($row = mysql_fetch_array($result)){
$id++;
print ("<table width='100%' align=center >\n");
print ("<tr align=center valign=top>\n");
print ("Delete</tr>\n");
print ("<tr align=center valign=top>\n");
print ("<td style='border:thin #ffffff solid;' align=center valign=top>$row[fname]</td></tr>\n");
print ("<tr align=center valign=top>\n");
print ("<td style='border:thin #ffffff solid;' align=center valign=top>$row[email]</td></tr>\n");
print ("<tr align=center valign=top>\n");
print ("<td style='border:thin #ffffff solid;' align=center valign=top>$row[title]</td></tr>\n");
print ("<tr align=center valign=top>\n");
print ("<td style='border:thin #ffffff solid;' align=center valign=top>$row[textw]</td>\n");
print ("</tr></table><br><br>\n");
}

mysql_close ($link);


}

?>


