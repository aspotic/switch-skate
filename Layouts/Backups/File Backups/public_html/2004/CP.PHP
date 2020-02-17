<html>
<head>
<title>VME Panel 1.1</title>
	
<?php
require ("config.php");

$query = "SELECT * from members";
$result = mysql_db_query ($database, $query, $dblink);

while ($row = mysql_fetch_array($result)){
	   
	   if ( ( ($row[rank] == 5) || ($row[rank] == 4) || ($row[rank] == 3) ) && ( $row[loggedin] == 1 ) && ( $row[ip] == $ipaddress ) ) {
	   	  $rank = $row[rank];
		  $scheme = $row[theme];
		  $Username = $row[username];
		  $email = $row[email];
		  $games = $row[numplayed];
		  $logged = 1;
		  $entrance = 1;
	   }
	   
} 

if ($entrance == 1) {

$numuniquevisitors = 0;
$numberadmin = 0;
$numbermembers = 0;
$numbertotalhits = 0;
$numberthemes = 0;
$numberarticles = 0;
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
	  if (($row[rank] >= 3) && ($row[rank] <= 5)) {
	  	 $numberadmin++;
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
	
<style>


body {
margin-top:0;
margin-left: auto ;
margin-right: auto ;
text-align:center;
background-color:#1D4E6D;
}


table.dimensions { 
font-family:Arial;
width:95%;
border:1 solid #183C53;
} 


td#toptable { 
background-color:#11567E;
font-family:Arial;
color:#F4F4F4;
text-align:left;
} 


td#header { 
background-color:#17374C;
font-family:Arial;
color:#F4F4F4;
text-align:left;
}  

td#center {
width:95%;
}

td.catagory {
background-color:#477B9E;
font-family:Arial;
color:#F4F4F4;
text-align:center;
}


td.alt1 {
background-color:#123F59;
font-family:Arial;
color:#F4F4F4;
text-align:left;
}


td.alt2 {
background-color:#11567E;
font-family:Arial;
color:#F4F4F4;
text-align:left;
}


a {
text-decoration:none;
color:#EABC1B;
}


a:hover {
text-decoration:none;
font-weight: normal ;
color:#F4F4F4;
}


select {
	 color:#F4F4F4;
	 background-color:#11567E;
	 font-family:Arial;
	 border:1 solid #183C53;
}


input {
	 color:#F4F4F4;
	 background-color:#11567E;
	 font-family:Arial;
	 border:1 solid #183C53;
}


textarea {
	 color:#F4F4F4;
	 background-color:#11567E;
	 font-family:Arial;
	 border:1 solid #183C53;
}


</style>
	
	
</head>

<body>



<table class="dimensions">
	   <tr>
	   	   <td id="toptable">
<img src="images/cpheader.gif" alt="VME Panel">
	   	   </td>
	   </tr>
	   <tr>
	   	   <td id="header">
[<a href="http://www.switchskate.net">Switch Skate</a>] [<a href="http://www.switchskate.net/vme">Ventaja Designs</a>]&nbsp;&nbsp;&nbsp;
 <?php echo "[<a href='$siteurl/index.php'>Back to Homepage</a>] [<a href='$siteurl/index.php?id=signout'>Sign Out</a>] \n"; ?>
	   	   </td>
	   </tr>
</table>


<br>


<table class="dimensions">
	   <tr>
	   
	   	   <td class="catagory" width="25%">General</td>
		   <td class="catagory" width="25%">Index Admin</td>
		   <td class="catagory" width="25%">Content Admin</td>
		   <td class="catagory" width="25%">Look & Feel</td>
		   
	   </tr>
	   <tr>
	   
	   	   <td class="alt1" valign="top" width="25%"><a href="?id=newsletter">Newsletter</a><br><a href="?id=editheader">Edit Header Text</a></td>
		   <td class="alt1" valign="top" width="25%"><a href="?id=addnews">News</a><br><a href="?id=navlinks">Navigation links</a><br><a href="?id=blocks">Edit Blocks</a><!--<br><a href="">Delete Blocks</a>--></td>
		   <td class="alt1" valign="top" width="25%"><a href="?id=addcontent">Add Content</a><br><a href="?id=deletecontent">Delete Content</a><br><a href="?id=addcatagory">Add Category</a><br><a href="?id=deletecatagory">Delete Category</a><br><a href="?id=editcatagory">Edit Category</a></td>
		   <td class="alt1" valign="top" width="25%"><a href="?id=themes">Themes<br><a href="?id=resetthemes">Reset Themes</a></td>
		   
	   </tr>
	   
	   
	   
	   <tr>
	   
	   	   <td class="catagory" width="25%">VME Reports</td>
		   <td class="catagory" width="25%">Statistics</td>
		   <td class="catagory" width="25%">Database Tools</td>
		   <td class="catagory" width="25%">Users</td>
		   
	   </tr>
	   <tr>
	   
	   	   <td class="alt1" valign="top" width="25%">
		   
		   <?php
		   $dblink2 = mysql_connect ($db2host, $db2user, $db2pass);
		   $Query5 = "SELECT * FROM $dbtable2";
		   $Result5 = mysql_db_query ($database2, $Query5, $dblink2);
		   if ($row5 = mysql_fetch_array ($Result5)) {echo $row5[stats];}
		   mysql_close ($dblink2);
		   $dblink = mysql_connect ($hostname, $username, $password);
		   ?>		   
		   
		   <br><a href="mailto:switchskate@gmail.com">REPORT ERRORS</a></td>
		   <td class="alt1" valign="top" width="25%"><?php echo "Administrators: $numberadmin<br>Members: $numbermembers<br>Themes: $numberthemes<br>Articles: $numberarticles"; ?></td>
		   <td class="alt1" valign="top" width="25%"><a href="?id=addrawsql">Insert Raw SQL</a></td>
		   <td class="alt1" valign="top" width="25%"><a href="?id=checkmembers">Members</a></td>
		   
	   </tr>
</table>
<br>
<br>





<!--ROW 1-->


  <!--General-->

    <!--Settings-->
    <!--Newsletter-->
	
	<?php if ($id == "newsletter"){ ?>
	
	<table class="dimensions">
		   <tr>
		   	   <td class="catagory">
		   	   	   Send out a newsletter
		   	   </td>
		   </tr>
		   <tr>
		   	   <td class="alt1"><center>
			   	   <form method="post" action="" name="sendletter">
						 <input name="emailtitle" type="text" value="Title" onFocus="javascript:select();"><br>
						 <textarea name="emailtext" style="width:50%; height:150;" onFocus="javascript:select();">Message</textarea><br>
						 <input type="submit" value="Send Message" name="sendmessage">
						 
						 <?php
						 
						 	  if (isset($sendmessage)) {
							  
							  	 $totalemailtitle = "$sitename Newsletter - $emailtitle";
							  
							  	 $Query = "SELECT * FROM mailinglist";
								 $Result = mysql_db_query ($database, $Query, $dblink);
								 
								 while ($row = mysql_fetch_array ($Result)) {
							  
							  	 	   if ( mail($row[email], $totalemailtitle ,$emailtext, "From: $webmail") ) {} else {echo mysql_error();} 
							  	 }
								 
								 echo "<script> window.location.replace ('cp.php'); </script>";
								 
							  }
						 
						 ?>
						 
			   	   </form>
		   	   </td>
		   </tr>
	</table>

<?php } ?>
	
	
    <!--Edit Header Text/Ad-->
<?php if ($id == "editheader"){ ?>
	
	<table class="dimensions">
		   <tr>
		   	   <td class="catagory">
		   	   	   Edit Header Text/Ad
		   	   </td>
		   </tr>
		   <tr>
		   	   <td class="alt1">
			   	   <a href="?id=editheadermember">Header For Members</a><br>
			   	   <a href="?id=editheaderguest">Header For Guests</a>
		   	   </td>
		   </tr>
	</table>

<?php } ?>

<?php if ($id == "editheadermember"){ ?>
	
	<table class="dimensions">
		   <tr>
		   	   <td class="catagory">
		   	   	   Edit Header Marquee for Members
		   	   </td>
		   </tr>
		   <tr>
		   	   <td class="alt1"><center>
			   <?php
			   
			   $Query = "SELECT * FROM header";
			   $Result = mysql_db_query ($database, $Query, $dblink);
			   if ($row = mysql_fetch_array($Result)) {
			   	  $marquee = $row[marquee];
			   	  $advertisement = $row[advertisement];
			   } else {
			   	  die('Invalid query, please report: ' . mysql_error());
			   }
			   
			   ?>
			   	   <form method="post" action="" name="changemember">
			   	   <?php echo "<textarea style='width:50%; height:150;' name='infomember' rows=5 cols=35 >$marquee</textarea><br> \n"; ?>
				   <input type="submit" value="Update Header (member)" name="updatemember">
<?php
				   if (isset($updatemember)) {
				   	  $Query = "UPDATE header SET marquee = '$infomember' WHERE id = '1';";
					  $Result = mysql_db_query ($database, $Query, $dblink);
					  if ($Result) {
					  	 print ("<script>\n");
	  	 				 print ("function redirect()\n");
	  	 				 print ("{window.location.replace('cp.php');}\n");
	  	 				 print ("redirect();\n");
	  	 				 print ("</script>\n");
					  } else {
					  	 echo "ERROR". mysql_error();
					  }
				   
				   }
?>		   
				   </form>
		   	   </td>
		   </tr>
	</table>

<?php } ?>


<?php if ($id == "editheaderguest"){ ?>
	
	<table class="dimensions">
		   <tr>
		   	   <td class="catagory">
		   	   	   Edit Header Advertisement for Guests
		   	   </td>
		   </tr>
		   <tr>
		   	   <td class="alt1"><center>
			   <?php
			   
			   $Query = "SELECT * FROM header";
			   $Result = mysql_db_query ($database, $Query, $dblink);
			   if ($row = mysql_fetch_array($Result)) {
			   	  $marquee = $row[marquee];
			   	  $advertisement = $row[advertisement];
			   } else {
			   	  die('Invalid query, please report: ' . mysql_error());
			   }
			   
			   ?>
			   
			   	   <form method="post" action="" name="changeguest">
			   	   <?php echo "<textarea style='width:50%; height:150;' name='infoguest' rows=5 cols=35 >$advertisement</textarea><br> \n"; ?>
				   <input type="submit" value="Update Header (guest)" name="updateguest">
<?php
				   if (isset($updateguest)) {
				   	  $Query = "UPDATE header SET advertisement = '$infoguest' WHERE id = '1';";
					  $Result = mysql_db_query ($database, $Query, $dblink);
					  if ($Result) {
					  	 print ("<script>\n");
	  	 				 print ("function redirect()\n");
	  	 				 print ("{window.location.replace('cp.php');}\n");
	  	 				 print ("redirect();\n");
	  	 				 print ("</script>\n");
					  } else {
					  	 echo "ERROR". mysql_error();
					  }
				   
				   }
?>		   
				   </form>
		   	   </td>
		   </tr>
	</table>

<?php } ?>



  <!--Index Admin-->

    <!--Settings-->
    <!--News-->
	
<?php if ($id == "addnews"){ ?>

<table class="dimensions">
<tr>
<td class="catagory">
Add News
</td>
</tr>
<tr>
<td class="alt1"><center>
<form method="post">
<input name="title" type="text" value="title"><br>
<input name="date" type="text" value="yyyymmdd"><br>
<textarea name="text" style="width:50%; height:150;" ></textarea><br>
<input type="submit" value="Submit" name="addnews">

<?php
if(isset( $addnews )){
$AddNewsQuery = "insert into news values ('$date', '$title', '$text')";
if (mysql_db_query ($database, $AddNewsQuery, $dblink)){			print ("<script>\n");
	  	 	print ("function redirect()\n");
	  	 	print ("{window.location.replace('cp.php');}\n");
	  	 	print ("redirect();\n");
	  	 	print ("</script>\n");}else{echo "MySQL Error";}
}
?>

</form>
</td>
</tr>
</table>

<?php } ?>

	
	
    <!--Navigation links-->
	
<?php if ($id == "navlinks2"){ ?>
	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Navigation Links
		   		 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1">
<a href="?id=navlinks_addlink">Add Link</a><br>
<a href="?id=navlinks_deletelink">Delete Link</a><br>
   				 </td>
			 </tr>
	  </table> 
<?php } ?>
	
	
      <!--Add navigation link-->
	  
<?php if ($id == "navlinks_addlink"){ ?>

	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Add a Navigation Link
	  			 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1">
<form method="post" action="">
<input name="name" type="text" value="Name:"><br>
<input name="url" type="text" value="URL:"><br>
<input type="submit" value="Add Link" name="addlink"><br>
</form>
<br>

<?php
if(isset( $addlink )){
$AddLinkQuery = "insert into navigation values ('0', '', '$name', '$url')";
if (mysql_db_query ($database, $AddLinkQuery, $dblink)){			
   			print ("<script>\n");
	  	 	print ("window.location.replace('cp.php');\n");
	  	 	print ("</script>\n");}else{echo "MySQL Error <br />"; echo mysql_error();}
}
?>

   				 </td>
			 </tr>
	  </table>

<?php }
	
	
	// <!--Delete navigation link-->
	
elseif ($id == "navlinks"){ ?>

<table class="dimensions">
<tr>
<td class="catagory">
Edit navigation links
</td>
</tr>
</table>
<br />

<table class="dimensions">
<tr>
<td class="catagory">Delete</td>
<td class="catagory">Title</td>
<td class="catagory">URL</td>
<td class="catagory">Position</td>
</tr>

<form method="post" action="">

<?php
$count = 1;
$altcolor = 1;
$PrintNavQuery = "SELECT * from navigation ORDER BY position ASC";
$NavResult = mysql_db_query ($database, $PrintNavQuery, $dblink);
while ($Nav = mysql_fetch_array($NavResult)){

print ("<tr> \n");
print ("<td class='alt$altcolor'><input type='checkbox' name='delete[$count]' value='1'></td> \n");
print ("<td class='alt$altcolor'><input name='title[$count]' type='text' value='$Nav[title]'></td> \n");
print ("<td class='alt$altcolor'><input name='url[$count]' type='text' value='$Nav[url]'></td> \n");
print ("<td class='alt$altcolor'><input name='position[$count]' type='text' value='$Nav[position]'><input name='linkid[$count]' type='hidden' value='$Nav[id]'></td> \n");
print ("</tr> \n");

$count++;
$altcolor++;
if ($altcolor == 3) {$altcolor = 1;}
}
?>
</table>

<br />
<table class="dimensions">
<tr>
<td class="catagory">Title</td>
<td class="catagory">URL</td>
<td class="catagory">Position</td>
</tr>

<?php
print ("<tr> \n");
print ("<td class='catagory'><input name='title[$count]' type='text' value=''></td> \n");
print ("<td class='catagory'><input name='url[$count]' type='text' value=''></td> \n");
print ("<td class='catagory'><input name='position[$count]' type='text' value=''></td> \n");
print ("</tr> \n");
?>

</table>

<br />
<input type="submit" value="Edit Links" name="editlinks"><br>


<?php

	 					   if ( isset ( $editlinks ) ) {
						   	  		  for ($counter = 1; $counter < $count; $counter++) {
									  if ($delete[$counter] != 1){
   			   			   	          	  	  $Query = "UPDATE navigation SET title = '$title[$counter]', position = '$position[$counter]', url = '$url[$counter]' WHERE id = '$linkid[$counter]'";
									  	   } elseif ($delete[$counter] == 1) {
										   	  $Query = "DELETE FROM navigation WHERE id = $linkid[$counter] LIMIT 1;";
										   }
										   $Result = mysql_db_query ($database, $Query, $dblink);
											  if ($Result) {
											  	 	$results++;
   									  		  } else {echo "ERROR <br> \n".mysql_error();}
											  
									  }
									  
									  if ($results == $count - 1) {
									  	    	 print ("<script>\n");
	  	 							  	   	  	 print ("window.location.replace('cp.php');\n");
	  	 							  	   	  	 print ("</script>\n");
									  } else {
									  		     echo "ERROR <br> \n".mysql_error();
									  }
									  

	 					  			   if ( $title[$count] != "" ) {
   			   			   	           	  	$Query = "INSERT INTO navigation VALUES ('', '$position[$count]','$title[$count]','$url[$count]')";
   									   	  	$Result = mysql_db_query ($database, $Query, $dblink);
									   	  	if ($Result) {
   									  	   	   			 print ("<script>\n");
	  	 							  	   				 print ("window.location.replace('cp.php');\n");
	  	 							  	   				 print ("</script>\n");
   									  } else {
   	  								  	   echo "ERROR <br> \n".mysql_error();
   									  }
						   			  }
									  
						   }

?>

</table>

</td>
</tr>
</table>

<?php } ?>
	
	
	
    <!--Edit Blocks-->
<?php if ($id == "blocksstart"){ ?>
	  <table class="dimensions">
	   		 <tr>
	   	   	 	 <td class="catagory">
				 	 Edit Blocks
	   	   		 </td>
	   		 </tr>
	   		 <tr>
	   	   	 	 <td class="alt1">
				 	 <a href="?id=editblocks">Edit/Delete</a><br>
					 <a href="?id=addblocks">Add New</a>
	   	   		 </td>
	   		 </tr>
	  </table>

<?php } ?>


<?php if ($id == "blocks"){ ?>

	  <table class="dimensions">
	   		 <tr>
	   	   	 	 <td class="catagory">
				 	 Edit Blocks
	   	   		 </td>
	   		 </tr>
	  </table>
	  
	  <br>

	  <table class="dimensions">
	   		 <tr>
			 <td class="catagory">
		   	 	 	 Delete
	   	   	 	 </td>
	   	   	 	 <td class="catagory">
		   	 	 	 Name (no spaces)
	   	   	 	 </td>
	   	   	 	 <td class="catagory">
		   	 	 	 Order
	   	   	 	 </td>
	   	   	 	 <td class="catagory">
		   	 	 	 Side
	   	   	 	 </td>
	   	   	 	 <td class="catagory">
		   	 	 	 Active
	   	   	 	 </td>
	   	   	 </tr>
<form method="post" action="" name="blocks">
<?php

	  $altcolor = 1;
	  $blocknum = 1;

	  $Query = "SELECT * FROM blocks ORDER BY position ASC";
	  $Result = mysql_db_query ($database, $Query, $dblink);

	  while ($row = mysql_fetch_array($Result)) {

	   		 echo "<tr> \n";
	   	   	 	  echo "<td class='alt$altcolor'> \n";
				  	   echo "<input name='deleteblock[$blocknum]' type='checkbox' value='1'> \n";
	   	   	 	  echo "</td> \n";
	   	   	 	  echo "<td class='alt$altcolor'> \n";
				  	   echo "<input name='blocktitle[$blocknum]' type='text' value='$row[title]'> \n";
	   	   	 	  echo "</td> \n";
	   	   	 	  echo "<td class='alt$altcolor'> \n";
			 	  	   echo "<input name='blockposition[$blocknum]' type='text' value='$row[position]'> \n";
	   	   	 	  echo "</td> \n";
	   	   	 	  echo "<td class='alt$altcolor'> \n";
				  	   echo "<select name='blockside[$blocknum]'> \n";
			 	  	   		    if($row[side] == 1) {
					   						  echo "<option value='1' selected>Left";
											  echo "<option value='2'>Right";
					   			} elseif ($row[side] == 2) {
					   	 		  		 	  echo "<option value='1' >Left";
											  echo "<option value='2' selected>Right";
					   			}
					   echo "</select> \n";
	   	   	 	  echo "</td> \n";
	   	   		  echo "<td class='alt$altcolor'> \n";
				  	   echo "<select name='blockactive[$blocknum]'> \n";
			 	  	   		    if($row[active] == 0) {
					   						  echo "<option value='0' selected>Off";
											  echo "<option value='1'>On";
					   			} elseif ($row[active] == 1) {
					   	 		  		 	  echo "<option value='0' >Off";
											  echo "<option value='1' selected>On";
					   			}
					   echo "</select> \n";
					   echo "<input name='blockid[$blocknum]' type='hidden' value='$row[id]'>";
	   	   	 	  echo "</td> \n";
	   		 echo "</tr> \n";
	   
	   $altcolor++;
	   $blocknum++;
	   if ($altcolor == 3) {$altcolor = 1;}
	   
	   }

?>
	  </table>
	  <br>
	  

	  		<table class="dimensions">
	   			   <tr>
	   	   		   	   <td class="catagory">
				   	   	   <b>NEW</b>
	   	    	   	   </td>
	   	    	   	   <td class="catagory">
		    	   	   	   Title (name of php file)
		    	   	   	   <input name="addblocktitle" type="text" value="">
	   	    	   	   </td>
	   	    	   	   <td class="catagory">
	 	    	   	   	   position
		    	   	   	   <input name="addblockposition" type="text" value="">
 	   	    	   	   </td>
	   	    	   	   <td class="catagory">
		    	   	   	   Side
		    	   	   	   <select name="addblockside">
    	    	   	   	   		   <option value=1>Left
    	    	   	   	   		   <option value=2>Right
		    	   	   	   </select>
	   	    	   	   </td>
	   	    	   	   <td class="catagory">
		    	   	   	   Active
		    	   	   	   <select name="addblockactive">
    	    	   	   	   		   <option value=1>Yes
    	    	   	   	   		   <option value=0>No
		    	   	   	   </select>
	   	    	   	   </td>
	   	    	   </tr>
		    </table>
	  
	  <br>
	  
	  
	  
		    	   	   	   <input type="submit" value="Edit Blocks" name="editblock">
						
						   
<?php

	 					   if ( isset ( $editblock ) ) {
						   	  		  for ($counter = 1; $counter < $blocknum; $counter++) {
									  if ($deleteblock[$counter] != 1){
   			   			   	          	  	  $Query = "UPDATE blocks set title = '$blocktitle[$counter]', position = '$blockposition[$counter]', side = '$blockside[$counter]', active = '$blockactive[$counter]' where id = '$blockid[$counter]'";
									  	   } elseif ($deleteblock[$counter] == 1) {
										   	  $Query = "DELETE FROM blocks WHERE id = $blockid[$counter] LIMIT 1;";
										   }
										   $Result = mysql_db_query ($database, $Query, $dblink);
											  if ($Result) {
											  	 	$results++;
   									  		  } else {echo "ERROR <br> \n".mysql_error();}
											  
									  }
									  
									  if ($results == $blocknum - 1) {
									  	    	 print ("<script>\n");
	  	 							  	   	  	 print ("function redirect()\n");
	  	 							  	   	  	 print ("{window.location.replace('cp.php');}\n");
	  	 							  	   	  	 print ("redirect();\n");
	  	 							  	   	  	 print ("</script>\n");
									  } else {
									  		     echo "ERROR <br> \n".mysql_error();
									  }
									  

	 					  			   if ( $addblocktitle != "" ) {
   			   			   	           	  	$Query = "INSERT INTO blocks VALUES ('', '$addblocktitle','$addblockposition','$addblockside','$addblockactive')";
   									   	  	$Result = mysql_db_query ($database, $Query, $dblink);
									   	  	if ($Result) {
   									  	   	   			 print ("<script>\n");
	  	 							  	   				 print ("window.location.replace('cp.php');\n");
	  	 							  	   				 print ("</script>\n");
   									  } else {
   	  								  	   echo "ERROR <br> \n".mysql_error();
   									  }
						   			  }
									  
						   }

?>


	  </form>
	  
<?php } ?>


<?php if ($id == "addblocks"){ ?>

	  <table class="dimensions">
	   		 <tr>
	   	   	 	 <td class="catagory">
				 	 Add Blocks
	   	   		 </td>
	   		 </tr>
	  </table>
	  
	  <br>

	  <table class="dimensions">
	   		 <tr>
	   	   	 	 <td class="catagory">
		   	 	 	 Name (no spaces)
	   	   	 	 </td>
	   	   	 	 <td class="catagory">
		   	 	 	 Order
	   	   	 	 </td>
	   	   	 	 <td class="catagory">
		   	 	 	 Side
	   	   	 	 </td>
	   	   	 	 <td class="catagory">
		   	 	 	 Active
	   	   	 	 </td>
	   	   	 </tr>

<?php

	  $altcolor = 1;

	  $Query = "SELECT * FROM blocks ORDER BY position ASC";
	  $Result = mysql_db_query ($database, $Query, $dblink);

	  while ($row = mysql_fetch_array($Result)) {

	   		 echo "<tr> \n";
	   	   	 	  echo "<td class='alt$altcolor'> \n";
			 	  	   echo $row[title];
	   	   	 	  echo "</td> \n";
	   	   	 	  echo "<td class='alt$altcolor'> \n";
			 	  	   echo $row[position];
	   	   	 	  echo "</td> \n";
	   	   	 	  echo "<td class='alt$altcolor'> \n";
			 	  	   if($row[side] == 1) {
					   			echo "Left";
					   } elseif ($row[side] == 2) {
					   	 		echo "Right";
					   }
	   	   	 	  echo "</td> \n";
	   	   		  echo "<td class='alt$altcolor'> \n";
			 	  	   if($row[active] == 0) {
					   			echo "Off";
					   } elseif ($row[active] == 1) {
					   	 		echo "On";
					   }
	   	   	 	  echo "</td> \n";
	   		 echo "</tr> \n";
	   
	   $altcolor++;
	   if ($altcolor == 3) {$altcolor = 1;}
	   
	   }

?>
	  </table>
	  <br>
	  
	  <form method="post" action="" name="addnewblock">
	  		<table class="dimensions">
	   			   <tr>
	   	   		   	   <td class="catagory">
				   	   	   <b>NEW</b>
	   	    	   	   </td>
	   	    	   	   <td class="catagory">
		    	   	   	   Title (name of php file)
		    	   	   	   <input name="blocktitle" type="text" value="">
	   	    	   	   </td>
	   	    	   	   <td class="catagory">
	 	    	   	   	   position
		    	   	   	   <input name="blockposition" type="text" value="">
 	   	    	   	   </td>
	   	    	   	   <td class="catagory">
		    	   	   	   Side
		    	   	   	   <select name="blockside">
    	    	   	   	   		   <option value=1>Left
    	    	   	   	   		   <option value=2>Right
		    	   	   	   </select>
	   	    	   	   </td>
	   	    	   	   <td class="catagory">
		    	   	   	   Active
		    	   	   	   <select name="blockactive">
    	    	   	   	   		   <option value=1>Yes
    	    	   	   	   		   <option value=0>No
		    	   	   	   </select>
	   	    	   	   </td>
	   	    	   	   <td class="catagory">
		    	   	   	   <input type="submit" value="Add Block" name="addablock">
						   
<?php

	 					   if ( isset ( $addablock ) ) {
   			   			   	          $Query = "INSERT INTO blocks VALUES ('', '$blocktitle','$blockposition','$blockside','$blockactive')";
   									  $Result = mysql_db_query ($database, $Query, $dblink);
									  if ($Result) {
   									  	   print ("<script>\n");
	  	 							  	   print ("function redirect()\n");
	  	 							  	   print ("{window.location.replace('$cp.php');}\n");
	  	 							  	   print ("redirect();\n");
	  	 							  	   print ("</script>\n");
   									  } else {
   	  								  	   echo "ERROR <br> \n".mysql_error();
   									  }
						   }

?>
				   
	   	    	   	   </td>
	   	    	   </tr>
		    </table>
	  </form>
	  

<?php } ?>



  <!--Content Admin-->	
	
    <!--Add Content-->
	
	<?php if ($id == "addcontent"){ ?>
	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Add Content
		   		 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1">
				
<?php 
$query = "SELECT * from vertcontset ORDER BY name ASC";
$result = mysql_db_query ($database, $query, $dblink);
while ($row = mysql_fetch_array($result)){
				 
print ("<a href='?id=addcontent_add&type=$row[type]&table=$row[tablename]&catname=$row[name]'>$row[name]</a><br>");

} ?>

   				 </td>
			 </tr>
	  </table> 
<?php } ?>
	
	  <!--Add the content-->
	
		<?php if ($id == "addcontent_add"){ ?>
	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Add Content to <?php echo $catname ?>
		   		 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1"><center>
<form method="post" action=""  name="addcont">
				 
<?php if ($type == 1) { ?>
 
 	  	   <input name="title" type="text" value="title"><br>
 		   <textarea name="text" style="width:50%; height:150;" rows=10 cols=20 >text</textarea><br>
		   <input name="table" type="hidden" value="<?php echo $table ?>"><br>
 		   <input type="submit" value="Submit" name="addcontnow">
		   
<?php } elseif ($type == 2) { ?>
 
 	  	   <input name="title" type="text" value="title"><br>
 		   <textarea name="text" style="width:50%; height:150;" rows=10 cols=20 >text</textarea><br>
		   <input name="table" type="hidden" value="<?php echo $table ?>"><br>
 		   <input type="submit" value="Submit" name="addcontnow">
		   
<?php } elseif ($type == 3) { ?>
 
 	  	   <input name="title" type="text" value="title"><br>
 		   <input name="url" type="text" value="URL">
		   <input name="table" type="hidden" value="<?php echo $table ?>"><br>
 		   <input type="submit" value="Submit" name="addcontnow">
		   
<?php } elseif ($type == 4) { ?>
 
 	  	   <input name="url" type="text" value="Image URL" onFocus="javascript:select();">
		   <input name="table" type="hidden" value="<?php echo $table ?>"><br>
 		   <input type="submit" value="Submit" name="addcontnow">
		   
<?php } elseif ($type == 5) { ?>
 
 	  	   <input name="title" type="text" value="title"><br>
 		   <textarea name="text" style="width:50%; height:150;" rows=10 cols=20 >text</textarea><br>
		   <input name="table" type="hidden" value="<?php echo $table ?>"><br>
 		   <input type="submit" value="Submit" name="addcontnow">
		   
<?php } ?>

</form>

<?php if (isset ($addcontnow)) {

	  if (($type == 1) || ($type == 2) || ($type == 5)) {
		   $query = "insert into $table values ('0', '$title', '$text')";
		   if (mysql_db_query ($database, $query, $dblink)){			print ("<script>\n");
	  	 	print ("function redirect()\n");
	  	 	print ("{window.location.replace('cp.php');}\n");
	  	 	print ("redirect();\n");
	  	 	print ("</script>\n");}else{echo "<br><br>MySQL ERROR <br>\n". mysql_error();}
	  }elseif ($type == 3) {
	  	   $query = "insert into $table values ('0', '$title', '$url')";
		   if (mysql_db_query ($database, $query, $dblink)){			print ("<script>\n");
	  	 	print ("function redirect()\n");
	  	 	print ("{window.location.replace('cp.php');}\n");
	  	 	print ("redirect();\n");
	  	 	print ("</script>\n");}else{echo "<br><br>MySQL ERROR <br>\n". mysql_error();}
	  }elseif ($type == 4) {
	  	   $query = "insert into $table values ('0', '$url')";
		   if (mysql_db_query ($database, $query, $dblink)){			print ("<script>\n");
	  	 	print ("window.location.replace('cp.php');\n");
	  	 	print ("</script>\n");}else{echo "<br><br>MySQL ERROR <br>\n". mysql_error();}
	  }
		   
} ?>


   				 </td>
			 </tr>
	  </table> 
<?php } ?>
	
	
	
    <!--Delete Content-->
	
	<?php if ($id == "deletecontent"){ ?>
	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Delete Content
		   		 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1">
				
<?php 
$query = "SELECT * from vertcontset ORDER BY name ASC";
$result = mysql_db_query ($database, $query, $dblink);
while ($row = mysql_fetch_array($result)){
				 
print ("<a href='?id=deletecontent_pick&table=$row[tablename]&listid=$row[id]&name=$row[name]&ctype=$row[type]'>$row[name]</a><br>");

} ?>

   				 </td>
			 </tr>
	  </table> 
<?php } ?>


	<?php if ($id == "deletecontent_pick"){ ?>
	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Delete Content
		   		 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1">
				
<?php 

if ($ctype != 4) {
$query = "SELECT * from $table ORDER BY title ASC";
$result = mysql_db_query ($database, $query, $dblink);
while ($row = mysql_fetch_array($result)){
				 
print ("<a href='?id=deletecontent_delete&table=$table&listid=$row[id]&name=$row[title]'>$row[title]</a><br>");

}

} elseif ($ctype == 4) {

$query = "SELECT * from $table";
$result = mysql_db_query ($database, $query, $dblink);
while ($row = mysql_fetch_array($result)){ ?>
				 
<a href="<?php echo "?id=deletecontent_delete&table=$table&listid=$row[id]"; ?>"><img src="<?php echo $row[picurl]; ?>" border="0" width="100" height="100"></img></a>

<?php }

} ?>

   				 </td>
			 </tr>
	  </table> 
<?php } ?>


	<?php if ($id == "deletecontent_delete"){ ?>
	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Delete Content <?php echo $name; ?>
		   		 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1">
				
<?php
$yes = 0;

$query = "DELETE from $table WHERE id = $listid LIMIT 1;";
$result = mysql_db_query ($database, $query, $dblink);
if (!$result) {
   die('Invalid query: ' . mysql_error());
   echo "  &nbsp;&nbsp;&nbsp;  Could not remove row from table";
} else {$yes++;}

if ($yes == 1) {echo "The content was removed";}

?>

   				 </td>
			 </tr>
	  </table> 
<?php } ?>
	
	
    <!--Add Category-->
	
<?php if ($id == "addcatagory") { ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagory">
Add Category
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">


Please pick only one type of display<br>
<a href="?id=addcatagory_make&typecat1=1">Vertical Content</a><br>
<a href="?id=addcatagory_make&typecat5=1">Vertical Content (In Text Area)</a><br>
<a href="?id=addcatagory_make&typecat2=1">Horizontal Content</a><br>
<a href="?id=addcatagory_make&typecat3=1">Links</a><br>
<a href="?id=addcatagory_make&typecat4=1">Pictures</a>
	   	   </td>
	   </tr>
</table>

<?php } ?>

<?php if ($id == "addcatagory_make") { ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagory">
Add a category
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
<form method="post" action=""  name="addcat">
		   <?php if ($typecat1 == "1") { ?>
		   		  Vertical Content <br>
		   		  <input name="addcattitle1" type="text" value="Title">&nbsp;&nbsp;<input name="addcatname1" type="text" value="name (nospace)"><br>
		   		  <input name="typecat1" type="hidden" value="1">
		   		  <input type="submit" value="submit" name="addcat">
		   		  <br><br>

		   <?php } elseif ($typecat2 == "1") { ?>
		   		  Horizontal Content <br>
		   	      <input name="addcattitle2" type="text" value="Title">&nbsp;&nbsp;<input name="addcatname2" type="text" value="name (nospace)"><br>
		   		  <input name="addcatpagenum2" type="text" value="# per page"><br>
		   		  <input name="typecat2" type="hidden" value="1">
		   		  <input type="submit" value="submit" name="addcat">
		   		  <br><br>

		   <?php } elseif ($typecat3 == "1") { ?>
		   		  Links <br>
		   		  <input name="addcatprefix3" type="text" value="Prefix"><br>
		   		  <input name="addcattitle3" type="text" value="Title">&nbsp;&nbsp;<input name="addcatname3" type="text" value="name (nospace)"><br>
		   		  <input name="addcatpagenum3" type="text" value="# per page"><br>
		   		  <input name="typecat3" type="hidden" value="1">
		   		  <input type="submit" value="submit" name="addcat">
		   		  <br><br>

		   <?php } elseif ($typecat4 == "1") { ?>
		   		  Pictures <br>
		   		  <input name="addcattitle4" type="text" value="Title">&nbsp;&nbsp;<input name="addcatname4" type="text" value="name (nospace)"><br>
		   		  <input name="addcatpagenum4" type="text" value="# per page"><br>
		   		  <input name="typecat4" type="hidden" value="1">
		   		  <input type="submit" value="submit" name="addcat">
		   		  <br><br>
				  
		   <?php } elseif ($typecat5 == "1") { ?>
				  Vertical Content in Text Area <br>
		   		  <input name="addcattitle5" type="text" value="Title">&nbsp;&nbsp;<input name="addcatname5" type="text" value="name (nospace)"><br>
		   		  <input name="typecat5" type="hidden" value="1">
		   		  <input type="submit" value="submit" name="addcat">
		   		  <br><br>
				  
		   <?php } 



		    if(isset( $addcat )){ 

		   		 if ($typecat1 == 1) {


           		 	     $query = "CREATE table $addcatname1 (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, title TEXT,  text TEXT)";
		   				 if (mysql_db_query($database,$query, $dblink)){}else{echo "<br><br>MySQL ERROR <br>\n". mysql_error();}

		   				 $query = "insert into vertcontset values ('0', '$addcattitle1', '$addcatname1', '$addcatpagenum1', '1', '')";
		   				 if (mysql_db_query ($database, $query, $dblink)){
			print ("The URL to this catagory is: ?id=content&table=$addcatname1&conttype=1&catname=$addcattitle1");
			
			}else{echo "<br><br>MySQL ERROR <br>\n". mysql_error();}

				 } elseif ($typecat2 == 1) {

          				  $query = "CREATE table $addcatname2 (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, title TEXT,  text TEXT)";
		   				  if (mysql_db_query($database,$query, $dblink)){}else{echo "<br><br>MySQL ERROR <br>\n". mysql_error();}

		   				  $query = "insert into vertcontset values ('0', '$addcattitle2', '$addcatname2', '$addcatpagenum2', '2', '')";
		   				  if (mysql_db_query ($database, $query, $dblink)){
			print ("The URL to this catagory is: ?id=content&table=$addcatname2&conttype=2&catname=$addcattitle2");
			}else{echo "<br><br>MySQL ERROR <br>\n". mysql_error();}

				 } elseif ($typecat3 == 1) {

				          $query = "CREATE table $addcatname3 (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, title TEXT,  url TEXT)";
		   				  if (mysql_db_query($database,$query, $dblink)){}else{echo "<br><br>MySQL ERROR <br>\n". mysql_error();}

		   				  $query = "insert into vertcontset values ('0', '$addcattitle3', '$addcatname3', '$addcatpagenum3', '3', '$addcatprefix3')";
		   				  if (mysql_db_query ($database, $query, $dblink)){
			print ("The URL to this catagory is: ?id=content&table=$addcatname3&conttype=3&catname=$addcattitle3");
			}else{echo "<br><br>MySQL ERROR <br>\n". mysql_error();}
	
				 } elseif ($typecat4 == 1) {
				 
				 
				          $query = "CREATE table $addcatname4 (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, picurl TEXT)";
		   				  if (mysql_db_query($database,$query, $dblink)){}else{echo "<br><br>MySQL ERROR <br>\n". mysql_error();}

		   				  $query = "insert into vertcontset values ('0', '$addcattitle4', '$addcatname4', '$addcatpagenum4', '4', '')";
		   				  if (mysql_db_query ($database, $query, $dblink)){
			print ("The URL to this catagory is: ?id=content&table=$addcatname4&conttype=4&catname=$addcattitle4");
			}else{echo "<br><br>MySQL ERROR <br>\n". mysql_error();}

				 } elseif ($typecat5 == 1) {
			
				   		 $query = "CREATE table $addcatname5 (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, title TEXT,  text TEXT)";
		   				 if (mysql_db_query($database,$query, $dblink)){
						 }else{
						 	     echo "<br><br>MySQL ERROR <br>\n". mysql_error();
						 }

		   				 $query = "insert into vertcontset values ('0', '$addcattitle5', '$addcatname5', '$addcatpagenum5', '5', '')";
		   				 if (mysql_db_query ($database, $query, $dblink)){
						 	     print ("The URL to this catagory is: ?id=content&table=$addcatname5&conttype=5&catname=$addcattitle5");
						 }else{
						 	     echo "<br><br>MySQL ERROR <br>\n". mysql_error();
						 }

   				 }else {
				 	      echo "ERROR";
				 }

		   } ?>

</form>


	   	   </td>
	   </tr>
</table>

<?php } ?>
	

    <!--Delete Category-->
	
	<?php if ($id == "deletecatagory"){ ?>
	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Delete Category
		   		 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1">
				
<?php 
$query = "SELECT * from vertcontset ORDER BY name ASC";
$result = mysql_db_query ($database, $query, $dblink);
while ($row = mysql_fetch_array($result)){
				 
print ("<a href='?id=deletecatagory_delete&table=$row[tablename]&listid=$row[id]&name=$row[name]'>$row[name]</a><br>");

} ?>

   				 </td>
			 </tr>
	  </table> 
<?php } ?>

	<?php if ($id == "deletecatagory_delete"){ ?>
	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Delete Category <?php echo $name; ?>
		   		 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1">
				
<?php
$yes = 0;

$query = "DROP TABLE $table";
$result = mysql_db_query ($database, $query, $dblink);
if (!$result) {
   die('Invalid query: ' . mysql_error());
   echo "  &nbsp;&nbsp;&nbsp;  Could not remove table";
} else {$yes++;}

$query = "DELETE from vertcontset WHERE id = $listid LIMIT 1;";
$result = mysql_db_query ($database, $query, $dblink);
if (!$result) {
   die('Invalid query: ' . mysql_error());
   echo "  &nbsp;&nbsp;&nbsp;  Could not remove row from table";
} else {$yes++;}

if ($yes == 2) {echo "The table was removed";}

?>

   				 </td>
			 </tr>
	  </table> 
<?php } ?>
	
	
    <!--Edit Category-->
	
	<?php if ($id == "editcatagory"){ ?>
	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Edit Catagory
		   		 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1">
				
<?php 
$query = "SELECT * from vertcontset ORDER BY name ASC";
$result = mysql_db_query ($database, $query, $dblink);
while ($row = mysql_fetch_array($result)){
				 
print ("<a href='?id=editcatagory_edit&idlist=$row[id]&name=$row[name]&table=$row[tablename]&pages=$row[pages]&type=$row[type]&prefix=$row[prefix]'>$row[name]</a> - The URL to this catagory is: ?id=content&table=$row[tablename]&conttype=$row[type]&catname=$row[name]<br>");

} ?>
   				 </td>
			 </tr>
	  </table> 
<?php } ?>

	<?php if ($id == "editcatagory_edit"){ ?>
	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Edit Category
		   		 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1">
				
<form method="post" action=""  name="addcat">

<?php 
		    if ($type == "1") {
print ("		   		  Vertical Content <br> \n");
print ("		   		  <input name='editcattitle1' type='text' value='$name'><br> \n");
print ("		   		  <input name='editcatpagenum1' type='text' value='$pages'><br> \n");
print ("		   		  <input name='type' type='hidden' value='1'> \n");
print ("		   		  <input name='idlist' type='hidden' value='$idlist'> \n");
print ("		   		  <input type='submit' value='submit' name='editcat'> \n");
print ("		   		  <br><br> \n");

		    } elseif ($type == "2") { 
print ("		   		  Horizontal Content <br> \n");
print ("		   		  <input name='editcattitle2' type='text' value='$name'><br> \n");
print ("		   		  <input name='editcatpagenum2' type='text' value='$pages'><br> \n");
print ("		   		  <input name='type' type='hidden' value='2'> \n");
print ("		   		  <input name='idlist' type='hidden' value='$idlist'> \n");
print ("		   		  <input type='submit' value='submit' name='editcat'> \n");
print ("		   		  <br><br> \n");

		    } elseif ($type == "3") {
print ("		   		  Links <br> \n");
print ("		   		  <input name='editcatprefix3' type='text' value='$prefix'><br> \n");
print ("		   		  <input name='editcattitle3' type='text' value='$name'><br> \n");
print ("		   		  <input name='editcatpagenum3' type='text' value='$pages'><br> \n");
print ("		   		  <input name='type' type='hidden' value='3'> \n");
print ("		   		  <input name='idlist' type='hidden' value='$idlist'> \n");
print ("		   		  <input type='submit' value='submit' name='editcat'> \n");
print ("		   		  <br><br> \n");

		    } elseif ($type == "4") {
print ("		   		  Pictures <br> \n");
print ("		   		  <input name='editcattitle4' type='text' value='$name'><br> \n");
print ("		   		  <input name='editcatpagenum4' type='text' value='$pages'><br> \n");
print ("		   		  <input name='type' type='hidden' value='4'> \n");
print ("		   		  <input name='idlist' type='hidden' value='$idlist'> \n");
print ("		   		  <input type='submit' value='submit' name='editcat'> \n");
print ("		   		  <br><br> \n");

		    } elseif ($type == "5") {
print ("		   		  Vertical Content in Text Area <br> \n");
print ("		   		  <input name='editcattitle5' type='text' value='$name'><br> \n");
print ("		   		  <input name='editcatpagenum5' type='text' value='$pages'><br> \n");
print ("		   		  <input name='type' type='hidden' value='5'> \n");
print ("		   		  <input name='idlist' type='hidden' value='$idlist'> \n");
print ("		   		  <input type='submit' value='submit' name='editcat'> \n");
print ("		   		  <br><br> \n");
	  		}
				
				
		if (isset( $editcat )){		
							
 $yes = 0;
					  
					  
					  if ($type == 1) {
					  	 	  $query = "UPDATE vertcontset SET name = '$editcattitle1', pages = '$editcatpagenum1' WHERE id = '$idlist' LIMIT 1";
					 	 	  $result = mysql_db_query ($database, $query, $dblink);
					  		  if (!$result) {
   							  	 		die('Invalid query: ' . mysql_error());
   							  	 		echo "  &nbsp;&nbsp;&nbsp;  Could not edit catagory information";
							  } else {$yes++;}
 
					  }
					  if ($type == 2) {
					  	 	  $query = "UPDATE vertcontset SET name = '$editcattitle2', pages = '$editcatpagenum2' WHERE id = '$idlist' LIMIT 1";
					 	 	  $result = mysql_db_query ($database, $query, $dblink);
					  		  if (!$result) {
   							  	 		die('Invalid query: ' . mysql_error());
   							  	 		echo "  &nbsp;&nbsp;&nbsp;  Could not edit catagory information";
							  } else {$yes++;}

					  }
					  if ($type == 3) {
					  	 	  $query = "UPDATE vertcontset SET name = '$editcattitle3', pages = '$editcatpagenum3', prefix = '$editcatprefix3' WHERE id = '$idlist' LIMIT 1";
					 	 	  $result = mysql_db_query ($database, $query, $dblink);
					  		  if (!$result) {
   							  	 		die('Invalid query: ' . mysql_error());
   							  	 		echo "  &nbsp;&nbsp;&nbsp;  Could not edit catagory information";
							  } else {$yes++;}

					   }
					  if ($type == 4) {
					  	 	  $query = "UPDATE vertcontset SET name = '$editcattitle4', pages = '$editcatpagenum4' WHERE id = '$idlist' LIMIT 1";
					 	 	  $result = mysql_db_query ($database, $query, $dblink);
					  		  if (!$result) {
   							  	 		die('Invalid query: ' . mysql_error());
   							  	 		echo "  &nbsp;&nbsp;&nbsp;  Could not edit catagory information";
							  } else {$yes++;}

					  }
					  if ($type == 5) {
					  	 	  $query = "UPDATE vertcontset SET name = '$editcattitle5', pages = '$editcatpagenum5' WHERE id = '$idlist' LIMIT 1";
					 	 	  $result = mysql_db_query ($database, $query, $dblink);
					  		  if (!$result) {
   							  	 		die('Invalid query: ' . mysql_error());
   							  	 		echo "  &nbsp;&nbsp;&nbsp;  Could not edit catagory information";
							  } else {$yes++;}
							  
					  }
					  
					  if ($yes == 1) {
					  	      echo "The catagory information was updated, Please update your navigation box with the new url";
					  }
		
		
		}		 
	
?>	
</form>
   				 </td>
			 </tr>
	  </table> 
<?php } ?>


  <!--Look & Feel-->

    <!--Themes-->
	
	<?php if ($id == "themes"){ ?>

	  <table class="dimensions">
	  		 <tr>
	  		 	 <td class="catagory">
	  		 	 	 Color Themes
	  		 	 </td>
	  		 </tr>
	  </table>
	  
<br>

	  <table class="dimensions">
	  		 <tr> 
	  		 	  <td class="catagory">Delete</td>
	  		 	  <td class="catagory">Theme Name</td>
	  		 	  <td class="catagory">Used</td>
	  		 </tr>
			  
<?php
				  
	  		 	  $themenum = 0;
				  $themes = 0;
				  $altcolor = 1;
				  
	  		 	  print ("<form method='post' action='' name='deletethemes'>");
				  
				  $query = "SELECT * from schemes ORDER BY title ASC";
	  		 	  $result = mysql_db_query ($database, $query, $dblink);
				  
	  		 	  while ($row = mysql_fetch_array($result)){
				  
	  		 	  		print ("<tr> \n");
	  		 	  			  print ("<td class='alt$altcolor'><input name='deleteTheme[$themenum]' type='checkbox' value='1'> <input name='themeID[$themenum]' type='hidden' value='$row[id]'> </td>\n");
	  		 	  			  print ("<td class='alt$altcolor'><a href='?id=edittheme&themeid=$row[id]'>$row[title]</a></td> \n");
							    	
									$themetotal[$themenum] = 0;
							  		$Query2 = "SELECT * FROM members";
									$Result2 = mysql_db_query ($database, $Query2, $dblink);
									 while ($row2 = mysql_fetch_array ($Result2)) {
										  if ($row2[theme] == $row[id]) {$themetotal[$themenum]++;}
									 }		
							  
							  print ("<td class='alt$altcolor'>$themetotal[$themenum]</td> \n");
	  		
						print ("</tr> \n");
	  		 	  		$themenum++;  
						$altcolor++;
						if ($altcolor == 3) {$altcolor = 1;}
	  		 	  } 
?>


	  </table>
	  <br>
			 
	  <input type="submit" name="deletethemes" value="Delete Themes">
				  
				  
<?php
				  if ( isset ( $deletethemes ) ) {
				  
	  		 	  		 for ($counter = 0; $counter <= $themenum; $counter++) {
						 	  if ($deleteTheme[$counter] == 1) {
	  		 	  		 	  	    $Query = "DELETE FROM schemes WHERE id = '$themeID[$counter]' LIMIT 1;";
									$Result = mysql_db_query ($database, $Query, $dblink);
									if ($Result) {
	  		 	  		 	  	         $results++;
	  		 	  		 	  		} else {
							  	         die('Invalid query: ' . mysql_error());
							  		}
									
	  		 	  		 	  }
						 }
	  		 	  		 	  
							 
	  		 	  	 	 	  print ("<script>\n");
	  		 	  		 	  print ("window.location.replace('cp.php');\n");
	  		 	  		 	  print ("</script>\n");
	  		 	  }
?>
				  		  
	  		 	  </form>
			 	  </td>
	  		 </tr>
	  </table>
	  <br>
	  <a href="?id=newtheme">New Theme</a>
<?php } ?>

<?php if ($id == "newtheme") { ?>

	  <table class="dimensions">
	  		 <tr>
	  		 	 <td class="catagory">
	  		 	 	 New Color Theme
	  		 	 </td>
	  		 </tr>
<form method="post" action="">
			 
<?php	 

$altcolor = 1;

			 echo "<tr> \n";
	  		 	 echo "<td class='alt1'> \n";
	  		 	 echo "<table width='500'><tr>";
				 	  echo "<td  class='alt1'>Title</td>";
					  echo "<td><input name='ThemeSet[1]' type='text' value=''></td>";
	  		 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Background Color</td>";
					  echo "<td><input name='ThemeSet[2]' type='text' value=''></td>";
	  		 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Border Size</td>";
					  echo "<td><input name='ThemeSet[3]' type='text' value=''></td>";
	  		 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Border Type (in CSS)</td>";
					  echo "<td><input name='ThemeSet[4]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>border Color</td>";
					  echo "<td><input name='ThemeSet[5]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Body Alignment</td>";
					  echo "<td><input name='ThemeSet[6]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Top Margin Size</td>";
					  echo "<td><input name='ThemeSet[7]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Link Color</td>";
					  echo "<td><input name='ThemeSet[8]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Link Mouseover Color</td>";
					  echo "<td><input name='ThemeSet[9]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Font Type</td>";
					  echo "<td><input name='ThemeSet[10]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Table Width</td>";
					  echo "<td><input name='ThemeSet[11]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Text Alignment</td>";
					  echo "<td><input name='ThemeSet[12]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Left Table Width</td>";
					  echo "<td><input name='ThemeSet[13]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Right Table Width</td>";
					  echo "<td><input name='ThemeSet[14]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Center Table Width</td>";
					  echo "<td><input name='ThemeSet[15]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Top Table Background Color</td>";
					  echo "<td><input name='ThemeSet[16]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Top Table Text Alignment</td>";
					  echo "<td><input name='ThemeSet[17]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Top Table Text Color</td>";
					  echo "<td><input name='ThemeSet[18]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Header background color</td>";
					  echo "<td><input name='ThemeSet[19]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Header text alignment</td>";
					  echo "<td><input name='ThemeSet[20]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Header text color</td>";
					  echo "<td><input name='ThemeSet[21]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Alternating background 1</td>";
					  echo "<td><input name='ThemeSet[22]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Alternating text 1</td>";
					  echo "<td><input name='ThemeSet[23]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Alternating background 2</td>";
					  echo "<td><input name='ThemeSet[24]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Alternating text 2</td>";
					  echo "<td><input name='ThemeSet[25]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Category Text Color</td>";
					  echo "<td><input name='ThemeSet[26]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Category Background Color</td>";
					  echo "<td><input name='ThemeSet[27]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Text alignment for categorys</td>";
					  echo "<td><input name='ThemeSet[28]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Category Width</td>";
					  echo "<td><input name='ThemeSet[29]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Header logo name</td>";
					  echo "<td><input name='ThemeSet[30]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Theme Folder</td>";
					  echo "<td><input name='ThemeSet[31]' type='text' value=''></td>";
	  		 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Category Content Logo Name (Optional)</td>";
					  echo "<td><input name='ThemeSet[33]' type='text' value=''></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Category Block Logo Name (Optional)</td>";
					  echo "<td><input name='ThemeSet[34]' type='text' value=''></td>";
	  		 echo "</tr> \n";
			 echo "<input name='ThemeSet[32]' type='hidden' value='$themeid'> \n";
			 
?>
      </table>
  	  </td>
	  </tr>
 	  </table>
<br>
<center>
<input type="submit" name="updatetheme" value="Add Theme">
</center>

<?php

if (isset ($updatetheme)) {

     $Query = "INSERT INTO schemes VALUES ('', '$ThemeSet[1]', '$ThemeSet[2]', '$ThemeSet[3]', '$ThemeSet[4]', '$ThemeSet[5]', '$ThemeSet[6]', '$ThemeSet[7]', '$ThemeSet[8]', '$ThemeSet[9]', '$ThemeSet[10]', '$ThemeSet[11]', '$ThemeSet[12]', '$ThemeSet[13]', '$ThemeSet[14]', '$ThemeSet[15]', '$ThemeSet[16]', '$ThemeSet[17]', '$ThemeSet[18]', '$ThemeSet[19]', '$ThemeSet[20]', '$ThemeSet[21]', '$ThemeSet[22]', '$ThemeSet[23]', '$ThemeSet[24]', '$ThemeSet[25]', '$ThemeSet[26]', '$ThemeSet[27]', '$ThemeSet[28]', '$ThemeSet[29]', '$ThemeSet[30]', '$ThemeSet[31]', '$ThemeSet[33]', '$ThemeSet[34]')";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if ($Result) {
	 	 echo "<script>window.location.replace ('cp.php');</script>";
	 } else {
	     echo mysql_error();
	 }
	 
}

} ?>
	
<?php if ($id == "edittheme") { ?>

	  <table class="dimensions">
	  		 <tr>
	  		 	 <td class="catagory">
	  		 	 	 Color Themes
	  		 	 </td>
	  		 </tr>
<form method="post" action="">
			 
<?php	 

$altcolor = 1;

$Query = "SELECT * FROM schemes WHERE id = '$themeid'";
$Result = mysql_db_query ($database, $Query, $dblink);
if ( $ThemeRow = mysql_fetch_array ($Result) ) {} else {echo "ERROR";}

			 echo "<tr> \n";
	  		 	 echo "<td class='alt1'> \n";
	  		 	 echo "<table width='500'><tr>";
				 	  echo "<td  class='alt1'>Title</td>";
					  echo "<td><input name='ThemeSet[1]' type='text' value='$ThemeRow[title]'></td>";
	  		 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Background Color</td>";
					  echo "<td><input name='ThemeSet[2]' type='text' value='$ThemeRow[background]'></td>";
	  		 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Border Size</td>";
					  echo "<td><input name='ThemeSet[3]' type='text' value='$ThemeRow[bordersize]'></td>";
	  		 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Border Type (in CSS)</td>";
					  echo "<td><input name='ThemeSet[4]' type='text' value='$ThemeRow[bordertype]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>border Color</td>";
					  echo "<td><input name='ThemeSet[5]' type='text' value='$ThemeRow[bordercolor]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Body Alignment</td>";
					  echo "<td><input name='ThemeSet[6]' type='text' value='$ThemeRow[alignbody]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Top Margin Size</td>";
					  echo "<td><input name='ThemeSet[7]' type='text' value='$ThemeRow[topmargin]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Link Color</td>";
					  echo "<td><input name='ThemeSet[8]' type='text' value='$ThemeRow[linkcolor]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Link Mouseover Color</td>";
					  echo "<td><input name='ThemeSet[9]' type='text' value='$ThemeRow[linkover]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Font Type</td>";
					  echo "<td><input name='ThemeSet[10]' type='text' value='$ThemeRow[fontface]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Table Width</td>";
					  echo "<td><input name='ThemeSet[11]' type='text' value='$ThemeRow[tablewidth]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Text Alignment</td>";
					  echo "<td><input name='ThemeSet[12]' type='text' value='$ThemeRow[txtalign]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Left Table Width</td>";
					  echo "<td><input name='ThemeSet[13]' type='text' value='$ThemeRow[widthleft]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Right Table Width</td>";
					  echo "<td><input name='ThemeSet[14]' type='text' value='$ThemeRow[widthright]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Center Table Width</td>";
					  echo "<td><input name='ThemeSet[15]' type='text' value='$ThemeRow[widthcenter]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Top Table Background Color</td>";
					  echo "<td><input name='ThemeSet[16]' type='text' value='$ThemeRow[toptablecolor]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Top Table Text Alignment</td>";
					  echo "<td><input name='ThemeSet[17]' type='text' value='$ThemeRow[txtaligntoptable]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Top Table Text Color</td>";
					  echo "<td><input name='ThemeSet[18]' type='text' value='$ThemeRow[colortoptable]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Header background color</td>";
					  echo "<td><input name='ThemeSet[19]' type='text' value='$ThemeRow[headercolor]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Header text alignment</td>";
					  echo "<td><input name='ThemeSet[20]' type='text' value='$ThemeRow[txtalignheader]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Header text color</td>";
					  echo "<td><input name='ThemeSet[21]' type='text' value='$ThemeRow[colorheader]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Alternating background 1</td>";
					  echo "<td><input name='ThemeSet[22]' type='text' value='$ThemeRow[alt1]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Alternating text 1</td>";
					  echo "<td><input name='ThemeSet[23]' type='text' value='$ThemeRow[coloralt1]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Alternating background 2</td>";
					  echo "<td><input name='ThemeSet[24]' type='text' value='$ThemeRow[alt2]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Alternating text 2</td>";
					  echo "<td><input name='ThemeSet[25]' type='text' value='$ThemeRow[coloralt2]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Category Text Color</td>";
					  echo "<td><input name='ThemeSet[26]' type='text' value='$ThemeRow[colorcatagory]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Category Background Color</td>";
					  echo "<td><input name='ThemeSet[27]' type='text' value='$ThemeRow[catagorybg]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Text alignment for categorys</td>";
					  echo "<td><input name='ThemeSet[28]' type='text' value='$ThemeRow[txtaligncatagory]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Category Width</td>";
					  echo "<td><input name='ThemeSet[29]' type='text' value='$ThemeRow[widthcatagory]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Header logo name</td>";
					  echo "<td><input name='ThemeSet[30]' type='text' value='$ThemeRow[logoname]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Theme Folder</td>";
					  echo "<td><input name='ThemeSet[31]' type='text' value='$ThemeRow[logofolder]'></td>";
	  		 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt2'>Category Content Logo (Optional)</td>";
					  echo "<td><input name='ThemeSet[33]' type='text' value='$ThemeRow[centercat]'></td>";
			 echo "</tr> \n";
			 echo "<tr> \n";
				 	  echo "<td class='alt1'>Category Side Logo (Optional)</td>";
					  echo "<td><input name='ThemeSet[34]' type='text' value='$ThemeRow[sidecat]'></td>";
	  		 echo "</tr> \n";
			 echo "<input name='ThemeSet[32]' type='hidden' value='$themeid'> \n";
			 
?>
      </table>
  	  </td>
	  </tr>
 	  </table>
<br>
<center>
<input type="submit" name="updatetheme" value="Update Theme">
</center>

<?php

if (isset ($updatetheme)) {

     $Query = "UPDATE schemes SET title = '$ThemeSet[1]', background = '$ThemeSet[2]', bordersize = '$ThemeSet[3]', bordertype = '$ThemeSet[4]', bordercolor = '$ThemeSet[5]', alignbody = '$ThemeSet[6]', topmargin = '$ThemeSet[7]', linkcolor = '$ThemeSet[8]', linkover = '$ThemeSet[9]', fontface = '$ThemeSet[10]', tablewidth = '$ThemeSet[11]', txtalign = '$ThemeSet[12]',widthleft = '$ThemeSet[13]',widthright = '$ThemeSet[14]',widthcenter = '$ThemeSet[15]', toptablecolor = '$ThemeSet[16]', txtaligntoptable = '$ThemeSet[17]', colortoptable = '$ThemeSet[18]', headercolor = '$ThemeSet[19]', txtalignheader = '$ThemeSet[20]', colorheader = '$ThemeSet[21]', alt1 = '$ThemeSet[22]', coloralt1 = '$ThemeSet[23]', alt2 = '$ThemeSet[24]', coloralt2 = '$ThemeSet[25]', colorcatagory = '$ThemeSet[26]', catagorybg = '$ThemeSet[27]', txtaligncatagory = '$ThemeSet[28]', widthcatagory = '$ThemeSet[29]', logoname = '$ThemeSet[30]', logofolder = '$ThemeSet[31]', centercat = '$ThemeSet[33]', sidecat = '$ThemeSet[34]' WHERE id = '$ThemeSet[32]'";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if ($Result) {
	 	 echo "<script>window.location.replace ('cp.php');</script>";
	 } else {
	     echo mysql_error();
	 }
	 
}

} ?>
	
    <!--Smilies-->
    <!--Settings-->

	
 
 <!--ROW 2-->

  <!--VME Reports-->
  
    <!--New Version Available-->
    <!--Using Version ?.?-->
    <!--New Release Date: n/a-->
    <!--XMB Forums: off-->
    <!--Report Errors-->
   
  
  <!--Stats & Logs-->
  
    <!--Clicks-->
    <!--Unique Visitors-->
    <!--Total Hits-->
    <!--U2Us-->
 
  
  <!--Database Tools-->

    <!--Insert Raw SQL-->
	
	<?php if ($id == "addrawsql"){ ?>
	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Insert Raw SQL
		   		 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1"><center>
				 <form method="post" action="" name="rawsql">
				 <textarea style="width:50%; height:150;" name="SQLQuery" rows=10 cols=40 ></textarea><br><br>
				 <input type="submit" value="Submit" name="SubmitSQL">
				 <?php
				 
				 if ( isset ($SubmitSQL)){
				 
				 $result = mysql_db_query ($database, $SQLQuery, $dblink);
					  		  if (!$result) {
							  	 		echo "<br><br>hello:  $SQLQuery \n";
							  	 		echo "<br> \n";
   							  	 		die('Invalid query: ' . mysql_error());
   							  	 		
							  } else {echo "Done!";}
				 
				 }
				 
				 ?>
				 </form>
				 </td>
			 </tr>
	  </table> 
<?php } ?>
	
    <!--Add Table-->
    <!--Delete Table-->
	
    <!--Reset Themes-->
	
	<?php if ($id == "resetthemes"){ ?>
		  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagory">
Reset Themes
		   		 </td>
			 </tr>
			 <tr>
			 	 <td class="alt1">
<?php
$totalmembers = 1;
$themeupdates = 1;
$countmembers = 0;

$query = "SELECT * from members";
$result = mysql_db_query ($database, $query, $dblink);
while ($row = mysql_fetch_array($result)){
	  $Members[$totalmembers] = $row[id];
	  $totalmembers++;
}
 

for ( $countmembers = 1; $countmembers <= $totalmembers; $countmembers++) {
	$sql = "UPDATE members SET theme = '$defaulttheme' WHERE id=$Members[$countmembers]";
	$result = mysql_db_query ($database, $sql, $dblink);
	if ($result){$themeupdates++;}
}

if ($totalmembers == $themeupdates){echo "Themes Updated";} else {echo "Error resetting themes";}


?>

				 </td>
			 </tr>
	  </table> 
<?php } ?> 
 
  
  
  <!--Users-->
  
    <!--IP Banning-->
    <!--Members-->
	
<?php if ($id == "checkmembers"){ ?>
	  <table class="dimensions">
	  		 <tr>
	  		 	 <td class="catagory">
	  		 	 	 Members
	  		 	 </td>
	  		 </tr>
	  </table>
	  
	  <table class="dimensions">
	  		 <tr> 
	  		 	  <td class="catagory">Username</td>
	  		 	  <td class="catagory">Password</td>
	  		 	  <td class="catagory">Email</td>
	  		 	  <td class="catagory">Rank</td>
	  		 	  <td class="catagory">Delete</td>
	  		 </tr>
			 
	  		 <?php
	  		 	  if(!isset($_GET['page'])){ 
	  		 	  		 $page = 1; 
	  		 	  } else { 
	  		 	  		 $page = $_GET['page']; 
	  		 	  } 
				  
	  		 	  $max_results = 25; 
	  		 	  $from = (($page * $max_results) - $max_results); 
				  
	  		 	  $memnum = 0;
				  
	  		 	  print ("<form method='post' action='' name='updatemembers'>");
				  
	  		 	  $query = "SELECT * from members ORDER BY username ASC LIMIT $from, $max_results";
	  		 	  $result = mysql_db_query ($database, $query, $dblink);
				  
	  		 	  while ($row = mysql_fetch_array($result)){
	  		 	  		print ("<tr> \n");
	  		 	  			  print ("<td class='alt1'><input name='memUsername[$memnum]' type='text' value='$row[username]' onFocus'javascript:select();'></td> \n");
	  		 	  			  print ("<td class='alt1'><input name='memPassword[$memnum]' type='password' value='$row[password]' onFocus'javascript:select();></td> \n");
	  		 	  			  print ("<td class='alt1'><input name='memEmail[$memnum]' type='text' value='$row[email]' onFocus'javascript:select();></td> \n");
	  		 	  			  print ("<td class='alt1'><select name='memRank[$memnum]'> \n");
	  		 	  				    if ($row[rank] == 6){echo "<option value='6' selected>Banned<option value='0'>Member<option value='1'>Moderator (training)<option value='2'>Moderator<option value='3'>Administrator<option value='4'>Webmaster<option value='5'>Site Owner";}
	  		 	  				 	if ($row[rank] == 0){echo "<option value='6'>Banned<option value='0' selected>Member<option value='1'>Moderator (training)<option value='2'>Moderator<option value='3'>Administrator<option value='4'>Webmaster<option value='5'>Site Owner";}
	  		 	  				 	if ($row[rank] == 1){echo "<option value='6'>Banned<option value='0'>Member<option value='1' selected>Moderator (training)<option value='2'>Moderator<option value='3'>Administrator<option value='4'>Webmaster<option value='5'>Site Owner";}
	  		 	  				 	if ($row[rank] == 2){echo "<option value='6'>Banned<option value='0'>Member<option value='1'>Moderator (training)<option value='2' selected>Moderator<option value='3'>Administrator<option value='4'>Webmaster<option value='5'>Site Owner";}
	  		 	  				 	if ($row[rank] == 3){echo "<option value='6'>Banned<option value='0'>Member<option value='1'>Moderator (training)<option value='2'>Moderator<option value='3' selected>Administrator<option value='4'>Webmaster<option value='5'>Site Owner";}
	  		 	  				 	if ($row[rank] == 4){echo "<option value='6'>Banned<option value='0'>Member<option value='1'>Moderator (training)<option value='2'>Moderator<option value='3'>Administrator<option value='4' selected>Webmaster<option value='5'>Site Owner";}
	  		 	  				 	if ($row[rank] == 5){echo "<option value='6'>Banned<option value='0'>Member<option value='1'>Moderator (training)<option value='2'>Moderator<option value='3'>Administrator<option value='4'>Webmaster<option value='5' selected>Site Owner";}
	  		 	  			  print ("</select></td> \n");
	  		 	  			  print ("<td class='alt1'><input name='deleteMember[$memnum]' type='checkbox' value='1'> </td> <input name='memberID[$memnum]' type='hidden' value='$row[id]'>\n");
	  		 	  		print ("</tr> \n");
	  		 	  		$memnum++;  
	  		 	  } 
				  
			 	  print ("</table>  \n");
			 	  print ("<br> \n");
			 
	  		 	  print ("<input type='submit' name='updatemembers' value='Update Members'>");
	  		 	  
				  if ( isset ( $updatemembers ) ) {
				  
	  		 	  		 for ($counter = 0; $counter <= $memnum; $counter++) {
						 
	  		 	  		 	  if ($deleteMember[$counter] != 1){
	  		 	  		 	  	    $Query = "UPDATE members set username = '$memUsername[$counter]', password = '$memPassword[$counter]', email = '$memEmail[$counter]', rank = '$memRank[$counter]' where id = '$memberID[$counter]'";
	  		 	  		 	  } elseif ($deleteMember[$counter] == 1) {
	  		 	  		 	  	    $Query = "DELETE FROM members WHERE id = $memberID[$counter] LIMIT 1;";
	  		 	  		 	  }
	  		 	  		 	  
							  $Result = mysql_db_query ($database, $Query, $dblink);
	  		 	  		 	  
							  if ($Result) {
	  		 	  		 	  	    $results++;
	  		 	  		 	  } else {
							  	    echo "ERROR <br> \n".mysql_error();
							  }
	  		 	  		 }
							 
	  		 	  		 if ($results == $counter) {
	  		 	  	 	 	  print ("<script>\n");
	  		 	  		 	  print ("window.location.replace('cp.php');\n");
	  		 	  		 	  print ("</script>\n");
	  		 	  		 } else {
	  		 	  		      echo "ERROR";
	  		 	  		 }
	  		 	  }
				  
	  		 	  print ("</form>");
			 
	  		 	  print ("<table class='dimensions'> \n");
	  		 	  		print ("<tr> \n");
	  		 	  			  print ("<td class='catagory'> \n");
							  
	  		 	  			  		$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM members"),0);
	  		 	  			  		$total_pages = ceil($total_results / $max_results);
									 
	  		 	  			  		echo "<center>"; 
									
	  		 	  			  		// Build Previous Link 
	  		 	  			  		if($page > 1){ 
	  		 	  			  				 $prev = ($page - 1); 
	  		 	  			  				 echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&id=checkmembers\">Previous </a>&nbsp;&nbsp;"; 
	  		 	  			  		} else {
									  	     echo "Previous&nbsp;&nbsp;"; 
									}
									
	  		 	  			  		for($i = 1; $i <= $total_pages; $i++){ 
	  		 	  			  			   if(($page) == $i){ 
	  		 	  			  			   		  echo "$i&nbsp;"; 
	  		 	  			  			   } else { 
	  		 	  			  			   	 	  echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&id=checkmembers\">$i</a>&nbsp;"; 
	  		 	  			  			   } 
	  		 	  			  		} 
									
	  		 	  			  		// Build Next Link 
	  		 	  			  		if($page < $total_pages){ 
	  		 	  			  				 $next = ($page + 1); 
	  		 	  			  				 echo "&nbsp;&nbsp;<a href=\"".$_SERVER['PHP_SELF']."?page=$next&id=checkmembers\">Next</a>"; 
	  		 	  			  		} else {
									  	   	 echo "&nbsp;&nbsp;Next"; 
									}
	  		 	  			  ?>
	  		 	  		<br>
	  		 	  </td>
	  		 </tr>
	  </table>
<?php } ?>
	
    <!--Settings-->



<!--EXTRA STUFF-->


  <!--Index (Detailed Statistics)-->

<?php if ($id == "statistics"){ ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagory">
Statistics
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
No statistics yet
	   	   </td>
	   </tr>
</table>

<?php } ?>


  <!--Updated catagory information-->
  
<?php if ($id == "editcat"){ ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagory">
Done
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
		   


	   	   </td>
	   </tr>
</table>

<?php } ?>




<?php mysql_close ($dblink); } else {echo "You are no allowed in the $sitename administration control panel.  If you think you should be allowed in then please email $webmail."; mysql_close ($dblink);} ?>
