<?php
require ("config.php");
$entrance = 0;

$query = "SELECT * from members";
$result = mysql_db_query ($database, $query, $dblink);

while ($row = mysql_fetch_array($result)){
	   
	   if ( ($row[rank] == 6) && ($row[loggedin] == 1) && ($row[ip] == $ipaddress) ) {$entrance = 1;}
	   if ( ($row[loggedin] == 1) && ($row[ip] == $ipaddress) ) {
	   	  $rank = $row[rank];
		  $scheme = $row[theme];
		  $username = $row[username];
		  $email = $row[email];
		  $games = $row[numplayed];
		  $idnumber = $row[id];
		  $logged = 1;
	   }
} 

if ($entrance == 0) {


?>


<!--HEADER-->
<html>
<head>

<?php require ("style.php"); ?>
<title> <?php echo $sitename; ?> - Powered by VME Panel 1.2</title>

</head>
<body> 

<table class="dimensions">
	   <tr>
	   	   <td id="toptable" align="left">
<table width="100%">
	   <tr>
	   	   <td width="50%" valign="top">
<?php


if ($imgurl != "") {
   print ("<img src='$imgurl$themefolder$Theme[logofolder]/$Theme[logoname]' alt='$sitename'>");
} else {
   print ("<img src='$cmsurl$imgfolder$themefolder$Theme[logofolder]/$Theme[logoname]' alt='$sitename'>");
}

?>
		   </td>
		   <td width="50%" valign="top" id="toptable">
<?php
if ($logged == 1) {
   echo "<b>$username</b> <br> \n";
   echo "Theme: $Theme[title]<br> \n";
   if ($rank == 0){echo "Rank: Member [<a href='?id=signout'>Sign Out</a>]";}
   if ($rank == 1){echo "Rank: Moderator (Training) [<a href='?id=signout'>Sign Out</a>]";}
   if ($rank == 2){echo "Rank: Moderator [<a href='?id=signout'>Sign Out</a>]";}
   if ($rank == 3){echo "Rank: Administrator [<a href='$siteurl/cp.php'>Administration Panel</a>] [<a href='?id=signout'>Sign Out</a>]";}
   if ($rank == 4){echo "Rank: Webmaster [<a href='$siteurl/cp.php'>Administration Panel</a>] [<a href='?id=signout'>Sign Out</a>]";}
   if ($rank == 5){echo "Rank: Site Owner [<a href='$siteurl/cp.php'>Administration Panel</a>] [<a href='?id=signout'>Sign Out</a>]";}
   if ($rank == 6){echo "Rank: Banned";}

} else {
echo "<b>Guest</b> [<a href='?id=signup'>Sign Up</a> | <a href='?id=signin'>Sign In</a>] \n";
} ?>
		   </td>
		</tr>
</table>
	   	   </td>
	   </tr>
	   <tr>
	   	   <td id="header">
<?php
if ($logged == 1) {

   $Query = "SELECT * FROM header WHERE id = '1'";
   $Result = mysql_db_query ($database, $Query, $dblink);
   if ($row = mysql_fetch_array($Result)) {
   print ("<marquee>$row[marquee]</marquee> \n");
   }

   
} else {
   $Query = "SELECT * FROM header WHERE id = '1'";
   $Result = mysql_db_query ($database, $Query, $dblink);
   if ($row = mysql_fetch_array($Result)) {
   print ("$row[advertisement] <br> \n");
   }
}
?>	   	   </td>
	   </tr>
</table>
<br><br>
<!--END HAEADER-->

<table id="whole">
<tr valign="top">
<td align="center">
<!--LEFT SIDE-->


<?php 

$Query = "SELECT * from blocks ORDER BY position ASC";
$Result = mysql_db_query($database, $Query, $dblink);
while ($row = mysql_fetch_array($Result)) {
	  if (($row[active] == 1) && ($row[side] == 1)) {require ("blocks/$row[title].php"); }
}

?>


<!--END LEFT SIDE-->
</td>
<td id="center" align="center">

<?php if ($id == "") { ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
News [ <a href="?id=oldnews">Old News Archive</a> ]
	   	   </td>
	   </tr>
</table>
<br>


<?php 

$totalnews = 0;
$countnews = 0;

$PrintNewsQuery = "SELECT * from news ORDER BY date DESC";
$NewsResult = mysql_db_query ($database, $PrintNewsQuery, $dblink);

while ( ($News = mysql_fetch_array($NewsResult)) && ($totalnews < $setnewssize) )  {

echo "<table class='dimensions'> \n";
	   echo "<tr> \n";
	   	   echo "<td class='catagorycenter'> \n";
echo $News[title];
	   	   echo "</td> \n";
	   echo "</tr> \n";
	   echo "<tr> \n";
	   	   echo "<td class='alt2'> \n";
echo $News[date];
	   	   echo "</td> \n";
	   echo "</tr> \n";
	   echo "<tr> \n";
	   	   echo "<td class='alt1'> \n";
echo $News[text];
	   	   echo "</td> \n";
	   echo "</tr> \n";
echo "</table> \n";
echo "<br><br> \n";

$totalnews++;
}




} ?>


<?php if ($id == "oldnews") { ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
News Archive [ <a href="?id=">Current News</a> ]
	   	   </td>
	   </tr>
</table>
<br>
<?php

if(!isset($_GET['page'])){ 
    $page = 1; 
} else { 
    $page = $_GET['page']; 
} 

$max_results = 5; 
$from = (($page * $max_results) - $max_results); 

$PrintNewsQuery = "SELECT * from news ORDER BY date DESC LIMIT $from, $max_results";
$NewsResult = mysql_db_query ($database, $PrintNewsQuery, $dblink);

while ($News = mysql_fetch_array($NewsResult)) {

echo "<table class='dimensions'> \n";
	   echo "<tr> \n";
	   	   echo "<td class='catagorycenter'> \n";
echo $News[title];
	   	   echo "</td> \n";
	   echo "</tr> \n";
	   echo "<tr> \n";
	   	   echo "<td class='alt2'> \n";
echo $News[date];
	   	   echo "</td> \n";
	   echo "</tr> \n";
	   echo "<tr> \n";
	   	   echo "<td class='alt1'> \n";
echo $News[text];
	   	   echo "</td> \n";
	   echo "</tr> \n";
echo "</table> \n";
echo "<br><br> \n";

}
?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
		   
<?php

$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM news"),0); 
$total_pages = ceil($total_results / $max_results); 
echo "<center>Select a Page: &nbsp;&nbsp;"; 

// Build Previous Link 
if($page > 1){ 
    $prev = ($page - 1); 
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&id=oldnews\">Previous </a>&nbsp;&nbsp;"; 
}  else {echo "Previous&nbsp;&nbsp;"; }

for($i = 1; $i <= $total_pages; $i++){ 
    if(($page) == $i){ 
        echo "$i&nbsp;"; 
        } else { 
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&id=oldnews\">$i</a>&nbsp;"; 
    } 
} 

// Build Next Link 
if($page < $total_pages){ 
    $next = ($page + 1); 
    echo "&nbsp;&nbsp;<a href=\"".$_SERVER['PHP_SELF']."?page=$next&id=oldnews\">Next</a>"; 
} else {echo "&nbsp;&nbsp;Next"; }
?>

	   	   </td>
	   </tr>
</table>

<?php } ?>



<?php if ($id == "signin"){ ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
Sign In
	   	   </td>
	   </tr>
	   	   <td class="alt1">
<form method="post" action="" name="usersignin">

<table>
	   <tr>
	   	   <td class="alt2">Username:</td>
		   <td class="alt1"><input name="signinusername" type="text" value=""></td>
	   </tr>
	   <tr>
	   	   <td class="alt2">Password:</td>
		   <td class="alt1"><input name="signinpassword" type="password" value=""></td>
	   </tr>
</table>
<br>
<input name="id" type="hidden" value="signin">
<input type="submit" value="Submit" name="usersignin">
</form>

<?php

if ( ( isset ( $usersignin ) ) && ($id == "signin")) {

   $query = "SELECT * from members";
   $result = mysql_db_query ($database, $query, $dblink);
   while ($row = mysql_fetch_array($result)){
   
   		 if ($row[username] == $signinusername) {
		 
		 	if ($row[password] == $signinpassword ) {
			
			   $query2 = "UPDATE members SET ip = '$ipaddress', loggedin = '1' WHERE id = '$row[id]' LIMIT 1";
			   $result2 = mysql_db_query ($database, $query2, $dblink);
			   
			   if (!$result2) {
			   
			   	  die('Invalid query: ' . mysql_error());
				  echo "  &nbsp;&nbsp;&nbsp;  Could not log in";
				  
			   } else {
			print ("<script>\n");
	  	 	print ("function redirect()\n");
	  	 	print ("{window.location.replace('index.php');}\n");
	  	 	print ("redirect();\n");
	  	 	print ("</script>\n");
			   }
			   
			}
			
		 }
   }

}

?>

	   	   </td>
	   </tr>
</table>

<?php } ?>


<?php if ($id == "signout"){

   $query = "SELECT * from members";
   $result = mysql_db_query ($database, $query, $dblink);
   while ($row = mysql_fetch_array($result)){
   
   		 if ($row[ip] == $ipaddress) {
			
			   $query2 = "UPDATE members SET ip = '', loggedin = '0' WHERE id = '$row[id]' LIMIT 1";
			   $result2 = mysql_db_query ($database, $query2, $dblink);
			   
			   if (!$result2) {
			   
			   	  die('Invalid query: ' . mysql_error());
				  echo "  &nbsp;&nbsp;&nbsp;  Could not log in";
				  
			   } else {
			   	  	 	print ("<script>\n");
	  	 	print ("function redirect()\n");
	  	 	print ("{window.location.replace('index.php');}\n");
	  	 	print ("redirect();\n");
	  	 	print ("</script>\n");
			   }
		 }
	}
} ?>



<?php if ($id == "signup"){ ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
Sign Up
	   	   </td>
	   </tr>
	   	   <td class="alt1">
<form method="post" action="" name="newuser">

<table>
	   <tr>
	   	   <td class="alt2">Username:</td>
		   <td class="alt1"><input name="signupusername" type="text" value=""></td>
	   </tr>
	   <tr>
	   	   <td class="alt2">Password:</td>
		   <td class="alt1"><input name="signuppassword" type="password" value=""></td>
	   </tr>
	   <tr>
	   	   <td class="alt2">Re-Enter Password:</td>
		   <td class="alt1"><input name="repassword" type="password" value=""></td>
	   </tr>
	   <tr>
	   	   <td class="alt2">E-mail:</td>
		   <td class="alt1"><input name="email" type="text" value=""></td>
	   </tr>
</table>
<br>
<input type="submit" value="Submit" name="newuser">
<input name="id" type="hidden" value="signup">
</form>

<?php

if ( ( isset ( $newuser ) ) && ($id == "signup")) {

    $Query2 = "SELECT * FROM members";
	$Result2 = mysql_db_query ($database, $Query2, $dblink);
	while ($row = mysql_fetch_array ($Result2)) {
			if ($signupusername != $row[username]) {$isokay++;}
			$possibleok++;
	}

    if ( ($signuppassword == $repassword) && ($possibleok == $isokay) ) {
	
	   	 		if ($possibleok == 0) {$rank = 5;} else {$rank = 0;}
	
	   	   		$query = "insert into members values ('0', '$signupusername', '$signuppassword', '$email', '$ipaddress', '', '$defaulttheme', '0', '$rank', '0')";
		   		if (mysql_db_query ($database, $query, $dblink)){
						print ("<script>\n");
	  	 				print ("function redirect()\n");
	  	 				print ("{window.location.replace('index.php');}\n");
	  	 				print ("redirect();\n");
	  	 				print ("</script>\n");
		   		}else{
		   		 		echo "<br><br>MySQL ERROR <br>\n". mysql_error();
		   		}
	} else {
	    echo "ERROR <br /> \n";
		if ($possibleok != $isokay) {echo "That username is already in use <br /> \n";}
		if ($signuppassword != $repassword) {echo "You typed in two different passwords \n";}
	}
	
}

?>

	   	   </td>
	   </tr>
</table>

<?php } ?>



<?php if ($id == "memberlist"){ ?>

	  <table class="dimensions">
	  		 <tr>
			 	 <td class="catagorycenter">
Member List
	  			 </td>
			 </tr>
	  </table>

<table class="dimensions">
	   <tr>
	   <td class="catagorycenter">Username</td>
	   <td class="catagorycenter">Email</td>
	   <td class="catagorycenter">Rank</td>
	   </tr>
	   
<?php
if(!isset($_GET['page'])){ 
    $page = 1; 
} else { 
    $page = $_GET['page']; 
} 

$max_results = 25; 
$from = (($page * $max_results) - $max_results); 

$query = "SELECT * from members ORDER BY username ASC LIMIT $from, $max_results";
$result = mysql_db_query ($database, $query, $dblink);

while ($row = mysql_fetch_array($result)){
	   
print ("<tr> \n");
print ("<td class='alt1'>$row[username]</td> \n");
print ("<td class='alt1'>$row[email]</td> \n");
print ("<td class='alt1'> \n");

    if ($row[rank] == 0){echo "Member";}
	if ($row[rank] == 1){echo "Moderator (training)";}
    if ($row[rank] == 2){echo "Moderator";}
	if ($row[rank] == 3){echo "Administrator";}
	if ($row[rank] == 4){echo "Webmaster";}
	if ($row[rank] == 5){echo "Site Owner";}
	if ($row[rank] == 6){echo "Banned";}

print ("</td> \n");
print ("</tr> \n");
	   
} 

	  print ("<table class='dimensions'> \n");
	  		 print ("<tr> \n");
			 	 print ("<td class='catagorycenter'> \n");



$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM members"),0); 
$total_pages = ceil($total_results / $max_results); 
echo "<center>"; 

// Build Previous Link 
if($page > 1){ 
    $prev = ($page - 1); 
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&id=memberlist\">Previous </a>&nbsp;&nbsp;"; 
}  else {echo "Previous&nbsp;&nbsp;"; }

for($i = 1; $i <= $total_pages; $i++){ 
    if(($page) == $i){ 
        echo "$i&nbsp;"; 
        } else { 
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&id=memberlist\">$i</a>&nbsp;"; 
    } 
} 

// Build Next Link 
if($page < $total_pages){ 
    $next = ($page + 1); 
    echo "&nbsp;&nbsp;<a href=\"".$_SERVER['PHP_SELF']."?page=$next&id=memberlist\">Next</a>"; 
} else {echo "&nbsp;&nbsp;Next"; }



?>
	   
<br>
	  			 </td>
			 </tr>
	  </table>

<?php } ?>


<?php if (($id == "content") && ($conttype == 1)){ ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
<?php
$Query = "SELECT * FROM vertcontset WHERE tablename = '$table'";
$Result = mysql_db_query ($database, $Query, $dblink);

if ($Row1 = mysql_fetch_array ($Result)) {
	  echo "$Row1[name]";
}

?>
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">

<?php
	 	   	   $Query = "SELECT * FROM $table ORDER BY title DESC";
			   $Result = mysql_db_query ($database, $Query, $dblink);

			   while ($Row = mysql_fetch_array ($Result)) {
	  		   		   echo "<a href='?id=viewcontent&table=$table&rowid=$Row[id]&contenttype=$Row1[type]&catname=$Row1[name]'>$Row[title]</a><br>";
			   }

?>

	   	   </td>
	   </tr>
</table>

<?php } 


if ( ( $id == "viewcontent" ) && ( $contenttype == 1 ) ){ ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
<?php

$Query = "SELECT * FROM $table WHERE id = '$rowid'";
$Result = mysql_db_query ($database, $Query, $dblink);
if ($ContentRow = mysql_fetch_array ($Result)) {}

echo "<a href='$siteurl'>$sitename</a> / <a href='?id=content&table=$table&conttype=1&catname=$catname'>$catname</a> / $ContentRow[title] \n";

?>
	   	   </td>
	   </tr>
</table>

<br \>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
<?php
echo "$ContentRow[title]";
?>
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">

<?php
	  		   		   echo "$ContentRow[text]";
?>

	   	   </td>
	   </tr>
</table>

<?php }



if ( ( $id == "content" ) && ( $conttype == 2 ) ){ ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
<?php
echo "<a href='$siteurl'>$sitename</a> / $catname \n";
?>
	   	   </td>
	   </tr>
</table>
<br \>



<table class="dimensions">
<tr>
	   	   <td class="catagorycenter">
<?php
echo "<big><big> $catname </big></big>\n";
?>
	   	   </td>
	   </tr>
</table>
<br />

<table class="dimensions">
<?php

$query = "SELECT * from vertcontset WHERE tablename = '$table'";
$result = mysql_db_query ($database, $query, $dblink);
if ($Row2 = mysql_fetch_array ($result)) {}


if(!isset($_GET['page'])){ 
    $page = 1; 
} else { 
    $page = $_GET['page']; 
} 

$max_results = $Row2[pages]; 
$from = (($page * $max_results) - $max_results); 

$Query = "SELECT * FROM $table ORDER BY title ASC LIMIT $from, $max_results";
$Result = mysql_db_query ($database, $Query, $dblink);

while ( $row = mysql_fetch_array($Result) ) {

	   echo "<tr> \n";
	   	   echo "<td class='catagorycenter' width='150'> \n";
		   echo $row[title];
	   	   echo "</td><td class='alt1'> \n";
		   echo $row[text];
	   	   echo "</td> \n";
	  echo " </tr> \n";
	 
} 

?>
	   
</table>
<br />


<?php

	  print ("<table class='dimensions'> \n");
	  		 print ("<tr> \n");
			 	 print ("<td class='catagorycenter'> \n");



$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM $table"),0); 
$total_pages = ceil($total_results / $max_results); 
echo "<center>"; 

// Build Previous Link 
if($page > 1){ 
    $prev = ($page - 1); 
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&id=content&table=$table&conttype=2 \">Previous </a>&nbsp;&nbsp;"; 
}  else {echo "Previous&nbsp;&nbsp;"; }

for($i = 1; $i <= $total_pages; $i++){ 
    if(($page) == $i){ 
        echo "$i&nbsp;"; 
        } else { 
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&id=content&table=$table&conttype=2\">$i</a>&nbsp;"; 
    } 
} 

// Build Next Link 
if($page < $total_pages){ 
    $next = ($page + 1); 
    echo "&nbsp;&nbsp;<a href=\"".$_SERVER['PHP_SELF']."?page=$next&id=content&table=$table&conttype=2\">Next</a>"; 
} else {echo "&nbsp;&nbsp;Next"; }

?>


</td>
</tr>
</table>

<?php }




if ( ( $id == "content" ) && ( $conttype == 3 ) ){ ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
<?php
echo "<a href='$siteurl'>$sitename</a> / $catname \n";
?>
	   	   </td>
	   </tr>
</table>
<br \>

<table class="dimensions">

<?php

echo "<tr> \n";
	   	   echo "<td class='catagorycenter'> \n";
		   echo "<big><big>$catname</big></big> \n";
	   	   echo "</td> \n";
	  echo " </tr> \n";



$query = "SELECT * from vertcontset WHERE tablename = '$table'";
$result = mysql_db_query ($database, $query, $dblink);
if ($Row2 = mysql_fetch_array ($result)) {}


if(!isset($_GET['page'])){ 
    $page = 1; 
} else { 
    $page = $_GET['page']; 
} 

$max_results = $Row2[pages]; 
$from = (($page * $max_results) - $max_results); 

$Query = "SELECT * FROM $table ORDER BY title ASC LIMIT $from, $max_results";
$Result = mysql_db_query ($database, $Query, $dblink);
$altcolor = 1;

while ( $row = mysql_fetch_array($Result) ) {

	   echo "<tr> \n";
	   	   echo "<td class='alt$altcolor'> \n";
		   echo "$Row2[prefix] <a href='$row[url]'>$row[title]</a>";
	   	   echo "</td> \n";
	  echo " </tr> \n";
	  
$altcolor++;
if ($altcolor == 3) {$altcolor = 1;}
	 
} 

?>
	   
</table>
<br />


<?php

	  print ("<table class='dimensions'> \n");
	  		 print ("<tr> \n");
			 	 print ("<td class='catagorycenter'> \n");



$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM $table"),0); 
$total_pages = ceil($total_results / $max_results); 
echo "<center>"; 

// Build Previous Link 
if($page > 1){ 
    $prev = ($page - 1); 
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&id=content&table=$table&conttype=3 \">Previous </a>&nbsp;&nbsp;"; 
}  else {echo "Previous&nbsp;&nbsp;"; }

for($i = 1; $i <= $total_pages; $i++){ 
    if(($page) == $i){ 
        echo "$i&nbsp;"; 
        } else { 
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&id=content&table=$table&conttype=3\">$i</a>&nbsp;"; 
    } 
} 

// Build Next Link 
if($page < $total_pages){ 
    $next = ($page + 1); 
    echo "&nbsp;&nbsp;<a href=\"".$_SERVER['PHP_SELF']."?page=$next&id=content&table=$table&conttype=3\">Next</a>"; 
} else {echo "&nbsp;&nbsp;Next"; }

?>


</td>
</tr>
</table>

<?php }



if ( ( $id == "content" ) && ( $conttype == 4 ) ){ ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
<?php
echo "<a href='$siteurl'>$sitename</a> / $catname \n";
?>
	   	   </td>
	   </tr>
</table>
<br \>

<table class="dimensions">

<?php

echo "<tr> \n";
	   	   echo "<td class='catagorycenter'> \n";
		   echo "<big><big>$catname</big></big> \n";
	   	   echo "</td> \n";
	  echo " </tr> \n";
	  echo "<tr> \n";
	   	   echo "<td class='alt1'> \n";


$query = "SELECT * from vertcontset WHERE tablename = '$table'";
$result = mysql_db_query ($database, $query, $dblink);
if ($Row2 = mysql_fetch_array ($result)) {}


if(!isset($_GET['page'])){ 
    $page = 1; 
} else { 
    $page = $_GET['page']; 
} 

$max_results = $Row2[pages]; 
$from = (($page * $max_results) - $max_results); 

$Query = "SELECT * FROM $table LIMIT $from, $max_results";
$Result = mysql_db_query ($database, $Query, $dblink);


while ( $row = mysql_fetch_array($Result) ) { ?>
<a href="<?php echo "?id=content&conttype=4&single=1&catname=$catname&table=$table&picid=$row[id]&page=$page"; ?>" ><img src="<?php echo "$row[picurl]"; ?>" width="100" height="100" alt="n/a" border="0"></img></a>
<?php } 

?>

</td>
</tr>
</table>
<br />


<?php

	  print ("<table class='dimensions'> \n");
	  		 print ("<tr> \n");
			 	 print ("<td class='catagorycenter'> \n");



$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM $table"),0); 
$total_pages = ceil($total_results / $max_results); 
echo "<center>"; 

// Build Previous Link 
if($page > 1){ 
    $prev = ($page - 1); 
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&id=content&table=$table&conttype=4&catname=$catname\">Previous </a>&nbsp;&nbsp;"; 
}  else {echo "Previous&nbsp;&nbsp;"; }

for($i = 1; $i <= $total_pages; $i++){ 
    if(($page) == $i){ 
        echo "$i&nbsp;"; 
        } else { 
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&id=content&table=$table&conttype=4&catname=$catname\">$i</a>&nbsp;"; 
    } 
} 

// Build Next Link 
if($page < $total_pages){ 
    $next = ($page + 1); 
    echo "&nbsp;&nbsp;<a href=\"".$_SERVER['PHP_SELF']."?page=$next&id=content&table=$table&conttype=4&catname=$catname\">Next</a>"; 
} else {echo "&nbsp;&nbsp;Next"; }

?>


</td>
</tr>
</table>

<?php } 


if ( ( $id == "content" ) && ( $conttype == 4 ) && ( $single == 1 ) ){ ?>

<br />

<table class="dimensions">

<tr>
<td class="catagorycenter">
View Picture
</td>
</tr>

<tr>
<td class="alt1">
<center>

<?php

$query = "SELECT * from $table WHERE id = '$picid'";
$result = mysql_db_query ($database, $query, $dblink);
if ($Row2 = mysql_fetch_array ($result)) {echo "<img src='$Row2[picurl]' alt='n/a' border='0'></img>";}

?>

</center>
</td>
</tr>
</table>

<?php } ?>




<?php if (($id == "content") && ($conttype == 5)){ ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
<?php
$Query = "SELECT * FROM vertcontset WHERE tablename = '$table'";
$Result = mysql_db_query ($database, $Query, $dblink);

if ($Row1 = mysql_fetch_array ($Result)) {
	  echo "$Row1[name]";
}

?>
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">

<?php
	 	   	   $Query = "SELECT * FROM $table ORDER BY title DESC";
			   $Result = mysql_db_query ($database, $Query, $dblink);

			   while ($Row = mysql_fetch_array ($Result)) {
	  		   		   echo "<a href='?id=viewcontent&table=$table&rowid=$Row[id]&contenttype=$Row1[type]&catname=$Row1[name]'>$Row[title]</a><br>";
			   }

?>

	   	   </td>
	   </tr>
</table>

<?php } 


if ( ( $id == "viewcontent" ) && ( $contenttype == 5 ) ){ ?>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
<?php

$Query = "SELECT * FROM $table WHERE id = '$rowid'";
$Result = mysql_db_query ($database, $Query, $dblink);
if ($ContentRow = mysql_fetch_array ($Result)) {}

echo "<a href='$siteurl'>$sitename</a> / <a href='?id=content&table=$table&conttype=1&catname=$catname'>$catname</a> / $ContentRow[title] \n";

?>
	   	   </td>
	   </tr>
</table>

<br \>

<table class="dimensions">
	   <tr>
	   	   <td class="catagorycenter">
<?php
echo "$ContentRow[title]";
?>
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1"><center>

<?php
	 	   	   		   echo " <textarea style='width:$TableWide;height:170;'>\n";
	  		   		   echo "$ContentRow[text]";
					   echo " </textarea>\n";
?>

	   	   </td>
	   </tr>
</table>

<?php } ?>

</td>



<td align="center">

<!--RIGHT SIDE-->


<?php 

$Query = "SELECT * from blocks ORDER BY position ASC";
$Result = mysql_db_query($database, $Query, $dblink);
while ($row = mysql_fetch_array($Result)) {
	  if (($row[active] == 1) && ($row[side] == 2)) {require ("blocks/$row[title].php"); }
}

?>



<!--END RIGHT SIDE-->

</td>
</tr>
</table>
<br>
<br>
<table class="dimensions">
	   <tr>
	   	   <td id="header" align="center">
VME Panel Copyright <a href="http://www.switchskate.net">SwitchSkate.net</a>
	   	   </td>
	   </tr>
</table>
<?php mysql_close ($dblink); } else {echo "You have been banned from $sitename.  If you think you have been wrongly banned then please email $webmail."; mysql_close ($dblink);} ?>
