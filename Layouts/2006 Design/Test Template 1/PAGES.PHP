<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>


<?php
	
	$Database = "switchsk_switch";
	$Hostname = "localhost";
	$DBUsername = "switchsk_adam";
	$DBPassword = "drummer";

	$DBLink = mysql_connect ($Hostname, $DBUsername, $DBPassword);

	$Query = "SELECT * FROM news";
	$Result = mysql_db_query ($Database, $Query, $DBLink);
	while ($Row = mysql_fetch_array ($Result)) {$TotalResults++;}

	if ($Page == "") {

	$Page = 1;}
	$NumberOnPage = 5;
	$TotalResults = $TotalResults;
	$TotalPages = ceil ($TotalResults/$NumberOnPage);
	$Last = $Page * $NumberOnPage;
	$First = $Last - $NumberOnPage;

	$Query = "SELECT * FROM news ORDER BY date DESC LIMIT $First, $NumberOnPage";
	$Result = mysql_db_query ($Database, $Query, $DBLink);

	while ($Row = mysql_fetch_array ($Result)) {	
		echo "$Row[date] <br />";
	}

	echo "<br /> <br /> <br />";

	
	echo "Page:&nbsp;&nbsp;&nbsp;&nbsp;";



	for ($ShowPage = 1; $ShowPage <= $TotalPages; $ShowPage++) {
		if ($Page != $ShowPage) {	
			echo "<a href='?Page=$ShowPage'>$ShowPage</a>";
		} else {
			echo "$ShowPage";
		}
	}


	mysql_close ($DBLink);

?>


</BODY>
</HTML>
