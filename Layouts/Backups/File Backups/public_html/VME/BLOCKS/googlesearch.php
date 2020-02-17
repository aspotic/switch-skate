<?php

$googlewide = $Theme[widthright] - 10;

?>

<table class="right">
	   <tr>
	   	   <td class="catagoryside">
Google Search
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
<form name="form" method="get" action="http://search.revenuepilot.com/servlet/search">

<table>
	   <tr>
	   	   <td class="alt1">
<input type='text' name='keyword' onFocus="javascript:select();" style="width:<?php echo $googlewide ?>;">
	   	   </td>
	   </tr>
	   <tr>
	   	   <td class="alt1">
               <input type='hidden' name='id' value='14269'>
               <input type='hidden' name='sid' value='0'>
	       <input type='hidden' name='filter' value='off'>
               <input type='hidden' name='mode' value='search'>
<input type="submit" value="Search" style="width:<?php echo $googlewide ?>;">
	   	   </td>
	   </tr>
</table>


	   	   </td>
	   </tr>
</table>
</center>
</form>
<br>
