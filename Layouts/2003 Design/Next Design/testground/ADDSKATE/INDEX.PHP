<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Switch Skate -Under Construction-</title>
	<style type="text/css">
	a {text-decoration:none; color:#000000;}
	</style>
</head>

<body>
<center>
<table width="100%">
<tr>
<td>
<font face="Arial"><h1>Switch Skate</h1>
</td>
<td>
% Done
</td>
</tr>
</table>
<br>
<a href="http://forum.switchskate.net"><h1>ENTER FORUM</h1></a>
<br>

<table width="100%">
<tr>
<td>
Submit Content<br>

<form action="handlecontent.php" method="post">
<br>First Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="array[fname]" type="text" value="">
<br>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="array[email]" type="text" value="">

<br>Type of content: <select name="array[type]">
    <option value=0 selected>-------------------------
    <option value=1 >Skate - Trick Tip
    <option value=2 >Skate - Review
    <option  value=3 >Skate - Article
    <option  value=4 >Skate - Skate Story
    <option  value=5 >Computer - Tutorial
    <option  value=6 >Computer - Review
    <option value=7 >Computer - Link
</select>

<br>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="array[title]" type="text" value="">
<br>Text:
<br><textarea name="array[textw]" rows=7 cols=30 ></textarea>
<br><input type="submit" value="submit" name="submit">

</form>
</td>
<td><center>
Submit a Picture

<form action="" method="post">
<br>First Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="text" value="">
<br>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="text" value="">

<br>Type of content: <select name="">
    <option selected>-----------------------------
    <option>Skate - Picture
    <option>Skate - Video
    <option>Computer - Download
	<option>Computer - Game
</select>

<br>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="text" value="">
<br>Upload: <input name="" type="text" value=""><input type="submit" name="upload" value="submit">
<br><input type="submit" value="submit" name="submit">

</form>
</td>
</tr>
</table>

<table width="100%">
<tr>
<td><center>
Get Linked

<form action="" method="post">
<br>E-mail &nbsp;&nbsp;&nbsp;<input name="" type="text" value="">
<br>Website <input name="" type="text" value="">
<br><input type="submit" name="submit" value="submit">
</form>

</td>
<td><center>
Wanted: Site Administrator
<form action="" method="post">

<br><input name="" type="text" value="">
<br><input name="" type="text" value="">

<br><select name="">
    <option selected>---
    <option>Yes
    <option>No
</select>

<br><select name="">
    <option selected>---
    <option>Yes
    <option>No
</select>

<br><input type="submit" value="submit" name="submit">
</form>
</td>
</tr>
</table>

<br>
<h3>Links</h3>

<?php


?>


</body>
</html>
