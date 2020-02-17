<?php require ("header.php"); 



?>

<br>



<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
  
    <TR>
      <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">	
<b>Add a tutorial</b>
	  </TD>
	</TR>

	
    <TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
	<form action="handle.php" method="post">
	<select name="type" style=" border-color:<?php echo $StyleRow[borderw] ?>; border-style: solid; width:135px;height:20px;background-color:<?php echo $row[alt1] ?>;color:<?php echo $row[text] ?>;font-size:8pt; font-family:<?php echo $row[font] ?>;">
    <option value="tutorials3" selected>PHP
    <option  value="tutorials2" >CSS
	<option  value="tutorials1" >HTML
	<option  value="tutorials4" >Other
    </select>  <br>
	<input name="title" type="text"  value="Site Name:" onFocus="if(this.value=='Site Name:')this.value='';" onBlur="if(this.value=='' )this.value='Site Name:';"><br>
	<textarea name="text" style=" border-color:<?php echo $row[bordw] ?>; border-style: solid; width:135px;height:100px;background-color:<?php echo $row[alt2] ?>;color:<?php echo $row[text] ?>;font-size:8pt; font-family:<?php echo $row[font] ?>;"></textarea><br>
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
