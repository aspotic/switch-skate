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

	<title>VME Plugger 1.0 Installer</title>
</head>

<body>

	<table class="dimensions">
		   <tr>
		   	   <td class="catagory">
		   	   	  VME Plugger 1.0 Installer
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

if ( ($bgcolor != "") && ($fonttype != "") && ($tblwidth != "") && ($bordersze != "") &&  ($bordertpe != "") && ($borderclr != "") && ($catbgclr != "") && ($cattext != "") && ($catalign != "") && ($butbgclr != "") && ($butalign != "") && ($textbgclr != "") && ($txtalign != "") && ($addbgclr != "") && ($addtxtclr != "") && ($linkclr != "") && ($linkhover != "") && ($inputtxt != "") && ($inptbgclr != "") ) {
	 
	 			 	 $dblink = mysql_connect ($hosttype, $username, $password);
					 
					 $Query = "CREATE table vmeplugger (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, title TEXT, url TEXT, type TINYINT)";
	 				 $Result = mysql_db_query($database,$Query, $dblink);
					 
					 if ($Result){
		  			 		echo "Plugger Table Created <br \>";
	 				 } else {
	      			 	    die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());
	 				 }
					 
					 
	 			 	 $Query = "INSERT INTO vmeplugger VALUES ( '0','http://www.switchskate.net/images/button4.gif','http://www.switchskate.net','2' )";
	 				 $Result = mysql_db_query ($database, $Query, $dblink);
	 				 
					 if (!$Result) {
					 		die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());
					 } else { 
					   		echo "Button link added <br \>"; 
					 }
	 				 
					 
					 $Query = "INSERT INTO vmeplugger VALUES ( '0','Ventaja Designs','http://www.switchskate.net/vme','1' )";
	 				 $Result = mysql_db_query ($database, $Query, $dblink);
	 				 
					 if (!$Result) {
					 		die('Invalid query, please copy this and send it to switchskate@gmail.com: ' . mysql_error());
					 } else {
					   		echo "Text link added <br \>";
					 }
					 
	 				 mysql_close ($dblink);
					 
					 
					 echo "<center><br><br><b><h5>DONE.  Please delete this file</h5></b></center>";
	 
} else {
	 
	 	   			 print "Please fill out all of the fields in the config.php file.  You use notepad to open the file and save it.";
	 
}

?>



		   	   </td>
		   </tr>
	</table>

</body>
</html>
