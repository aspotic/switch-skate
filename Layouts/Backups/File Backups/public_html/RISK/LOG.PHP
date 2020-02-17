<?php
session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$result = mysql_query("SELECT * FROM risk_log ORDER BY num DESC LIMIT 25");

echo $log_header;

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
 echo "<tr><td style='text-align:left'><font size='2'><font color='gray'>", $row['stamp'], "</font> ", $row['log'], "</font></td></tr>";
 }

echo $log_footer;
