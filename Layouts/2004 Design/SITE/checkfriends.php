<?php require ("header.php"); ?>


<table width="<?php echo $StyleRow[tablew] ?>" align="center">
<tr>
<td valign="top">
<?php require ("left.php"); ?>
</td>

<td valign="top" width="<?php echo $StyleRow[tablew] ?>">
<?php 

$webmaster = "webmaster@switchskate.net";
$websubject = "I Told a friend";


$webmsg = "From \n";
$webmsg .= "$sname \n";
$webmsg .= "$semail \n";
$webmsg .= " \n";
$webmsg .= "To \n";
$webmsg .= "$fname \n";
$webmsg .= "$femail \n";


$msg = "Hey $fname, ";
$msg .= "  \n";
$msg .= "\t       I found this sick site with an awesome message board so check it out.  \n";
$msg .= "http://www.switchskate.net  \n";
$msg .= "  \n";
$msg .= "If the address doesn't work then just copy it into the address bar of your explorer window and hit enter.  \n";

$recipients = "$femail";
$subject = "Check this out $fname";

$mailheaders = "From:$semail";

if (mail($recipients, $subject, $msg, $mailheaders))
{
mail($webmaster, $websubject, $webmsg, $mailheaders);
print ("<br><br><center>The message was sent");
print ("<script>\n");
print ("function redirect()\n");
print ("{window.location.replace('http://www.switchskate.net/index.php');}\n");
print ("setTimeout('redirect();', 1250);\n");
print ("</script>\n");

exit;
}else{
print ("ERROR<br><br>\n");
print ("Please email webmaster@switchskate.net about this error \n");
}
?> 
</td>

<td valign="top">
<?php require ("right.php"); ?>
</td>
</tr>
</table>
<br>
<br>

<?php require ("footer.php"); ?>
