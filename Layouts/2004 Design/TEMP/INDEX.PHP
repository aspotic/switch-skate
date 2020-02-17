<?php

require ("header.php");  // Open header file


// Constant Variables

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 
$LinkUp = mysql_connect ($host, $user, $pass);


// Connect to News Ticker Tape

$NewsDB="switchsk_other";
$NewsQuery = "SELECT * from news WHERE id = 1";
$NewsResult = mysql_db_query ($NewsDB, $NewsQuery, $LinkUp);
$NewsRow = mysql_fetch_array($NewsResult);


mysql_close ($LinkUp);  //Close Database Connection

?>



<br>
<center><a href="http://switchskate.net/forums/portal.php"><h3>ENTER FORUMS</h3></a></center>	  
<br>




<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
      <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>NEWS</b>
	  </TD>
	</TR>
	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt1] ?>" align="center">
	Published by: <?php echo $NewsRow[name] ?><br>
	Published on: <?php echo $NewsRow[date] ?>
	  </TD>
	</TR>
	
    <TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt1] ?>">
	  
<?php echo $NewsRow[text] ?>	  

      </TD>
	</TR>
  </TBODY>
</TABLE>

<br><br>

<?php require ("footer.php"); ?>

</body>
</html>
