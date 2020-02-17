<?php

require ("header.php");


$host = "localhost";
$user = "switchsk_adam";
$pass = "drummer";
$StyleDB="switchsk_style";
$LinkUp = mysql_connect ($host, $user, $pass);

// Pick the Color Scheme

$PickDB="switchsk_style";
$PickQuery = "SELECT * from choice WHERE id = 1";
$PickResult = mysql_db_query ($PickDB, $PickQuery, $LinkUp);
$PickRow = mysql_fetch_array($PickResult);

// Open color scheme for use

$Style2DB="switchsk_style";
$Style2Query = "SELECT * from colors WHERE id = $PickRow[scheme] ";
$Style2Result = mysql_db_query ($Style2DB, $Style2Query, $LinkUp);
$Style2Row = mysql_fetch_array($Style2Result);



mysql_close ($LinkUp);
?>


<center>
<form action="newcolor.php" method="post">

<h3>EDIT WEBSITE STYLE</h3>

<table style="border: thin solid <?php echo $StyleRow[border] ?>;width:400;" bgcolor="<?php echo $Style2Row[alt1] ?>" valign="top" align="center">
<tr>
<td>THEME NAME</td>
<td align="right"><input name="title" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td width="65"></td>
</tr>

<tr>
<td>BACKGROUND</td>
<td align="right"><input name="bg" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>
</table>
<br>
<table style="border: thin solid <?php echo $StyleRow[border] ?>;width:400;" bgcolor="<?php echo $Style2Row[alt2] ?>" valign="top" align="center">
<tr>
<td>ALTERNATING COLOR 1</td>
<td align="right"><input name="alt1" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>ALTERNATING COLOR 2</td>
<td align="right"><input name="alt2" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>HEADER COLOR</td>
<td align="right"><input name="header" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>TOP TABLE COLOR</td>
<td align="right"><input name="toptable" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>CATAGORY COLOR</td>
<td align="right"><input name="catagory" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>CATAGORY BG COLOR</td>
<td align="right"><input name="catback" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>BORDER COLOR</td>
<td align="right"><input name="border" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>
</table>
<br>
<table style="border: thin solid <?php echo $StyleRow[border] ?>;width:400;" bgcolor="<?php echo $Style2Row[alt1] ?>" valign="top" align="center">
<tr>
<td>TEXT</td>
<td align="right"><input name="text" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>TABLE TEXT</td>
<td align="right"><input name="tabletxt" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>HEADER TEXT</td>
<td align="right"><input name="headertxt" type="text" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>CATAGORY TEXT</td>
<td align="right"><input name="cattxt" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>LINK COLOR</td>
<td align="right"><input name="link" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>ROLLOVER COLOR</td>
<td align="right"><input name="roll" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>
</table>
<br>
<table style="border: thin solid <?php echo $StyleRow[border] ?>;width:400;" bgcolor="<?php echo $Style2Row[alt2] ?>" valign="top" align="center">
<tr>
<td>BASE</td>
<td align="right"><input name="base" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>TRACK</td>
<td align="right"><input name="track" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>ARROW</td>
<td align="right"><input name="arrow" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>COLOR</td>
<td align="right"><input name="color" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>HIGHLIGHT</td>
<td align="right"><input name="highlight" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>DARK</td>
<td align="right"><input name="dark" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>SHADOW</td>
<td align="right"><input name="shadow" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>

<tr>
<td>3DLIGHT</td>
<td align="right"><input name="light" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
</tr>
</table>
<br>
<table style="border: thin solid <?php echo $StyleRow[border] ?>;width:400;" bgcolor="<?php echo $Style2Row[alt1] ?>" valign="top" align="center">
<tr>
<td valign="top">RAW CSS</td>
<td align="right">

<textarea name="rawcss" style="border-color<?php echo $StyleRow[border] ?>:; border-style: solid; width:130px;height:70px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;">
</textarea></td>
<td<td width="65"></td>
</tr>

<tr>
<td>BORDER WIDTH</td>
<td align="right"><input name="borderw" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td<td width="65"></td>
</tr>

<tr>
<td>TABLE WIDTH</td>
<td align="right"><input name="tablew" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td<td width="65"></td>
</tr>

<tr>
<td>TABLE SPACING</td>
<td align="right"><input name="tablespace" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td<td width="65"></td>
</tr>

<tr>
<td>BORDER WIDTH</td>
<td align="right"><input name="borderw" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td<td width="65"></td>
</tr>

<tr>
<td>FONT FACE</td>
<td align="right"><input name="font" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td width="65"></td>
</tr>

<tr>
<td>FONT SIZE</td>
<td align="right"><input name="fontsize" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td width="65"></td>
</tr>
</table>
<br>
<table style="border: thin solid <?php echo $StyleRow[border] ?>;width:400;" bgcolor="<?php echo $Style2Row[alt2] ?>" valign="top" align="center">

<tr>
<td>IMAGE DIRECTORY</td>
<td align="right"><input name="imagedir" type="text" value="" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td width="65"></td>
</tr>

</table>
<br>
<input name="edit" type="hidden" value=" <?php echo $edit ?> ">
<input type="submit" value="Submit" style="border-color<?php echo $StyleRow[border] ?>:; border-style: solid; width:110px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;">

</form>

<br>
<br>
<br>

</body>
</html>