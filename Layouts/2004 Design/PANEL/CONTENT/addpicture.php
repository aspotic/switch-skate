<?php require ("header.php"); ?>

<form name="submitpic" method="post" action="" enctype="multipart/form-data"> 

<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
  
    <TR>
      <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">	
<b>SUBMIT CONTENT : PICTURE </b>
	  </TD>
	</TR>
	
    <TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
	  <table align="center"><tr class=tablerow><td align="left" class=mediumtxt>
Trick Name: <input name="trick" type="text" value=""> <br>
Persons Name: <input name="name" type="text" value=""> <br>
Persons Email: <input name="email" type="text" value=""> <br>
Picture Name: <input name="filenm" type="text" value=""> <br>
<input type="submit" name="Submit" value="Submit"> 
</td></tr></table>
<br>
<? 


$FContDB = "switchsk_cucont";
$LinkUp = mysql_connect ($host, $user, $pass);
$FContQuery = "insert into pictures values ('0', '$trick', '$name','$email','$filenm')";

if (mysql_db_query ($FContDB, $FContQuery, $LinkUp)){}else {die ("Error");}

?>

</form>
<br>
      </TD>
	</TR>
  </TBODY>
</TABLE>
<br>