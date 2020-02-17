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
			  
			  SCROLLBAR-ARROW-COLOR: #FFFFFF;
			  SCROLLBAR-FACE-COLOR: #4F6186;
			  SCROLLBAR-HIGHLIGHT-COLOR: #F8F9FC;
			  SCROLLBAR-3DLIGHT-COLOR: #666666;
			  SCROLLBAR-SHADOW-COLOR: #F8F9FC;
			  SCROLLBAR-DARKSHADOW-COLOR: #666666;
			  SCROLLBAR-TRACK-COLOR: #222222;
		  }
		  
		  div.scroll {
		  			 height: 200px;
	width: 300px;
	overflow: auto;
	border: 1px solid #666;
	background-color: #ccc;
	padding: 8px;
}
-->
		  
		  a {font-family:Microsoft Sans Serif;color:#4F6186; text-decoration:none;}
		  a:hover {font-family:Microsoft Sans Serif;color:#F4F4F4;}
		  th {font-family:Microsoft Sans Serif;color:#F4F4F4; background-color:#194D7E; background-image: url("http://www.switchskate.net/2006/images/nav2.gif")  }
		  td#content {font-family:Microsoft Sans Serif;color:#F4F4F4; background-color:#999999;}
		  td#nav {font-family:Microsoft Sans Serif;color:#F4F4F4; background-color:#999999;}
		  td#top {font-family:Microsoft Sans Serif; color:#F4F4F4; background-color:#3A4A69;}
		  td#base {font-family:Microsoft Sans Serif; color:#F4F4F4; background-color:#3A4A69;}
		  .top {font-family:Microsoft Sans Serif; color:#CACACA; background-color:#3A4A69;}
		  .base {font-family:Microsoft Sans Serif; color:#CACACA; background-color:#3A4A69;}
	
	</style>
	<SCRIPT TYPE="text/javascript">
		<!--
			function popup(mylink, windowname) {
				 if (! window.focus)return true;
				 var href;
				 if (typeof(mylink) == 'string')
				 	   href=mylink;
				 else
				       href=mylink.href;
					   window.open(href, windowname, 'width=750,height=300,dependent=no,scrollbars=no');
			     return false;
		    }
		//-->
			</SCRIPT>
</head>

<body text="#DCDCDC">

<?php
	 $memberlogged = TRUE;
	 if ($category == "") {$category = "news";}
	 if ($memberlogged == FALSE) {	
	 	  $catrowspan = 3;				 	
	 } elseif ($memberlogged == TRUE) { 
	      $catrowspan = 5;	
	 }  
	 
	 $today = date ("Ymd"); 
	 $webmastername = "Adam K";
	 $webmasteremail = "switchskate@gmail.com";

	 $ipaddress =  $_SERVER['REMOTE_ADDR'];
	 
	 $Database = "switchsk_switch2006";
	 $DBUser = "switchsk_adam";
	 $DBPass = "drummer";
	 $Host = "localhost";
	 
	 $members = 0;
	 $articles = 0;
	 $forumposts = 0;
	 $usersonline = 0;
	 $datenumber = 1;

	 
	 $DBLink = mysql_connect ($Host, $DBUser, $DBPass);
	 
	 
/*
	 $Query = "select * from members";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array ($Result)) {$members++;}
*/
	 
	 $Query = "select * from textcontent ORDER BY date DESC";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	  	   while ($row = mysql_fetch_array ($Result)) {
		   	  if ($datenumber < 5) {
				  $newtid[$datenumber] = $row[id];
				  $newttitle[$datenumber] = $row[title];
				  $newtcategory[$datenumber] = $row[cat];
				  $newttype[$datenumber] = "sviewtext";
	       	  }
		   	  $datenumber++;
		   }
		   
$datenumber = 1;
		   			
	 $Query = "select * from imagecontent ORDER BY date DESC";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	  	   while ($row = mysql_fetch_array ($Result)) {
		   	  if ($datenumber < 5) {
				  $newpid[$datenumber] = $row[image_id];
				  $newptitle[$datenumber] = $row[title];
				  $newpcategory[$datenumber] = $row[category];
				  $newptype[$datenumber] = "sviewtext";
	       	  }
		   	  $datenumber++;
		   }
	 
	 
	  if ($memberlogged == FALSE) { ?>
						  	  	   	  
			<SCRIPT LANGUAGE="JavaScript">
	  				<!-- 12 hours
			  	    	 if (document.cookie.indexOf("popuptrafficpopup") == -1) {
				   	     	  var expdate = new Date((new Date()).getTime() + 43200000);
					  		  document.cookie="popuptrafficpopup=general; expires=" + expdate.toGMTString() + "; path=/;";
					  		  document.write("<SCRIPT LANGUAGE=\"JavaScript\" src=\"http://www.popuptraffic.com/assign.php?l=drumsticks\"></script>");
				         }
			        //-->
	        </script>
			
			<SCRIPT LANGUAGE="JavaScript">
					<!-- 12 hours
			  	   		 if (document.cookie.indexOf("popuptrafficbehind") == -1) {
			  	     	 	  var expdate = new Date((new Date()).getTime() + 43200000);
			  	   	  		  document.cookie="popuptrafficbehind=general; expires=" + expdate.toGMTString() + "; path=/;";
			  	  			  document.write("<SCRIPT LANGUAGE=\"JavaScript\" src=\"http://www.popuptraffic.com/assign.php?l=drumsticks&mode=behind\"></script>");
			      	     }
			        //-->
	        </script>
												 
	  <?php }
?>

<center>
<table width="750" border="1" bordercolor="#777777" cellpadding="0" cellspacing="0">
	<tr>
		<th valign="top" colspan="3">
			Switch Skate.  A great resource for any of your skateboarding needs.</TD>
	</th>
	<tr>
		<td valign="top" colspan="3">
			<img src="images/TestHeader1.gif" width="750" height="100" alt="" />
		</td>
	</tr>
<!--
	<tr>
		<td id="top" valign="top" colspan='3'">
			<center>
				<a href="http://www.freeiPods.com/?r=18983405" title="FreeiPods.com"><img src="images/20GB iPod_468x60.gif" border="0" alt="Free iPods"></a>
			</center>
		</td>
	</tr>
-->
	<?php
		if ($memberlogged == TRUE) {	  	
		} elseif ($memberlogged == FALSE) { ?>

	<tr>
		<td id="top" valign="top">
			Site of the week:
		</td>
		<td id="top" valign="top" colspan="2">
			<a href="" class="top">Title</a> : <a href="" class="top">Submit a site</a> : <a href="" class="top">Past Winners</a>
		</td>
	</tr>

	<?php } ?>	
	<tr>
		<th valign="top" width="150" style="width:150;">
			Navigation
		</th>
		<th valign="top" width="450" style="width:450;">
			Content Title
		</th>
		<th valign="top" width="150" style="width:150;">
			<?php
				 if ($memberlogged == FALSE) {	  	
				 	print ("Web Design");
				 } elseif ($memberlogged == TRUE) { 
					print ("Just Added");
				 }  
			?>
		</th>
	</tr>
	<tr>
		<td id="content" valign="top">
			<a href="">Message Boards</a>
		</td>
		<td id="top" valign="top">
			<a href="" class="top">Home</a>
			<?php
				 
				 if ($category == "news") { echo " > News"; }
				 elseif ($category == "skatepics") { echo "<a href='?category=skatepics' class='top'>Skate Pictures</a>"; }
				 elseif ($category == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($category == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($category == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($category == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($category == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($category == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($category == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($category == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($category == "") { echo "<a href='' class='top'></a>"; }
				 
				 if ($sub == "") { echo ""; }
				 elseif ($sub == "tricktips") { echo " > <a href='?sub=tricktips&category=blank' class='top'>Trick Tips</a>"; }
				 elseif ($sub == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($sub == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($sub == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($sub == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($sub == "") { echo "<a href='' class='top'></a>"; }
				 
				 if ($type == "") { echo ""; }
				 elseif ($type == "tricktip") { echo " > <a href='?sub=tricktips&category=blank' class='top'>Trick Tips</a>"; }
				 elseif ($type == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($type == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($type == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($type == "") { echo "<a href='' class='top'></a>"; }
				 elseif ($type == "") { echo "<a href='' class='top'></a>"; }
				 
				 if ($subcate = "") {echo "";}
				 elseif ($subcat == "stance") {echo " > <a href='?category=sviewtext&type=tricktip&subcat=stance' class='top'>Stances</a>";}
				 elseif ($subcat == "flatland") {echo " > <a href='?category=sviewtext&type=tricktip&subcat=flatland' class='top'>Flatland</a>";}
				 elseif ($subcat == "grindslide") {echo " > <a href='?category=sviewtext&type=tricktip&subcat=grindslide' class='top'>Grinds and Slides</a>";}
				 elseif ($subcat == "stall") {echo " > <a href='?category=sviewtext&type=tricktip&subcat=stall' class='top'>Stall</a>";}
				 elseif ($subcat == "grab") {echo " > <a href='?category=sviewtext&type=tricktip&subcat=grab' class='top'>Grab</a>";}
				 elseif ($subcat == "ramptrick") {echo " > <a href='?category=sviewtext&type=tricktip&subcat=ramptrick' class='top'>Ramp Trick</a>";}
				 
				 if ($conttitle != "") {print (" > $conttitle"); } 
				 
				 
			?>
		</td>
		<td id="content" valign="top">
			<?php
				 if ($memberlogged == FALSE) {	  	
				 	print ("<a href=''>Tutorials</a>  ");
				 } elseif ($memberlogged == TRUE) { 
					print ("Text Articles");
				 }  
			?>
		</td>
	</tr>
	<tr>
		<td id="content" valign="top" valign="top">	
			<a href="?sub=tricktips&category=blank">Trick Tips</a> <br />
			<a href="?category=skatepics">Pictures</a> <br />
			<a href="">Glossary</a> <br />
			<a href="">Reviews</a> <br />
			<a href="">Articles</a> <br />
			<a href="">Ramp Plans</a> <br />
			<a href="">Skateboard Links</a> <br />
			<a href="">Get Linked</a> <br />
			<a href="">Contact Us</a> <br />
		</td>
		<td id="content" valign="top" valign="top" rowspan="<?php echo $catrowspan ?>">
<!--Site Content-->
			<div class="scroll">
			
					 <?php
					 if ($sub == "tricktips") { ?>
					 
					 	<a href="?category=sviewtext&type=tricktip&subcat=stance">Stances</a> <br />
						<a href="?category=sviewtext&type=tricktip&subcat=flatland">Flat Land</a> <br />
						<a href="?category=sviewtext&type=tricktip&subcat=grindslide">Grinds and Slides</a> <br />
						<a href="?category=sviewtext&type=tricktip&subcat=stall">Stalls</a> <br />
						<a href="?category=sviewtext&type=tricktip&subcat=grab">Grabs</a> <br />
						<a href="?category=sviewtext&type=tricktip&subcat=ramptrick">Ramp Tricks</a>
					 
					 <?php } else {}
					 
					  require "$category.php"; ?>
					  
			</div>		  
<!--/ Site Content-->
		</td>
			<td id="content" valign="top" valign="top">
				 <?php
				 if ($memberlogged == FALSE) {?>	
				 
				   	<a href="">Wallpaper</a> <br />
					<a href="">Scripts</a> <br />
					<a href="">Reviews</a> <br />
					<a href="">Articles</a> <br />
					<a href="">Web Design Links</a> <br />
					<a href="">Get Linked</a> <br />
									  
				 <?php } elseif ($memberlogged == TRUE) { 
				 
				 	print ("1. <a href='?category=$newttype[1]&type=$newtcategory[1]&conttitle=$newttitle[1]&trickid=$newtid[1]'>$newttitle[1]</a> <br />");
					print ("2. <a href='?category=$newttype[2]&type=$newtcategory[2]&conttitle=$newttitle[2]&trickid=$newtid[2]'>$newttitle[2]</a> <br />");
					print ("3. <a href='?category=$newttype[3]&type=$newtcategory[3]&conttitle=$newttitle[3]&trickid=$newtid[3]'>$newttitle[3]</a> <br />");
					print ("4. <a href='?category=$newttype[4]&type=$newtcategory[4]&conttitle=$newttitle[4]&trickid=$newtid[4]'>$newttitle[4]</a> <br />");
					print ("Images<br />");
					print ("1. <a href='?category=$newptype[1]&type=$newpcategory[1]&conttitle=$newptitle[1]&trickid=$newpid[1]'>$newptitle[1]</a> <br />");
					print ("2. <a href='?category=$newptype[2]&type=$newpcategory[2]&conttitle=$newptitle[2]&trickid=$newpid[2]'>$newptitle[2]</a> <br />");
					print ("3. <a href='?category=$newptype[3]&type=$newpcategory[3]&conttitle=$newptitle[3]&trickid=$newpid[3]'>$newptitle[3]</a> <br />");
					print ("4. <a href='?category=$newptype[4]&type=$newpcategory[4]&conttitle=$newptitle[4]&trickid=$newpid[4]'>$newptitle[4]</a> <br />");
				 				 
				  }  
				 ?>
			
		</td>
	</tr>
	<tr>
		<th valign="top">
			<?php
				 if ($memberlogged == FALSE) {	  	
				 	print ("Get Membership");
				 } elseif ($memberlogged == TRUE) { 
					print ("Web Design");
				 }  
			?>
		</th>
		<th valign="top">
			<?php
				 if ($memberlogged == FALSE) {
					echo "Member Login";			  		 
				 } elseif ($memberlogged == TRUE) { 
					echo "Member CP";
				 }  
			?>
		</th>
	</tr>
	<tr>
		<td id="content" valign="top">
		     <?php
				 if ($memberlogged == FALSE) {	  	
				 	   print ("When you become a member you will receieve all sorts of features that you don't right now.<br /> <a href='?category=membersignup'>Become a member</a>");
				 } elseif ($memberlogged == TRUE) { ?>	
						<a href="">Tutorials</a> <br />
						<a href="">Wallpaper</a> <br />
						<a href="">Scripts</a> <br />
						<a href="">Reviews</a> <br />
						<a href="">Articles</a> <br />
						<a href="">Web Design Links</a> <br />
						<a href="">Get Linked</a> <br />
				 <?php }  
		     ?>
		</td>		
		<td id="content" valign="top">
			<?php
				 if ($memberlogged == FALSE) {
					echo "<a href=''>Sign Up</a><br />";
						 echo "<form>";
							 echo "<input type='text' value='Username' name='' onClick='javascript:select();' width='140'> <br />";
							 echo "<input type='password' value='Password' name='' onClick='javascript:select();' width='140'> <br />";
							 echo "<input type='submit' value='Login' name=''> <a href='?category=membersignup'>Signup</a>";
						 echo "</form>";
							  		 
				 } elseif ($memberlogged == TRUE) { ?>
							  
					<a href="">Control Panel</a> <br />
					<a href="">Members List</a> <br />
					<a href="">Private Forums</a> <br />
					<a href="">Private Tagger</a> <br />
					<a href="">Email a Member</a> <br />
					<a href="">Submit Pictures</a> <br />
					<a href="">Members Radio</a> <br />
				 <?php }  ?>
			
		</td>
	</tr>
	
		<?php
			if ($memberlogged == FALSE) {
			} elseif ($memberlogged == TRUE) { ?>
			   <tr>
				 <th valign="top">
				 	   Poll
				 </th>
				 <th valign="top">
				 	   Statistics
				 </th>
			   </tr>
		<?php
			}
				 if ($memberlogged == FALSE) {		  		 
				 } elseif ($memberlogged == TRUE) { 
				 print ("<tr><td id='content' valign='top'>");
				 $Query = "select * from monthlypoll ORDER BY date DESC";
	 			 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 			 if ($row = mysql_fetch_array ($Result)) { 	 	
	 			 
			
				  	    print ("$row[question] <br />");
				   		print ("<form name='Poll' action='siteprocess.php' method='post'>");
				  			  print ("<input type='radio' name='poll' value='result1'>$row[answer1] <br />");
				  			  print ("<input type='radio' name='poll' value='result2'>$row[answer2] <br />");
				  			  print ("<input type='radio' name='poll' value='result3'>$row[answer3] <br />");
				  			  print ("<input type='radio' name='poll' value='result4'>$row[answer4] <br />");
				  			  print ("<input type='radio' name='poll' value='result5'>$row[answer5] <br />");
							  print ("<input type='hidden' name='CatID' value='poll'>");
							  print ("<input type='hidden' name='ID' value='$row[id]'>");
							  print ("<input type='hidden' name='CatID' value='poll'>");
				  
				  			  print ("<input type='submit' value='submit/results'>");
				  		print ("</form>");
				  
				  } else {
				  	    echo "No Poll";
				  }
				  print ("</td>");
				  }

			if ($memberlogged == FALSE) {		  		 
			} elseif ($memberlogged == TRUE) { 
			  	 print ("<td id='content' valign='top'>");
			     print ("Members : $members<br />");
				 print ("Articles : $articles<br />");
				 print ("Forum Posts : $forumposts<br />");
				 print ("Users Online : $usersonline<br />");
				 print ("</td></tr>");
			}
			?>
		

			
			
	
			<?php
				 if ($page != "") { ?>
				 
				 	<tr>
						<td id="content" align="right" valign="top">
							Select a Page:
						</td>
						<td id="base" valign="top">
				 			
				 <?php
				 	for($i = 1; $i <= $total_pages; $i++){ 
    					   if(($page) == $i){ 
        				   		echo "$i&nbsp;"; 
        				   } else { 
            			   	    echo "<a href='?category=$category&page=$i' class='base'>$i</a>&nbsp;"; 
    					   } 
					} ?>
					
					    </td>
						<td id="content" valign="top">
							<a href="">Forums</a>
						</td>
					</tr>
				 <?php
				 } else {}
				 
			?>

	
	
	
	
	<tr>
		<th colspan="3">
			All content, Images, and design are copyrighted to the owners of switchskate.net
		</th>
	</tr>
	<tr>
		<td>
		<img src="" width="150" height="1">
		</td>
		<td>
		<img src="" width="450" height="1">
		</td>
		<td>
		<img src="" width="150" height="1">
		</th>
	</tr>
</table>
</center>

<?php
  	   mysql_close ($DBLink);
?>

</body>
</html>
