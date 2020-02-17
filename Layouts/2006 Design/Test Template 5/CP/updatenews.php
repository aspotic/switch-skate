<center>
	  	<form name="updatenews" action="process.php" method="post">
			  		<!--Insert Category ID--><input name="CatID" type="hidden" value="news">
			  		<!--Insert Date--><input name="Date" type="hidden" value="<?php print date ("Y");  print date ("m"); print date ("d");?>">
					<!--Insert Username--><input name="User" type="hidden" value="<?php echo $webmastername; ?>">
					<!--Insert Email--><input name="Email" type="hidden" value="<?php echo $webmasteremail; ?>">
					<input name="Title" type="text" value="Title" onClick="javascript:select ();"> <br />
					<textarea name="Message" style="width:450; height:200;" ></textarea> <br />
					<input type="submit" value="Submit">
		</form>
</center>

