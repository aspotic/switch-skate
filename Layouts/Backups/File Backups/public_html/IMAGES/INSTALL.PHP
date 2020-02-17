<html>
<head>

<style>


body {
margin-top:30;
margin-left: auto ;
margin-right: auto ;
text-align:center;
background-color:#1D4E6D;
}


table.dimensions { 
font-family:Arial;
width:95%;
border:1 solid #183C53;
} 


td#toptable { 
background-color:#11567E;
font-family:Arial;
color:#F4F4F4;
text-align:left;
} 


td#header { 
background-color:#17374C;
font-family:Arial;
color:#F4F4F4;
text-align:left;
}  

td#center {
width:95%;
}

td.catagory {
background-color:#477B9E;
font-family:Arial;
color:#F4F4F4;
text-align:center;
}


td.alt1 {
background-color:#123F59;
font-family:Arial;
color:#F4F4F4;
text-align:left;
}


td.alt2 {
background-color:#11567E;
font-family:Arial;
color:#F4F4F4;
text-align:left;
}


a {
text-decoration:none;
color:#EABC1B;
}


a:hover {
text-decoration:none;
font-weight: normal ;
color:#F4F4F4;
}


select {
	 color:#F4F4F4;
	 background-color:#11567E;
	 font-family:Arial;
	 border:1 solid #183C53;
}


input {
	 color:#F4F4F4;
	 background-color:#11567E;
	 font-family:Arial;
	 border:1 solid #183C53;
}


textarea {
	 color:#F4F4F4;
	 background-color:#11567E;
	 font-family:Arial;
	 border:1 solid #183C53;
}


</style>

	<title>VME Panel Version 1.2 Installer</title>
</head>

<body>

	<table class="dimensions">
		   <tr>
		   	   <td class="catagory">
		   	   	   VME Panel Version 1.2 Installer
		   	   </td>
		   </tr>
		   <tr>
		   <tr>
		   	   <td class="alt2">
		   	   	  Please report all errors to <a href="mailto:switchskate@gmail.com">switchskate@gmail.com</a>
		   	   </td>
		   </tr>
		   <tr>
		   	   <td class="alt1"><br>
		
<?php

require ("config.php");

if ( 
($username != "") && ($password != "") && 
($hostname != "") && ($database != "") && 
($webmaster != "") && ($webmail != "") && 
($sitename != "") && ($siteurl != "") && 
($cmsurl != "") && ($defaulttheme != "")
) {


     $query = "CREATE table blocks (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, title TEXT, position TINYINT, side TINYINT, active TINYINT)";
	 if (mysql_db_query($database,$query, $dblink)){
		  echo "Blocks Table Created <br \>";
	 }else{
	      die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());
	 }
	 

	 $Query = "INSERT INTO blocks VALUES ( '1','navigation','1','1','1' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Block 1 added <br \>"; }

	 $Query = "INSERT INTO blocks VALUES ( '2','choosetheme','2','1','1' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Block 2 added <br \>"; }

	 $Query = "INSERT INTO blocks VALUES ( '3','statistics','3','1','1' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Block 3 added <br \>"; }

	 $Query = "INSERT INTO blocks VALUES ( '4','googlesearch','1','2','1' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Block 4 added <br \>"; }

	 $Query = "INSERT INTO blocks VALUES ( '5','mailinglist','2','2','1' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Block 5 added <br \>"; }

	 $Query = "INSERT INTO blocks VALUES ( '6','signin','3','2','1' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Block 6 added <br \>"; }

	 $Query = "INSERT INTO blocks VALUES ( '7','extrablockone','0','2','0' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Block 7 added <br \>"; }

	 $Query = "INSERT INTO blocks VALUES ( '8','extrablocktwo','0','1','0' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Block 8 added <br \>"; }
	 
	 $Query = "INSERT INTO blocks VALUES ( '9','extrablockthree','0','2','0' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Block 9 added <br \>"; }
	 
echo "Values added to blocks <br \><br \>";



	 $query = "CREATE table header (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, marquee TEXT, advertisement TEXT)";
	 if (mysql_db_query($database,$query, $dblink)){
		  echo "Header Table Created <br \>";
	 }else{
	      die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());
	 }
	 
	 $Query = "INSERT INTO header VALUES ( '1','Edit the marquee text that your members will see', 'This is the text your visitors will see.  I suggest putting an ad here.' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Header added <br \>"; }
	 
echo "Values added to header <br \><br \>";
	 
	 
	 
	 $query = "CREATE table mailinglist (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, email MEDIUMTEXT)";
	 if (mysql_db_query($database,$query, $dblink)){
		  echo "Mailing List Table Created <br \>";
	 }else{
	      die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());
	 }
	 
	 
	 
	 $query = "CREATE table members (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, username MEDIUMTEXT, password MEDIUMTEXT, email MEDIUMTEXT, originalip MEDIUMTEXT, ip MEDIUMTEXT, theme TINYINT, numplayed INT, rank TINYINT, loggedin TINYINT)";
	 if (mysql_db_query($database,$query, $dblink)){
		  echo "Members Table Created <br \>";
	 }else{
	      die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());
	 }
	 
	 
	 
	 $query = "CREATE table navigation (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, position MEDIUMINT, title MEDIUMTEXT, url MEDIUMTEXT)";
	 if (mysql_db_query($database,$query, $dblink)){
		  echo "Navigation Table Created <br \>";
	 }else{
	      die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());
	 }
	 
	 
	 
	 $query = "CREATE table news (date DATE PRIMARY KEY, title MEDIUMTEXT, text TEXT)";
	 if (mysql_db_query($database,$query, $dblink)){
		  echo "News Table Created <br \>";
	 }else{
	      die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());
	 }
	 	 
	 
	 
	 $query = "CREATE table schemes (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, title MEDIUMTEXT, background MEDIUMTEXT, bordersize MEDIUMTEXT, bordertype MEDIUMTEXT, bordercolor MEDIUMTEXT, alignbody MEDIUMTEXT, topmargin MEDIUMTEXT, linkcolor MEDIUMTEXT, linkover MEDIUMTEXT, fontface MEDIUMTEXT, tablewidth MEDIUMTEXT, txtalign MEDIUMTEXT, widthleft MEDIUMTEXT, widthright MEDIUMTEXT, widthcenter MEDIUMTEXT, toptablecolor MEDIUMTEXT, txtaligntoptable MEDIUMTEXT, colortoptable MEDIUMTEXT, headercolor MEDIUMTEXT, txtalignheader MEDIUMTEXT, colorheader MEDIUMTEXT, alt1 MEDIUMTEXT, coloralt1 MEDIUMTEXT, alt2 MEDIUMTEXT, coloralt2 MEDIUMTEXT, colorcatagory MEDIUMTEXT, catagorybg MEDIUMTEXT, txtaligncatagory MEDIUMTEXT, widthcatagory MEDIUMTEXT, logoname MEDIUMTEXT, logofolder MEDIUMTEXT, centercat MEDIUMTEXT, sidecat MEDIUMTEXT)";
	 if (mysql_db_query($database,$query, $dblink)){
		  echo "Schemes Table Created <br \>";
	 }else{
	      die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());
	 }
	 
	 $Query = "INSERT INTO schemes VALUES ( '1','Blue Halo', '#1D4E6D','1','solid','#477B9E','center','0','#EABC1B','#F4F4F4','Arial','95%','left','140','140','95%','#11567E','left','#FFFFFF','#17374C','center','#F4F4F4','#123F59','#F4F4F4','#11567E','#F4F4F4','#F4F4F4','#477B9E','center','100%','header.gif','basicthemes','','' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Theme 1 Added <br \>"; }
 
	 $Query = "INSERT INTO schemes VALUES ( '2','Green Crush','#051107','1','solid','#092519','center','0','#c6f4d3','#FFFFFF','Arial','95%','left','140','140','95%','#228d07','center','#FFFFFF','#29680a','center','#FFFFFF','#097339','#FFFFFF','#1b5c0a','#FFFFFF','#FFFFFF','#203a0a','center','100%','header.gif','basicthemes','','' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Theme 2 Added <br \>"; }
	 
	 $Query = "INSERT INTO schemes VALUES ( '3','Blue Demize','#B1B1B1','1','solid','#000000','center','15','#777777','#008ee2','Tahoma','95%','left','140','140','95%','#DCDCDC','left','#000000','#1C3D7D','center','#FFFFFF','#EDEDED','#000000','#DCDCDC','#000000','#FFFFFF','#1C3D7D','center','100%','header.gif','basicthemes','','' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Theme 3 Added <br \>"; }

	 $Query = "INSERT INTO schemes VALUES ( '4','Reborn','#00003C','1','solid','#303030','center','15','#FFFFFF','#4F648E','Arial ','95%','left','140','140','95%','#00003C','left','#FFFFFF','#4F648E','center','#FFFFFF','#3A496B','#FFFFFF','#4F648E','#FFFFFF','#FFFFFF','#095A85','center','100%','header.gif','basicthemes','','' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Theme 4 Added <br \>"; }

	 $Query = "INSERT INTO schemes VALUES ( '5','Relax','#DEE2E1','1','solid','#506A9E','center','0','#42596B','#000000','Tahoma','95%','left','140','140','95%','#EEF6FE','left','#000000','#C6D0E5','center','#000000','#FFFFFE','#000000','#EFF6FE','#000000','#FFFFFF','#6179AC','center','100%','header.gif','basicthemes','','' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Theme 5 Added <br \>"; }

	 $Query = "INSERT INTO schemes VALUES ( '6','Blood','#6C6C6C','1','solid','#FFFFFF','center','10','#FFFFFF','#8B0101','Tahoma','95%','left','140','140','100%','#8B0101','left','#FFFFFF','#373636','center','#FFFFFF','#8B0101','#FFFFFF','#373636','#FFFFFF','#FFFFFF','#000000','center','100%','header.gif','basicthemes','','' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Theme 6 Added <br \>"; }

	 $Query = "INSERT INTO schemes VALUES ( '7','Forever Grey','#777777','1','solid','#000000','center','0','#570416','#000000','Arial','95%','left','140','140','95%','#A2A2A2','left','#000000','#013E82','center','#FFFFFF','#C5C5C5','#000000','#636363','#D1D1D1','#C9C9C9','#90061F','center','100%','header.gif','basicthemes','','' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Theme 7 Added <br \>"; }

	 $Query = "INSERT INTO schemes VALUES ( '8','Forever Pink','#f4c6e9','1','solid','#bd11ff','center','0','#9202ca','#bd11ff','Tahoma','95%','left','140','140','95%','#f581d8','left','#000000','#ca02a2','center','#FFFFFF','#ff05cd','#FFFFFF','#ca02a2','#FFFFFF','#FFFFFF','#bd11ff','center','100%','header.gif','basicthemes','','' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Theme 8 Added <br \>"; }
	 
	 $Query = "INSERT INTO schemes VALUES ( '9','Mello Yellow','#000000','1','solid','#f3ff05','center','10','#f3ff05','#000000','Tahoma','90%','left','140','140','95%','#000000','left','#fe9e1e','#444444','left','#fe9e1e','#000000','#FFFFFF','#444444','#FFFFFF','#000000','#f3ff05','right','100%','header.gif','version1.2','catmelloyellow.gif','catmelloyellow.gif')";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Theme 9 Added <br \>"; }

	 $Query = "INSERT INTO schemes VALUES ( '10','Truly Blue','#091625','1','solid','#0a1268','left','0','#e5eef7','#FFFFFF','Arial','95%','left','140','140','95%','#036fbd','left','#FFFFFF','#036fbd','center','#e5eef7','#0542a5','#FFFFFF','#1503bd','#e5eef7','#FFFFFF','#0a2268','center','95%','header.gif','version1.2','cattrulyblue.gif','cattrulyblue.gif' )";
	 $Result = mysql_db_query ($database, $Query, $dblink);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());} else { echo "Theme 10 Added <br \>"; }
	 
	 
echo "Values added to themes <br \><br \>";
	 
	 
	 
	 $query = "CREATE table vertcontset (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, name MEDIUMTEXT, tablename MEDIUMTEXT, pages MEDIUMTEXT, type TINYINT, prefix MEDIUMTEXT)";
	 if (mysql_db_query($database,$query, $dblink)){
		  echo "Categorys Table Created <br \>";
	 }else{
	      die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());
	 }
	  
	  
	  
mysql_close ($dblink);

$dblink2 = mysql_connect ($db2host, $db2user, $db2pass);
	  
	 $Query = "INSERT INTO $dbtable3 VALUES ( '','$siteurl','VME Panel' )";
	 $Result = mysql_db_query ($database2, $Query, $dblink2);
	 if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());}
	 
mysql_close ($dblink2);


	 
echo "<center><br><br><b><h5>DONE Please delete this file</h5></b></center>";
	 
} else {
     print "Please fill out all of the fields in the config.php file.  You use notepad to open the file and save it.";
} 
?>



		   	   </td>
		   </tr>
	</table>

</body>
</html>
