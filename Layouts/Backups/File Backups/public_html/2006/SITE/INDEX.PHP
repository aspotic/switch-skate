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
			  color:#DCDCDC;
		  }
		  
		  div.scroll {
		  	  height: 600px;
			  width: 450px;
			  overflow: auto;
			  border: none;
			  background-color: #999999;
			  padding: 0px;
			  SCROLLBAR-ARROW-COLOR: #4F6186;
			  SCROLLBAR-FACE-COLOR: #999999;
			  SCROLLBAR-HIGHLIGHT-COLOR: #999999;
			  SCROLLBAR-3DLIGHT-COLOR: #999999;
			  SCROLLBAR-SHADOW-COLOR: #999999;
			  SCROLLBAR-DARKSHADOW-COLOR: #999999;
			  SCROLLBAR-TRACK-COLOR: #999999;
		  }
		  
		  a {font-family:Microsoft Sans Serif;color:#4F6186; text-decoration:none;}
		  a:hover {font-family:Microsoft Sans Serif;color:#F4F4F4;}
		  th {font-family:Microsoft Sans Serif;color:#F4F4F4; background-color:#194D7E; background-image: url("http://www.switchskate.net/2006/site/images/nav2.gif")  }
		  td#content {font-family:Microsoft Sans Serif;color:#F4F4F4; background-color:#999999;}
		  td#content2 {font-family:Microsoft Sans Serif;color:#F4F4F4; background-color:#999999;}
		  td#nav {font-family:Microsoft Sans Serif;color:#F4F4F4; background-color:#999999;}
		  td#top {font-family:Microsoft Sans Serif; color:#F4F4F4; background-color:#3A4A69;}
		  td#base {font-family:Microsoft Sans Serif; color:#F4F4F4; background-color:#3A4A69;}
		  .top {font-family:Microsoft Sans Serif; color:#CACACA;}
		  .base {font-family:Microsoft Sans Serif; color:#CACACA;}
	
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
<body>


<?php
	 if(isset($_COOKIE["xmbuser"])) {$memberlogged = TRUE; $xmbuser = $_COOKIE["xmbuser"];} else {$memberlogged = FALSE;}
	 //$memberlogged = TRUE;
	 if ($category == "") {$category = "news";}
	 
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
	 
	  $onlinetime = time();
	  $newtime = $onlinetime - 600;

	 
	 $DBLink = mysql_connect ($Host, $DBUser, $DBPass);
	 
	 $Query = " DELETE FROM 2006_whosonline WHERE ((ip = '$ipaddress' && username = 'xguest123') OR (username = '$xmbuser') OR (time < '$newtime')) ";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 if ($Result) {} else { echo "MySQL Error <br /> ".mysql_error(); }
	 
	 
     $Query = " INSERT INTO 2006_whosonline (username, ip, time, location, invisible) VALUES ('xguest123', '$ipaddress', '$newtime', '', '0')";
	 if (mysql_db_query ($Database, $Query, $DBLink)){
	 } else{ echo "MySQL Error <br /> ".mysql_error(); }
	 

	 $Query = "select * from members";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array ($Result)) {$members++;}

	 
	 $Query = "select * from 2006_posts";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array ($Result)) {$forumposts++;}
	 

	 $Query = "select * from 2006_whosonline";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 while ($row = mysql_fetch_array ($Result)) {$membersonline++;}


	 $Query = "select * from members WHERE username = '$xmbuser'";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	 if ($row = mysql_fetch_array ($Result)) {
	 	  $useremail = $row[email];
		  $userrank = $row[status];
	 }
	 
	 if ($userrank == "Banned") {$memberlogged = FALSE;}
	 
	 
	 $Query = "select * from textcontent ORDER BY date DESC";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	  	   while ($row = mysql_fetch_array ($Result)) {
		   	  if ($datenumber < 5) {
				  $newtid[$datenumber] = $row[id];
				  $newttitle[$datenumber] = $row[title];
				  $newtcategory[$datenumber] = $row[cat];
				  $newturl[$datenumber] = $row[url];
				  $newttype[$datenumber] = "sviewtext";
	       	  }
		   	  $datenumber++;
			  $articles++;
		   }
		   
$datenumber = 1;
		   			
	 $Query = "select * from imagecontent ORDER BY date DESC";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	  	   while ($row = mysql_fetch_array ($Result)) {
		   	  if ($datenumber < 5) {
				  $newpid[$datenumber] = $row[id];
				  if ($row[title] != "") {$newptitle[$datenumber] = $row[title];} else {$newptitle[$datenumber] = "Wallpaper";}
				  $newpcategory[$datenumber] = $row[category];
				  $newptype[$datenumber] = "sviewimage";
	       	  }
		   	  $datenumber++;
			  $articles++;
		   }
		   
	 $Query = "select * from weeklysite ORDER BY date DESC";
	 $Result = mysql_db_query ($Database, $Query, $DBLink);
	  	   if ($row = mysql_fetch_array ($Result)) {
		   $sotwtitle = $row[title];
		   $sotwurl = $row[url];
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
	 
	  
	  
	  
	  if ($category == "news") { $catname = "News"; }
				 		 elseif ($category == "glossary") { $catname = "<a href='?category=glossary' class='top'>Glossary</a>"; }
						 elseif ($category == "getlinked") { $catname = "<a href='?category=getlinked' class='top'>Get Linked</a>"; }
						 elseif ($category == "contactus") { $catname = "<a href='?category=contactus' class='top'>Contact Us</a>"; }
						 elseif ($category == "emailform") { $catname = "<a href='?category=emailform' class='top'>Email Form</a>"; }
						 elseif ($category == "submitsotw") { $catname = "<a href='?category=submitsotw' class='top'>Submit your Site</a>"; }
						 elseif ($category == "sotwwinners") { $catname = "<a href='?category=sotwwinners' class='top'>Past Winners</a>"; }
						 elseif ($category == "submitcontent") { $catname = "<a href='?category=blank&sub=submitcontent' class='top'>Submit Content</a>"; }
						 elseif ($category == "topsites") { $catname = "<a href='?category=topsites' class='top'>Top Sites List</a>"; }
						 elseif ($category == "submittopsite") { $catname = "<a href='?category=submittopsite' class='top'>Submit Your Site</a>"; }
						 elseif ($category == "") { $catname = "<a href='?category=' class='top'></a>"; }
				 
				 		 if ($sub == "") {}
				 		 elseif ($sub == "tricktip") { $catname = "<a href='?sub=tricktips&category=blank' class='top'>Trick Tips</a>"; }
				 		 elseif ($sub == "tricktips") { $catname = "<a href='?sub=tricktips&category=blank' class='top'>Trick Tips</a>"; }
						 elseif ($sub == "reviews") { $catname = "<a href='?sub=reviews&category=blank' class='top'>Reviews</a>"; }
						 elseif ($sub == "tutorials") { $catname = "<a href='?sub=tutorials&category=blank' class='top'>Tutorials</a>"; }
						 elseif ($sub == "comreview") { $catname = "<a href='?sub=comreview&category=blank' class='top'>Tech Reviews</a>"; }
						 elseif ($sub == "submitcontent") { $catname = "<a href='?category=blank&sub=submitcontent' class='top'>Submit Content</a>"; }
						 elseif ($sub == "") { $catname = "<a href='' class='top'></a>"; }
				 
				 		 if ($type == "") {}
				 		 elseif ($type == "tricktip") { $catname = "<a href='?sub=tricktips&category=blank' class='top'>Trick Tips</a>"; }
				 		 elseif ($type == "skatereview") { $catname = "<a href='?sub=reviews&category=blank' class='top'>Reviews</a>"; }
				 		 elseif ($type == "skatearticle") { $catname = "<a href='?category=sviewtext&type=skatearticle' class='top'>Articles</a>"; }
						 elseif ($type == "skatepicture") { $catname = "<a href='?category=skatepics&type=skatepics' class='top'>Skate Pictures</a>";}
						 elseif ($type == "rampplan") { $catname = "<a href='?category=skatepics&type=rampplan' class='top'>Ramp Plans</a>"; }
						 elseif ($type == "skatelink") { $catname = "<a href='?category=sviewtext&skatelink' class='top'>Skateboarding Links</a>"; }
						 elseif ($type == "tutorials") { $catname = "<a href='?sub=tutorials&category=blank' class='top'>Tutorials</a>"; }
						 elseif ($type == "wallpaper") { $catname = "<a href='?category=skatepics&type=wallpaper' class='top'>Wallpaper</a>"; }
						 elseif ($type == "script") { $catname = "<a href='?category=sviewtext&type=script' class='top'>Scripts</a>"; }
						 elseif ($type == "comarticles") { $catname = "<a href='?category=sviewtext&type=comarticles' class='top'>Tech Articles</a>"; }
						 elseif ($type == "comlinks") { $catname = "<a href='?category=sviewtext&type=comlinks' class='top'>Tech Links</a>"; }
						 elseif ($type == "") { $catname = "<a href='' class='top'></a>"; }
						 				 
				 		 if ($subcate = "") {}
				 		 elseif ($subcat == "stance") { $subname = "<a href='?category=sviewtext&type=tricktip&subcat=stance' class='top'>Stances</a>";}
				 		 elseif ($subcat == "flatland") { $subname = "<a href='?category=sviewtext&type=tricktip&subcat=flatland' class='top'>Flatland</a>";}
				 		 elseif ($subcat == "grindslide") { $subname = "<a href='?category=sviewtext&type=tricktip&subcat=grindslide' class='top'>Grinds and Slides</a>";}
				 		 elseif ($subcat == "stall") { $subname = "<a href='?category=sviewtext&type=tricktip&subcat=stall' class='top'>Stall</a>";}
				 		 elseif ($subcat == "grab") { $subname = "<a href='?category=sviewtext&type=tricktip&subcat=grab' class='top'>Grab</a>";}
				 		 elseif ($subcat == "ramptrick") { $subname = "<a href='?category=sviewtext&type=tricktip&subcat=ramptrick' class='top'>Ramp Trick</a>";}
						 elseif ($subcat == "deck") { $subname = "<a href='?category=sviewtext&type=skatereview&subcat=deck' class='top'>Decks</a>";}
						 elseif ($subcat == "truck") { $subname = "<a href='?category=sviewtext&type=skatereview&subcat=truck' class='top'>Trucks</a>";}
						 elseif ($subcat == "wheel") { $subname = "<a href='?category=sviewtext&type=skatereview&subcat=wheel' class='top'>Wheels</a>";}
						 elseif ($subcat == "video") { $subname = "<a href='?category=sviewtext&type=skatereview&subcat=video' class='top'>Videos</a>";}
						 elseif ($subcat == "other") { $subname = "<a href='?category=sviewtext&type=skatereview&subcat=other' class='top'>Other</a>";}
						 elseif ($subcat == "picture") { $subname = "<a href='?category=submitcontent&subcat=picture' class='top'>Picture</a>";}
						 elseif ($subcat == "text") { $subname = "<a href='?category=submitcontent&subcat=text' class='top'>Text</a>";}
						 elseif ($subcat == "link") { $subname = "<a href='?category=submitcontent&subcat=link' class='top'>Links</a>";}
?>

<center>
<table width="754" border="1" bordercolor="#777777" cellpadding="0" cellspacing="0">
	<tr>
		<th valign="top" colspan="3" width="750">
			Switch Skate.  A great resource for any of your skateboarding needs.
		</th>
	</tr>
	<tr>
		<td valign="top" colspan="3" width="754">
			<img src="images/TestHeader1.gif" width="750" height="100" alt="SwitchSkate.net" />
		</td>
	</tr>		
<?php
if ($memberlogged == TRUE) {	  	
} elseif ($memberlogged == FALSE) { ?>
	<tr>
		<td id="top" valign="top" colspan="3" width="754">
			<center>
				<a href="http://www.freeiPods.com/?r=18983405" title="FreeiPods.com"><img src="images/20GB iPod_468x60.gif" border="0" alt="Free iPods"></a>
			</center>
		</td>
	</tr>
<?php } ?>	
	<tr>
		<td id="top" valign="top" align="right" width="150">
			Site of the week:
		</td>
		<td id="top" valign="top" align="center" colspan="2" width="600">
			[ <a href="leavesite.php?address=<?php echo $sotwurl;?>" class="top" target="_blank"><?php echo $sotwtitle;?></a> ] [ <a href="?category=submitsotw" class="top">Submit a site</a> | <a href="?category=sotwwinners" class="top">Past Winners</a> ]
		</td>
	</tr>
</table>

<table width="754" border="0" bordercolor="#777777" cellpadding="0" cellspacing="0">

	<tr>
		<td width="152" valign="top" id="content">
			<table width="152" border="1" rules="all" frame="void" bordercolor="#777777" cellpadding="0" cellspacing="0">
				 <tr>
				 	 <th valign="top">
					 	 Navigation
					 </th>
				  </tr>
				  <tr>
					 <td id="content" valign="top" width="150" style="height:20px;">
					 	 <a href="?category=blank&sub=submitcontent">Submit Content</a>
					 </td>
				 </tr>
				 <tr>
				 	 <td id="content" valign="top" valign="top" width="150" style="height:190px;">	
					 	 <a href="?sub=tricktips&category=blank">Trick Tips</a> <br />
					 	 <a href="?category=skatepics&type=skatepicture">Pictures</a> <br />
					 	 <a href="?category=glossary">Glossary</a> <br />
						 <a href="?sub=reviews&category=blank">Reviews</a> <br />
					 	 <a href="?category=sviewtext&type=skatearticle">Articles</a> <br />
					 	 <a href="?category=skatepics&type=rampplan">Ramp Plans</a> <br />
					 	 <a href="?category=sviewtext&type=skatelink">Skateboard Links</a> <br />
			  		 	 <a href="?category=getlinked">Get Linked</a> <br />
					 	 <a href="?category=contactus">Contact Us</a> <br />
					 </td>
				 </tr>
				 <tr>
				 	 <th valign="top" width="150" style="height:20px;">
			<?php
				 if ($memberlogged == FALSE) {	  	
				 	print ("Get Membership");
				 } elseif ($memberlogged == TRUE) { 
					print ("Web Design");
				 }  
			?>
			  	 	</th>
			     </tr>
				 <tr>
		<td id="content" valign="top" width="150" style="height:150px;">
			<?php
				 if ($memberlogged == FALSE) {	  	
				 	   print ("When you become a member you will receive all sorts of features that you don't have right now.<br /> <a href='http://switchskate.net/2006/member.php?action=coppa'>Become a member</a>");
				 } elseif ($memberlogged == TRUE) { ?>	
						<a href="?sub=tutorials&category=blank">Tutorials</a> <br />
						<a href="?category=skatepics&type=wallpaper">Wallpaper</a> <br />
						<a href="?category=sviewtext&type=script">Scripts</a> <br />
						<a href="?category=blank&sub=comreview">Reviews</a> <br />
						<a href="?category=sviewtext&type=comarticles">Articles</a> <br />
						<a href="?category=sviewtext&type=comlinks">Web Design Links</a> <br />
						<a href="?category=getlinked">Get Linked</a> <br />
				 <?php }  
		     ?>
		</td>		
		</tr>
			<?php
			if ($memberlogged == FALSE) {
			} elseif ($memberlogged == TRUE) {
			   print ("<tr>");
				 print ("<th valign='top' width='150' height=20>");
				 	   print ("Poll");
				 print ("</th>");
			   print ("</tr>");
			 }
	?>
	<?php
			 if ($memberlogged == FALSE) {		  		 
			 } elseif ($memberlogged == TRUE) { 
				print ("<tr>");
				print ("<td id='content' valign='top' width='150'>");
				$Query = "select * from monthlypoll ORDER BY date DESC";
	 			$Result = mysql_db_query ($Database, $Query, $DBLink);
	 			 	  
				if ($row = mysql_fetch_array ($Result)) { 	 	
				
				   $pollips = explode(":", $row[ips]);
				   $totalips = $row[result1] + $row[result2] + $row[result3] + $row[result4] + $row[result5];
				   for ($checkip = 0; $checkip <= $totalips; $checkip++) {
				   	     if ($pollips[$checkip] == $ipaddress) {$ipused = 1;}
				   }
				   
				
				   if ($ipused == "") {
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
				   
				   $Results = $row[result1] + $row[result2] + $row[result3] + $row[result4] + $row[result5];
			  
			  		 if ($Results != 0) {$multiplier = 100/$Results;} else {$multiplier = 0;}
			  
			  		 $Result1 = $row[result1]*$multiplier;
			  		 $Result2 = $row[result2]*$multiplier;
			  		 $Result3 = $row[result3]*$multiplier;
			  		 $Result4 = $row[result4]*$multiplier;
			  		 $Result5 = $row[result5]*$multiplier;
					 
					 $EndResult1 = round($Result1, 1);
					 $EndResult2 = round($Result2, 1);
					 $EndResult3 = round($Result3, 1);
					 $EndResult4 = round($Result4, 1);
					 $EndResult5 = round($Result5, 1);
			  
			  		 echo "<br /><h5>Poll Results</h5>";
			  		 echo "$row[question]<br /><br />";
			  
			  		 echo "$row[answer1]: $EndResult1%<br />";
			  		 echo "$row[answer2]: $EndResult2%<br />";
			  		 echo "$row[answer3]: $EndResult3%<br />";
			  		 echo "$row[answer4]: $EndResult4%<br />";
			  		 echo "$row[answer5]: $EndResult5%<br />";
				   
				   }
				} else {
				  	   echo "No Poll";
				}
				print ("</td>");
				print ("</tr>");
			 }
		?>
		
			</table>
				 
		</td>
		<td widt="450" valign="top" id="content2">
			<table width="450" border="1" rules="cols" frame="vsides" bordercolor="#777777" cellpadding="0" cellspacing="0">
				 <tr>
				 	 <th valign="top" width="450">
					 	 <?php
						 if (($catname != "") && ($subname == "") && ($ $conttitle == "")) { print (" &gt; $catname &lt;"); 
						 } elseif (($subname != "") && ($conttitle == "")) { print (" &gt; $subname &lt;"); 
						 } elseif ($conttitle != "") { print (" &gt; $conttitle &lt;"); 
						 } else { echo "&#60; Content &#62;"; }
						 ?>
					 </th>
				  </tr>
				  <tr>		 
					 <td id="top" valign="top" width="450" style="height:20px;">
					 	 <a href="" class="top">Home</a>
						 <?php						 		 
						 if ($catname != "") { print (" &gt; $catname"); }
						 if ($subname != "") { print (" &gt; $subname"); }
				 		 if ($conttitle != "") {print (" &gt; $conttitle"); }  
				 		 ?>
				      </td>
				 </tr>
				 <tr>
				 	 <?php if ($memberlogged == TRUE) { print ("<td id='content2' valign='top' width='450' height='600'>");}
					 	   else { print ("<td id='content2' valign='top' width='450' height='370'>");} ?>
				 	 
		<!--Site Content-->
			<!--<div class="scroll">-->
			
					 <?php if ($sub == "tricktips") { ?>
					 
					 	<a href="?category=sviewtext&type=tricktip&subcat=stance">Stances</a> <br />
						<a href="?category=sviewtext&type=tricktip&subcat=flatland">Flat Land</a> <br />
						<a href="?category=sviewtext&type=tricktip&subcat=grindslide">Grinds and Slides</a> <br />
						<a href="?category=sviewtext&type=tricktip&subcat=stall">Stalls</a> <br />
						<a href="?category=sviewtext&type=tricktip&subcat=grab">Grabs</a> <br />
						<a href="?category=sviewtext&type=tricktip&subcat=ramptrick">Ramp Tricks</a>
						
					 <?php } elseif ($sub == "reviews") { ?>
					 
					 	<a href="?category=sviewtext&type=skatereview&subcat=deck">Decks</a> <br />
						<a href="?category=sviewtext&type=skatereview&subcat=truck">Trucks</a> <br />
						<a href="?category=sviewtext&type=skatereview&subcat=wheel">Wheels</a> <br />
						<a href="?category=sviewtext&type=skatereview&subcat=video">Videos</a> <br />
						<a href="?category=sviewtext&type=skatereview&subcat=other">Other</a>

					 <?php } elseif ($sub == "tutorials") { ?>
					 
					 	<a href="?category=sviewtext&type=tutorial&subcat=php">PHP</a> <br />
						<a href="?category=sviewtext&type=tutorial&subcat=mysql">MySQL</a> <br />
						<a href="?category=sviewtext&type=tutorial&subcat=css">CSS</a> <br />
						<a href="?category=sviewtext&type=tutorial&subcat=html">HTML</a> <br />
						<a href="?category=sviewtext&type=tutorial&subcat=photoshop">Photoshop</a> <br />
						
					 <?php } elseif ($sub == "comreview") { ?>
					 
					 	<a href="?category=sviewtext&type=comreview&subcat=website">Websites</a> <br />
						<a href="?category=sviewtext&type=comreview&subcat=game">Games</a> <br />
						<a href="?category=sviewtext&type=comreview&subcat=electronic">Electronics</a> <br />
						<a href="?category=sviewtext&type=comreview&subcat=movie">Movies</a> <br />
						
					 <?php } elseif ($sub == "submitcontent") { ?>
					 
					 	<a href="?category=submitcontent&subcat=picture">Picture</a> <br />
						<a href="?category=submitcontent&subcat=text">Text</a> <br />
						<a href="?category=submitcontent&subcat=link">Link</a> <br />
										 
					 <?php } else {}
					 
					  require "$category.php"; ?>
					  
			<!--</div>-->		  
<!--/ Site Content-->
		   			 </td>
				</tr>
			</table>
		</td>
		<td width="152" valign="top" id="content">
			<table width="152" border="1" rules="all" frame="void" bordercolor="#777777" cellpadding="0" cellspacing="0">
				 <tr>
				 	 <th valign="top" width="150">
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
					 <td id="content" valign="top" width="150" style="height:20px;">
					 <?php
				 	 	  if ($memberlogged == FALSE) {	  	
				 	 	  	  print ("<a href='?sub=tutorials&category=blank'>Tutorials</a>  ");
				 	 	  } elseif ($memberlogged == TRUE) { 
					 	  	  print ("Articles");
				 	 	  }  
					 ?>
					 </td>
				 </tr>
				 <tr>
				 	 <td id="content" valign="top" valign="top" style="height:190px;">
				 	 	 <?php
				 		 	  if ($memberlogged == FALSE) {?>	
				 
				   			  <a href="?category=skatepics&type=wallpaper">Wallpaper</a> <br />
							  <a href="?category=sviewtext&type=script">Scripts</a> <br />
							  <a href="?category=blank&sub=comreview">Reviews</a> <br />
							  <a href="?category=sviewtext&type=comarticles">Articles</a> <br />
							  <a href="?category=sviewtext&type=comlinks">Web Design Links</a> <br />
							  <a href="?category=getlinked">Get Linked</a> <br />
									  
				 			  <?php } elseif ($memberlogged == TRUE) { 
				 			  		
									if (($newtcategory[1] == "skatelink") || ($newtcategory[1] == "comlink")) {print ("1. <a href='leavesite.php?address=$newturl[1]' target='_blank'>$newttitle[1]</a> <br />");} else {print ("1. <a href='?category=$newttype[1]&type=$newtcategory[1]&conttitle=$newttitle[1]&trickid=$newtid[1]'>$newttitle[1]</a> <br />");}
				 			  		if (($newtcategory[2] == "skatelink") || ($newtcategory[2] == "comlink")) {print ("2. <a href='leavesite.php?address=$newturl[2]' target='_blank'>$newttitle[2]</a> <br />");} else {print ("2. <a href='?category=$newttype[2]&type=$newtcategory[2]&conttitle=$newttitle[2]&trickid=$newtid[2]'>$newttitle[2]</a> <br />");}
									if (($newtcategory[3] == "skatelink") || ($newtcategory[3] == "comlink")) {print ("3. <a href='leavesite.php?address=$newturl[3]' target='_blank'>$newttitle[3]</a> <br />");} else {print ("3. <a href='?category=$newttype[3]&type=$newtcategory[3]&conttitle=$newttitle[3]&trickid=$newtid[3]'>$newttitle[3]</a> <br />");}
									if (($newtcategory[4] == "skatelink") || ($newtcategory[4] == "comlink")) {print ("4. <a href='leavesite.php?address=$newturl[4]' target='_blank'>$newttitle[4]</a> <br />");} else {print ("4. <a href='?category=$newttype[4]&type=$newtcategory[4]&conttitle=$newttitle[4]&trickid=$newtid[4]'>$newttitle[4]</a> <br />");}
									print ("Images<br />");
									print ("1. <a href='?category=skatepics&type=$newpcategory[1]'>$newptitle[1]</a> <br />");
									print ("2. <a href='?category=skatepics&type=$newpcategory[2]'>$newptitle[2]</a> <br />");
									print ("3. <a href='?category=skatepics&type=$newpcategory[3]'>$newptitle[3]</a> <br />");
									print ("4. <a href='?category=skatepics&type=$newpcategory[4]'>$newptitle[4]</a> <br />");
				 				 
				  			 }  
					   ?>
				  </td>
				</tr>
				<tr>
					<th valign="top" width="150" style="height:20px;">
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
				 <td id="content" valign="top" width="150" style="height:150px;">	 			
			<?php
				 if ($memberlogged == FALSE) {
						 echo "<form method='post' action='http://www.switchskate.net/2006/misc.php?action=login'>";
							 echo "<input type='text' value='Username' name='username' onClick='javascript:select();' width='140'> <br />";
							 echo "<input type='password' value='Password' name='password' onClick='javascript:select();' width='140'> <br />";
							 echo "<input type='submit' value='Login' name='loginsubmit'> or <a href='http://switchskate.net/2006/member.php?action=coppa'>Signup</a>";
						 echo "</form>";
							  		 
				 } elseif ($memberlogged == TRUE) { ?>
							  
					<a href="http://switchskate.net/2006/memcp.php">Control Panel</a> <br />
					<a href="http://switchskate.net/2006/misc.php?action=list">Members List</a> <br />
					<a href="http://switchskate.net/2006/index.php">Forums</a> <br />
					<a href="http://switchskate.net/2006/u2u.php" target="_blank">Check Mail</a> <br />		
					<a href="?category=topsites">Top Sites!!</a> <br />	
					<a href="memberradio.php" target="_blank">Members Radio!!</a> <br />
					<?php if ($userrank == "Super Administrator") {print ("<a href='http://www.switchskate.net/2006/site/cp/'>Admin CP</a>");} else {print ("<a href=''>Submit Pictures</a>"); } ?> <br />
			<?php }  ?>
		</td>
	</tr>
		<?php
			if ($memberlogged == FALSE) {
			} elseif ($memberlogged == TRUE) {
			   print ("<tr>");
				 print ("<th valign='top' width='150' style='height:20px;'>");
				 	   print ("Statistics");
				 print ("</th>");
			   print ("</tr>");
			 }
	?>
			<?php
			if ($memberlogged == FALSE) {
			} elseif ($memberlogged == TRUE) {
				print ("<tr>");
				print ("<td id='content' valign='top' width='150'>"); 
				print ("Articles : $articles<br />");
				print ("Members : $members<br />");
				print ("Forum Posts : $forumposts<br />");
				print ("Members Online : $membersonline<br />");
				print ("</td>");
				print ("</tr>");
			 }
	?>	
			</table>
		</td>
	</tr>
</table>

<table width="754" border="1" bordercolor="#777777" cellpadding="0" cellspacing="0">
<?php 
	if ($max_results < $total_results) {
	if ($memberlogged == TRUE) { ?>
	<tr>
		<td id="content" align="right" valign="top" width="150" style="height:20px;">
			Select Page:
		</td>
		<td id="base" valign="top" width="600" colspan="2" style="height:20px;">
			 <?php
				  for($i = 1; $i <= $total_pages; $i++){ 
    				   if(($page) == $i){ 
        				   echo "$i&nbsp;"; 
        			   } else { 
            			   echo "<a href='?category=$category&subcat=$subcat&type=$type&page=$i' class='base'>$i</a>&nbsp;"; 
    				   } 
			      }
			 ?>
		</td>
	</tr>
	<?php } else { ?>
	<tr>
		<td id="base" valign="top" width="600" colspan="3" style="height:20px;">
			 	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  &nbsp;&nbsp;&nbsp;&nbsp;
				  Become a member to access <?php echo $total_pages ?> more page(s) of <?php echo $catname ?>
		</td>
	</tr>
<?php
	}
	} else {}
?>
	<tr>
		<th colspan="3" width="750" style="height:20px;">
			All content, Images, and design are copyrighted to the owners of switchskate.net
		</th>
	</tr>
</table>
</center>

<?php
  	   mysql_close ($DBLink);
?>

</body>
</html>
