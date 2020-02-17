<form method="post" enctype="multipart/form-data">
<?php if ($subcat == "picture") { ?>
	 	<select name="type">
     	  	  <option>Skate Picture
     	  	  <option>Ramp Plan
	      	  <option>Wallpaper
	 	</select><br />
	 	<input type="file" name="userfile" id="userfile"> <br />
	 	<input type="text" name="writer" value="Your Name" onClick="javascript:select();"> <br />
	 	<input type="text" name="title" value="Title/Trick" onClick="javascript:select();"> <br />
	 	<input type="submit" value="Submit" name="SubmitPicture">
	 <?php } elseif ($subcat == "text") { ?>
	 	<select name="type">
     	  	  <option>Trick Tip
     	  	  <option>Skate Article
	      	  <option>Skate Review
			  <option>Glossary Term
			  <option>Tutorial
			  <option>Tech Article
			  <option>Tech Review
	 	</select><br />
	 	<input type="text" name="writer" value="Your Name" onClick="javascript:select();"> <br />
		<input type="text" name="email" value="Your Email" onClick="javascript:select();"> <br />
	 	<input type="text" name="title" value="Title" onClick="javascript:select();"> <br />
	 	<textarea name="text" style="width:350px; height=:250;" ></textarea> <br />
		<input type="submit" value="Submit" name="SubmitText">
	 <?php } elseif ($subcat == "link") { ?>
	 	<select name="type">
     	  	  <option>Skate Link
     	  	  <option>Tech Link
	      	  <option>Tech Script
	 	</select><br />
	    <input type="text" name="title" value="Title" onClick="javascript:select();"> <br />
	    <input type="text" name="url" value="URL" onClick="javascript:select();"> <br />
	    <input type="submit" value="Submit" name="SubmitLink">
	<?php } ?>

</form>


<?php
	 if(isset($_POST['SubmitPicture']) && $_FILES['userfile']['size'] != 0) {
	       $fileName = $_FILES['userfile']['name'];
	 	   $tmpName  = $_FILES['userfile']['tmp_name'];
	 	   $fileSize = $_FILES['userfile']['size'];
	 	   $fileType = $_FILES['userfile']['type'];

	 	   $fp = fopen($tmpName, 'r');
	 	   $content = fread($fp, filesize($tmpName));
	 	   $content = addslashes($content);
	 	   fclose($fp);

	 	   if(!get_magic_quotes_gpc()) {
     	        $fileName = addslashes($fileName);
	 	   }

		   $Query = "insert into imagesubmissions values ('','$fileName', '$fileSize', '$fileType', '$content', '$today','$title','$writer','$type')";
		   if (mysql_db_query ($Database, $Query, $DBLink)){
				echo "Image Uploaded<br />";
		   } else{
				echo "MySQL Error <br /> ".mysql_error();
		   }
		   
	 } elseif (isset($SubmitText)) { 
	 	  $Query = "insert into textsubmissions values ('','$today', '$type', '$ipaddress', '$email', '$writer','$title','$text')";
		   if (mysql_db_query ($Database, $Query, $DBLink)){
				echo "Text Submitted<br />";
		   } else{
				echo "MySQL Error <br /> ".mysql_error();
		   }
	 
	  } elseif (isset($SubmitLink)) { 
	 	  $Query = "insert into textsubmissions values ('','$today', '$type', '$ipaddress', '$email', '','$title','$url')";
		   if (mysql_db_query ($Database, $Query, $DBLink)){
				echo "Link Submitted<br />";
		   } else{
				echo "MySQL Error <br /> ".mysql_error();
		   }
	  }
?>