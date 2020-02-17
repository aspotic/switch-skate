<?php require ("header.php"); ?>
<table width="<?php echo $StyleRow[tablew] ?>" align="center">
<tr>
<td valign="top">
<?php require ("left.php"); ?>
</td>

<td valign="top" width="<?php echo $StyleRow[tablew] ?>">


<?php
print ("<TABLE style='width:$StyleRow[tablew]; border:$StyleRow[borderw]px solid $StyleRow[border];' cellspacing='$StyleRow[borderw]' cellPadding='6' align='center'>\n");
  print ("<TBODY>\n");
    print ("<TR>\n");
	  print ("<TD bgcolor='$StyleRow[catagory]' background='$StyleRow[catagory]' align='center'>\n");
	  print ("Link Us\n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
	  print ("<TR class='tablerow'>\n");
      print ("<TD class='mediumtxt' bgcolor='$StyleRow[alt2]' align='center'><br><br>\n");
	  	  

$host = "localhost";
$user = "switchsk_adam";
$password = "drummer";
$dbname = "switchsk_cucont";
$tablename = "linkus";

$link = mysql_connect ($host, $user, $password);
$query = "SELECT * from $tablename";
$result = mysql_db_query ($dbname, $query, $link);
mysql_close ($link);


while ($row = mysql_fetch_array($result)){

	  print ("<img src='$row[direc]'><br><br><textarea name='code' rows=5 cols=50 ><a href='http://www.switchskate.net' target='_self'><img src='$row[direc]'></a></textarea><br><br><br><br>\n");	

}

	  print ("<a href='http://www.switchskate.net'>Switch Skate</a><br><br><textarea name='code' rows=5 cols=50 ><a href='http://www.switchskate.net' target='_self'>Switch Skate</a></textarea><br><br>\n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
    print ("</TBODY>\n");
  print ("</TABLE>\n");
print ("<br>\n");
?>
</td>

<td valign="top">
<?php require ("right.php"); ?>
</td>
</tr>
</table>
<br>
<br>

<?php require ("footer.php"); ?>
</body>
</html>
