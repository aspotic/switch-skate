<html>
<meta name="keywords" content="soccer, webdesign, webhosting, web hosting, java, php, webdesign, html, programming">
<title>Ashton's FreEmail 1.0</title>
<body bgcolor="#000000" link="#33cc33 vlink="#33cc33" alink="#33cc33" text="#33cc33">

<form name="FreEmail 1.0" action="">
<p align= "center"><tr>
                   <input type="input" name="from" size = "50" value="From:" style="font-family:BlacklightD" onfocus="javascript:select();">
                   <br />
                   <input type="input" name="to" size = "50" value="To:" style="font-family:BlacklightD" onfocus="javascript:select();">
                   </p>
                   </tr>

<p align= "center"><textarea name="message" rows=15 cols=50 style="font-family:BlacklightD" onfocus="javascript:select();">Message Here</textarea>
                   </p>
<p align= "center"><input type= "submit" name = "submit" value = "Send Message" style="font-family:BlacklightD">                
                   </p>

</form>
</body>
<?php
       
$Mailfrom = "$from";
$Mailto = "$to";
$MailMessage = "$message";



if (isset ($submit)) {
          if (mail ($Mailto ,$Mailfrom ,$MailMessage)) {
           echo "<script> window.location.replace ('http://neutiquam.switchskate.net/mail.php'); </script>";
           }else{
           echo "<script> window.location.replace ('http://neutiquam.switchskate.net/error.php'); </script>";
          }
}
?>




<p align="center">
<table>
<tr>
      
   <script type="text/javascript"><!--
google_ad_client = "pub-6326369933309468";
google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_channel ="";
google_color_border = "333333";
google_color_bg = "000000";
google_color_link = "FFFFFF";
google_color_url = "999999";
google_color_text = "CCCCCC";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
      </script>
</tr>
</table>
</p>
</html>