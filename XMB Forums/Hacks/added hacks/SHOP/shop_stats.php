<?php
/*
	SHOP HACK v1.3 by NFPUNK/FLIXON

	If you require support please post in the forum
	at www.flixon.com/shop/forum.  Thanks

	- nfpunk/Flixon
*/

require "./header.php";
loadtemplates('header', 'footer', 'footer_load', 'footer_querynum', 'footer_phpsql', 'footer_totaltime', 'css', 'shop_stats', 'shop_info', 'shop_links', 'shop_footer');

$query = $db->query("SELECT * FROM $table_shop_settings");
$set = $db->fetch_array($query);
$db->free_result($query);

$navigation = "&raquo; <a href=\"shop.php\">$lang[shop_title]</a> &raquo; $lang[shop_textstats]";

eval("\$css = \"".template('css')."\";");
eval("echo (\"".template('header')."\");");

$private = explode("|", $set['private']);
$userlist = explode("|", $set['userlist']);

$authorization = privfcheck($private[1], $userlist[1]);

if(!$authorization || X_GUEST) {
    	error($lang['shop_nopage'], false);
}

if($set['stats'] != "on") {
	error($lang['shop_stats_off'], false);
}

// Get total amount of shops
$query 		= $db->query("SELECT COUNT(*) FROM $table_shop_cats");
$shops 		= $db->result($query, 0);
$db->free_result($query);

// Get total amount of shops that are ON
$query 		= $db->query("SELECT COUNT(*) FROM $table_shop_cats WHERE status='on'");
$shopson 	= $db->result($query, 0);
$db->free_result($query);

// Get total amount of items
$query 		= $db->query("SELECT COUNT(*) FROM $table_shop_items");
$items	 	= $db->result($query, 0);
$db->free_result($query);

// Get total amount of members
$query 		= $db->query("SELECT COUNT(*) FROM $table_members");
$members 	= $db->result($query, 0);
$db->free_result($query);

// Get amount of money per member
$memmoney 	= 0;
$query 		= $db->query("SELECT SUM(money) FROM $table_members");
$memmoney 	= number_format(($db->result($query, 0) / $members), 2);
$db->free_result($query);

// Get richest member
$query 		= $db->query("SELECT username FROM $table_members ORDER BY money DESC LIMIT 0, 1");
$memrich 	= $db->result($query, 0);
$db->free_result($query);
$memrichhtml	= "<a href=\"member.php?action=viewpro&amp;member=".rawurlencode($memrich)."\">$memrich</a>";

// Get top 5 most purchased items
$viewmost = '';
$query 		= $db->query("SELECT id, itemname, sold FROM $table_shop_items WHERE status='on' ORDER BY sold DESC LIMIT 0, 5");
while($sold = $db->fetch_array($query)) {
	$viewmost .= "<a href=\"shop_item.php?iid=$sold[id]\">$sold[itemname]</a> ($sold[sold] $lang[shop_textsold])<br />";
}
$db->free_result($query);

eval($lang['shop_textevalstats1']);
eval($lang['shop_textevalstats2']);
eval($lang['shop_textevalstats3']);
eval($lang['shop_textevalstats4']);
eval($lang['shop_textevalstats5']);

eval("echo (\"".template('shop_stats')."\");");

// Links

$displaylinks = array();

if(X_ADMIN) {
	$displaylinks[] = "<img src=\"images/shop/admin.gif\" alt=\"$lang[shop_textadminpanel]\" border=\"0\" /> <a href=\"shop_admin.php\">$lang[shop_textadminpanel]</a>";
}

if($set['stats'] == "on") {
	$displaylinks[] = "<img src=\"images/shop/search.gif\" alt=\"$lang[shop_textsearch]\" border=\"0\" /> <a href=\"shop_search.php\">$lang[shop_textsearch]</a>";
}

$displaylinks = implode(' &nbsp; ', $displaylinks);

if($displaylinks != "") {
	eval("echo (\"".template('shop_links')."\");");
}

eval("echo (\"".template('shop_footer')."\");");

end_time();

eval("echo (\"".template('footer')."\");");

?>