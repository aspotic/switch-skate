<?php require ("header.php"); 



?>

<br>



<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
  
    <TR>
      <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">	
<b>Add a Link</b>
	  </TD>
	</TR>

	
    <TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
	<form action="handle.php" method="post">
	<select name="type" style=" border-color:<?php echo $StyleRow[borderw] ?>; border-style: solid; width:135px;height:20px;background-color:<?php echo $row[alt1] ?>;color:<?php echo $row[text] ?>;font-size:8pt; font-family:<?php echo $row[font] ?>;">
    <option value="sblinks" selected>Skateboard - Link
    <option  value="colinks" >Computer - Link
    </select>  <br>
	<input name="title" type="text"  value="Site Name:" onFocus="if(this.value=='Site Name:')this.value='';" onBlur="if(this.value=='' )this.value='Site Name:';"><br>
	<input name="text" type="text" value="Site URL:" onFocus="if(this.value=='Site URL:')this.value='';" onBlur="if(this.value=='' )this.value='Site URL:';"><br>
	<input type="submit" name="submit" value="Submit">  
	</form>
	<br>

      </TD>
	</TR>
  </TBODY>
</TABLE>
<br>

</body>
</html>
