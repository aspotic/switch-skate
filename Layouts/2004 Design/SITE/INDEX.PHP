<SCRIPT LANGUAGE="JavaScript" src="http://www.popuptraffic.com/assign.php?l=drumsticks&mode=behind"> </script>
<SCRIPT LANGUAGE="JavaScript" src="http://www.popuptraffic.com/assign.php?l=drumsticks"></script> 

<?php

require ("header.php");  // Open header file

$ipaddress = $_SERVER['REMOTE_ADDR'];


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
while ($NewsRow = mysql_fetch_array($NewsResult)){$post++;}

while ($count <= 2)
{
$NewsDB="switchsk_other";
$NewsQuery = "SELECT * from news WHERE id = '$post'";
$NewsResult = mysql_db_query ($NewsDB, $NewsQuery, $LinkUp);
$NewsRow = mysql_fetch_array($NewsResult);

print ("<TABLE style='width:$StyleRow[tablew]; border:$StyleRow[borderw]px solid $StyleRow[border];' cellspacing='$StyleRow[borderw]' cellPadding='6' align='center'>\n");
  print ("<TBODY>\n");
    print ("<TR>\n");
      print ("<TD bgcolor='$StyleRow[catagory]' background='$StyleRow[catagory]' align='center'>\n");
	  print ("<b>$NewsRow[title]</b>\n");
	 print (" </TD>\n");
	print ("</TR>\n");
	print ("<TR class=tablerow>\n");
    print ("  <TD class=mediumtxt bgColor='$StyleRow[alt1]' align='center'>\n");
	print ("Published by: $NewsRow[name] <br>\n");
	print ("Published on: $NewsRow[date] \n");
	  print ("</TD>\n");
	print ("</TR>\n");
	
    print ("<TR class=tablerow>\n");
      print ("<TD class=mediumtxt bgColor='$StyleRow[alt1]'>\n");
	  
print ("$NewsRow[text] \n");  

      print ("</TD>\n");
	print ("</TR>\n");
  print ("</TBODY>\n");
print ("</TABLE>\n");
print ("<br><br>\n");

$count++;
$post--;
}
mysql_close($LinkUp);
?>

<br><br><center>
<a href="http://www.switchskate.net/site/oldnews.php">(<?php echo $news ?>) View old news</a><br>
<?php echo "<a href='http://search.revenuepilot.com/servlet/search?mode=html&id=14269&sid=1&filter=on&perpage=20&ip=$ipaddress&skip=0&keyword=hosting' target='_blank'>Find unbelievable hosting here</a><br> \n"; ?>
</td>

<td valign="top">
<?php require ("right.php"); ?>
</td>
</tr>
</table>
<br>
<br>

<?php require ("footer.php"); ?>

