<?php

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

$ContentDB = "switchsk_cucont";
$FContentDB = "switchsk_fcontent";
$StatsDB = "switchsk_forunms"

$tricktips = 0;
$stories = 0;
$articles = 0;
$sbreviews = 0;
$sblinks = 0;
$tutorials = 0;
$colinks = 0;
$news = 0;
$tthemes = 0;
$tpost = 0;
$tmember = 0;

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

$ncontent = $stories + $tricktips + $articles + $sbreviews + $sblinks + $tutorials + $colinks + $coreviwe + $news;

?>

<TABLE style="width:140; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
      <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>Menu</b>
	  </TD>
	</TR>
		<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>">
	  Skateboarding
	  </TD>
	  </TR>
	  
	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>">
<a href="http://www.switchskate.net/forums/">Message Board</a><br>
<a href="http://www.switchskate.net/site/tricktips.php">(<?php echo $tricktips ?>) Trick Tips</a><br>
<a href="http://www.switchskate.net/site/stories.php">(<?php echo $stories ?>) Skate Stories</a><br>
<!-- <a href="http://www.switchskate.net/site/pictures.php">Pictures (<?php  ?>)</a><br> -->
<a href="http://www.switchskate.net/site/articles.php">(<?php echo $articles ?>) Articles</a><br>
<a href="http://www.switchskate.net/site/sbreviews.php">(<?php echo $sbreviews ?>) Reviews</a><br>
<a href="http://www.switchskate.net/site/links.php">(<?php echo $sblinks ?>) Links</a><br>
	  </TD>
	</TR>
		<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>">
	  Computers
	  </TD>
	  </TR>
	  	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>">
<a href="http://www.switchskate.net/site/tutorials.php">(<?php echo $tutorials ?>) Tutorials</a><br>
<a href="http://www.switchskate.net/site/coreviews.php">(<?php echo $coreviews ?>) Reviews</a><br>
<a href="http://www.switchskate.net/site/colinks.php">(<?php echo $colinks ?>) Links</a><br>
<a href="http://www.switchskate.net/webclass/index.php">SCCHS</a>
	  </TD>
	</TR>

		<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>">
	  Miscellaneous
	  </TD>
	  </TR>
	  	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>">
<a HREF="#" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://www.switchskate.net');">Make Homepage</a><br>
<a href="#" onclick = "javascript:window.external.AddFavorite('http://www.switchskate.net', '-->SwitchSkate.net');">Add To Favorites</a><br>
<a href="http://www.switchskate.net/site/tellfriends.php">Tell A Friend</a><br>
<a href="http://www.switchskate.net/site/submit/index.php">Submit Content</a><br>
<a href="http://www.switchskate.net/site/linkus.php">Link Us</a><br>
<a href="http://www.switchskate.net/index.php">Home</a><br>
	  </TD>
	</TR>
  </TBODY>
</TABLE>

<br>

<TABLE style="width:140; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
      <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>Comments</b>
	  </TD>
	</TR>
	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
	  <form action="http://www.switchskate.net/site/handcomment.php" method="post">
<textarea name="text" style=" border-color:<?php echo $row[bordw] ?>; border-style: solid; width:120px;height:100px;background-color:<?php echo $row[alt2] ?>;color:<?php echo $row[text] ?>;font-size:8pt; font-family:<?php echo $row[font] ?>;">
</textarea><br><br>
<input type="submit" name="submit" value="Submit">  
</form>
	  </TD>
	</TR>
  </TBODY>
</TABLE>

<br>

<TABLE style="width:140; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
      <TD bgolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>Stats</b>
	  </TD>
	</TR>
	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="left">
	  <?php
	  print ("$online online<br>\n");
	  print ("$ncontent articles<br>\n");
	  print ("$tmember members<br>\n");
	  print ("$tpost posts<br>\n");
	  print ("$ttheme themes<br>\n");
	  ?>
	  </TD>
	</TR>
  </TBODY>
</TABLE>