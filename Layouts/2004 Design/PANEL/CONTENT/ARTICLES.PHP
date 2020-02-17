<?php
require ("header.php");

$host = "localhost";
$user = "switchsk_adam";
$password = "drummer";
$dbname = "switchsk_cucont";
$tablename = "articles";

print ("<center><h3>Articles</h3></center>");

$link = mysql_connect ($host, $user, $password);
$query = "SELECT * from $tablename";
$result = mysql_db_query ($dbname, $query, $link);
mysql_close ($link);


while ($row = mysql_fetch_array($result)){

print ("<TABLE style='width:$StyleRow[tablew]; border:$StyleRow[borderw]px solid $StyleRow[border];' cellspacing='$StyleRow[borderw]' cellPadding='6' align='center'>\n");
  print ("<TBODY>\n");
    print ("<TR>\n");
	  print ("<TD bgolor='$StyleRow[catagory]' background='$StyleRow[catagory]' align='center'>\n");
	  print ("$row[title]\n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
      print ("<TR class='tablerow'>\n");
      print ("<TD class='mediumtxt' bgcolor='$StyleRow[alt1]' align='center'>\n");
	  print ("$row[text]\n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
      print ("<TR class='tablerow'>\n");
      print ("<TD class='mediumtx' bgcolor='$StyleRow[alt2]' align='center'>\n");
      print ("<form action='removetext.php' method='post'>\n");
	  print ("<input name='place' type='hidden' value='$row[id]'>\n");
	  print ("<input name='dbname' type='hidden' value='$dbname'>\n");
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
