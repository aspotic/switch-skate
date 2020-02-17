<?php

require ("header.php");  // Open header file

?>
<br><br>
<table width="<?php echo $StyleRow[tablew] ?>" align="center">
<tr>
<td valign="top">
<?php require ("left.php"); ?>
</td>

<td valign="top">

<?php



// Constant Variables



mysql_select_db('switchsk_other', mysql_pconnect('localhost','switchsk_adam','drummer')) or die (mysql_error()); 
$tablename = "news";

$count = 0;
// If current page number, use it 
// if not, set one! 

if(!isset($_GET['page'])){ 
    $page = 1; 
} else { 
    $page = $_GET['page']; 
} 

// Define the number of results per page 
$max_results = 5; 

// Figure out the limit for the query based 
// on the current page number. 
$from = (($page * $max_results) - $max_results); 

// Perform MySQL query on only the current page number's results 

$sql = mysql_query("SELECT * FROM $tablename LIMIT $from, $max_results"); 

print ("<TABLE style='width:$StyleRow[tablew]; border:$StyleRow[borderw]px solid $StyleRow[border];' cellspacing='$StyleRow[borderw]' cellPadding='6' align='center'>\n");
  print ("<TBODY>\n");
    print ("<TR>\n");
	  print ("<TD bgcolor='$StyleRow[catagory]' background='$StyleRow[catagory]' align='center'>\n");
	  print ("Cool Sites \n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
      print ("<TR class='tablerow'>\n");
      print ("<TD class='mediumtxt' bgcolor='$StyleRow[alt1]' align='left'>\n");
echo " <script src='http://search.revenuepilot.com/servlet/search?mode=js&perpage=3&filter=off&id=14269&sid=0&skip=0&keyword=hosting'></script> \n";
	  print ("</TD>\n");
	  print ("</TR>\n");
  print ("</TBODY>\n");
print ("</TABLE>\n");
print ("<br>\n");


while($NewsRow = mysql_fetch_array($sql)){ 

print ("<TABLE style='width:$StyleRow[tablew]; border:$StyleRow[borderw]px solid $StyleRow[border];' cellspacing='$StyleRow[borderw]' cellPadding='6' align='center'>\n");
  print ("<TBODY>\n");
    print ("<TR>\n");
      print ("<TD bgcolor='$StyleRow[catagory]' background='$StyleRow[catagory]' align='center'>\n");
	  print ("<b>$NewsRow[title]</b>\n");
	 print (" </TD>\n");
	print ("</TR>\n");
	print ("<TR class=tablerow>\n");
    print ("  <TD class=mediumtxt bgColor='$StyleRow[alt1]' align='center'>\n");
	print ("Published by: $NewsRow[name] <br>\n");
	print ("Published on: $NewsRow[date] \n");
	  print ("</TD>\n");
	print ("</TR>\n");
	
    print ("<TR class=tablerow>\n");
      print ("<TD class=mediumtxt bgColor='$StyleRow[alt1]'>\n");
	  
print ("$NewsRow[text] \n");  

      print ("</TD>\n");
	print ("</TR>\n");
  print ("</TBODY>\n");
print ("</TABLE>\n");
print ("<br><br>\n");

$count++;
}

print ("<TABLE style='width:$StyleRow[tablew]; border:$StyleRow[borderw]px solid $StyleRow[border];' cellspacing='$StyleRow[borderw]' cellPadding='6' align='center'>\n");
  print ("<TBODY>\n");
    print ("<TR>\n");
	  print ("<TD bgcolor='$StyleRow[catagory]' background='$StyleRow[catagory]' align='center'>\n");
	  print ("Cool Sites \n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
      print ("<TR class='tablerow'>\n");
      print ("<TD class='mediumtxt' bgcolor='$StyleRow[alt1]' align='left'>\n");
echo " <script src='http://search.revenuepilot.com/servlet/search?mode=js&perpage=3&filter=off&id=14269&sid=0&skip=0&keyword=hosting'></script> \n";
	  print ("</TD>\n");
	  print ("</TR>\n");
  print ("</TBODY>\n");
print ("</TABLE>\n");
print ("<br>\n");


// Figure out the total number of results in DB: 
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM $tablename"),0); 

// Figure out the total number of pages. Always round up using ceil() 
$total_pages = ceil($total_results / $max_results); 

// Build Page Number Hyperlinks 
echo "<center>Select a Page<br />"; 

// Build Previous Link 
if($page > 1){ 
    $prev = ($page - 1); 
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\">Previous </a>&nbsp;&nbsp;"; 
} 

for($i = 1; $i <= $total_pages; $i++){ 
    if(($page) == $i){ 
        echo "$i&nbsp;"; 
        } else { 
            echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\">$i</a>&nbsp;"; 
    } 
} 

// Build Next Link 
if($page < $total_pages){ 
    $next = ($page + 1); 
    echo "&nbsp;&nbsp;<a href=\"".$_SERVER['PHP_SELF']."?page=$next\">Next</a>"; 
} 
echo "</center>"; 
?>

<br><br>
</td>

<td valign="top">
<?php require ("right.php"); ?>
</td>
</tr>
</table>
<br>
<br>

<?php require ("footer.php"); ?>

</body>
</html>
