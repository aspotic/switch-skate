<?php require ("header.php"); ?>

<table width="<?php echo $StyleRow[tablew] ?>" align="center">
<tr>
<td valign="top">
<?php require ("left.php"); ?>
</td>

<td valign="top" width="<?php echo $StyleRow[tablew] ?>">

<form action="handtheme.php" method="post">

<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
  
    <TR>
      <TD bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="right">	
<b>SUBMIT THEME </b>
	  </TD>
	  <TD bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="left">	
<b>CODE </b>
	  </TD>
	</TR>

	
    <TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt1] ?>" align="right">

	  
	  <table height="240" align="right">
	  <tr align="right"><td class=mediumtxt>Your Name:</td></tr>
	  <tr align="right"><td class=mediumtxt>Your Email:</td></tr>
	  <tr align="right"><td class=mediumtxt>Theme Name:</td></tr>
	  <tr align="right"><td class=mediumtxt>Background Color:</td></tr>
	  <tr align="right"><td class=mediumtxt>Alternating Color 1:</td></tr>
	  <tr align="right"><td class=mediumtxt>Alternating Color 2:</td></tr>
	  <tr align="right"><td class=mediumtxt>Table Color:</td></tr>
	  <tr align="right"><td class=mediumtxt>Border Color:</td></tr>
	  <tr align="right"><td class=mediumtxt>Link Color:</td></tr>
	  <tr align="right"><td class=mediumtxt>Link Rollover Color:</td></tr>
	  <tr align="right"><td class=mediumtxt>Text Color:</td></tr>
	  <tr align="right"><td class=mediumtxt>Font Type:</td></tr>
	  </table>

      </TD>
	  
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="left">

	
<input name="person" type="text" value=""><br>
<input name="email" type="text" value=""><br>  
<input name="name" type="text" value=""><br>
<input name="bg" type="text" value=""><br>
<input name="alt1" type="text" value=""><br>
<input name="alt2" type="text" value=""><br>
<input name="tablecolor" type="text" value=""><br>
<input name="border" type="text" value=""><br>
<input name="link" type="text" value=""><br>
<input name="roll" type="text" value=""><br>
<input name="text" type="text" value=""><br>
<input name="font" type="text" value=""><br>

      </TD>
	</TR>
  </TBODY>
</TABLE>
<br>
<center>
<input type="submit" value="Submit">

</form>
</td>

<td valign="top">
<?php require ("right.php"); ?>
</td>
</tr>
</table>
<br>
<br>

<?php require ("footer.php"); ?>