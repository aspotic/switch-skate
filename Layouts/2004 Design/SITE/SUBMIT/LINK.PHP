<?php require ("header.php"); ?>
<table width="<?php echo $StyleRow[tablew] ?>" align="center">
<tr>
<td valign="top">
<?php require ("left.php"); ?>
</td>

<td valign="top" width="<?php echo $StyleRow[tablew] ?>">


<form action="handlink.php" method="post">

<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
  
    <TR>
      <TD bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">	
<b>SUBMIT CONTENT : LINK </b>
	  </TD>
	</TR>
	
		<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
	<select name="type" style=" border-color:<?php echo $StyleRow[borderw] ?>; border-style: solid; width:135px;height:20px;background-color:<?php echo $row[alt1] ?>;color:<?php echo $row[text] ?>;font-size:8pt; font-family:<?php echo $row[font] ?>;">
    <option selected value=0 >Type of Content
    <option value=1 >Skate - Link
    <option  value=2 >Computer - Link
    </select>
	  </TD>
	</TR>
	
    <TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
	  
<input name="name" type="text"  value="Your Name:" onFocus="if(this.value=='Your Name:')this.value='';" onBlur="if(this.value=='' )this.value='Your Name:';"><br>
<input name="email" type="text" value="Your Email:" onFocus="if(this.value=='Your Email:')this.value='';" onBlur="if(this.value=='' )this.value='Your Email:';"><br>
<input name="site" type="text" value="Site Name:" onFocus="if(this.value=='Site Name:')this.value='';" onBlur="if(this.value=='' )this.value='Site Name:';"><br>
<input name="url" type="text" value="Site URL:" onFocus="if(this.value=='Site URL:')this.value='';" onBlur="if(this.value=='' )this.value='Site URL:';"><br>

<input type="submit" name="submit" value="Submit">  
</form>
<br>
      </TD>
	</TR>
  </TBODY>
</TABLE>
</td>

<td valign="top">
<?php require ("right.php"); ?>
</td>
</tr>
</table>
<br>
<br>

<?php require ("footer.php"); ?>