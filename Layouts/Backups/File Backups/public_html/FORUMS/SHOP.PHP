<?php
/*
	SHOP HACK v1.3 by NFPUNK/FLIXON

	If you require support please post in the forum
	at www.flixon.com/shop/forum.  Thanks

	- nfpunk/Flixon
*/

require "./header.php";
loadtemplates('header', 'footer', 'footer_load', 'footer_querynum', 'footer_phpsql', 'footer_totaltime', 'css', 'shop_rules', 'shop_cats', 'shop_cats_row', 'shop_cats_lastadd', 'shop_userpanel', 'shop_info', 'shop_links', 'shop_footer');

$query = $db->query("SELECT * FROM $table_shop_settings");
$set = $db->fetch_array($query);
$db->free_result($query);

$navigation = "&raquo; $lang[shop_title]";

eval("\$css = \"".template('css')."\";");
eval("echo (\"".template('header')."\");");

$private = explode("|", $set['private']);
$userlist = explode("|", $set['userlist']);

$authorization = privfcheck($private[1], $userlist[1]);

if(!$authorization || X_GUEST) {
    	error($lang['shop_nopage'], false);
}

// Categories

if((!isset($acceptrules) || !$acceptrules) && $set['shoprules'] == "on") {
	$set['shoprulestxt'] = stripslashes($set['shoprulestxt']);
	$set['shoprulestxt'] = nl2br($set['shoprulestxt']);

	eval("echo (\"".template('shop_rules')."\");");
} else {
	$catsrows = '';

	$query = $db->query("SELECT * FROM $table_shop_cats WHERE cid='0' && status='on' ORDER BY displayorder, catname");

	while($cat = $db->fetch_array($query)) {
		if($cat['items'] >= $set['hotcat']) {
			$folder = "$imgdir/hot_folder.gif";
		} else {
			$folder = "$imgdir/folder.gif";
		}

		if($cat['lastadd'] != "") {
			$lastadd = explode("|", $cat['lastadd']);

			$encodeuser = rawurlencode($lastadd[1]);

			$lastadddate = gmdate($dateformat, $lastadd[0] + ($timeoffset * 3600) + ($addtime * 3600));
			$lastaddtime = gmdate($timecode, $lastadd[0] + ($timeoffset * 3600) + ($addtime * 3600));

			$lastadd = "$lastadddate $lang[shop_textat] $lastaddtime<br />$lang[shop_textby] <a href=\"$boardurl/member.php?action=viewpro&amp;member=$encodeuser\">$lastadd[1]</a>";
			eval("\$lastaddrow = \"".template('shop_cats_lastadd')."\";");
		} else {
			$lastaddrow = $lang['shop_textnever'];
		}

		$cat['description'] = stripslashes($cat['description']);

		eval("\$catsrows .= \"".template('shop_cats_row')."\";");
	}

	$db->free_result($query);

	eval("echo (\"".template('shop_cats')."\");");
	eval("echo (\"".template('shop_userpanel')."\");");
}

// Links

$displaylinks = array();

if(X_ADMIN) {
	$displaylinks[] = "<img src=\"images/shop/admin.gif\" alt=\"$lang[shop_textadminpanel]\" border=\"0\" /> <a href=\"shop_admin.php\">$lang[shop_textadminpanel]</a>";
}

$authorization = privfcheck($private[0], $userlist[0]);

if($authorization) {
    	$displaylinks[] = "<img src=\"images/shop/newcat.gif\" alt=\"$lang[shop_textnewcat]\" border=\"0\" /> <a href=\"shop_edit.php?action=newcat\">$lang[shop_textnewcat]</a>";
}

if($set['search'] == "on") {
	$displaylinks[] = "<img src=\"images/shop/search.gif\" alt=\"$lang[shop_textsearch]\" border=\"0\" /> <a href=\"shop_search.php\">$lang[shop_textsearch]</a>";
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