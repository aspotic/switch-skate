<?php require ("http://www.switchskate.net/cp/handlers/header3.php");?>
<br>
<br><center>
<b>Edit News Ticker</b>
<br>

<?php

// NEWS TICKER
$host = "localhost";
$username = "switchsk_adam";
$password = "drummer";
$dbname="switchsk_other";

$link = mysql_connect ($host, $username, $password);
$query = "SELECT * from news";
$result = mysql_db_query ($dbname, $query, $link);
$row = mysql_fetch_array($result);

print ("<table align='center'><tr>\n");
print ("<td><b><font type='arial'>Current News:</b></font></td>\n");
print ("<td width=690><marquee><font face='arial'> $row[marquee] </font></marquee></td>\n");
print ("</tr></table>\n");

mysql_close ($link);
// END NEWS TICKER
?>

<br>
<form action="handlers/editmarquee.php">
<input name="medit" type="text" value="News Ticker Update:" onFocus="if(this.value=='News Ticker Update:')this.value='';" onBlur="if(this.value=='' )this.value='News Ticker Update:';" style=" border-color:#667B8D; border-style: hidden; width:500px;height:20px;background-color:667B8D;color:#FFFFFF;font-size:8pt; font-family:Arial;">
<input type="submit" value="submit" style=" border-color:#a52505; border-style: hidden; width:65px;height:20px;background-color:#a52505;color:#fffe05;font-size:8pt; font-family:Arial;">
</form>

</body>
</html>
