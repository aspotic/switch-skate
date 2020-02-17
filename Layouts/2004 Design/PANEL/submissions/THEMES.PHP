<?php
require ("header.php");

$host = "localhost";
$user = "switchsk_adam";
$password = "drummer";
$dbname = "switchsk_fcontent";
$tablename = "colors";

print ("<center><h3>Themes</h3></center>");

$link = mysql_connect ($host, $user, $password);
$query = "SELECT * from $tablename";
$result = mysql_db_query ($dbname, $query, $link);
mysql_close ($link);


while ($row = mysql_fetch_array($result)){

print ("<TABLE style='width:$StyleRow[tablew]; border:$StyleRow[borderw]px solid $StyleRow[border];' cellspacing='$StyleRow[borderw]' cellPadding='6' align='center'>\n");
  print ("<TBODY>\n");
    print ("<TR>\n");
	  print ("<TD bgolor='$StyleRow[catagory]' background='$StyleRow[catagory]' align='center'>\n");
	  print ("$row[person],  $row[email]\n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
      print ("<TR class='tablerow'>\n");
	  print ("<TD class='mediumtxt' bgcolor='$StyleRow[alt1]' align='center'>\n");
	  
	  print ("<center><b>$row[name]</b><br><br></center>\n");	
	  print ("<table height='240' width='300' align='center'>\n");	
	  print ("<tr><td class=mediumtxt>Background Color:</td><td class=mediumtxt>$row[bg]</td><td bgcolor='$row[bg]' width='70'></td></tr>\n");	
	  print ("<tr><td class=mediumtxt>Alternating Color 1:</td><td class=mediumtxt>$row[alt1]</td><td bgcolor='$row[alt1]' width='70'></td></tr>\n");	
	  print ("<tr><td class=mediumtxt>Alternating Color 2:</td><td class=mediumtxt>$row[alt2]</td><td bgcolor='$row[alt2]' width='70'></td></tr>\n");	
	  print ("<tr><td class=mediumtxt>Table Color:</td><td class=mediumtxt>$row[tablecolor]</td><td bgcolor='$row[tablecolor]' width='70'></td></tr>\n");	
	  print ("<tr><td class=mediumtxt>Border Color:</td><td class=mediumtxt>$row[border]</td><td bgcolor='$row[border]' width='70'></td></tr>\n");	
	  print ("<tr><td class=mediumtxt>Link Color:</td><td class=mediumtxt>$row[link]</td><td bgcolor='$row[link]' width='70'></td></tr>\n");	
	  print ("<tr><td class=mediumtxt>Link Rollover Color:</td><td class=mediumtxt>$row[roll]</td><td bgcolor='$row[roll]' width='70'></td></tr>\n");	
	  print ("<tr><td class=mediumtxt>Text Color:</td><td class=mediumtxt>$row[text]</td><td bgcolor='$row[text]' width='70'></td></tr>\n");	
	  print ("<tr><td class=mediumtxt>Font Type:</td><td class=mediumtxt>$row[font]</td><td bgcolor='$row[font]' width='70'></td></tr>\n");	
	  print ("</table>\n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
      print ("<TR class='tablerow'>\n");
      print ("<TD class='mediumtx' bgcolor='$StyleRow[alt2]' align='center'>\n");
      print ("<form action='removetext.php' method='post'>\n");
	  print ("<input name='dbname' type='hidden' value='$dbname'>\n");
	  print ("<input name='place' type='hidden' value='$row[id]'>\n");
	  print ("<input name='area' type='hidden' value='$tablename'>\n");
	  print ("<input type='submit' value='DELETE'>\n");
	  print ("</form>\n");
      print ("</TD>\n");
   	  print ("</TR>\n");
  print ("</TBODY>\n");
print ("</TABLE>\n");
	  




print ("<br>\n");



}

?>

</body>
</html>
