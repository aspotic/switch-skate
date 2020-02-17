<html>
<head>
	<title>VME Plugger</title>
	
<?php require ("config.php"); 

echo "
<style>

body {
margin-top:0;
margin-left: auto ;
margin-right: auto ;
text-align:center;
background-color:$bgcolor;
}


table.dimensions { 
font-family:$fonttype;
width:$tblwidth;
border:$bordersze $bordertpe $borderclr;
} 


td.category {
background-color:$catbgclr;
font-family:$fonttype;
color:$cattext;
text-align:$catalign;
}


td.buttons {
background-color:$butbgclr;
font-family:$fonttype;
text-align:$butalign;
}


td.text {
background-color:$textbgclr;
font-family:$fonttype;
text-align:$txtalign;
}


td.add {
background-color:$addbgclr;
font-family:$fonttype;
color:$addtxtclr;
text-align:left;
}


a {
text-decoration:none;
color:$linkclr;
}


a:hover {
text-decoration:none;
font-weight: normal ;
color:$linkhover;
}


input {
	 color:$inputtxt;
	 background-color:$inptbgclr;
	 font-family:$fonttype;
	 border:$bordersze $bordertpe $borderclr;
}

</style>
"; ?>


</head>
<body>
<?php
$ipaddress =  $_SERVER['REMOTE_ADDR'];

 if ($ipaddress == $adminip) { ?>

<form method="post" action="">
<table class="dimensions">
	   <tr>
	   	   <td class="category">
		   <big><big>Plugger</big></big>
		   </td>
	   </tr>
</table>

<br />

<table class="dimensions">
	   <tr>
	   	   <td class="category">
		   Button Links
		   </td>
	   </tr>
	   <tr>
	   	   <td class="buttons">
		   <?php
		   $count = 1;
		   
		   $dblink = mysql_connect ($hosttype, $username, $password);
		   
		   $Query = "SELECT * FROM vmeplugger ORDER BY title ASC";
		   
		   $Result = mysql_db_query ($database, $Query, $dblink);
		   
		   while ( $Row = mysql_fetch_array ($Result) ) {
		   
		   		 if ($Row[type] == 2) { ?>
				 	  <?php echo "<input type='checkbox' name='deletenum[$count]' value='$Row[id]'>" ?><a href="<?php echo $Row[url] ?>"><img src="<?php echo $Row[title] ?>" width="88" height="31" border="0" alt="n/a"></a>&nbsp;&nbsp;&nbsp;
		   <?php $count++; }
		   
		   }		   
		   
		   mysql_close ($dblink);  
		   ?>
		   <br />
		   <br />
		   </td>
	   </tr>
	   <tr>
	   	   <td class="category">
		   Text Links
		   </td>
	   </tr>
	   <tr>
	   	   <td class="text">
		   <?php
		   $dblink = mysql_connect ($hosttype, $username, $password);
		   
		   $Query = "SELECT * FROM vmeplugger ORDER BY title ASC";
		   $Result = mysql_db_query ($database, $Query, $dblink);
		   
		   while ( $Row = mysql_fetch_array ($Result) ) {
		   
		   		 if ($Row[type] == 1) {
				 	  print ("<input type='checkbox' name='deletenum[$count]' value='$Row[id]'><a href='$Row[url]'>$Row[title]</a>&nbsp;&nbsp;&nbsp;");
				 $count++;}
		   
		   }		
		   
		   mysql_close ($dblink);   
		   ?>
		   <br />
		   <br />
		   <br />
		   </td>
	   </tr>
</table>

<br />

<table class="dimensions">
	   <tr>
	   	   <td class="category">
		   Action
		   </td>
	   </tr>
	   <tr>
	   	   <td class="add">
		   <center>
		   <input type="submit" value="Delete" name="plug">
		   </center>
		   
		   <?php
		   		if ( isset ( $plug ) ) {
		   	    	 $dblink = mysql_connect ($hosttype, $username, $password);
		   
		   			 for ($counter == 1; $counter < $count; $counter++) {
		   
		   			 	 	if ($deletenum[$counter] != "") {
					 
					 		      $Query = "DELETE FROM vmeplugger WHERE id = $deletenum[$counter]";
								  $Result = mysql_db_query ($database, $Query, $dblink);
								   if (!$Result) {die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());}
					 
					 		}
					 
					 }
					 
					 mysql_close ($dblink);   
	 				 
					 echo "<script>window.location.replace ('?');</script>";
		   
		   			 
		   		}
		   ?>
		   
		   </form>
		   </td>
	   </tr>
</table>



</body>

<?php } ?>

</html>
