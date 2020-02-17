<?php require ("header.php"); ?>

<table width="<?php echo $StyleRow[tablew] ?>" align="center">
<tr>
<td valign="top">
<?php require ("left.php"); ?>
</td>

<td valign="top" width="<?php echo $StyleRow[tablew] ?>">


<form action="handresume.php" method="post">

<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
  
    <TR>
      <TD bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">	
<b>BECOME AN ADMINISTRATOR </b>
	  </TD>
	</TR>

	
    <TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">

	  
<input name="name" type="text"  value="Your Name:" onFocus="if(this.value=='Your Name:')this.value='';" onBlur="if(this.value=='' )this.value='Your Name:';"><br>
<input name="email" type="text" value="Your Email:" onFocus="if(this.value=='Your Email:')this.value='';" onBlur="if(this.value=='' )this.value='Your Email:';"><br>
<input name="talk" type="text" value="MSN or AOL address:" onFocus="if(this.value=='Title:')this.value='';" onBlur="if(this.value=='' )this.value='Title:';"><br>
<textarea name="help" style=" border-color:<?php echo $row[bordw] ?>; border-style: solid; width:135px;height:100px;background-color:<?php echo $row[alt2] ?>;color:<?php echo $row[text] ?>;font-size:8pt; font-family:<?php echo $row[font] ?>;">
How you can help:</textarea><br>
<textarea name="comment" style=" border-color:<?php echo $row[bordw] ?>; border-style: solid; width:135px;height:80px;background-color:<?php echo $row[alt2] ?>;color:<?php echo $row[text] ?>;font-size:8pt; font-family:<?php echo $row[font] ?>;">
Other comments:</textarea><br><br>
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
