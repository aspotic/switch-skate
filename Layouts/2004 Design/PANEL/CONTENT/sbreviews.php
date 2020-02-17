<?php
require ("header.php");


print ("<TABLE style='width:$StyleRow[tablew]; border:$StyleRow[borderw]px solid $StyleRow[border];' cellspacing='$StyleRow[borderw]' cellPadding='6' align='center'>\n");
  print ("<TBODY>\n");
    print ("<TR>\n");
	  print ("<TD bgolor='$StyleRow[catagory]' background='$StyleRow[catagory]' align='center'>\n");
	  print ("Skateboarding Reviews\n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
      print ("<TR class='tablerow'>\n");
      print ("<TD class='mediumtxt' bgcolor='$StyleRow[alt1]' align='center'>\n");
	  print ("<a href='sbredecks.php'>Decks</a><br>\n");	
	  print ("<a href='sbretrucks.php'>Trucks</a><br>\n");	
	  print ("<a href='sbrewheels.php'>Wheels</a><br>\n");	
	  print ("<a href='sbreother.php'>Other</a><br>\n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
   print ("</TBODY>\n");
print ("</TABLE>\n");
print ("<br>\n");


?>

</body>
</html>
