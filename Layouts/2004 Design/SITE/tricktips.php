<?php
require ("header.php");

?>
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
	  print ("Trick Tips\n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
      print ("<TR class='tablerow'>\n");
      print ("<TD class='mediumtxt' bgcolor='$StyleRow[alt1]' align='center'>\n");
	  print ("<a href='tteasy.php'>Beginner</a><br>\n");	
	  print ("<a href='tthard.php'>Flatland</a><br>\n");	
	  print ("<a href='ttpro.php'>Grinds/Slides</a><br>\n");	
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
