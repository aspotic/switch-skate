<TABLE style="width:150; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
      <TD bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>Vote for us</b>
	  </TD>
	</TR>
	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt1] ?>" align="center" valign="top">
<A HREF="http://www.skateboard-city.com/topsites/vote.php?id=1100010299"
TARGET="_blank"><IMG
SRC="http://www.skateboard-city.com/topsites/pictures/vote.gif" BORDER=0
ALT="Skateboard City">
</A>
<br><br>
<a href="http://www.skatetop.com/index.php?do=v&i=197" target="_blank">
<img src="http://www.skatetop.com/index.php?do=in&id=197" border=0
ALT="Skate Top">
</a>
<br><br>
<a href="http://www.electroskate.com/toplist/in.php?id=39" target="_blank">
<img src="http://www.electroskate.com/toplist/images/button.jpg" border=0
ALT="Electroskate">
</a>
<br><br>
<a href="http://www.no-complyskate.co.uk/topsites/in.php?id=3" target="_blank">
<img src="http://www.no-complyskate.co.uk/topsites/img.php?id=3" border="0"></a>
<br><br>
<a href="http://www.customskateboarding.com/topsite/index.php?id=32" target="_blank">
<img src="http://www.customskateboarding.com/topsite/img.php?id=32" border="0"></a>


	  </TD>
	</TR>
  </TBODY>
</TABLE>
<br>
<TABLE style="width:150; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
      <TD bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>Submit a picture</b>
	  </TD>
	</TR>
	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center" valign="top">
<form name="submitpic" method="post" action="" enctype="multipart/form-data"> 
 <input type="file" name="imagefile" style="width:140;"><br>
 <input name="trick" type="text" value="Trick Name:"><br>
 <input name="name" type="text" value="Name:"><br>
 <input name="email" type="text" value="(optional) Email: "><br>
Allowed: gif, jpg, png<br>
<input type="submit" name="Submit" value="Submit"> 
<br>

<? 

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 

if(isset( $Submit )) 
{ 



//If the Submitbutton was pressed do: 

if (($_FILES['imagefile']['type'] == "image/gif") || ($_FILES['imagefile']['type'] == "image/pjpeg") || ($_FILES['imagefile']['type'] == "application/octet-stream")){ 
    $filenm = $_FILES['imagefile']['name'];
	


$FContDB = "switchsk_fcontent";
$LinkUp = mysql_connect ($host, $user, $pass);
$FContQuery = "insert into pictures values ('0', '$trick', '$name','$email','$filenm')";

if (mysql_db_query ($FContDB, $FContQuery, $LinkUp)){}else {die ("Error");}

	
	copy ($_FILES['imagefile']['tmp_name'], "submit/files/".$_FILES['imagefile']['name']) 
    or die ("Could not copy"); 
       echo ""; 
        echo "Another? <br>\n"; 
        } 
		        else { 
            echo ""; 
            echo "Wrong Filetype"; 
        } 
} 
?>

</form>

	  </TD>
	</TR>
  </TBODY>
</TABLE>

<br>

<TABLE style="width:150; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
      <TD bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>Comments</b>
	  </TD>
	</TR>
	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
	  <form action="http://www.switchskate.net/site/handcomment.php" method="post">
<textarea name="text" style=" border-color:<?php echo $row[bordw] ?>; border-style: solid; width:120px;height:100px;background-color:<?php echo $row[alt2] ?>;color:<?php echo $row[text] ?>;font-size:8pt; font-family:<?php echo $row[font] ?>;">
</textarea><br><br>
<input type="submit" name="submit" value="Submit">  
</form>
	  </TD>
	</TR>
  </TBODY>
</TABLE>
