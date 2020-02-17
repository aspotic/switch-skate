<?php

$numberarticles = 0;
$usersonline = 0;
$numbermembers = 0;
$numberthemes = 0;


$Query2 = "SELECT * from schemes";
$Result2 = mysql_db_query ($database, $Query2, $dblink);
while ($row = mysql_fetch_array ($Result2)) {
	  $numberthemes++;
}


$Query3 = "SELECT * from members";
$Result3 = mysql_db_query ($database, $Query3, $dblink);
while ($row = mysql_fetch_array ($Result3)) {
	  $numbermembers++;
	  if ($row[loggedin] == 1) {
	  	 $usersonline++;
	  }
}

$Query4 = "SELECT * from vertcontset";
$Result4 = mysql_db_query ($database, $Query4, $dblink);
while ($row = mysql_fetch_array ($Result4)) {
	  
	  $Query5 = "SELECT * FROM $row[tablename]";
	  $Result5 = mysql_db_query ($database, $Query5, $dblink);
	  while ($row = mysql_fetch_array ($Result5)) {$numberarticles++;}
}

?>


<table class="right">
	   <tr>
	   	   <td class="catagoryside">
Statistics
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
		   	   <?php
			   echo "Users: $numbermembers <br> \n";
			   echo "Themes: $numberthemes <br> \n";
			   echo "Articles: $numberarticles \n";
			   ?>
	   	   </td>
	   </tr>
</table>
<br>