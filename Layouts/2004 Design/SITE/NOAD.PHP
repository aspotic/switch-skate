<html>
<head>
</head>
<?php
// Constant Variables

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 
$LinkUp = mysql_connect ($host, $user, $pass);


// Pick the Color Scheme

$PickDB="switchsk_style";
$PickQuery = "SELECT * from choice WHERE id = 1";
$PickResult = mysql_db_query ($PickDB, $PickQuery, $LinkUp);
$PickRow = mysql_fetch_array($PickResult);


// Connect to Styles Database

$StyleDB="switchsk_style";
$StyleQuery = "SELECT * from colors WHERE id = $PickRow[scheme]";
$StyleResult = mysql_db_query ($StyleDB, $StyleQuery, $LinkUp);
$StyleRow = mysql_fetch_array($StyleResult);

print ("<body bgcolor='$StyleRow[alt1]'> \n");

?>



</body>
</html>
