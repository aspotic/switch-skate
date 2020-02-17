<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>

<form name="form1" method="post" action="" enctype="multipart/form-data"> 
<input type="file" name="imagefile"> 

<input type="submit" name="Submit" value="Submit"> 

<br>
<br>
<? 
if(isset( $Submit )) 
{ 
//If the Submitbutton was pressed do: 

if (($_FILES['imagefile']['type'] == "image/gif") || ($_FILES['imagefile']['type'] == "image/pjpeg") || ($_FILES['imagefile']['type'] == "application/octet-stream")){ 
    copy ($_FILES['imagefile']['tmp_name'], "files/".$_FILES['imagefile']['name']) 
    or die ("Could not copy"); 
       echo ""; 
        echo "Name: ".$_FILES['imagefile']['name']."<br>\n"; 
        echo "Size: ".$_FILES['imagefile']['size']."<br>\n"; 
        echo "Type: ".$_FILES['imagefile']['type']."<br>\n"; 
        echo "Copy Done...."; 
        } 
		        else { 
            echo ""; 
            echo "Could Not Copy, Wrong Filetype (".$_FILES['imagefile']['name'].")"; 
        } 
} 
?>
 </form> 

</body>
</html>
