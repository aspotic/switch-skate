<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>

<?php

// Key Info

$host = "localhost";
$user = "switchsk_adam";
$pass = "drummer";
$links = 0;

$LinkUp = mysql_connect ($host, $user, $pass);

// open choice table

// Connect to DB 1

$StyleDB = "switchsk_style"; 
$StyleQuery = "SELECT * from colors WHERE id = 1";
$StyleResult = mysql_db_query ($StyleDB, $StyleQuery, $LinkUp);
$style = mysql_fetch_array($StyleResult);



// Connect to DB 2	

$SBLlinksDB="switchsk_cucont";
$SBLlinksQuery = "SELECT * from sblinks";
$SBResult = mysql_db_query ($SBLlinksDB, $SBLlinksQuery, $LinkUp);

mysql_close ($LinkUp);

?>

Background color = <?php echo $style[bg] ?>
	
<br><br>

<?php
while ($SBLinks = mysql_fetch_array($SBResult))
{
print (" ");
print ("<a href='$SBLinks[url]'><font face='arial'>[ $SBLinks[site] ]</a>\n");
print (" ");
}
?>

</body>
</html>
