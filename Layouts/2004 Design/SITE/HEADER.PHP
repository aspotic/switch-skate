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


// Connect to News Ticker Tape

$TickerDB="switchsk_other";
$TickerQuery = "SELECT * from upscroll WHERE id = 1";
$TickerResult = mysql_db_query ($TickerDB, $TickerQuery, $LinkUp);
$TickerRow = mysql_fetch_array($TickerResult);


mysql_close ($LinkUp);  //Close Database Connection

?>


<!--HTML CODE-->


<html>
<head>


<style type="text/css">
a {text-decoration:none; color:<?php echo $StyleRow[link] ?>; }
a:hover {text-decoration:none; color:<?php echo $StyleRow[roll] ?>;}
body {
font-family: <?php echo $StyleRow[font] ?>;
color:<?php echo $StyleRow[text] ?>;
background-color:<?php echo $StyleRow[bg] ?>;
scrollbar-base-color:<?php echo $StyleRow[base] ?>;
scrollbar-dark-color:<?php echo $StyleRow[dark] ?>;
scrollbar-shadow-color:<?php echo $StyleRow[shadow] ?>;
scrollbar-highlight-color:<?php echo $StyleRow[highlight] ?>;
scrollbar-3dlight-color:<?php echo $StyleRow[light] ?>;
scrollbar-arrow-color:<?php echo $StyleRow[arrow] ?>;
scrollbar-track-color:<?php echo $StyleRow[track] ?>;
scrollbar-color:<?php echo $StyleRow[color] ?>;}

<?php echo $StyleRow[rawcss] ?>

</style>
		
		
<title>Switch Skate -The ultimate skateboarding experience-</title>
<meta name="resource-type" content="documen">
<meta name="Generator" content="switchsk Tag Generator">
<meta name="revisit-after" content="5">
<meta name="classification" content="Sports">
<meta name="description" content="Get great skateboarding trick tips here even if you aren't a beginner.  We have a thriving community for you to chat with other skaters and so much more.">
<meta name="keywords" content="skateboard, trick tips, tricks, skateboard shop, pictures, ramp plans, message board, stories, free ramp plans, skateboard trick tips, building ramps,  trick help, trick tutorials, how to videos, how to do skateboarding tricks, snowboard tricks, learning bmx, extreme sports discussion, skateboard ramps, sports message board, ramprage, snowboarding, the boarder source, skate games">
<meta name="robots" content="ALL">
<meta name="rating" content="General">
<meta name="copyright" content="switchskate.net 2004">
<meta name="author" content="adam k">
<meta http-equiv="reply-to" content="webmaster@switchskate.net">
<meta http-equiv="Content-Language" content="english">


</head>
<body topmargin="0" leftmargin="0" marginwidth="0" marginheight="0" >
<font face="<?php echo $StyleRow[font] ?>" color="<?php echo $StyleRow[text] ?>" >


<table style="width:<?php echo $StyleRow[tablew] ?>; background-color:<?php echo $StyleRow[header] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" align="center" ><tr>
<td><img src="<?php echo $StyleRow[imagedir] ?>logo1.gif"></td>
<td align="center">

<form name="form" method="get" action="http://search.revenuepilot.com/servlet/search">
               <input type='text' name='keyword'>
               <input type='hidden' name='id' value='14269'>
               <input type='hidden' name='sid' value='0'>
	       <input type='hidden' name='filter' value='on'>
               <input type='hidden' name='mode' value='search'>
<input type="submit" value="Search">
</form>



<!-- <FORM name="searchbox" action="http://search.clicksor.com/index.php" method="post">
  
  <INPUT type="hidden" name="pid"  value="6878">
  <INPUT type="hidden" name="sid"  value="9468">
  <INPUT type="hidden" name="per_page" value="10">
  <INPUT type="hidden" name="logo" value="http://search.clicksor.com/images/yesup_logo.gif">
  <INPUT type="hidden" name="page_bg_color" value="#FFFFFF">
  <INPUT type="hidden" name="clicksor_num_sponsor_ad" value="3">
  <INPUT type="hidden" name="sponsor_box_bg_color"  value="#F0F5FB">
  <INPUT type="hidden" name="title_font_size"  value="3">
  <INPUT type="hidden" name="title_color"  value="blue">
  <INPUT type="hidden" name="desc_font_size"  value="2">
  <INPUT type="hidden" name="desc_color"  value="black">
  <INPUT type="hidden" name="source_title_size"  value="-3">
  <INPUT type="hidden" name="source_title_color"  value="blue">
  <INPUT type="hidden" name="real_url_size"  value="-1">
  <INPUT type="hidden" name="real_url_color"  value="green">
  <INPUT type="hidden" name="new_win_icon"  value="http://search.clicksor.com/templates/images/newwin.gif">
  <INPUT type="hidden" name="extra_qry" value="">
  <INPUT type="hidden" name="page" value="1">
  <INPUT type="hidden" name="qry_id" value="">
  <INPUT type="text" name="qry_str" size="40" value="Web Hosting">
  <INPUT name="submit" type=submit value="Search">
</FORM> -->

</td></tr></table>

<table height="<?php echo $StyleRow[tablespace] ?>"><tr><td></td></tr></table>

<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">

    <TR>
      <TD class=mediumtxt bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" >
        <TABLE>
	      <TR>
	        <TD width="15">
UPDATES:
	        </TD>
            <TD width="100%">
<marquee><?php echo $TickerRow[updates] ?></marquee>
	        </TD>
	      </TR>
	    </TABLE>
	  </TD>
    </TR>
    <TR>
      <TD bgColor="<?php echo $StyleRow[alt1] ?>" align="center">
	    <TABLE>
          <TR class=tablerow>
	        <TD class=mediumtxt align="center">


<script type="text/javascript"><!--
google_ad_client = "pub-7229403056554060";
google_ad_width = 728;
google_ad_height = 90;
google_ad_format = "728x90_as";
google_ad_channel ="";
google_ad_type = "text_image";
google_color_border = "578A24";
google_color_bg = "CCFF99";
google_color_link = "00008B";
google_color_url = "00008B";
google_color_text = "000000";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>


      	    </TD>
		  </TR>
	    </TABLE>
	  </TD>
    </TR>

</TABLE><br><br>