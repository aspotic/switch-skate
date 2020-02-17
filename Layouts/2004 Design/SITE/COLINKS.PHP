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
	  print ("Computer Related Links\n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
	  print ("<TR class='tablerow'>\n");
      print ("<TD class='mediumtxt' bgcolor='$StyleRow[alt1]' align='left'>\n");
	  
	  
$host = "localhost";
$username = "switchsk_adam";
$password = "drummer";
$dbname = "switchsk_cucont";
$tablename = "colinks";

$link = mysql_connect ($host, $username, $password);
$query = "SELECT * from $tablename";
$result = mysql_db_query ($dbname, $query, $link);
mysql_close ($link);


while ($row = mysql_fetch_array($result)){

	  print ("-) <a href='$row[url]' target='_blank'>$row[site]</a><br>\n");	

}

	  print ("</TD>\n");
	  print ("</TR>\n");
    print ("</TBODY>\n");
  print ("</TABLE>\n");
print ("<br>\n");

print ("<TABLE style='width:$StyleRow[tablew]; border:$StyleRow[borderw]px solid $StyleRow[border];' cellspacing='$StyleRow[borderw]' cellPadding='6' align='center'>\n");
  print ("<TBODY>\n");
    print ("<TR>\n");
	  print ("<TD bgcolor='$StyleRow[catagory]' background='$StyleRow[catagory]' align='center'>\n");
	  print ("Cool Sites \n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
      print ("<TR class='tablerow'>\n");
      print ("<TD class='mediumtxt' bgcolor='$StyleRow[alt1]' align='left'>\n");
echo " <script src='http://search.revenuepilot.com/servlet/search?mode=js&perpage=3&filter=off&id=14269&sid=0&skip=0&keyword=hosting'></script> \n";
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
