<?php

$host = "localhost"; 
$user = "switchsk_adam"; 
$password = "drummer"; 
$dbname = "switchsk_contco"; 


$link = mysql_connect ($host, $user, $password);


$query = "SELECT * from $what";
$result = mysql_db_query ($dbname, $query, $link);

// Creat table
print ("<table border=1 width='100%' cellspacing=2 cellpading=2 align=center >\n");
print ("<tr align=center valign=top>\n");
print ("<td align=center valign=top>Title</td>\n");
print ("<td align=center valign=top>Text</td>\n");
print ("</tr>\n");

// get results
while ($row = mysql_fetch_array($result)){
print ("<tr align=center valign=top>\n");
print ("<td align=center valign=top>$row[title]</td>\n");
print ("<td align=center valign=top>$row[textw]</td>\n");

print ("</tr>\n");

}

mysql_close ($link);
print ("</table>\n");

?>