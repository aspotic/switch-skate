<?php require ("header.php");

// Constant Variables

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 
$LinkUp = mysql_connect ($host, $user, $pass);


// Open the copyright text

$CopyDB = "switchsk_other"; 
$CopyQuery = "SELECT * from copyright WHERE 1";
$CopyResult = mysql_db_query ($CopyDB, $CopyQuery, $LinkUp);
$CopyRow = mysql_fetch_array($CopyResult);	

mysql_close ($LinkUp);

?>

<br>
<center><a href="http://www.switchskate.net/forums"><h3>ENTER FORUMS</h3></a></center> 
<br>
	

	
<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
      <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>COPYRIGHT</b>
	  </TD>
	</TR>
	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt1] ?>" align="center">
	Published by: <?php echo $CopyRow[name] ?><br>
	Published on: <?php echo $CopyRow[date] ?>
	  </TD>
	</TR>
	
    <TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt1] ?>">
	  
<?php echo $CopyRow[text] ?>	  

      </TD>
	</TR>
  </TBODY>
</TABLE>

<br>

<?php require ("footer.php"); ?>