
<?php
$host = "localhost"; 
$user = "switchsk_adam"; 
$pass = "drummer"; 
$LinkUp = mysql_connect ($host, $user, $pass);
$dbname = "switchsk_style";
$TCTBL = "users";
$repeatu = 0;
$ident = 0;
$ip = $_SERVER['REMOTE_ADDR']; 		   

$query = "SELECT * from $TCTBL";
$result = mysql_db_query ($dbname, $query, $LinkUp);

 while ($row = mysql_fetch_array($result)){
 if ($row[ip] == $ip){
 $repeatu = 1;
 $ident = $row[id];
 }}

 
 
 if ($repeatu == 1){
	
	    $host = "localhost";
		$username = "switchsk_adam";
		$password = "drummer";
		
		$sql = "UPDATE users SET choice = '$picker' WHERE id = '$ident'";
		$result = mysql_db_query ($dbname, $sql, $LinkUp);
		if ($result){}else{echo "n";}
		
}elseif ($repeatu == 0){

	 	$host = "localhost"; 
		$user = "switchsk_adam"; 
		$pass = "drummer"; 

		$FContQuery = "insert into users values ('0', '$ip', '$picker')";
		if (mysql_db_query ($dbname, $FContQuery, $LinkUp)){}else{print ("no good");}
		
}else{

		print ("Error");

}

		
		
echo "<meta http-equiv='refresh' content='0;URL=http://www.switchskate.net'>";	

mysql_close ($LinkUp);	
?>