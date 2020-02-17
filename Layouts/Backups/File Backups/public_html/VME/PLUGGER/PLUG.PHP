<html>
<head>
	<title>VME Plugger</title>
	
<?php require ("plugconfig.php"); ?>

<?php echo "
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
		   $dblink = mysql_connect ($hosttype, $username, $password);
		   
		   $Query = "SELECT * FROM vmeplugger ORDER BY title ASC";
		   
		   $Result = mysql_db_query ($database, $Query, $dblink);
		   
		   while ( $Row = mysql_fetch_array ($Result) ) {
		   
		   		 if ($Row[type] == 2) { ?>
				 	  <a href="<?php echo $Row[url] ?>"><img src="<?php echo $Row[title] ?>" width="88" height="31" border="0" alt="n/a"></a>
		   <?php }
		   
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
				 	  print ("<a href='$Row[url]'>$Row[title]</a>&nbsp;&nbsp;&nbsp;");
				 }
		   
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
		   Plug your site
		   </td>
	   </tr>
	   <tr>
	   	   <td class="add">
		   <form method="post" action="">
		   <input name="title" type="text" value="Title/Image URL" onFocus="javascript:select()"><br>
		   <input name="url" type="text" value="Site URL" onFocus="javascript:select()"><br>
		   <input name="type" type="radio" value="1">Text Link<br>
		   <input name="type" type="radio" value="2">Button Link<br>
		   <input type="submit" value="Plug" name="plug">
		   
		   <?php
		   		if ( isset ( $plug ) ) {
		   	    	 $dblink = mysql_connect ($hosttype, $username, $password);
		   
		   			 $Query = "INSERT INTO vmeplugger VALUES ( '','$title','$url','$type' )";
	 				 $Result = mysql_db_query ($database, $Query, $dblink);
	 				 
					 if (!$Result) {
					 		die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());
					 } else { 
					   		echo "<script>window.location.replace ('?');</script>"; 
					 }	
		   
		   			 mysql_close ($dblink);   
		   		}
		   ?>
		   
		   </form>
		   </td>
	   </tr>
</table>



</body>
</html>
