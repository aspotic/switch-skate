<table class="left">
	   <tr>
	   	   <td class="catagoryside">
Navigation
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
<?php

$PrintNavQuery = "SELECT * from navigation ORDER BY position ASC";
$NavResult = mysql_db_query ($database, $PrintNavQuery, $dblink);
while ($Nav = mysql_fetch_array($NavResult)){
print ("<a href='$Nav[url]'> $Nav[title] </a> <br> \n"); 
}
 
?>
	   	   </td>
	   </tr>
</table>
<br>