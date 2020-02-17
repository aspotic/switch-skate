<?php

$host = "localhost";
$user = "switchsk_adam";
$password = "drummer";

$link = mysql_connect ($host, $user, $password);
$query = "DELETE from $area WHERE id = $place LIMIT 1;";
$result = mysql_db_query ($dbname, $query, $link);

if (!$result) {
   die('Invalid query: ' . mysql_error());
}

header("Location: http://www.switchskate.net/panel/index.php");

exit;

mysql_close ($link);
?>

</body>
</html>

