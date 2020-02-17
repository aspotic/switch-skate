<?php
require ("header.php");

?>
<table width="<?php echo $StyleRow[tablew] ?>" align="center">
<tr>
<td valign="top">
<?php require ("left.php"); ?>
</td>

<td valign="top" width="<?php echo $StyleRow[tablew] ?>">
<center><h3>Stories</h3></center>


<TABLE style="width:<?php echo $StyleRow[tablew] ?>; border:<?php echo $StyleRow[borderw] ?>px solid <?php echo $StyleRow[border] ?>;" cellspacing="<?php echo $StyleRow[borderw] ?>" cellPadding="6" align="center">
  <TBODY>
    <TR>
      <TD bgcolor="<?php echo $StyleRow[catagory] ?>" background="<?php echo $StyleRow[catagory] ?>" align="center">
	  <b>Add a story</b>
	  </TD>
	</TR>
	<TR class=tablerow>
      <TD class=mediumtxt bgColor="<?php echo $StyleRow[alt2] ?>" align="center">
<form action="addstory.php" method="post"> 
<input name="name" type="text"  value="Your Name:" onFocus="if(this.value=='Your Name:')this.value='';" onBlur="if(this.value=='' )this.value='Your Name:';"><br>
<input name="email" type="text" value="Your Email:" onFocus="if(this.value=='Your Email:')this.value='';" onBlur="if(this.value=='' )this.value='Your Email:';"><br>
<input name="title" type="text" value="Title:" onFocus="if(this.value=='Title:')this.value='';" onBlur="if(this.value=='' )this.value='Title:';"><br>
<textarea name="text" style=" border-color:<?php echo $row[bordw] ?>; border-style: solid; width:250px;height:50px;background-color:<?php echo $row[alt2] ?>;color:<?php echo $row[text] ?>;font-size:8pt; font-family:<?php echo $row[font] ?>;">
</textarea><br>
<input type="submit" name="submit" value="Submit">  
</form>
	  </TD>
	</TR>
  </TBODY>
</TABLE>
<br><br>

<?php

mysql_select_db('switchsk_fcontent', mysql_pconnect('localhost','switchsk_adam','drummer')) or die (mysql_error()); 

$tablename = "storys";
// If current page number, use it 
// if not, set one! 

if(!isset($_GET['page'])){ 
    $page = 1; 
} else { 
    $page = $_GET['page']; 
} 

// Define the number of results per page 
$max_results = 15; 

// Figure out the limit for the query based 
// on the current page number. 
$from = (($page * $max_results) - $max_results); 

// Perform MySQL query on only the current page number's results 

$sql = mysql_query("SELECT * FROM $tablename LIMIT $from, $max_results"); 

while($row = mysql_fetch_array($sql)){ 



print ("<TABLE style='width:$StyleRow[tablew]; border:$StyleRow[borderw]px solid $StyleRow[border];' cellspacing='$StyleRow[borderw]' cellPadding='6' align='center'>\n");
  print ("<TBODY>\n");
    print ("<TR>\n");
	  print ("<TD bgcolor='$StyleRow[catagory]' background='$StyleRow[catagory]' align='center'>\n");
	  print ("$row[title]\n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
      print ("<TR class='tablerow'>\n");
      print ("<TD class='mediumtxt' bgcolor='$StyleRow[alt1]' align='left'>\n");
	  print ("$row[text]\n");	
	  print ("</TD>\n");
	  print ("</TR>\n");
  print ("</TBODY>\n");
print ("</TABLE>\n");
print ("<br>\n");
}

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
