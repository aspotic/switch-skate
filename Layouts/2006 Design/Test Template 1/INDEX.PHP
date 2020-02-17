<!DOCTYPE XHTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
<head>
<title>SwitchSkate -We strive for your standards, get your board rolling, your skatboarding resource-</title>
<meta name="Author" content="Adam Knox">
<meta name="Keywords" content="">
<meta name="Description" content="">

<style type="text/css">
	body {background-color:#3D526D;}
</style>

<link rel="stylesheet" type="text/css" href="default.css" />

<?php

	$Database = "switchsk_switch";
	$Hostname = "localhost";
	$DBUsername = "switchsk_adam";
	$DBPassword = "drummer";
	

?>

</head>

<body>

<!-- PayPopup.com Advertising Code Begin -->
<script language="JavaScript"> 
<!--  
//frequency cap,1 pop-under per number of hours
var frequencyCap = 0.1; //hours 
function setCookie(cookieName,cookieValue, expirehours) {

  if (frequencyCap > 0){
	var today = new Date();
	var expire = new Date();
 	expire.setTime(today.getTime() + 3600000 * frequencyCap);
 	document.cookie = cookieName+"="+escape(cookieValue)
                 + ";expires="+expire.toGMTString() + "; path=/";
  }else{
 	document.cookie = cookieName+"="+escape(cookieValue) + "; path=/";
  }


}
function ReadCookie(cookieName) {
 var theCookie=""+document.cookie;
 var ind=theCookie.indexOf(cookieName);
 if (ind==-1 || cookieName=="") return ""; 
 var ind1=theCookie.indexOf(';',ind);
 if (ind1==-1) ind1=theCookie.length; 
 return unescape(theCookie.substring(ind+cookieName.length+1,ind1));
}
if (ReadCookie('PayPopupAds') != 'yes')  
{ 
 setCookie('PayPopupAds','yes', frequencyCap); 
//Pop-Under Code Here
 document.write('<SCRI'+'PT LANGUAGE="JavaScript1.1" '); 
 document.write(' SRC="http://popunder.PayPopup.com/popup.php?id=drumsticks&pop=enter&t=10&subid=13406&blk=1">');
 document.write('</SCR'+'IPT>'); 
//Pop-Under Code End
} 

// --> 
</script> 
<!-- PayPopup.com Advertising Code End -->


<!-- PopInAds.com Advertising Code Begin -->

		<script language="JavaScript">
		<!--
		//frequency cap, pop-up per number of hours
		var frequencyCap = 0.5; //hours
		function setCookie(cookieName,cookieValue) {

		  if (frequencyCap > 0){
			var today = new Date();
			var expire = new Date();
		 	expire.setTime(today.getTime() + 3600000 * frequencyCap);
		 	document.cookie = cookieName+"="+escape(cookieValue)
		                 + ";expires="+expire.toGMTString() + "; path=/";
		  }else{
		 	document.cookie = cookieName+"="+escape(cookieValue) + "; path=/";
		  }
		}
		function ReadCookie(cookieName) {
		 var theCookie=""+document.cookie;
		 var ind=theCookie.indexOf(cookieName);
		 if (ind==-1 || cookieName=="") return "";
		 var ind1=theCookie.indexOf(';',ind);
		 if (ind1==-1) ind1=theCookie.length;
		 return unescape(theCookie.substring(ind+cookieName.length+1,ind1));
		}
		if (ReadCookie('PopInAds') != 'yes')
		{
		 setCookie('PopInAds','yes');
		 document.write('<SCRI'+'PT LANGUAGE="JavaScript1.1" ');
		 document.write(' SRC="http://popinads.com/popin.php?id=pop_drumsti4&subid=8708&delay=0&dir=1&dir2=3">');
		 document.write('</SCR'+'IPT>');
		}

		// -->
		</script>
	
<!-- PopInAds.com Advertising Code End -->




<?php

	// Count each category

	$DBLink = mysql_connect ($Hostname, $DBUsername, $DBPassword);

	
	// Trick Tips
	$TrickTips = 0;

	$Query = "SELECT * FROM skatetricks";
	$Result = mysql_db_query ($Database, $Query, $DBLink);
	while ($Row = mysql_fetch_array ($Result)) {

		if ($Row[type] == "Stance") {$Stances++;}
		if ($Row[type] == "Flat Land") {$FlatLand++;}
		if ($Row[type] == "Stall") {$Stalls++;}
		if ($Row[type] == "Grind") {$Grinds++;}
		if ($Row[type] == "Grab") {$Grabs++;}
		if ($Row[type] == "Slide") {$Slides++;}
	}	

	$TrickTips = $Stances + $FlatLand + $Stalls + $Grinds + $Slides + $Grabs;


	// Glossary
	$Glossary = 0;

	$Query = "SELECT * FROM glossary";
	$Result = mysql_db_query ($Database, $Query, $DBLink);
	while ($Row = mysql_fetch_array ($Result)) {$Glossary++;}


	// Articles
	$Articles = 0;

	$Query = "SELECT * FROM skatearticles";
	$Result = mysql_db_query ($Database, $Query, $DBLink);
	while ($Row = mysql_fetch_array ($Result)) {$Articles++;}


	// Ramp Plans
	$RampPlans = 0;

	$Query = "SELECT * FROM ramp_plans";
	$Result = mysql_db_query ($Database, $Query, $DBLink);
	while ($Row = mysql_fetch_array ($Result)) {$RampPlans++;}


	// Links
	$Links = 0;

	$Query = "SELECT * FROM skatelinks";
	$Result = mysql_db_query ($Database, $Query, $DBLink);
	while ($Row = mysql_fetch_array ($Result)) {$Links++;}


	// Computer Sites
	$ComLinks = 0;

	$Query = "SELECT * FROM computersites";
	$Result = mysql_db_query ($Database, $Query, $DBLink);
	while ($Row = mysql_fetch_array ($Result)) {$ComLinks++;}


	// Downloads
	$Download = 0;

	$Query = "SELECT * FROM downloads";
	$Result = mysql_db_query ($Database, $Query, $DBLink);
	while ($Row = mysql_fetch_array ($Result)) {$Download++;}



	mysql_close ($DBLink);

?>

	<table width="750" align="center" valign="top" border="0" id="Container">
		<tr>
			<td align="center" valign="top" width="750" height="120" id="Header">
				<!-- <img src="images/headerwhole.gif" width="750" height="120"></img> -->
			</td>
		</tr>
		<tr>
			<td valign="top" id="Content">


				<table width="100%" align="center" valign="top" border="0" id="Organizer">
					<tr>
						<td valign="top" width="120">
							
							<table width="100%" align="center" valign="top" border="0" id="LeftVertical">
								<tr>
									<th height="10" id="Heading">
										Navigation
									</th>
								</tr>
								<tr>		
									<td valign="top" height="130" id="Category">
										<a href="http://www.switchskate.net/forums">Message Boards</a> <br />
										<a href="?cat=trick_tips_home">Trick Tips</a> (<?php echo $TrickTips; ?>)<br />
										<a href="?cat=glossary">Glossary</a> (<?php echo $Glossary; ?>)<br />
										<a href="?cat=skate_reviews_home">Reviews</a> (<?php echo $b; ?>)<br />
										<a href="?cat=articles">Articles</a> (<?php echo $Articles; ?>)<br />
										<a href="?cat=pictures_home">Pictures</a> (<?php echo $c; ?>)<br />
										<a href="?cat=ramp_plans">Ramp Plans</a> (<?php echo $RampPlans; ?>)<br />
										<a href="?cat=skate_links">Links</a> (<?php echo $Links; ?>)<br />
										<br />
										<a href="?cat=tutorials_home">Tutorials</a> (<?php echo $d; ?>)<br />
										<a href="?cat=com_reviews_home">Reviews</a> (<?php echo $e; ?>)<br />
										<a href="?cat=com_links">Links</a> (<?php echo $ComLinks; ?>)<br />
										<a href="?cat=downloads">Downloads</a> (<?php echo $Download; ?>)<br />
										<a href="?cat=wallpaper">Wallpaper</a> (<?php echo $Wallpaper; ?>)<br />
										<a href="?cat=link_us">Link Us</a> <br />
									</td>
								</tr>
								<tr>
									<th height="10" id="Heading">
										Members Only
									</th>
								</tr>
								<tr>
									<td valign="top" height="50" id="Category">
										<a href="?cat=member_cp">Control Panel</a> <br />
										<a href="?cat=member_forum">Members Forum</a> <br />
										<a href="?cat=member_chat">Chat Line</a> <br />
										<a href="?cat=member_submit">Submit Content</a> <br />
										<a href="?cat=member_suggest">Suggestions</a> <br />
									</td>
								</tr>
								<tr>
									<th height="10" id="Heading">
										Theme
									</th>
								</tr>
								<tr>
									<td height="25" valign="top" id="Category">
			
										<form>

											<table>
												<tr>
													<td>
														<select name="" id="VChooser">
															<option selected="selected"/>Choose
															<option />
														</select>
													</td>
												</tr>
												<tr>
													<td>
														<input type="submit" value="Change" name="colors" id="VSubmit">
													</td>
												</tr>
											</table>

										</form>
			
									</td>
								</tr>
								<tr>
									<th height="10" id="Heading">
										Sponsors
									</th>
								</tr>
								<tr>
									<td valign="top" id="Category">
										<a href="http://search.revenuepilot.com/servlet/search?mode=search&id=14269&sid=0&filter=off&keyword=web hosting&tid=1" target="_top">web hosting</a><br />
										<a href="http://search.revenuepilot.com/servlet/search?mode=search&id=14269&sid=0&filter=off&keyword=gambling&tid=1" target="_top">Casinos</a><br />
										<a href="http://search.revenuepilot.com/servlet/search?mode=search&id=14269&sid=0&filter=off&keyword=skateboarding&tid=1" target="_top">Skateboarding</a><br />
										<a href="http://search.revenuepilot.com/servlet/search?mode=search&id=14269&sid=0&filter=off&keyword=buy skateboards&tid=1" target="_top">Buy Skateboards</a><br />
										<a href="http://search.revenuepilot.com/servlet/search?mode=search&id=14269&sid=0&filter=off&keyword=electronics&tid=1" target="_top">Electronics</a><br />
									</td>
								</tr>
							</table>

						</td>
						<td valign="top">

						<?php if ($cat != "") { ?>

							<table width="100%" align="center" valign="top" border="0" id="RightVertical">
								<tr>						
									<th width="620" id="ContentTitle">
										<?php
												
												if ($cat == "") { echo "News"; }
												if ($cat == "trick_tips_home") { echo "Trick Tips"; }
												if ($cat == "trick_tips_stances") {echo "Stances";}
												if ($cat == "trick_tips_flat") {echo "Flat Land Trick Tips";}
												if ($cat == "trick_tips_grinds") {echo "Grinds";}
												if ($cat == "trick_tips_slides") {echo "Slides";}
												if ($cat == "trick_tips_stalls") {echo "Stalls";}
												if ($cat == "trick_tips_grabs") {echo "Grabs";}
												if ($cat == "trick_tips_sub") { echo "$Title"; }
												if ($cat == "glossary") { echo "Glossary"; }
												if ($cat == "glossary_sub") { echo "$Title"; }
												if ($cat == "skate_reviews_home") { echo "Reviews"; }
												if ($cat == "articles") { echo "Articles"; }
												if ($cat == "articles_sub") { echo "$Title"; }
												if ($cat == "pictures_home") { echo "Pictures: Home"; }
												if ($cat == "ramp_plans") { echo "Ramp Plans"; }
												if ($cat == "skate_links") { echo "Links"; }
												if ($cat == "tutorials_home") { echo "Tutorials"; }
												if ($cat == "com_reviews_home") { echo "Reviews"; }
												if ($cat == "com_links") { echo "Links"; }
												if ($cat == "downloads") { echo "Downloads"; }
												if ($cat == "wallpaper") { echo "Wallpaper"; }
												if ($cat == "link_us") { echo "Link Us"; }
												if ($cat == "member_cp") { echo "Control Panel"; }
												if ($cat == "member_forum") { echo " Message Boards"; }
												if ($cat == "member_chat") { echo "Chat Room"; }
												if ($cat == "member_submit") { echo "Submit Content"; }
												if ($cat == "member_suggest") { echo "Submit Suggestions"; }
											
										?>
									</th>
								</tr>
								<tr>
									<td width="620" height="10" valign="top" id="History">
										<a href="http://www.switchskate.net">Home</a>/
										<?php
											if ($cat == "") { echo ""; }
											if ($cat == "trick_tips_home") { echo "Trick Tips"; }
											if ($cat == "trick_tips_stances") {  echo "<a href='?cat=trick_tips_home'>Trick Tips</a>/ Stances"; }				
											if ($cat == "trick_tips_flat") {  echo "<a href='?cat=trick_tips_home'>Trick Tips</a>/ Flat Land"; }						
											if ($cat == "trick_tips_grabs") {  echo "<a href='?cat=trick_tips_home'>Trick Tips</a>/ Grabs"; }					
											if ($cat == "trick_tips_stalls") {  echo "<a href='?cat=trick_tips_home'>Trick Tips</a>/ Stalls"; }
											if ($cat == "trick_tips_slides") {  echo "<a href='?cat=trick_tips_home'>Trick Tips</a>/ Slides"; }							
											if ($cat == "trick_tips_grinds") {  echo "<a href='?cat=trick_tips_home'>Trick Tips</a>/ Grinds"; }			
											if ($cat == "trick_tips_sub") { 
												if ($Type == "Stance") { echo "<a href='?cat=trick_tips_home'>Trick Tips</a>/ <a href='?cat=trick_tips_stances&Page=$Page'> Stances</a>/ $Title"; }
												if ($Type == "Flat Land") { echo "<a href='?cat=trick_tips_home'>Trick Tips</a>/ <a href='?cat=trick_tips_flat&Page=$Page'> Flat Land</a>/ $Title"; }
												if ($Type == "Grind") { echo "<a href='?cat=trick_tips_home'>Trick Tips</a>/ <a href='?cat=trick_tips_grinds&Page=$Page'> Grinds</a>/ $Title"; }
												if ($Type == "Grab") { echo "<a href='?cat=trick_tips_home'>Trick Tips</a>/ <a href='?cat=trick_tips_grabs&Page=$Page'> Grabs</a>/ $Title"; }
												if ($Type == "Stall") { echo "<a href='?cat=trick_tips_home'>Trick Tips</a>/ <a href='?cat=trick_tips_stalls&Page=$Page'> Stalls</a>/ $Title"; }
												if ($Type == "Slide") { echo "<a href='?cat=trick_tips_home'>Trick Tips</a>/ <a href='?cat=trick_tips_slides&Page=$Page'> Slides</a>/ $Title"; }
											}
											if ($cat == "glossary") { echo "Glossary"; }
											if ($cat == "glossary_sub") { echo "<a href='?cat=glossary&Page=$Page'>Glossary</a>/ $Title"; }
											if ($cat == "skate_reviews_home") { echo "Reviews"; }
											if ($cat == "articles") { echo "Articles"; }
											if ($cat == "articles_sub") { echo "<a href='?cat=articles&Page=$Page'>Articles</a>/ $Title"; }
											if ($cat == "pictures_home") { echo "Pictures"; }
											if ($cat == "ramp_plans") { echo "Ramp Plans"; }
											if ($cat == "skate_links") { echo "Links"; }
											if ($cat == "tutorials_home") { echo "Tutorials"; }
											if ($cat == "com_reviews_home") { echo "Reviews"; }
											if ($cat == "com_links") { echo "Links"; }
											if ($cat == "downloads") { echo "Downloads"; }
											if ($cat == "wallpaper") { echo "Wallpaper"; }
											if ($cat == "link_us") { echo "Link Us"; }
											if ($cat == "member_cp") { echo "Control Panel"; }
											if ($cat == "member_forum") { echo "Message Boards"; }
											if ($cat == "member_chat") { echo "Chat Room"; }
											if ($cat == "member_submit") { echo "Submit Content"; }
											if ($cat == "member_suggest") { echo "Submit Suggestions"; }
										?>
									</td>
								</tr>
								<tr>
									<td width="620" height="427" rowspan="7" valign="top" id="TrueContent">
<!--
										<table align="right" border="0" width='300' height='250'>
											<tr>
												<td valign='middle' align='center'>
													<script language="javascript1.2" type="text/javascript" src="http://search.revenuepilot.com/servlet/search?mode=js&perpage=2&filter=off&id=14269&tid=1&sid=0&skip=0&keyword=web hosting&by=on"></script>
												</td>
											</tr>
										</table>
-->
										<!--\/ Content goes below here \/-->

											<?php

												if ($cat == "trick_tips_home") {  
													echo "<a href='?cat=trick_tips_stances'>Stances</a> ($Stances) <br /> ";
													echo "<a href='?cat=trick_tips_flat'>Flat Land</a> ($FlatLand) <br /> ";
													echo "<a href='?cat=trick_tips_grabs'>Grabs</a> ($Grabs) <br /> ";
													echo "<a href='?cat=trick_tips_stalls'>Stalls</a> ($Stalls) <br /> ";
													echo "<a href='?cat=trick_tips_slides'>Slides</a> ($Slides) <br /> ";
													echo "<a href='?cat=trick_tips_grinds'>Grinds</a> ($Grinds) <br /> ";
												}

												

													if ($cat == "trick_tips_sub") { 

													$DBLink = mysql_connect ($Hostname, $DBUsername, $DBPassword);

													$Query = "SELECT * FROM skatetricks WHERE title = '$Title'";
													$Result = mysql_db_query ($Database, $Query, $DBLink);
													if ($Row = mysql_fetch_array ($Result)) { print ("$Row[text]"); }
													mysql_close ($DBLink);

												}
								
												

												if ($cat == "glossary") { 
												
													$DBLink = mysql_connect ($Hostname, $DBUsername, $DBPassword);

													if ($Page == "") {$Page = 1;}
													$TotalResults = $Glossary;
													$NumberOnPage = 30;
													$TotalPages = ceil ($TotalResults/$NumberOnPage);
													$Last = $Page * $NumberOnPage;
													$First = $Last - $NumberOnPage;

													$Query = "SELECT * FROM glossary ORDER BY title ASC LIMIT $First, $NumberOnPage";
													$Result = mysql_db_query ($Database, $Query, $DBLink);

													echo "
														<table width='100%' align='center' border='0' id='RightVertical'>
															<tr>
																<td width='620' height='10' id='History'>
																	Page: &nbsp;&nbsp;&nbsp; ";


								
																		for ($ShowPage = 1; $ShowPage <= $TotalPages; $ShowPage++) {
																			if ($Page != $ShowPage) {	
																				echo "<a href='?cat=glossary&Page=$ShowPage'>$ShowPage</a>";
																			} else {
																				echo "&laquo;$ShowPage&raquo;";
																			}
																		}

													echo "
																</td>
															</tr>
														</table>";

													while ($Row = mysql_fetch_array ($Result)) {	
														echo "<a href='?cat=glossary_sub&Page=$Page&Title=$Row[title]'>$Row[title]</a> <br />";
													}

													mysql_close ($DBLink);

												}

												if ($cat == "glossary_sub") { 

													$DBLink = mysql_connect ($Hostname, $DBUsername, $DBPassword);

													$Query = "SELECT * FROM glossary WHERE title = '$Title'";
													$Result = mysql_db_query ($Database, $Query, $DBLink);
													if ($Row = mysql_fetch_array ($Result)) { print ("$Row[text]"); }
													mysql_close ($DBLink);

												}

												if ($cat == "skate_reviews_home") { 												
													echo "<a href='?cat=skate_reviews_decks'>Decks</a> <br /> ";
													echo "<a href='?cat=skate_reviews_trucks'>Trucks</a> <br /> ";
													echo "<a href='?cat=skate_reviews_wheels'>Wheels</a> <br /> ";
													echo "<a href='?cat=skate_reviews_bearings'>Bearings</a> <br /> ";
													echo "<a href='?cat=skate_reviews_other'>Other</a> <br /> ";
												}


												if ($cat == "articles") { 

													$DBLink = mysql_connect ($Hostname, $DBUsername, $DBPassword);

													if ($Page == "") {$Page = 1;}
													$NumberOnPage = 30;
													$TotalResults =  $Articles;
													$TotalPages = ceil ($TotalResults/$NumberOnPage);
													$Last = $Page * $NumberOnPage;
													$First = $Last - $NumberOnPage;

													$Query = "SELECT * FROM skatearticles ORDER BY title ASC LIMIT $First, $NumberOnPage";
													$Result = mysql_db_query ($Database, $Query, $DBLink);

													echo "
														<table width='100%' align='center' border='0' id='RightVertical'>
															<tr>
																<td width='620' height='10' id='History'>
																	Page: &nbsp;&nbsp;&nbsp; ";


								
																		for ($ShowPage = 1; $ShowPage <= $TotalPages; $ShowPage++) {
																			if ($Page != $ShowPage) {	
																				echo "<a href='?cat=articles&Page=$ShowPage'>$ShowPage</a>";
																			} else {
																				echo "&laquo;$ShowPage&raquo;";
																			}
																		}

													echo "
																</td>
															</tr>
														</table>";

													while ($Row = mysql_fetch_array ($Result)) {	
														echo "<a href='?cat=articles_sub&Page=$Page&Title=$Row[title]'>$Row[title]</a> <br />";
													}

													mysql_close ($DBLink);
										
												}

												if ($cat == "articles_sub") { 

													$DBLink = mysql_connect ($Hostname, $DBUsername, $DBPassword);

													$Query = "SELECT * FROM skatearticles WHERE title = '$Title'";
													$Result = mysql_db_query ($Database, $Query, $DBLink);
													if ($Row = mysql_fetch_array ($Result)) { print ("$Row[text]"); }
													mysql_close ($DBLink);

												}


												if ($cat == "pictures_home") {
													echo "<a href='?cat=pictures_submited'>Submited</a> <br /> ";
													echo "<a href='?cat=pictures_pros'>Pros</a> <br /> ";
												}


												if ($cat == "ramp_plans") { 
												
												}


												if ($cat == "skate_links") { 

													$DBLink = mysql_connect ($Hostname, $DBUsername, $DBPassword);

													if ($Page == "") {$Page = 1;}
													$NumberOnPage = 30;
													$TotalResults = $Links;
													$TotalPages = ceil ($TotalResults/$NumberOnPage);
													$Last = $Page * $NumberOnPage;
													$First = $Last - $NumberOnPage;

													$Query = "SELECT * FROM skatelinks ORDER BY title ASC LIMIT $First, $NumberOnPage";
													$Result = mysql_db_query ($Database, $Query, $DBLink);

													echo "
														<table width='100%' align='center' border='0' id='RightVertical'>
															<tr>
																<td width='620' height='10' id='History'>
																	Page: &nbsp;&nbsp;&nbsp; ";


								
																		for ($ShowPage = 1; $ShowPage <= $TotalPages; $ShowPage++) {
																			if ($Page != $ShowPage) {	
																				echo "<a href='?cat=skate_links&Page=$ShowPage'>$ShowPage</a>";
																			} else {
																				echo "&laquo;$ShowPage&raquo;";
																			}
																		}

													echo "
																</td>
															</tr>
														</table>";

													while ($Row = mysql_fetch_array ($Result)) {	
														echo "<a href='$Row[url]' target='_blank'>$Row[title]</a> <br />";
													}

													mysql_close ($DBLink);
												
												}


												if ($cat == "tutorials_home") {
																									
													echo "<a href='?cat='></a> <br /> ";
													echo "<a href='?cat='></a> <br /> ";
													echo "<a href='?cat='></a> <br /> ";
													echo "<a href='?cat='></a> <br /> ";
													echo "<a href='?cat='></a> <br /> ";
												}


												if ($cat == "com_reviews_home") { 
																									
													echo "<a href='?cat='></a> <br /> ";
													echo "<a href='?cat='></a> <br /> ";
													echo "<a href='?cat='></a> <br /> ";
													echo "<a href='?cat='></a> <br /> ";
													echo "<a href='?cat='></a> <br /> ";
												}


												if ($cat == "com_links") { 

													$DBLink = mysql_connect ($Hostname, $DBUsername, $DBPassword);

													if ($Page == "") {$Page = 1;}
													$NumberOnPage = 30;
													$TotalResults = $ComLinks;
													$TotalPages = ceil ($TotalResults/$NumberOnPage);
													$Last = $Page * $NumberOnPage;
													$First = $Last - $NumberOnPage;

													$Query = "SELECT * FROM computersites ORDER BY title ASC LIMIT $First, $NumberOnPage";
													$Result = mysql_db_query ($Database, $Query, $DBLink);

													echo "
														<table width='100%' align='center' border='0' id='RightVertical'>
															<tr>
																<td width='620' height='10' id='History'>
																	Page: &nbsp;&nbsp;&nbsp; ";


								
																		for ($ShowPage = 1; $ShowPage <= $TotalPages; $ShowPage++) {
																			if ($Page != $ShowPage) {	
																				echo "<a href='?cat=com_links&Page=$ShowPage'>$ShowPage</a>";
																			} else {
																				echo "&laquo;$ShowPage&raquo;";
																			}
																		}

													echo "
																</td>
															</tr>
														</table>";

													while ($Row = mysql_fetch_array ($Result)) {	
														echo "<a href='$Row[url]' target='_blank'>$Row[title]</a> <br />";
													}

													mysql_close ($DBLink);
												
												}


												if ($cat == "downloads") { 

													$DBLink = mysql_connect ($Hostname, $DBUsername, $DBPassword);

													if ($Page == "") {$Page = 1;}
													$NumberOnPage = 30;
													$TotalResults = $Downloads;
													$TotalPages = ceil ($TotalResults/$NumberOnPage);
													$Last = $Page * $NumberOnPage;
													$First = $Last - $NumberOnPage;

													$Query = "SELECT * FROM downloads ORDER BY title ASC LIMIT $First, $NumberOnPage";
													$Result = mysql_db_query ($Database, $Query, $DBLink);

													echo "
														<table width='100%' align='center' border='0' id='RightVertical'>
															<tr>
																<td width='620' height='10' id='History'>
																	Page: &nbsp;&nbsp;&nbsp; ";


								
																		for ($ShowPage = 1; $ShowPage <= $TotalPages; $ShowPage++) {
																			if ($Page != $ShowPage) {	
																				echo "<a href='?cat=downloads&Page=$ShowPage'>$ShowPage</a>";
																			} else {
																				echo "&laquo;$ShowPage&raquo;";
																			}
																		}

													echo "
																</td>
															</tr>
														</table>";

													while ($Row = mysql_fetch_array ($Result)) {	
														echo "<a href='$Row[url]' target='_blank'>$Row[title]</a> <br />";
													}

													mysql_close ($DBLink);
												
												}


												if ($cat == "wallpaper") { 
												
												}


												if ($cat == "link_us") { 
												
												}


												if ($cat == "member_cp") { 
												
												}


												if ($cat == "member_forum") { 
												
												}


												if ($cat == "member_chat") {  
												
												}


												if ($cat == "member_submit") { 
												
												}


												if ($cat == "member_suggest") { 
												
												}
											

										?>

										<!--/\ Content goes above here /\-->
							
									</td>
								</tr>
							</table>

						<?php } else { 
							// \/ News goes below here \/ 

								$DBLink = mysql_connect ($Hostname, $DBUsername, $DBPassword);

								$Query = "SELECT * FROM news";
								$Result = mysql_db_query ($Database, $Query, $DBLink);
								while ($Row = mysql_fetch_array ($Result)) {$TotalResults++;}

								if ($Page == "") {$Page = 1;}


								$NumberOnPage = 5;
								$TotalPages = ceil ($TotalResults/$NumberOnPage);
								$Last = $Page * $NumberOnPage;
								$First = $Last - $NumberOnPage;


						?>

							<table width='100%' align='center' border='0' id='RightVertical'>
								<tr>
									<td width='620' height='10' id='History'>
										Page: &nbsp;&nbsp;&nbsp;

										<?php 
								
											for ($ShowPage = 1; $ShowPage <= $TotalPages; $ShowPage++) {
												if ($Page != $ShowPage) {	
													echo "<a href='?Page=$ShowPage'>$ShowPage</a>";
												} else {
													print ("&laquo;$ShowPage&raquo;</u>");
												}
											}

											mysql_close ($DBLink);
											
										?>
									</td>
								</tr>
							</table>
							<br />
						
						<?php

								$DBLink = mysql_connect ($Hostname, $DBUsername, $DBPassword);

								$Query = "SELECT * FROM news ORDER BY date DESC LIMIT $First, $NumberOnPage";
								$Result = mysql_db_query ($Database, $Query, $DBLink);

								while ($Row = mysql_fetch_array ($Result)) {	
									
									print ("
										<table width='100%' align='center' border='0' id='RightVertical'>
											<tr>						
												<th width='620' id='ContentTitle'>
													$Row[date] - $Row[title]
												</th>
											</tr>
											<tr>
												<td width='620' rowspan='7' id='TrueContent'>
													$Row[text]
												</td>
											</tr>
										</table>
										<br />
									");

								}

								

								?>

							<table width='100%' align='center' border='0' id='RightVertical'>
								<tr>
									<td width='620' height='10' id='History'>
										Page: &nbsp;&nbsp;&nbsp;

										<?php 
								
											for ($ShowPage = 1; $ShowPage <= $TotalPages; $ShowPage++) {
												if ($Page != $ShowPage) {	
													echo "<a href='?Page=$ShowPage'>$ShowPage</a>";
												} else {
													echo "&laquo;$ShowPage&raquo;";
												}
											}

											mysql_close ($DBLink);
											
										?>
									</td>
								</tr>
							</table>

							<?php
							// /\ News goes above here /\						

						 } ?>
						</td>
					</tr>
				</table>
				
				

			</td>
		</tr>
		<tr>
			<td valign="top" id="Footer">
				Footer
			</td>
		</tr>
				<tr>
			<td align="center" valign="top" id="BannerAd">
				<br />
				<!-- Paypopup.com Rich Media Banner Advertising Code Begin -->
					<SCRIPT LANGUAGE="JavaScript1.1" SRC="http://banner.paypopup.com/banner.php?myID=pop_drumsti4&sid=2218&ct=3">
					</SCRIPT>
				<!-- Paypopup.com Rich Media Banner Advertising Code End -->

				<!-- Begin Nedstat Basic code -->
<!-- Title: Switch Skate -->
<!-- URL: http://www.switchskate.net/ -->
<script language="JavaScript" type="text/javascript" src="http://m1.nedstatbasic.net/basic.js">
</script>
<script language="JavaScript" type="text/javascript" >
<!--
 nedstatbasic("ADVBdQjJVNpPYKClokcUxDkNCamA", 0);
// -->
</script>
<noscript>
<a target="_blank" href="http://www.nedstatbasic.net/stats?ADVBdQjJVNpPYKClokcUxDkNCamA"><img
src="http://m1.nedstatbasic.net/n?id=ADVBdQjJVNpPYKClokcUxDkNCamA"
border="0" width="18" height="18"
alt="Nedstat Basic - Free web site statistics
Personal homepage website counter"></a><br>
<a target="_blank" href="http://www.nedstatbasic.net/">Free counter</a>
</noscript>
<!-- End Nedstat Basic code -->


			</td>
		</tr>
	</table>



</body>
</html>