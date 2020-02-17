<?php

$loginwide = $Theme[widthright] - 10;

if ($logged == 0) { ?>
<table class="left">
	   <tr>
	   	   <td class="catagoryside">
Sign In
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
<form method="post" action="" name="usersignin">

<center>

<table>
	   <tr>
	   	   <td class="alt1">
		   <input name="signinusername" type="text" value="Username" onFocus="javascript:select()" style="width:<?php echo $loginwide; ?>;">
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
		   <input name="signinpassword" type="password" value="Password" onFocus="javascript:select()" style="width:<?php echo $loginwide; ?>;">
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
		   <input type="submit" value="Submit" name="usersignin2" style="width:<?php echo $loginwide; ?>;">
	   	   </td>
	   </tr>
</table>

</center>

<input name="id" type="hidden" value="signin">

</form>

<?php

if ( isset ( $usersignin2 )) {

   $query = "SELECT * from members";
   $result = mysql_db_query ($database, $query, $dblink);
   while ($row = mysql_fetch_array($result)){
   
   		 if ($row[username] == $signinusername) {
		 
		 	if ($row[password] == $signinpassword ) {
			
			   $query2 = "UPDATE members SET ip = '$ipaddress', loggedin = '1' WHERE id = '$row[id]' LIMIT 1";
			   $result2 = mysql_db_query ($database, $query2, $dblink);
			   
			   if (!$result2) {
			   
			   	  die('Invalid query: ' . mysql_error());
				  echo "  &nbsp;&nbsp;&nbsp;  Could not log in";
				  
			   } else {
			print ("<script>\n");
	  	 	print ("window.location.replace('$siteurl/index.php');\n");
	  	 	print ("</script>\n");
			   }
			   
			}
			
		 }
   }

}

?>

	   	   </td>
	   </tr>
</table>
<br>
<?php } ?>
