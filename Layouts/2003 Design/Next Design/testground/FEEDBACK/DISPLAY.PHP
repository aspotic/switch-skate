<?php

$host = "localhost";
$user = "switchsk_adam";
$password = "drummer";
$dbname = "switchsk_content";
$tablename = "feedback";

$link = mysql_connect ($host, $user, $password);

$query = "SELECT * from $tablename";
$result = mysql_db_query ($dbname, $query, $link);

// Creat table
print ("<table border=1 width='75%' cellspacing=2 cellpading=2 align=center>\n");
print ("<tr align=center valign=top>\n");
print ("<td align=center valign=top>name</td>\n");
print ("<td align=center valign=top>email</td>\n");
print ("<td align=center valign=top>comments</td>\n");
print ("</tr>\n");

// get results
while ($row = mysql_fetch_array($result)){
print ("<tr align=center valign=top>\n");
print ("<td align=center valign=top>$row[firstname] $row[lastname]</td>\n");
print ("<td align=center valign=top>$row[emailaddress]</td>\n");
print ("<td align=center valign=top>$row[comments]</td>\n");

print ("</tr>\n");

}

mysql_close ($link);
print ("</table>\n");

?>