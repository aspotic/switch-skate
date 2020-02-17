<?php require ("header.php"); ?>

<table width="<?php echo $StyleRow[tablew] ?>" align="center">
<tr>
<td valign="top">
<?php require ("left.php"); ?>
</td>

<td valign="top" width="<?php echo $StyleRow[tablew] ?>">

<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
  
    <TR>
      <TD bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">	
<b>Submit Content </b>
	  </TD>
	</TR>
	
    <TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
	  
<a href="http://www.switchskate.net/site/submit/comments.php">Comments</a><br>
<a href="http://www.switchskate.net/site/submit/text.php">Submit Text</a><br>
<a href="http://www.switchskate.net/site/submit/theme.php">Submit a Color Scheme</a><br>
<a href="http://www.switchskate.net/site/submit/picture.php">Submit Pictures</a><br>
<a href="http://www.switchskate.net/site/submit/resume.php">Become an Administrator</a><br>
<a href="http://www.switchskate.net/site/submit/link.php">Get Linked</a> 	    
	  
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