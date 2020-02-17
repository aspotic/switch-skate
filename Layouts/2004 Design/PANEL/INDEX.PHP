<?php

require ("header.php");  // Open header file


// Constant Variables

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 
$LinkUp = mysql_connect ($host, $user, $pass);

	  $MSTPPLTBL = "ppl_most_site"; 
$MSTDB="switchsk_other";
$MSTQuery = "SELECT * from $MSTPPLTBL WHERE id = 1";
$MSTResult = mysql_db_query ($MSTDB, $MSTQuery, $LinkUp);
$MSTRow = mysql_fetch_array($MSTResult);

// Set Variables

$host = "localhost";
$user = "switchsk_adam";
$pass = "drummer";
$TTTBL1 = "tricktips1";
$TTTBL2 = "tricktips2";
$TTTBL3 = "tricktips3";
$TTTBL4 = "tricktips4";
$SSTBL = "storys";
$ARTBL = "articles";
$SBRETBL1 = "reviews1";
$SBRETBL2 = "reviews2";
$SBRETBL3 = "reviews3";
$SBRETBL4 = "reviews4";
$CORETBL1 = "coreviews1";
$CORETBL2 = "coreviews2";
$CORETBL3 = "coreviews3";
$CORETBL4 = "coreviews4";
$SBLITBL = "sblinks";
$COTUTBL1 = "tutorials1";
$COTUTBL2 = "tutorials2";
$COTUTBL3 = "tutorials3";
$COTUTBL4 = "tutorials4";
$COLITBL = "colinks";
$NWSTBL = "news";
$PCTBL = "pictures";

$ContentDB = "switchsk_cucont";
$FContentDB = "switchsk_fcontent";
$StatsDB = "switchsk_forum";

$tricktips = 0;
$stories = 0;
$articles = 0;
$sbreviews = 0;
$coreviews = 0;
$sblinks = 0;
$tutorials = 0;
$colinks = 0;
$news = 0;
$tthemes = 0;
$tpost = 0;
$tmember = 0;
$sitemost = 0;
$tpictures = 0;

$LinkUp = mysql_connect ($host, $user, $pass);

$StatsQuery = "SELECT * from xmb_members";
$StatsResult = mysql_db_query ($StatsDB, $StatsQuery, $LinkUp);
while ($StatsRow = mysql_fetch_array($StatsResult)){$tmember++;}

$StatsQuery = "SELECT * from xmb_posts";
$StatsResult = mysql_db_query ($StatsDB, $StatsQuery, $LinkUp);
while ($StatsRow = mysql_fetch_array($StatsResult)){$tpost++;}

$StatsQuery = "SELECT * from xmb_themes";
$StatsResult = mysql_db_query ($StatsDB, $StatsQuery, $LinkUp);
while ($StatsRow = mysql_fetch_array($StatsResult)){$ttheme++;}



mysql_select_db('switchsk_fcontent', mysql_pconnect('localhost','switchsk_adam','drummer')) or die (mysql_error()); 
$SS = mysql_query("SELECT * FROM $SSTBL"); 
while($SSRow = mysql_fetch_array($SS)){$stories++;}

mysql_select_db('switchsk_other', mysql_pconnect('localhost','switchsk_adam','drummer')) or die (mysql_error()); 

$NWS = mysql_query("SELECT * FROM $NWSTBL"); 
while($NWSRow = mysql_fetch_array($NWS)){$news++;}

mysql_select_db('switchsk_cucont', mysql_pconnect('localhost','switchsk_adam','drummer')) or die (mysql_error()); 

$PC = mysql_query("SELECT * FROM $PCTBL"); 
while($PCRow = mysql_fetch_array($PC)){$tpictures++;}

$TT1 = mysql_query("SELECT * FROM $TTTBL1"); 
while($TT1Row = mysql_fetch_array($TT1)){$tricktips++;}
$TT2 = mysql_query("SELECT * FROM $TTTBL2"); 
while($TT2Row = mysql_fetch_array($TT2)){$tricktips++;}
$TT3 = mysql_query("SELECT * FROM $TTTBL3"); 
while($TT3Row = mysql_fetch_array($TT3)){$tricktips++;}
$TT4 = mysql_query("SELECT * FROM $TTTBL4"); 
while($TT4Row = mysql_fetch_array($TT4)){$tricktips++;}

$AR = mysql_query("SELECT * FROM $ARTBL"); 
while($ARRow = mysql_fetch_array($AR)){$articles++;}

$SBRE1 = mysql_query("SELECT * FROM $SBRETBL1"); 
while($SBRE1Row = mysql_fetch_array($SBRE1)){$sbreviews++;}
$SBRE2 = mysql_query("SELECT * FROM $SBRETBL2"); 
while($SBRE2Row = mysql_fetch_array($SBRE2)){$sbreviews++;}
$SBRE3 = mysql_query("SELECT * FROM $SBRETBL3"); 
while($SBRE3Row = mysql_fetch_array($SBRE3)){$sbreviews++;}
$SBRE4 = mysql_query("SELECT * FROM $SBRETBL4"); 
while($SBRE4Row = mysql_fetch_array($SBRE4)){$sbreviews++;}

$SBLI = mysql_query("SELECT * FROM $SBLITBL"); 
while($SBLIRow = mysql_fetch_array($SBLI)){$sblinks++;}

$COTUT1 = mysql_query("SELECT * FROM $COTUTBL1"); 
while($COTUTRow1 = mysql_fetch_array($COTUT1)){$tutorials++;}
$COTUT2 = mysql_query("SELECT * FROM $COTUTBL2"); 
while($COTUTRow2 = mysql_fetch_array($COTUT2)){$tutorials++;}
$COTUT3 = mysql_query("SELECT * FROM $COTUTBL3"); 
while($COTUTRow3 = mysql_fetch_array($COTUT3)){$tutorials++;}
$COTUT4 = mysql_query("SELECT * FROM $COTUTBL4"); 
while($COTUTRow4 = mysql_fetch_array($COTUT4)){$tutorials++;}

$COLI = mysql_query("SELECT * FROM $COLITBL"); 
while($COLIRow = mysql_fetch_array($COLI)){$colinks++;}

$CORE1 = mysql_query("SELECT * FROM $CORETBL1"); 
while($CORE1Row = mysql_fetch_array($CORE1)){$coreviews++;}
$CORE2 = mysql_query("SELECT * FROM $CORETBL2"); 
while($CORE2Row = mysql_fetch_array($CORE2)){$coreviews++;}
$CORE3 = mysql_query("SELECT * FROM $CORETBL3"); 
while($CORE3Row = mysql_fetch_array($CORE3)){$coreviews++;}
$CORE4 = mysql_query("SELECT * FROM $CORETBL4"); 
while($CORE4Row = mysql_fetch_array($CORE4)){$coreviews++;}

$ncontent = $stories + $tricktips + $articles + $sbreviews + $sblinks + $tutorials + $colinks + $coreviews + $news;


$ssblink = 0;
$stricktip = 0;
$sarticle = 0;
$ssbreview = 0;
$sstory = 0;
$scolink = 0;
$stutorial = 0;
$scoreveiw = 0;
$sresume = 0;
$scolor = 0;
$csblink = 0;
$ctricktip = 0;
$carticle = 0;
$creview = 0;
$cstory = 0;
$ccolink = 0;
$ctutorial = 0;
$ccoreview = 0;
$cresume = 0;
$ccolor = 0;
$tmember = 0;
$tmost = 0;
$tpost = 0;
$ttheme = 0;
$stotal = 0;
$scomment = 0;
$none = 0;
$none1 = 0;
$none2 = 0;
$none3 = 0;
$spictures = 0;

// Declare Databases

$StatsDB="switchsk_forum";
$SubmitDB="switchsk_fcontent";


// Connect to

$StatsQuery = "SELECT * from xmb_members";
$StatsResult = mysql_db_query ($StatsDB, $StatsQuery, $LinkUp);
while ($StatsRow = mysql_fetch_array($StatsResult)){$tmember++;}


// Connect to

$StatsQuery = "SELECT * from xmb_mostonline";
$StatsResult = mysql_db_query ($StatsDB, $StatsQuery, $LinkUp);
$StatsRow = mysql_fetch_array($StatsResult);
$tmost = $StatsRow[mostonlinecount];


// Connect to

$StatsQuery = "SELECT * from xmb_posts";
$StatsResult = mysql_db_query ($StatsDB, $StatsQuery, $LinkUp);
while ($StatsRow = mysql_fetch_array($StatsResult)){$tpost++;}


// Connect to

$StatsQuery = "SELECT * from xmb_themes";
$StatsResult = mysql_db_query ($StatsDB, $StatsQuery, $LinkUp);
while ($StatsRow = mysql_fetch_array($StatsResult)){$ttheme++;}
 

// Connect to

$SubmitQuery = "SELECT * from sblinks";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$ssblink++;}


// Connect to

$SubmitQuery = "SELECT * from pictures";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$spictures++;}

// Connect to

$SubmitQuery = "SELECT * from tricktips";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$stricktip++;}


// Connect to

$SubmitQuery = "SELECT * from articles";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$sarticle++;}


// Connect to

$SubmitQuery = "SELECT * from reviews";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$ssbreview++;}


// Connect to

$SubmitQuery = "SELECT * from storys";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$sstory++;}


// Connect to

$SubmitQuery = "SELECT * from colinks";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$scolink++;}


// Connect to

$SubmitQuery = "SELECT * from games";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$sgame++;}


// Connect to

$SubmitQuery = "SELECT * from tutorials";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$stutorial++;}


// Connect to

$SubmitQuery = "SELECT * from coreviews";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$scoreview++;}


// Connect to

$SubmitQuery = "SELECT * from colors";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$scolor++;}


// Connect to

$SubmitDB = "switchsk_other";
$SubmitQuery = "SELECT * from resume";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$sresume++;}


// Connect to

$SubmitQuery = "SELECT * from comments";
$SubmitResult = mysql_db_query ($SubmitDB, $SubmitQuery, $LinkUp);
while ($SubmitRow = mysql_fetch_array($SubmitResult)){$scomment++;}


mysql_close ($LinkUp);  //Close Database Connection

?>



<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
	  <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>New Submissions</b>
	  </TD>
	  <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>Content Count</b>
	  </TD>
      <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>Website Stats</b>
	  </TD>
	</TR>
	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt1] ?>" valign="top">	  
	  <?php
	   
	  if ($stricktip != 0){print ("$stricktip new trick tip(s)<br>\n");}else{$none1++;}
	  if ($sarticle != 0){print ("$sarticle new article(s)<br>\n");}else{$none1++;}
	  if ($ssbreview != 0){print ("$ssbreview new skate review(s)<br>\n");}else{$none1++;}
	  if ($sstory != 0){print ("$sstory new story(s)<br>\n");}else{$none1++;}
	  if ($ssblink != 0){print ("$ssblink new skate link(s)<br>\n");}else{$none1++;}
	  if ($spictures != 0){print ("$spictures new picture(s)<br>\n");}else{$none1++;}
	  if ($none1 != 6){ print ("<br>\n"); }
	  if ($scolink != 0){print ("$scolink new computer link(s)<br>\n");}else{$none2++;}
	  if ($stutorial != 0){print ("$stutorial new tutorial(s)<br>\n");}else{$none2++;}
	  if ($scoreview != 0){print ("$scoreview new computer review(s)<br>\n");}else{$none2++;}
	  if ($none2 != 3){ print ("<br>\n"); }
	  if ($sresume != 0){print ("$sresume new resume(s)<br>\n");}else{$none3++;}
	  if ($scolor != 0){print ("$scolor new color scheme(s)<br>\n");}else{$none3++;}
	  if ($scomment != 0){print ("$scomment new comment(s)<br>\n");}else{$none3++;}
	  if ($none3 != 3){ print ("<br>\n"); }
	  $none = $none1 + $none2 + $none3;
	  $stotal = $stricktip + $scomment + $spictures + $sarticle + $ssbreview + $sstory + $ssblink + $scolink + $stutorial + $scoreview + $sresume + $scolor;
	  if ($none == 12){ print ("NO NEW SUBMISSIONS"); }else{print ("$stotal NEW SUBMISSIONS");}
	  
	  $none = 0;
	  $none1 = 0;
	  $none2 = 0;
	  $none3 = 0;
	  
	  ?>  
	  </TD>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt1] ?>" valign="top">
	  <?php
	  
	  print ("$stories Skate Stories<br>\n");
	  print ("$tpictures Pictures<br>\n");
	  print ("$articles Skate Articles<br>\n");
	  print ("$sbreviews Skate Reviews<br>\n");
	  print ("$sblinks Skate Links<br>\n");
	  print ("$tutorials Tutorials<br>\n");
	  print ("$colinks Computer Links<br>\n");
	  print ("$coreviews Computer Reviews<br>\n");
	  print ("$news News Articles<br><br>\n");
	  print ("$ncontent Total");  
	  ?>
	  </TD>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt1] ?>" valign="top">
	  <?php
	  
	  
	  mysql_select_db('switchsk_other', mysql_pconnect('localhost','switchsk_adam','drummer')) or die (mysql_error()); 

	  $totlog = $MSTRow[most];
	  $limit_time = time() - 300; // 5 Minute time out. 60 * 5 = 300 
	  $sql = mysql_query("SELECT * FROM ppl_online WHERE UNIX_TIMESTAMP(activity) >= $limit_time AND member='n' GROUP BY ip_address") or die (mysql_error()); 
	  $sql_member = mysql_query("SELECT * FROM ppl_online WHERE UNIX_TIMESTAMP(activity) >= $limit_time AND member='y' and admin='' GROUP BY ip_address") or die (mysql_error()); 
	  $sql_admin = mysql_query("SELECT * FROM ppl_online WHERE UNIX_TIMESTAMP(activity) >= $limit_time AND admin='y' GROUP BY ip_address") or die (mysql_error());
	  $visits = mysql_num_rows($sql); 
	  $members = mysql_num_rows($sql_member); 
	  $admins = mysql_num_rows($sql_admin); 
	  $users = $visits + $members;
	  $totmem = $users + $admins;

	  print ("$totmem Online<br>\n"); 
	  print ("$ttheme themes<br>\n");
	  print ("$ncontent articles<br>\n");  
	  print ("$tpost posts<br>\n");
	  print ("$tmember members<br>\n");
	  print ("$totlog is most ever on site<br>\n");
	  print ("$tmost is most ever on forums<br>\n");
	  ?>
	  </TD>
	</TR>
  </TBODY>
</TABLE>


	  
</body>
</html>
