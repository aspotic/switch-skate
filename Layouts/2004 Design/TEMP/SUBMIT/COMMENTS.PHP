<?php require ("header.php"); 



?>

<br>

<form action="handcomment.php" method="post">

<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
  
    <TR>
      <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">	
<b>COMMENTS </b>
	  </TD>
	</TR>
	
    <TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
	  
<textarea name="text" rows=10 cols=100 style=" border-color:<?php echo $row[bordw] ?>; border-style: solid; width:135px;height:200px;background-color:<?php echo $row[alt2] ?>;color:<?php echo $row[text] ?>;font-size:8pt; font-family:<?php echo $row[font] ?>;">
Comments:</textarea><br>
<input type="submit" name="submit" value="Submit">  
</form>
<br>
      </TD>
	</TR>
  </TBODY>
</TABLE>
<br>

<?php require ("footer.php"); ?>

</body>
</html>
