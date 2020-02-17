<?php require ("header.php"); 



?>

<br>

<form action="handtext.php" method="post">

<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
  
    <TR>
      <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">	
<b>SUBMIT CONTENT : TEXT </b>
	  </TD>
	</TR>
	
		<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
	<select name="type" style=" border-color:<?php echo $StyleRow[borderw] ?>; border-style: solid; width:135px;height:20px;background-color:<?php echo $row[alt1] ?>;color:<?php echo $row[text] ?>;font-size:8pt; font-family:<?php echo $row[font] ?>;">
    <option selected value=0 >Type of Content
    <option value=1 >Skate - Trick Tip
    <option value=2 >Skate - Review
    <option  value=3 >Skate - Article
    <option  value=4 >Skate - Skate Story
    <option  value=5 >Computer - Tutorial
    <option  value=6 >Computer - Review
    </select>
	  </TD>
	</TR>
	
    <TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
	  
<input name="name" type="text"  value="Your Name:" onFocus="if(this.value=='Your Name:')this.value='';" onBlur="if(this.value=='' )this.value='Your Name:';"><br>
<input name="email" type="text" value="Your Email:" onFocus="if(this.value=='Your Email:')this.value='';" onBlur="if(this.value=='' )this.value='Your Email:';"><br>
<input name="title" type="text" value="Title:" onFocus="if(this.value=='Title:')this.value='';" onBlur="if(this.value=='' )this.value='Title:';"><br>
<textarea name="text" rows=10 cols=100 style=" border-color:<?php echo $row[bordw] ?>; border-style: solid; width:135px;height:200px;background-color:<?php echo $row[alt2] ?>;color:<?php echo $row[text] ?>;font-size:8pt; font-family:<?php echo $row[font] ?>;">
Text:</textarea><br>
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
