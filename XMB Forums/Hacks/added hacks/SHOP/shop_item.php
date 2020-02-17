<?php
/*
	SHOP HACK v1.3 by NFPUNK/FLIXON

	If you require support please post in the forum
	at www.flixon.com/shop/forum.  Thanks

	- nfpunk/Flixon
*/

require "./header.php";
loadtemplates('header', 'footer', 'footer_load', 'footer_querynum', 'footer_phpsql', 'footer_totaltime', 'css', 'shop_cat_password', 'shop_item_rate', 'shop_item_cusername', 'shop_item_avatar', 'shop_item_color', 'shop_item_color_preview', 'shop_item_image', 'shop_item_cstatus', 'shop_item_item', 'shop_info', 'shop_links', 'shop_footer');

$query = $db->query("SELECT * FROM $table_shop_settings");
$set = $db->fetch_array($query);
$db->free_result($query);

if(isset($goto) && $goto == "lastadd") {
	$cid = (isset($cid) && is_numeric($cid)) ? (int) $cid : 0;

	$query = $db->query("SELECT id FROM $table_shop_items WHERE cid='$cid' ORDER BY dateline DESC LIMIT 0, 1");
	$iid = $db->result($query, 0);
	$db->free_result($query);
}

$iid = (isset($iid) && is_numeric($iid)) ? (int) $iid : 0;

$query = $db->query("SELECT * FROM $table_shop_items WHERE id='$iid'");
$item = $db->fetch_array($query);
$db->free_result($query);

$query = $db->query("SELECT * FROM $table_shop_cats WHERE id='$item[cid]'");
$cat = $db->fetch_array($query);
$db->free_result($query);

if($cat['cid'] != 0) {
	$query = $db->query("SELECT id, catname FROM $table_shop_cats WHERE id='$cat[cid]'");
	$upcat = $db->fetch_array($query);
	$db->free_result($query);

	$navigation = "&raquo; <a href=\"shop.php\">$lang[shop_title]</a> &raquo; <a href=\"shop_category.php?cid=$upcat[id]\">$upcat[catname]</a> &raquo; <a href=\"shop_category.php?cid=$cat[id]\">$cat[catname]</a> &raquo; $item[itemname]";
} else {
	$navigation = "&raquo; <a href=\"shop.php\">$lang[shop_title]</a> &raquo; <a href=\"shop_category.php?cid=$cat[id]\">$cat[catname]</a> &raquo; $item[itemname]";
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

if($item['status'] != "on") {
	error($lang['shop_item_off'], false);
}

if(trim($cat['password']) != "" && $_COOKIE['cidpw'.$cat['id']] != $cat['password'] && $status != "Super Administrator") {
	eval("echo (\"".template('shop_cat_password')."\");");
	end_time();
	eval("echo (\"".template('footer')."\");");
	exit();
}

if(!$action) {
	// Change Username

	if($item['feature'] == "cusername") {
		if(!isset($submit) || !$submit) {
			eval("echo (\"".template('shop_item_cusername')."\");");
		} else {
			if($self['money'] >= $item['price'] && $item['stock'] != 0) {
				$find = array('<', '>', '|', '"', '[', ']', '\\', '&nbsp');

				foreach($find as $needle) {
					if(false !== strstr($newusername, $needle)) {
						error($lang[shop_item_username_invalid].' (- '.$needle.' -)', false);
					}
				}

				$newusername = trim($newusername);

				$query = $db->query("SELECT username FROM $table_members WHERE username='$newusername'");

				if($member = $db->fetch_array($query)) {					
					error($lang['shop_item_username_alreadyreg'], false);
				}

				$db->free_result($query);

				$query = $db->query("SELECT name FROM $table_restricted WHERE name='$newusername'");

				if($member = $db->fetch_array($query)) {
					error($lang['shop_item_username_restricted'], false);
				}

				$db->free_result($query);

				$thatime = time();

				$db->query("INSERT INTO $table_shop_bank (fromuid, touid, dateline, amount, comment, type) VALUES ('$self[uid]', 0, '$thatime', '$item[price]', '$item[itemname]', 'shop')");
				$db->query("UPDATE $table_shop_items SET stock=stock-1, sold=sold+1 WHERE id='$iid'");
				$db->query("UPDATE $table_buddys SET username='$newusername' WHERE username='$xmbuser'");
				$db->query("UPDATE $table_buddys SET buddyname='$newusername' WHERE buddyname='$xmbuser'");
				$db->query("UPDATE $table_favorites SET username='$newusername' WHERE username='$xmbuser'");
				$db->query("UPDATE $table_forums SET moderator='$newusername' WHERE moderator='$xmbuser'");
				$db->query("UPDATE $table_members SET username='$newusername', money=money-'$item[price]' WHERE username='$xmbuser'");
				$db->query("UPDATE $table_posts SET author='$newusername' WHERE author='$xmbuser'");
				$db->query("UPDATE $table_threads SET author='$newusername' WHERE author='$xmbuser'");
				$db->query("UPDATE $table_u2u SET msgto='$newusername' WHERE msgto='$xmbuser'");
				$db->query("UPDATE $table_u2u SET msgfrom='$newusername' WHERE msgfrom='$xmbuser'");
				$db->query("UPDATE $table_u2u SET owner='$newusername' WHERE owner='$xmbuser'");
				$db->query("UPDATE $table_whosonline SET username='$newusername' WHERE username='$xmbuser'");

				$query = $db->query("SELECT * FROM $table_forums WHERE lastpost LIKE '$xmbuser'");

				while($lastposter_data = $db->fetch_array($query)) {
					$lastpost_oldval = $lastposter_data['lastpost'];
					$lastpost_newval = ereg_replace($xmbuser, $newusername, $lastpost_oldval);

					$db->query("UPDATE $table_forums SET lastpost='$lastpost_newval' WHERE lastpost='$lastpost_oldval'");
				}

				$db->free_result($query);

				$query = $db->query("SELECT * FROM $table_threads WHERE lastpost LIKE '$xmbuser'");

				while($lastposter_data = $db->fetch_array($query)) {
					$lastpost_oldval = $lastposter_data['lastpost'];
					$lastpost_newval = ereg_replace($xmbuser, $newusername, $lastpost_oldval);

					$db->query("UPDATE $table_threads SET lastpost='$lastpost_newval' WHERE lastpost='$lastpost_oldval'");
				}

				$db->free_result($query);

				$query = $db->query("SELECT * FROM $table_forums WHERE userlist LIKE '$xmbuser'");

				while($userlist_data = $db->fetch_array($query)) {
					$userlist_oldval = $userlist_data['userlist'];
					$userlist_newval = ereg_replace($xmbuser, $newusername, $userlist_oldval);
					echo "Test line 0: $userlist_newval";

					$db->query("UPDATE $table_forums SET userlist='$userlist_newval' WHERE userlist='$userlist_oldval'");
				}

				$db->free_result($query);

				$outputtext = $lang['shop_item_username_update'];
				eval("echo (\"".template('shop_info')."\");");
				redirect("misc.php?action=login", 2, X_REDIRECT_JS);
			} else {
				$outputtext = $lang['shop_item_noupdate'];
				eval("echo (\"".template('shop_info')."\");");
				redirect("shop_category.php?cid=$cat[id]", 2, X_REDIRECT_JS);
			}
		}
	}

	// Username Glow/Change Colour

	else if($item['feature'] == "glow" || $item['feature'] == "color") {
		if($item['feature'] == "glow") {
			$lang['shop_textitemcolorinfo'] = $lang['shop_textitemcolorinfo1'];
			$field = "glowcolor";
		} else {
			$lang['shop_textitemcolorinfo'] = $lang['shop_textitemcolorinfo2'];
			$field = "hexcolor";
		}

		if(!isset($submit) || !$submit) {
			// Preview Name

			$hexcolorselect = array();
			$glowcolorselect = array();

			if(!isset($hexcolor) || !eregi("^[a-f0-9]{6}$", $hexcolor)) {
				$hexcolor1 = "";
				$hexcolor2 = "";
			} else {
				$hexcolor1 = "#$hexcolor";
				$hexcolor2 = "color:#$hexcolor";

				$hexcolorselect['X'.$hexcolor] = "selected";
			}

			if(!isset($glowcolor) || !eregi("^[a-f0-9]{6}$", $glowcolor) ) {
				$span1 = "<font color=\"$hexcolor1\">";
				$span2 = "</font>";
			} else {
				$span1 = "<font	style=\"width:100%; $hexcolor2; filter:glow(color=#$glowcolor, strength=2)\">";
				$span2 = "</font>";

				$glowcolorselect['X'.$glowcolor] = "selected";
			}

			$username = "$span1$xmbuser$span2";

			eval("echo (\"".template('shop_item_color_preview')."\");");
			eval("echo (\"".template('shop_item_color')."\");");
		} else {
			if($self['money'] >= $item['price'] && $item['stock'] != 0) {
				if(!eregi("^[a-f0-9]{6}$", $color)) {
					exit();
				}

				$thatime = time();

				$db->query("INSERT INTO $table_shop_bank (fromuid, touid, dateline, amount, comment, type) VALUES ('$self[uid]', 0, '$thatime', '$item[price]', '$item[itemname]', 'shop')");
				$db->query("UPDATE $table_shop_items SET stock=stock-1, sold=sold+1 WHERE id='$iid'");
				$db->query("UPDATE $table_members SET $field='$color', money=money-'$item[price]' WHERE username='$xmbuser'");

				$outputtext = $lang['shop_item_color_update'];
				eval("echo (\"".template('shop_info')."\");");
				redirect("shop_category.php?cid=$cat[id]", 2, X_REDIRECT_JS);
			} else {
				$outputtext = $lang['shop_item_noupdate'];
				eval("echo (\"".template('shop_info')."\");");
				redirect("shop_category.php?cid=$cat[id]", 2, X_REDIRECT_JS);
			}
		}
	}

	// Personal Photo/Upload Avatar (100*100/200*200)

	else if($item['feature'] == "pp" || $item['feature'] == "avatar100" || $item['feature'] == "avatar200") {
		if($item['feature'] == "pp") {
			$max_image_fsize = '50000'; // 50kb file size
			$max_image_psize = array('400', '300'); // 400x300 ('width', 'height')
			$upldir = "pphotos";
			$field = "pphoto";
		} else if($item['feature'] == "avatar100") {
			$max_image_fsize = '50000'; // 50kb file size
			$max_image_psize = array('100', '100'); // 100x100 ('width', 'height')
			$upldir = "avatars";
			$field = "avatar";
		} else {
			$max_image_fsize = '80000'; // 80kb file size
			$max_image_psize = array('200', '200'); // 200x200 ('width', 'height')
			$upldir = "avatars";
			$field = "avatar";
		}

		if(!isset($submit) || !$submit) {
			eval("echo (\"".template('shop_item_avatar')."\");");
		} else {
			if($self['money'] >= $item['price'] && $item['stock'] != 0) {
				if(!is_uploaded_file($HTTP_POST_FILES['flocation']['tmp_name'])) {
					$outputtext = $lang['shop_item_upload_noimage'];
					eval("echo (\"".template('shop_info')."\");");
					redirect("shop_item.php?iid=$iid", 2, X_REDIRECT_JS);
				} else {
					$upload_file = $HTTP_POST_FILES['flocation']['name'];
					$temp = $HTTP_POST_FILES['flocation']['tmp_name'];
					$extension = substr($upload_file, -4);

					if($extension == ".jpg" XOR $extension == ".png" XOR $extension == ".gif" XOR $extension == ".JPG" XOR $extension == ".PNG" XOR $extension == ".GIF" XOR $extension == "jpeg" XOR $extension == "JPEG") {
						if($extension == "JPEG" xor $extension == "jpeg") {
							$extension = ".jpeg";
						}

						$imageurl = "images/$upldir/$xmbuser$extension";
						move_uploaded_file($temp, $imageurl);

						$size = filesize($imageurl);

						if($size > $max_image_fsize) {
							unlink($imageurl);
							error($lang['shop_admin_item_toobig'].' '.$max_image_fsize.' bytes!', false);
						}

						$SizeArray = getimagesize($imageurl);

						if($SizeArray[0] > $max_image_psize[0] || $SizeArray[1] > $max_image_psize[1]) {
							unlink($imageurl);
							error($lang['shop_admin_item_toobig'].' '.$max_image_psize[0].' * '.$max_image_psize[1].'!', false);
						}
					} else {
						error($lang['shop_admin_item_wrongtype'], false);
					}

					$thatime = time();

					$db->query("INSERT INTO $table_shop_bank (fromuid, touid, dateline, amount, comment, type) VALUES ('$self[uid]', 0, '$thatime', '$item[price]', '$item[itemname]', 'shop')");
					$db->query("UPDATE $table_shop_items SET stock=stock-1, sold=sold+1 WHERE id='$iid'");
					$db->query("UPDATE $table_members SET $field='$imageurl', money=money-'$item[price]' WHERE username='$xmbuser'");

					$outputtext = $lang['shop_item_update'];
					eval("echo (\"".template('shop_info')."\");");
					redirect("shop_category.php?cid=$cat[id]", 2, X_REDIRECT_JS);
				}
			} else {
				$outputtext = $lang['shop_item_noupdate'];
				eval("echo (\"".template('shop_info')."\");");
				redirect("shop_category.php?cid=$cat[id]", 2, X_REDIRECT_JS);
			}
		}
	}

	// Change Custom Status

	else if($item['feature'] == "cstatus") {
		if(!isset($submit) || !$submit) {
			eval("echo (\"".template('shop_item_cstatus')."\");");
		} else {
			if($self['money'] >= $item['price'] && $item['stock'] != 0) {
				$newcstatus = isset($newcstatus) ? checkInput($newcstatus, '', '', 'javascript', false) : '';

				$thatime = time();

				$db->query("INSERT INTO $table_shop_bank (fromuid, touid, dateline, amount, comment, type) VALUES ('$self[uid]', 0, '$thatime', '$item[price]', '$item[itemname]', 'shop')");
				$db->query("UPDATE $table_shop_items SET stock=stock-1, sold=sold+1 WHERE id='$iid'");
				$db->query("UPDATE $table_members SET customstatus='$newcstatus', money=money-'$item[price]' WHERE username='$xmbuser'");

				$outputtext = $lang['shop_item_cstatus_update'];
				eval("echo (\"".template('shop_info')."\");");
				redirect("shop_category.php?cid=$cat[id]", 2, X_REDIRECT_JS);
			} else {
				$outputtext = $lang['shop_item_noupdate'];
				eval("echo (\"".template('shop_info')."\");");
				redirect("shop_category.php?cid=$cat[id]", 2, X_REDIRECT_JS);
			}
		}
	}

	// Items

	else {
		if(!isset($submit) || !$submit) {
			if($item['imageurl'] == "") {
				$image = "images/shop/noitempic.gif";
			} else {
				$image = $item['imageurl'];
			}

			eval("echo (\"".template('shop_item_item')."\");");
		} else {
			if($self['money'] >= $item['price'] && $item['stock'] != 0) {
				// Check that user has not purchased the item before

				$query = $db->query("SELECT COUNT(*) FROM $table_member_items WHERE iid='$iid' && uid='$self[uid]'");
				$items = $db->result($query, 0);
				$db->free_result($query);

				if($items != 0) {
					if($item['multiple'] == "off") {
						error($lang['shop_item_noupdate2'], false);
					} else {
						$db->query("UPDATE $table_member_items SET quantity=quantity+1 WHERE iid='$iid' && uid='$self[uid]'");
					}
				} else {
					$db->query("INSERT INTO $table_member_items (iid, uid, quantity) VALUES ('$iid', '$self[uid]', 1)");
				}

				$db->query("UPDATE $table_members SET money=money-'$item[price]' WHERE username='$xmbuser'");
				$db->query("UPDATE $table_shop_items SET stock=stock-1, sold=sold+1 WHERE id='$iid'");

				$thatime = time();

				if($cat['ownermoney'] == "on" && $item['owner'] != 0) {
					$db->query("INSERT INTO $table_shop_bank (fromuid, touid, dateline, amount, comment, type) VALUES ('$self[uid]', '$item[owner]', '$thatime', '$item[price]', '$item[itemname]', 'shop')");
					$db->query("UPDATE $table_members SET money=money+'$item[price]' WHERE uid='$item[owner]'");
				} else {
					$db->query("INSERT INTO $table_shop_bank (fromuid, touid, dateline, amount, comment, type) VALUES ('$self[uid]', 0, '$thatime', '$item[price]', '$item[itemname]', 'shop')");
				}

				$outputtext = $lang['shop_item_update'];
				eval("echo (\"".template('shop_info')."\");");
				redirect("shop_category.php?cid=$cat[id]", 2, X_REDIRECT_JS);
			} else {
				$outputtext = $lang['shop_item_noupdate'];
				eval("echo (\"".template('shop_info')."\");");
				redirect("shop_category.php?cid=$cat[id]", 2, X_REDIRECT_JS);
			}
		}
	}
}

// Rate Item

if($action == "rate") {
	$query = $db->query("SELECT COUNT(*) FROM $table_shop_votes WHERE iid='$iid'");
	$nbrows = $db->result($query, 0);
	$db->free_result($query);

	if($nbrows != 0) {
		$query = $db->query("SELECT uid FROM $table_shop_votes WHERE iid='$iid'");
		$vote = $db->result($query, 0);
		$db->free_result($query);
	} else {
		$vote = 0;
	}

	if($set['rating'] != "on") {
		error($lang['shop_item_rate_off'], false);
	}

	if($vote == $self['uid']) {
		error($lang['shop_item_rate_nopage'], false);
	}

	if(!isset($submit) || !$submit) {
		eval("echo (\"".template('shop_item_rate')."\");");
	} else {
		$db->query("UPDATE $table_shop_items SET votes=votes+1, rate=rate+'$rate' WHERE id='$iid'");
		$db->query("INSERT INTO $table_shop_votes (iid, uid) VALUES ('$item[id]', '$self[uid]')");

		$outputtext = "$lang[shop_item_rate_update] $item[itemname]";
		eval("echo (\"".template('shop_info')."\");");
		redirect("shop_item.php?iid=$iid", 2, X_REDIRECT_JS);
	}
}

// Links

$displaylinks = array();

if(X_ADMIN) {
	$displaylinks[] = "<img src=\"images/shop/admin.gif\" alt=\"$lang[shop_textadminpanel]\" border=\"0\" /> <a href=\"shop_admin.php\">$lang[shop_textadminpanel]</a>";
}

$private = explode("|", $cat['private']);
$userlist = explode("|", $cat['userlist']);

$authorization = privfcheck($private[0], $userlist[0]);

if(($cat['creatoronly'] == "on" && $cat['owner'] == $self['uid']) || $authorization) {
    	$displaylinks[] = "<img src=\"images/shop/newitem.gif\" alt=\"$lang[shop_textnewitem]\" border=\"0\" /> <a href=\"shop_edit.php?action=newitem&amp;cid=$cat[id]\">$lang[shop_textnewitem]</a>";
	$displaylinks[] = "<img src=\"images/shop/edititem.gif\" alt=\"$lang[shop_textedititem]\" border=\"0\" /> <a href=\"shop_edit.php?action=edititem&amp;iid=$iid\">$lang[shop_textedititem]</a>";
	$displaylinks[] = "<img src=\"images/shop/delete.gif\" alt=\"$lang[shop_textdeleteitem]\" border=\"0\" /> <a href=\"shop_edit.php?action=deleteitem&amp;iid=$iid\">$lang[shop_textdeleteitem]</a>";
}

if($set['rating'] == "on") {
	$displaylinks[] = "<img src=\"images/shop/rate.gif\" alt=\"$lang[shop_textrateitem]\" border=\"0\" /> <a href=\"shop_item.php?action=rate&amp;iid=$iid\">$lang[shop_textrateitem]</a>";
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