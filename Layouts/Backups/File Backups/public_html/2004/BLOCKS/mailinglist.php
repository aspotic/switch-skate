<?php

$maillistwide = $Theme[widthright] - 10;

?>

<form method="post" action="" name="addtolist">
<table class="right">
	   <tr>
	   	   <td class="catagoryside">
Mailing list
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">

<center>

<table>
	   <tr>
	   	   <td class="alt1">
<input style="width:<?php echo $maillistwide; ?>" name="emailaddress" type="text" value="Email address" onFocus="javascript:select();">
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
<input style="width:<?php echo $maillistwide; ?>" type="submit" value="Submit" name="updatemaillist">
	   	   </td>
	   </tr>
</table>

</center>
	   	   </td>
	   </tr>
</table>

<?php

	 if (isset ($updatemaillist)) {
	 	$Query2 = "INSERT INTO mailinglist VALUES ('', '$emailaddress')";
		$Result2 = mysql_db_query ($database, $Query2, $dblink);
		if ($Result2) {
		     print ("<script>\n");
	  	     print ("window.location.replace('$siteurl/index.php');\n");
	  	     print ("</script>\n");
		} else {
		    echo "MySQL Error, Please Report". mysql_error();
		}
	 }

?>

</form>
<br>