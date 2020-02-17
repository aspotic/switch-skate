<?php

require ("header.php");


$host = "localhost";
$user = "switchsk_adam";
$pass = "drummer";
$StyleDB="switchsk_style";
$LinkUp = mysql_connect ($host, $user, $pass);



if (($edit == 0) && ($select != 0 )) {

$Pick2DB="switchsk_style";
$Pick2Query = "UPDATE choice SET scheme = '$select' WHERE id='1'";
$Pick2Result = mysql_db_query ($Pick2DB, $Pick2Query, $LinkUp);

print ("<center><br><br>your changes were made\n");
print ("<script>\n");
print ("function redirect()\n");
print ("{window.location.replace('color.php');}\n");
print ("setTimeout('redirect();', 1250);\n");
print ("</script>\n");

exit;

}elseif ($select == 0){
print ("<center><br><br>Please select a theme\n");
print ("<script>\n");
print ("function redirect()\n");
print ("{window.location.replace('color.php');}\n");
print ("setTimeout('redirect();', 1250);\n");
print ("</script>\n");
exit;

}

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


// Open color scheme for editing

$StyleDB="switchsk_style";
$StyleQuery = "SELECT * from colors WHERE id = $edit";
$StyleResult = mysql_db_query ($StyleDB, $StyleQuery, $LinkUp);
$StyleRow = mysql_fetch_array($StyleResult);

$Pick2DB="switchsk_style";
$Pick2Query = "UPDATE choice SET scheme = '$select' WHERE id='1'";
$Pick2Result = mysql_db_query ($Pick2DB, $Pick2Query, $LinkUp);

mysql_close ($LinkUp);
?>


<center>
<form action="chcolor.php" method="post">

<h3>EDIT WEBSITE STYLE</h3>

<table style="border: thin solid <?php echo $StyleRow[border] ?>;width:400;" bgcolor="<?php echo $Style2Row[alt1] ?>" valign="top" align="center">
<tr>
<td>THEME NAME</td>
<td align="right"><input name="title" type="text" value="<?php echo $StyleRow[title] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td width="65"></td>
</tr>

<tr>
<td>BACKGROUND</td>
<td align="right"><input name="bg" type="text" value="<?php echo $StyleRow[bg] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[bg] ?>" width="65"></td>
</tr>
</table>
<br>
<table style="border: thin solid <?php echo $StyleRow[border] ?>;width:400;" bgcolor="<?php echo $Style2Row[alt2] ?>" valign="top" align="center">
<tr>
<td>ALTERNATING COLOR 1</td>
<td align="right"><input name="alt1" type="text" value="<?php echo $StyleRow[alt1] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[alt1] ?>" width="65"></td>
</tr>

<tr>
<td>ALTERNATING COLOR 2</td>
<td align="right"><input name="alt2" type="text" value="<?php echo $StyleRow[alt2] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[alt2] ?>" width="65"></td>
</tr>

<tr>
<td>HEADER COLOR</td>
<td align="right"><input name="header" type="text" value="<?php echo $StyleRow[header] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[header] ?>" width="65"></td>
</tr>

<tr>
<td>TOP TABLE COLOR</td>
<td align="right"><input name="toptable" type="text" value="<?php echo $StyleRow[toptable] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[toptable] ?>" width="65"></td>
</tr>

<tr>
<td>CATAGORY COLOR</td>
<td align="right"><input name="catagory" type="text" value="<?php echo $StyleRow[catagory] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[catagory] ?>" width="65"></td>
</tr>

<tr>
<td>BORDER COLOR</td>
<td align="right"><input name="border" type="text" value="<?php echo $StyleRow[border] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[border] ?>" width="65"></td>
</tr>
</table>
<br>
<table style="border: thin solid <?php echo $StyleRow[border] ?>;width:400;" bgcolor="<?php echo $Style2Row[alt1] ?>" valign="top" align="center">
<tr>
<td>TEXT</td>
<td align="right"><input name="text" type="text" value="<?php echo $StyleRow[text] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[text] ?>" width="65"></td>
</tr>

<tr>
<td>TABLE TEXT</td>
<td align="right"><input name="tabletxt" type="text" value="<?php echo $StyleRow[tabletxt] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[tabletxt] ?>" width="65"></td>
</tr>

<tr>
<td>HEADER TEXT</td>
<td align="right"><input name="headertxt" type="text" value="<?php echo $StyleRow[headtxt] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[headtxt] ?>" width="65"></td>
</tr>

<tr>
<td>CATAGORY TEXT</td>
<td align="right"><input name="cattxt" type="text" value="<?php echo $StyleRow[cattxt] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[cattxt] ?>" width="65"></td>
</tr>

<tr>
<td>LINK COLOR</td>
<td align="right"><input name="link" type="text" value="<?php echo $StyleRow[link] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[link] ?>" width="65"></td>
</tr>

<tr>
<td>ROLLOVER COLOR</td>
<td align="right"><input name="roll" type="text" value="<?php echo $StyleRow[roll] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[roll] ?>" width="65"></td>
</tr>
</table>
<br>
<table style="border: thin solid <?php echo $StyleRow[border] ?>;width:400;" bgcolor="<?php echo $Style2Row[alt2] ?>" valign="top" align="center">
<tr>
<td>BASE</td>
<td align="right"><input name="base" type="text" value="<?php echo $StyleRow[base] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[base] ?>" width="65"></td>
</tr>

<tr>
<td>TRACK</td>
<td align="right"><input name="track" type="text" value="<?php echo $StyleRow[track] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[track] ?>" width="65"></td>
</tr>

<tr>
<td>ARROW</td>
<td align="right"><input name="arrow" type="text" value="<?php echo $StyleRow[arrow] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[arrow] ?>" width="65"></td>
</tr>

<tr>
<td>COLOR</td>
<td align="right"><input name="color" type="text" value="<?php echo $StyleRow[color] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[color] ?>" width="65"></td>
</tr>

<tr>
<td>HIGHLIGHT</td>
<td align="right"><input name="highlight" type="text" value="<?php echo $StyleRow[highlight] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[highlight] ?>" width="65"></td>
</tr>

<tr>
<td>DARK</td>
<td align="right"><input name="dark" type="text" value="<?php echo $StyleRow[dark] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[dark] ?>" width="65"></td>
</tr>

<tr>
<td>SHADOW</td>
<td align="right"><input name="shadow" type="text" value="<?php echo $StyleRow[shadow] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[shadow] ?>" width="65"></td>
</tr>

<tr>
<td>3DLIGHT</td>
<td align="right"><input name="light" type="text" value="<?php echo $StyleRow[light] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td bgcolor="<?php echo $StyleRow[light] ?>" width="65"></td>
</tr>
</table>
<br>
<table style="border: thin solid <?php echo $StyleRow[border] ?>;width:400;" bgcolor="<?php echo $Style2Row[alt1] ?>" valign="top" align="center">
<tr>
<td valign="top">RAW CSS</td>
<td align="right">

<textarea name="rawcss" style="border-color<?php echo $StyleRow[border] ?>:; border-style: solid; width:130px;height:70px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;">
<?php echo $StyleRow[rawcss] ?>
</textarea></td>
<td<td width="65"></td>
</tr>

<tr>
<td>BORDER WIDTH</td>
<td align="right"><input name="borderw" type="text" value="<?php echo $StyleRow[borderw] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td<td width="65"></td>
</tr>

<tr>
<td>TABLE WIDTH</td>
<td align="right"><input name="tablew" type="text" value="<?php echo $StyleRow[tablew] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td<td width="65"></td>
</tr>

<tr>
<td>TABLE SPACING</td>
<td align="right"><input name="tablespace" type="text" value="<?php echo $StyleRow[tablespace] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td<td width="65"></td>
</tr>

<tr>
<td>BORDER WIDTH</td>
<td align="right"><input name="borderw" type="text" value="<?php echo $StyleRow[borderw] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td<td width="65"></td>
</tr>

<tr>
<td>FONT FACE</td>
<td align="right"><input name="font" type="text" value="<?php echo $StyleRow[font] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td width="65"></td>
</tr>

<tr>
<td>FONT SIZE</td>
<td align="right"><input name="fontsize" type="text" value="<?php echo $StyleRow[fontsize] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
<td width="65"></td>
</tr>
</table>
<br>
<table style="border: thin solid <?php echo $StyleRow[border] ?>;width:400;" bgcolor="<?php echo $Style2Row[alt2] ?>" valign="top" align="center">

<tr>
<td>IMAGE DIRECTORY</td>
<td align="right"><input name="imagedir" type="text" value="<?php echo $StyleRow[imagedir] ?>" style="border-color:<?php echo $StyleRow[border] ?>; border-style: solid; width:130px;height:20px;background-color:<?php echo $StyleRow[bg] ?>;color:<?php echo $StyleRow[text] ?>;font-size:<?php echo $StyleRow[fontsize] ?>pt; font-family:<?php echo $StyleRow[font] ?>;"></td>
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