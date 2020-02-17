<?php require ("header.php"); ?>

<form action="tablecreate.php">

<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
	  <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>Make a new DB table</b>
	  </TD>
	</TR>

	<TR class=smalltxt>
	  <TD bgcolor="<?php echo $StyleRow[alt2] ?>"align="center">
<input name="dbname" type="text" value="switchsk_ D B"><br>
<input name="tablename" type="text" value="TABLE N A M E"><br>
<input name="a" type="text" value="">&nbsp;<input name="b" type="text" value=""><br>
<input name="c" type="text" value="">&nbsp;<input name="d" type="text" value=""><br>
<input name="e" type="text" value="">&nbsp;<input name="f" type="text" value=""><br>
<input name="g" type="text" value="">&nbsp;<input name="h" type="text" value=""><br>
<input name="i" type="text" value="">&nbsp;<input name="j" type="text" value=""><br>
<input name="k" type="text" value="">&nbsp;<input name="l" type="text" value=""><br>
<input name="m" type="text" value="">&nbsp;<input name="n" type="text" value=""><br>
<input name="o" type="text" value="">&nbsp;<input name="p" type="text" value=""><br>
<input name="q" type="text" value="">&nbsp;<input name="r" type="text" value=""><br>
<input name="s" type="text" value="">&nbsp;<input name="t" type="text" value="">
<br><br>
<b>
&nbsp;TEXT,
</b>
<br><br>
<input type="submit" value="SUBMIT">
	  </TD>
	</TR>
  </TBODY>
</TABLE>

</form>


<br>
</body>
</html>