<?php

require ("header.php");  // Open header file


// Constant Variables

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 
$LinkUp = mysql_connect ($host, $user, $pass);
$count = 0;


// Connect to News Ticker Tape

$NewsDB="switchsk_other";
$NewsQuery = "SELECT * from news";
$NewsResult = mysql_db_query ($NewsDB, $NewsQuery, $LinkUp);

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
	  print ("<b>Sports News</b>\n");
	 print (" </TD>\n");
	print ("</TR>\n");
    print ("<TR class=tablerow>\n");
      print ("<TD class=mediumtxt bgColor='$StyleRow[alt1]'>\n");
?>
<!--#include virtual="/v-cgi/feeds.cgi?feedid=38"-->
<?php
      print ("</TD>\n");
	print ("</TR>\n");
  print ("</TBODY>\n");
print ("</TABLE>\n");

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

