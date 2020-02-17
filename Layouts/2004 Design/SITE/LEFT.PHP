<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=220,height=10,left = 402,top = 234');");
}
// End -->
</script>

<?php
$ipaddress = $_SERVER['REMOTE_ADDR'];

$radio = 116; // MANUAL UPDATE
$wallpaper = 6; // MANUAL UPDATE

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
$MSTPPLTBL = "ppl_most_site";
$PCTBL = "pictures";
$GLTBL = "glossary";

$ContentDB = "switchsk_cucont";
$FContentDB = "switchsk_fcontent";
$StatsDB = "switchsk_forum";

$tricktips = 0;
$stories = 0;
$articles = 0;
$coreviews = 0;
$sbreviews = 0;
$sblinks = 0;
$tutorials = 0;
$colinks = 0;
$news = 0;
$tthemes = 0;
$tpost = 0;
$tmember = 0;
$totlog = 0;
$pictures = 0;
$glossary = 0;

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

$MSTPPLTBL = "ppl_most_site"; 
$MSTDB="switchsk_other";
$MSTQuery = "SELECT * from $MSTPPLTBL WHERE id = 1";
$MSTResult = mysql_db_query ($MSTDB, $MSTQuery, $LinkUp);
$MSTRow = mysql_fetch_array($MSTResult);
$totlog = $MSTRow[most];


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

$PC = mysql_query("SELECT * FROM $PCTBL"); 
while($PCRow = mysql_fetch_array($PC)){$pictures++;}

$GL = mysql_query("SELECT * FROM $GLTBL"); 
while($GLRow = mysql_fetch_array($GL)){$glossary++;}

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

$ncontent = $wallpaper + $radio + $stories + $tricktips + $articles + $sbreviews + $glossary + $sblinks + $tutorials + $colinks + $coreviews + $news + $pictures;


?>

<TABLE style="width:150; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
      <TD bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
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
<?php echo "<a href='http://search.revenuepilot.com/servlet/search?mode=html&id=14269&sid=1&filter=on&perpage=20&ip=$ipaddress&skip=0&keyword=hosting' target='_blank'>WEBHOSTING</a><br> \n"; ?>
<a href="http://www.switchskate.net/forums/">(<?php echo $tpost ?>) <b>Forums</b></a><br>
<!-- <a href="http://www.cafepress.com/Switch7/">Shop</a><br> -->
<a href="http://www.switchskate.net/site/tricktips.php">(<?php echo $tricktips ?>) Trick Tips</a><br>
<a href="http://www.switchskate.net/site/glossary.php">(<?php echo $glossary ?>) Skate Terms</a><br>
<a href="http://www.switchskate.net/site/pictures.php">(<?php echo $pictures ?>) Pictures</a><br>
<a href="http://www.switchskate.net/site/articles.php">(<?php echo $articles ?>) Articles</a><br>
<a href="http://www.switchskate.net/site/sbreviews.php">(<?php echo $sbreviews ?>) Reviews</a><br>
<a href="http://www.switchskate.net/site/stories.php">(<?php echo $stories ?>) Stories</a><br>
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
<a href="http://www.switchskate.net/site/wallpaper.php">(<?php echo $wallpaper ?>) Wallpaper</a><br>
<a href="http://www.switchskate.net/site/coreviews.php">(<?php echo $coreviews ?>) Reviews</a><br>
<a href="http://www.switchskate.net/site/colinks.php">(<?php echo $colinks ?>) Links</a><br>
<A HREF="javascript:popUp('http://www.switchskate.net/radio.blog/index.php')">(<?php echo $radio ?>) Radio</A>



<!-- <a href="http://www.switchskate.net/webclass/index.php">SCCHS</a> -->
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
<a href="http://www.switchskate.net/site/submit/index.php">Submit Content</a><br>
<a href="http://www.switchskate.net/site/tellfriends.php">Tell A Friend</a><br>
<a href="http://www.switchskate.net/site/linkus.php">Link Us</a><br>
<a href="http://www.switchskate.net/index.php">Home</a><br>
	  </TD>
	</TR>
  </TBODY>
</TABLE>

<br>

<TABLE style="width:150; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
      <TD bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>Theme Chooser</b>
	  </TD>
	</TR>
	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
<form name="picktheme" method="post" action="http://www.switchskate.net/site/submit/upscheme.php"> 

	  <select name="picker">
	
<?php  
	   $host = "localhost"; 
	   $user = "switchsk_adam"; 
	   $pass = "drummer"; 
	   $LinkUp = mysql_connect ($host, $user, $pass);


$StyleDB="switchsk_style";
$StyleQuery = "SELECT * from colors";
$StyleResult = mysql_db_query ($StyleDB, $StyleQuery, $LinkUp);

while ($StyleRow = mysql_fetch_array($StyleResult)){
	  
	   print ("<option value='$StyleRow[id]'>$StyleRow[id] - $StyleRow[title]");
	   
 }
 

 
?>

    </select>
	
<br><br>
<input type="submit" name="submit" value="Submit"> 

</form>
	
	  </TD>
	</TR>
  </TBODY>
</TABLE>


<?php
// Constant Variables

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 
$LinkUp = mysql_connect ($host, $user, $pass);

// Find user

$dbname = "switchsk_style";
$TCTBL = "users";
$user = 0;
$sel = 0;
$repeatu = 0;

$ip = $_SERVER['REMOTE_ADDR']; 

$query = "SELECT * from $TCTBL";
$result = mysql_db_query ($dbname, $query, $LinkUp);
while ($row = mysql_fetch_array($result))
{
			 if ($row[ip] == $ip){
			  $user = $row[choice];
			  $sel = $row[choice];
			  $repeatu = 1;		
			  }else{}
}



// Pick the Color Scheme

if ($user == 0) {
$PickDB="switchsk_style";
$PickQuery = "SELECT * from choice WHERE id = 1";
$PickResult = mysql_db_query ($PickDB, $PickQuery, $LinkUp);
$PickRow = mysql_fetch_array($PickResult);

$user = $PickRow[scheme];
$sel = $PickRow[scheme];
$repeatu = 0;
}else{}


// Connect to Styles Database

$StyleDB="switchsk_style";
$StyleQuery = "SELECT * from colors WHERE id = $user";
$StyleResult = mysql_db_query ($StyleDB, $StyleQuery, $LinkUp);
$StyleRow = mysql_fetch_array($StyleResult);

?>



<br>



<br>

<TABLE style="width:150; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
      <TD bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>Stats</b>
	  </TD>
	</TR>
	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="left">
	  <?php  
mysql_select_db('switchsk_other', mysql_pconnect('localhost','switchsk_adam','drummer')) or die (mysql_error()); 

$limit_time = time() - 300; // 5 Minute time out. 60 * 5 = 300 
$sql = mysql_query("SELECT * FROM ppl_online WHERE UNIX_TIMESTAMP(activity) >= $limit_time AND member='n' GROUP BY ip_address") or die (mysql_error()); 
$sql_member = mysql_query("SELECT * FROM ppl_online WHERE UNIX_TIMESTAMP(activity) >= $limit_time AND member='y' and admin='' GROUP BY ip_address") or die (mysql_error()); 
$sql_admin = mysql_query("SELECT * FROM ppl_online WHERE UNIX_TIMESTAMP(activity) >= $limit_time AND admin='y' GROUP BY ip_address") or die (mysql_error());

$MSTDB = "switchsk_other";
$visits = mysql_num_rows($sql); 
$members = mysql_num_rows($sql_member); 
$admins = mysql_num_rows($sql_admin); 
$users = $visits + $members;
$totmem = $users + $admins;

if ($totlog < $totmem){
$sql = "UPDATE ppl_most_site SET most = '$totmem' WHERE id=1";
$result = mysql_db_query ($MSTDB, $sql, $LinkUp);}

//else{echo "ERROR <br />";}
// if ($result){echo "OK<br />";}else{echo "ERROR <br />";}
// if ($sql){echo "OK<br />";}else{echo "ERROR <br />";}
// print ("$totlog Most On Site <br>\n"); 

	  //print ("$totmem Online <br>\n"); 
	  print ("$ncontent articles<br>\n");
	  print ("$tmember members<br>\n");
	  print ("$tpost posts<br>\n");
	  print ("$ttheme themes<br>\n");
	  ?>
	  </TD>
	</TR>
  </TBODY>
</TABLE>
