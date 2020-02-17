<?php

	 $counter = 1;

	 
	 if ($remove != "") {
	 
	 	   $Query = "DELETE FROM imagecontent where id = '$remove' LIMIT 1";
		   $Result = mysql_db_query ($Database, $Query, $DBLink);
		   if ($Result) {} 
		   else {
				echo "MySQL Error <br /> ".mysql_error();
		   }
	 
	 
	 }
	 
	 
	 if ($image != "") {
	 	   print ("<img src='image.php?table=imagecontent&iid=$image' width='200' height='200' /><br /><br />");
	 }
	 
	 
	 $Query = "SELECT * FROM imagecontent ORDER BY date DESC";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array ($Result)) {
	 	   
		   if ($type == $row[category]) {
	 	   	    echo "$counter. <a href='?category=viewimage&type=$type&image=$row[id]'>$row[title] by $row[writer]</a> [<a href='?category=viewimage&type=$type&remove=$row[id]'>Delete</a>]<br /> ";
		   		$counter++;
		   }
	 
	 }
	 


?>


<form method="post" enctype="multipart/form-data">
<input type="file" name="userfile"  id=userfile> <br />
<?php if ($type != "wallpaper") { ?><input type="text" name="title" value="Trick" onClick="javascript:select();"><?php } ?>
<input type="text" name="writer" value="Person" onClick="javascript:select();">
<input type="hidden" name="date" value="<?php echo $today; ?>">
<input type="hidden" name="type" value="<?php echo $type; ?>">
<input type="submit" value="Upload" name="upload">
</form>

<?php
	 if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
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

		   $Query = "insert into imagecontent values ('','$fileName', '$fileSize', '$fileType', '$content', '$date','$title','$writer','$type')";
		   if (mysql_db_query ($Database, $Query, $DBLink)){
				echo "Image Uploaded<br />";
		   } else{
				echo "MySQL Error <br /> ".mysql_error();
		   }

	 	   echo "<br>File $fileName uploaded<br>";
	 }
?>
