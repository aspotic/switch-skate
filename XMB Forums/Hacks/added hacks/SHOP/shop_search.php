<?php
/*
	SHOP HACK v1.3 by NFPUNK/FLIXON

	If you require support please post in the forum
	at www.flixon.com/shop/forum.  Thanks

	- nfpunk/Flixon
*/

require "./header.php";
loadtemplates('header', 'footer', 'footer_load', 'footer_querynum', 'footer_phpsql', 'footer_totaltime', 'css', 'shop_search', 'shop_search_results', 'shop_search_results_row', 'shop_search_results_none', 'shop_info', 'shop_links', 'shop_footer');

$query = $db->query("SELECT * FROM $table_shop_settings");
$set = $db->fetch_array($query);
$db->free_result($query);

$navigation = "&raquo; <a href=\"shop.php\">$lang[shop_title]</a> &raquo; $lang[shop_textsearch]";

eval("\$css = \"".template('css')."\";");
eval("echo (\"".template('header')."\");");

$private = explode("|", $set['private']);
$userlist = explode("|", $set['userlist']);

$authorization = privfcheck($private[1], $userlist[1]);

if(!$authorization || X_GUEST) {
    	error($lang['shop_nopage'], false);
}

if($set['search'] != "on") {
	error($lang['shop_search_off'], false);
}

if(!isset($submit) || !$submit) {
	eval("echo (\"".template('shop_search')."\");");
} else {
	$srchtxt = isset($srchtxt) ? checkInput($srchtxt, '', '', 'javascript', false) : '';

	$searchresultsrows = '';

	$query = $db->query("SELECT * FROM $table_shop_items WHERE itemname LIKE '%$srchtxt%' ORDER BY itemname");

	while($item = $db->fetch_array($query)) {
		eval("\$searchresultsrows .= \"".template('shop_search_results_row')."\";");
	}

	$db->free_result($query);

	if($searchresultsrows == "") {
		eval("\$searchresultsrows = \"".template('shop_search_results_none')."\";");
	}

	eval("echo (\"".template('shop_search_results')."\");");
}

// Links

$displaylinks = array();

if(X_ADMIN) {
	$displaylinks[] = "<img src=\"images/shop/admin.gif\" alt=\"$lang[shop_textadminpanel]\" border=\"0\" /> <a href=\"shop_admin.php\">$lang[shop_textadminpanel]</a>";
}

if($set['stats'] == "on") {
	$displaylinks[] = "<img src=\"images/shop/stats.gif\" alt=\"$lang[shop_textstats]\" border=\"0\" /> <a href=\"shop_stats.php\">$lang[shop_textstats]</a>";
}

$displaylinks = implode(' &nbsp; ', $displaylinks);

if($displaylinks != "") {
	eval("echo (\"".template('shop_links')."\");");
}

eval("echo (\"".template('shop_footer')."\");");

end_time();

eval("echo (\"".template('footer')."\");");

?>