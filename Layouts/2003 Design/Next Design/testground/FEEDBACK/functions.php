<?php

function connectcontsb (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_contsb"; 
$link = mysql_connect ($host, $username, $password);
mysql_select_db($database, $link); 
}

function closecontsb (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_contsb"; 
$link = mysql_connect ($host, $username, $password);
$mysql_select_db($database, $link); 
mysql_close ($link);
}

function connectfcontsb (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_fcontsb"; 
$link = mysql_connect ($host, $username, $password);
mysql_select_db($database, $link); 
}

function closefcontsb (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_fcontsb"; 
$link = mysql_connect ($host, $username, $password);
mysql_select_db($database, $link);  
mysql_close ($link);
}

function connectcontco (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_contco"; 
$link = mysql_connect ($host, $username, $password);
mysql_select_db($database, $link);  
}

function closecontco (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_contco"; 
$link = mysql_connect ($host, $username, $password);
mysql_select_db($database, $link); 
mysql_close ($link);
}

function connectfcontco (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_fcontco"; 
$link = mysql_connect ($host, $username, $password);
mysql_select_db($database, $link); 
}

function closefcontco (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_fcontco"; 
$link = mysql_connect ($host, $username, $password);
mysql_select_db($database, $link); 
mysql_close ($link);
}

function connectother (){
$host = "localhost";
$username = "switchsk_adam";
$password = "drummer";
$database = "switchsk_other";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ){
$link = mysql_connect ($host, $username, $password);
//mysql_select_db($database, $link); 
}

function closeother (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_other"; 
$link = mysql_connect ($host, $username, $password);
mysql_select_db($database, $link); 
mysql_close ($link);
}

function connectfother (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_fother"; 
$link = mysql_connect ($host, $username, $password);
mysql_select_db($database, $link); 
}

function closefother (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_fother"; 
$link = mysql_connect ($host, $username, $password);
mysql_select_db($database, $link); 
mysql_close ($link);
}

function connectlayout (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_layout"; 
$link = mysql_connect ($host, $username, $password);
mysql_select_db($database, $link); 
}

function closelayout (){
$host = "localhost"; 
$username = "switchsk_adam"; 
$password = "drummer"; 
$database = "switchsk_layout"; 
$link = mysql_connect ($host, $username, $password);
mysql_select_db($database, $link); 
mysql_close ($link);
}

?>