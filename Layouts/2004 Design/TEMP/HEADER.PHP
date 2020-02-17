<?php

if(!session_is_registered('online')){ 
    @mysql_query("INSERT INTO ppl_online (session_id, activity, ip_address, refurl, user_agent)         VALUES ('".session_id()."', now(), '{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['HTTP_REFERER']}', '{$_SERVER['HTTP_USER_AGENT']}')"); 
    session_register('online'); 
} else { 
    if(session_is_registered('user_id')){ 
        @mysql_query("UPDATE ppl_online SET activity=now(), member='y' WHERE session_id='".session_id()."'"); 
    } 
} 
if(session_is_registered('online')){         
    @mysql_query("UPDATE ppl_online SET activity=now() WHERE session_id='".session_id()."'"); 
} 

// Constant Variables

$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 
$LinkUp = mysql_connect ($host, $user, $pass);


// Pick the Color Scheme

$PickDB="switchsk_style";
$PickQuery = "SELECT * from choice WHERE id = 1";
$PickResult = mysql_db_query ($PickDB, $PickQuery, $LinkUp);
$PickRow = mysql_fetch_array($PickResult);


// Connect to Styles Database

$StyleDB="switchsk_style";
$StyleQuery = "SELECT * from colors WHERE id = $PickRow[scheme]";
$StyleResult = mysql_db_query ($StyleDB, $StyleQuery, $LinkUp);
$StyleRow = mysql_fetch_array($StyleResult);


// Connect to Amount Finished

$DoneDB="switchsk_other";
$DoneQuery = "SELECT * from partdone";
$DoneResult = mysql_db_query ($DoneDB, $DoneQuery, $LinkUp);
$DoneRow = mysql_fetch_array($DoneResult);


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
<meta name="description" content="Get great skateboarding trick tips here even if you aren"t a beginner.  We have a thriving community for you to chat with other skaters and so much more.">
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
<td align="right" valign="top">

<?php

while ($DoneRow = mysql_fetch_array($DoneResult)){$numdone++;}
if ($numdone <= 100){
print ("<table border=1 align=right width=102 height=15 bordercolorlight=ffffff bordercolordark=ffffff bgcolor=ffffff cellspacing=0 cellpadding=0><tr><td>\n");
print ("<table width=$numdone height=13 bgcolor=#066d98><tr><td></td></tr></table>\n");
print ("</td></tr></table>\n");
print ("<br><font face='arial' size='2'>$numdone% COMPLETE</font>\n");
}
else{print ("SITE DONE");}

?>

</td></tr></table>

<table height="<?php echo $StyleRow[tablespace] ?>"><tr><td></td></tr></table>

<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">

    <TR>
      <TD class=mediumtxt bgcolor="<?php echo $StyleRow[catback] ?>" background="<?php echo $StyleRow[catagory] ?>" >
        <TABLE>
	      <TR class=tablerow>
	        <TD width="15">
UPDATES:
	        </TD>
            <TD class=mediumtxt bgcolor="<?php echo $StyleRow[catback] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center"width="100%">
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
			<a href="http://www.switchskate.net/forums/portal.php">Enter Forums</a> - <a href="http://www.switchskate.net/temp/submit/comments.php">Comments</a> - <a href="http://www.switchskate.net/temp/submit/text.php">Submit Content</a> - <a href="http://www.switchskate.net/temp/submit/theme.php">Submit Color Schemes</a> <!-- - <a href="#"><strike>Submit Pictures</strike></a> -->- <a href="http://www.switchskate.net/temp/submit/resume.php">Become an Administrator</a> - <a href="http://www.switchskate.net/temp/submit/link.php">Get Linked</a>
      	    </TD>
		  </TR>
	    </TABLE>
	  </TD>
    </TR>

</TABLE>