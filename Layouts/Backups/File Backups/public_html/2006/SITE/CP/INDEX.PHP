<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Switch Skate.  A great resource for any of your skateboarding needs.</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="rating" content="general" />
	<meta name="copyright" content="2004, switchskate.net" />
	<meta name="revisit-after" content="7 Days" />
	<meta name="expires" content="never" />
	<meta name="distribution" content="global" />
	<meta name="robots" content="index" />
	
	<style type="text/css">
		   
		  body {
		      font-family:Microsoft Sans Serif;
		  	  BACKGROUND-COLOR:#222222;
			  SCROLLBAR-FACE-COLOR: #F8F9FC;
    		  SCROLLBAR-HIGHLIGHT-COLOR: #F8F9FC;
    		  SCROLLBAR-SHADOW-COLOR: #000000;
    		  SCROLLBAR-3DLIGHT-COLOR: #000000;
    		  SCROLLBAR-ARROW-COLOR: #000000;
    		  SCROLLBAR-DARKSHADOW-COLOR: #F8F9FC;
    		  SCROLLBAR-BASE-COLOR: #000000;
		  }
		  a {font-family:Microsoft Sans Serif;color:#4F6186; text-decoration:none;}
		  a:hover {font-family:Microsoft Sans Serif;color:#F4F4F4;}
		  th {font-family:Microsoft Sans Serif;color:#F4F4F4; background-color:#194D7E; background-image: url("http://www.switchskate.net/2006/site/images/nav2.gif")  }
		  th#contenttitle {font-family:Microsoft Sans Serif;color:#F4F4F4; background-color:#194D7E;} /* background-image: url(images/ctitle.gif) ;} */
		  td#copyright {font-family:Microsoft Sans Serif;color:#F4F4F4; background-color:#194D7E;} /* background-image: url(images/ctitle.gif) ;} */
		  td#content {font-family:Microsoft Sans Serif;color:#F4F4F4; background-color:#999999;}
		  td#nav {font-family:Microsoft Sans Serif;color:#F4F4F4; background-color:#999999;}
		  td#top {font-family:Microsoft Sans Serif; color:#F4F4F4; background-color:#3A4A69;}
		  td#base {font-family:Microsoft Sans Serif; color:#F4F4F4; background-color:#3A4A69;}
		  .top {font-family:Microsoft Sans Serif; color:#CACACA; background-color:#3A4A69;}
		  .bottom {font-family:Microsoft Sans Serif; color:#CACACA; background-color:#3A4A69;}
	
	</style>
	
</head>

<body text="#DCDCDC">

<?php
if ($userrank != "") {
     echo "Invalid Information 1";exit();
}

	 $today = date ("Ymd"); 
	 $webmastername = "Adam K";
	 $webmasteremail = "switchskate@gmail.com";
	
	 $ipaddress =  $_SERVER['REMOTE_ADDR'];
	 if(isset($_COOKIE["xmbuser"])) {$xmbuser = $_COOKIE["xmbuser"];}
	 
	 $Database = "switchsk_switch2006";
	 $DBUser = "switchsk_adam";
	 $DBPass = "drummer";
	 $Host = "localhost";
	 
	 $DBLink = mysql_connect ($Host, $DBUser, $DBPass);
	 
	 
	 
	 $Query = "select * from members WHERE username = '$xmbuser'";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 if ($row = mysql_fetch_array ($Result)) {
		  $userrank = $row[status];
	 }

	 if ($userrank != "Super Administrator") {echo "Invalid Rank"; mysql_close($DBLink); exit();}

	 if ($category == "") {$category = "home";}

?>

<center>
<table width="750" border="1" bordercolor="#777777" cellpadding="0" cellspacing="0">
	<tr height="100">
		<td valign="top" colspan="2">
			<img src="http://www.switchskate.net/2006/site/images/TestHeader1.gif" width="750" height="100" alt="" />
		</td>
	</tr>
	<tr height="25">
		<td width="150" valign="top" id="top">
			<?php 
	  			  print date ("Y"); 
				  print (":"); 
	  			  print date ("m");
				  print (":"); 
	  			  print date ("d");
				  print ("-"); 
				  print date ("g"); 
				  print (":"); 
				  print date ("i"); 
				  print date ("a"); 
				  
	  		?>
		</td>
		<td width="600" valign="top" id="top">
			<a href="" class="top">Home</a> >
		</td>
	</tr>
	<tr height="25">
		<th valign="top">
			Navigation
		</th>
		<th valign="top">
		
			<?php
			
				 if ($category == "home") { print ("Home");
				 } elseif (($category == "usercomments") && ($subcat == "")) { print ("User Comments");
				 } elseif (($category == "monthlypoll") && ($subcat == "")) { print ("Update Monthly Poll");
				 } elseif (($category == "newsletter") && ($subcat == "")) { print ("Send Newsletter");
				 } elseif (($category == "updatenews") && ($subcat == "")) { print ("Update News");
				 } elseif (($category == "weeklysite") && ($subcat == "")) { print ("Update Site of the Week");
				 }
			
			?>
		</th>
	</tr>
	<tr height="25">
		<td valign="top" valign="top" id="nav">	
			<a href="?category=updatecontent">Update Content</a> <br />
			<a href="?category=statistics">Statistics</a> <br />
<!--
			<a href="">Site Options</a> <br />
			<a href="">Exclusive Members</a> <br />
			<a href="">Themes</a> <br />
-->		
			
		</td>
		<td valign="top" valign="top" id="content">
			<!--Site Content-->
					 <?php require "$category.php"; ?>
			<!--/ Site Content-->
		</td>
	</tr>
	<tr>
		<td id="base">
			<?php 
	  			  print date ("Y"); 
				  print (":"); 
	  			  print date ("m");
				  print (":"); 
	  			  print date ("d");
				  print ("-"); 
				  print date ("g"); 
				  print (":"); 
				  print date ("i"); 
				  print date ("a"); 
				  
	  		?>
		</td>
		<td id="base">
			Page Picker
		</td>
	</tr>
	<tr>
		<td>
			<img width="150" height="1" />
		</td>
		<td>
			<img width="600" height="1" />
		</td>
	</tr>
</table>
</center>

<?php
  	   mysql_close ($DBLink);
?>

</body>
</html>

