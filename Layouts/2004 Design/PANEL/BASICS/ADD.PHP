<?php

require ("header.php");

$host = "localhost";
$user = "switchsk_adam";
$pass = "drummer";
$PerDB="switchsk_other";

$LinkUp = mysql_connect ($host, $user, $pass);

$PerQuery1 = "SELECT * from partdone";
$PerResult = mysql_db_query ($PerDB, $PerQuery1, $LinkUp);
$PerRow = mysql_fetch_array($PerResult);

while ($PerRow = mysql_fetch_array($PerResult)){$perc++;}


$PerQuery2 = "INSERT INTO partdone ( id ) VALUES ( '0' ); ";
$PerResult = mysql_db_query ($PerDB, $PerQuery2, $LinkUp);

$perc++;

mysql_close ($LinkUp);
?>

<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
  
    <TR>
	  <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>% Complete</b>
	  </TD>
	</TR>
	
	<TR class=smalltxt>
	  <TD bgolor="<?php echo $StyleRow[alt1] ?>"align="left">
<?php
print ("<center><br><br>$perc COMPLETE");
print ("<script>\n");
print ("function redirect()\n");
print ("{window.location.replace('http://www.switchskate.net/panel/index.php');}\n");
print ("setTimeout('redirect();', 1250);\n");
print ("</script>\n");	
?>
	  </TD>
	</TR>
	
  </TBODY>
</TABLE>
