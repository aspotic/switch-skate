<table class="left">
	   <tr>
	   	   <td class="catagoryside">
Choose Theme
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
<form method="post" action="" name="updatetheme">
<center>   
<table>
	   <tr>
	   	   <td class="alt1">

<?php

$themewide = $Theme[widthleft] - 10; 
 
if ($logged == 1){
	  print ("<select name='choosetheme' style='width:$themewide;'> \n");

	  $Query1 = "SELECT * from schemes";
	  $Result1 = mysql_db_query ($database, $Query1, $dblink);
	 
	  while ($Nav = mysql_fetch_array($Result1)){
	  		if ($Nav[id] == $scheme) { print ("<option value=$Nav[id] selected>$Nav[title]\n"); }
	  		if ($Nav[id] != $scheme) { print ("<option value=$Nav[id]>$Nav[title]\n"); }
      }

	  print ("</select>\n");
?>

	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
		   
<?php
print ("<input style='width:$themewide;' type='submit' name='changetheme' value='Change'> \n");
	  
	  if ( isset ( $changetheme )) {
	  	 $Query2 = "UPDATE members SET theme = '$choosetheme' WHERE id = '$idnumber'";
	  	 $Result2 = mysql_db_query ($database, $Query2, $dblink);
	  	 if (!$Result2) {echo "Error changing theme";} else {
	  	 	print ("<script>\n");
	  	 	print ("function redirect()\n");
	  	 	print ("{window.location.replace('$siteurl/index.php');}\n");
	  	 	print ("redirect();\n");
	  	 	print ("</script>\n");
		 }
	  }
	  
} else {
  print ("Sign up to use this feature");
}
?>	

	   	   </td>
	   </tr>
</table>
	   	   </td>
	   </tr>
</table>
</center>
</form>