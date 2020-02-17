<?php
/*
	SHOP HACK v1.3 by NFPUNK/FLIXON

	If you require support please post in the forum
	at www.flixon.com/shop/forum.  Thanks

	- nfpunk/Flixon
*/

require "./header.php";
loadtemplates('header', 'footer', 'footer_load', 'footer_querynum', 'footer_phpsql', 'footer_totaltime', 'css', 'shop_cat_password', 'shop_subcats', 'shop_subcats_row', 'shop_subcats_lastadd', 'shop_items', 'shop_items_row', 'shop_info', 'shop_links', 'shop_footer');

$query = $db->query("SELECT * FROM $table_shop_settings");
$set = $db->fetch_array($query);
$db->free_result($query);

$cid = (isset($cid) && is_numeric($cid)) ? (int) $cid : 0;

$query = $db->query("SELECT * FROM $table_shop_cats WHERE id='$cid'");
$cat = $db->fetch_array($query);
$db->free_result($query);

$db->query("UPDATE $table_shop_cats SET views=views+1 WHERE id='$cid'");

if($cat['cid'] != 0) {
	$query = $db->query("SELECT id, catname FROM $table_shop_cats WHERE id='$cat[cid]'");
	$upcat = $db->fetch_array($query);
	$db->free_result($query);

	$navigation = "&raquo; <a href=\"shop.php\">$lang[shop_title]</a> &raquo; <a href=\"shop_category.php?cid=$upcat[id]\">$upcat[catname]</a> &raquo; $cat[catname]";
} else {
	$navigation = "&raquo; <a href=\"shop.php\">$lang[shop_title]</a> &raquo; $cat[catname]";
}

eval("\$css = \"".template('css')."\";");
eval("echo (\"".template('header')."\");");

$private = explode("|", $set['private']);
$userlist = explode("|", $set['userlist']);

$authorization = privfcheck($private[1], $userlist[1]);

if(!$authorization || X_GUEST) {
    	error($lang['shop_nopage'], false);
}

if($cat['status'] != "on") {
	error($lang['shop_cat_off'], false);
}

if(!isset($pw) || !$pw) {
	$pw = "";
}

if(trim($cat['password']) != "" && $_COOKIE['cidpw'.$cid] != $cat['password'] && $status != "Super Administrator") {
	if($pw != $cat['password']) {
		eval("echo (\"".template('shop_cat_password')."\");");
		end_time();
		eval("echo (\"".template('footer')."\");");
	} else {
		put_cookie("cidpw$cid", $pw, (time() + (86400*30)), $cookiepath, $cookiedomain);
		header("Location: shop_category.php?cid=$cid");
	}

	exit();
}

// Sub Categories

if($set['subcats'] == "on") {
	$subcatsrows = '';

	$query = $db->query("SELECT * FROM $table_shop_cats WHERE cid='$cid' && status='on' ORDER BY displayorder, catname");

	while($subcat = $db->fetch_array($query)) {
		if($subcat['items'] >= $set['hotcat']) {
			$folder = "$imgdir/hot_folder.gif";
		} else {
			$folder = "$imgdir/folder.gif";
		}

		if($subcat['lastadd'] != '') {
			$lastadd = explode("|", $subcat['lastadd']);

			$encodeuser = rawurlencode($lastadd['1']);

			$lastadddate = gmdate($dateformat, $lastadd[0] + ($timeoffset * 3600) + ($addtime * 3600));
			$lastaddtime = gmdate($timecode, $lastadd[0] + ($timeoffset * 3600) + ($addtime * 3600));

			$lastadd = "$lastadddate $lang[shop_textat] $lastaddtime<br />$lang[shop_textby] <a href=\"$boardurl/member.php?action=viewpro&amp;member=$encodeuser\">$lastadd[1]</a>";
			eval("\$lastaddrow = \"".template('shop_subcats_lastadd')."\";");
		} else {
			$lastaddrow = $lang['shop_textnever'];
		}

		$subcat['description'] = stripslashes($subcat['description']);

		eval("\$subcatsrows .= \"".template('shop_subcats_row')."\";");
	}

	$db->free_result($query);

	if($subcatsrows != "") {
		eval("echo (\"".template('shop_subcats')."\");");
	}
}

// Items

$itemsrows = '';

$query = $db->query("SELECT * FROM $table_shop_items WHERE cid='$cid' && status='on' ORDER BY displayorder, itemname");

while($item = $db->fetch_array($query)) {
	if($item['imageurl'] == "") {
		if($item['sold'] >= $set['hotitem']) {
			$image = "images/shop/noitempic.gif"; // Hot Item - Change this if you wish to use this feature
		} else {
			$image = "images/shop/noitempic.gif";
		}
	} else {
		$image = $item['imageurl'];
	}

	if($set['rating'] == "on" && $item['votes'] != "0") {
		$num = ceil($item['rate'] / $item['votes']);

		$rate = " - ";

		for($i = 1; $i <= $num; $i++) {
			$rate .= "<img src=\"$imgdir/star.gif\" border=\"0\" />";
		}

		$rate .= " ($lang[shop_textvotes]: $item[votes])";
	} else {
		$rate = "";
	}

	$item['description'] = stripslashes($item['description']);

	eval("\$itemsrows .= \"".template('shop_items_row')."\";");
}

$db->free_result($query);

if($itemsrows != "") {
	eval("echo (\"".template('shop_items')."\");");
}

// Links

$displaylinks = array();

if(X_ADMIN) {
	$displaylinks[] = "<img src=\"images/shop/admin.gif\" alt=\"$lang[shop_textadminpanel]\" border=\"0\" /> <a href=\"shop_admin.php\">$lang[shop_textadminpanel]</a>";
}

$authorization = privfcheck($private[0], $userlist[0]);

if(($cat['creatoronly'] == "on" && $cat['owner'] == $self['uid']) || $authorization) {
    	$displaylinks[] = "<img src=\"images/shop/editcat.gif\" alt=\"$lang[shop_texteditcat]\" border=\"0\" /> <a href=\"shop_edit.php?action=editcat&amp;cid=$cid\">$lang[shop_texteditcat]</a>";
	$displaylinks[] = "<img src=\"images/shop/delete.gif\" alt=\"$lang[shop_textdeletecat]\" border=\"0\" /> <a href=\"shop_edit.php?action=deletecat&amp;cid=$cid\">$lang[shop_textdeletecat]</a>";
}

$private = explode("|", $cat['private']);
$userlist = explode("|", $cat['userlist']);

$authorization = privfcheck($private[0], $userlist[0]);

if(($cat['creatoronly'] == "on" && $cat['owner'] == $self['uid']) || $authorization) {
    	if($set['subcats'] == "on" && $cat['cid'] == 0) {
		$displaylinks[] = "<img src=\"images/shop/newcat.gif\" alt=\"$lang[shop_textnewsubcat]\" border=\"0\" /> <a href=\"shop_edit.php?action=newsubcat&amp;cid=$cid\">$lang[shop_textnewsubcat]</a>";
	}

	$displaylinks[] = "<img src=\"images/shop/newitem.gif\" alt=\"$lang[shop_textnewitem]\" border=\"0\" /> <a href=\"shop_edit.php?action=newitem&amp;cid=$cid\">$lang[shop_textnewitem]</a>";
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