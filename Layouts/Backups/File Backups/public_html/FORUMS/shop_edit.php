<?php
/*
	SHOP HACK v1.3 by NFPUNK/FLIXON

	If you require support please post in the forum
	at www.flixon.com/shop/forum.  Thanks

	- nfpunk/Flixon
*/

require "./header.php";
loadtemplates('header', 'footer', 'footer_load', 'footer_querynum', 'footer_phpsql', 'footer_totaltime', 'css', 'shop_edit_cat_new', 'shop_edit_cat_edit', 'shop_edit_cat_delete', 'shop_edit_subcat_new', 'shop_edit_item_new', 'shop_edit_item_edit', 'shop_edit_item_delete', 'shop_info', 'shop_footer');

$query = $db->query("SELECT * FROM $table_shop_settings");
$set = $db->fetch_array($query);
$db->free_result($query);

$navigation = "&raquo; <a href=\"shop.php\">$lang[shop_title]</a> &raquo; $lang[shop_texteditshop]";

eval("\$css = \"".template('css')."\";");
eval("echo (\"".template('header')."\");");

// New Category

if($action == "newcat") {
	$private = explode("|", $set['private']);
	$userlist = explode("|", $set['userlist']);

	$authorization = privfcheck($private[0], $userlist[0]);

	if(!$authorization) {
    		error($lang['shop_admin_newcat_noupdate'], false);
	}

	if(!isset($submit) || !$submit) {
		eval("echo (\"".template('shop_edit_cat_new')."\");");
	} else {
		$catname	= isset($catname) ? checkInput($catname, '', '', 'javascript', false) : '';
		$description	= isset($description) ? checkInput($description, '', '', 'javascript', false) : '';
		$displayorder	= (isset($displayorder) && is_numeric($displayorder)) ? (int) $displayorder : 0;
		$catstatus	= (isset($catstatus) && $catstatus == 'on') ? 'on' : 'off';

		$description = addslashes($description);

		if(ereg('"', $password) || ereg("'", $password)) {
			error($lang['shop_admin_password_invalid'], false);
		}

		$db->query("INSERT INTO $table_shop_cats (id, cid, owner, catname, description, displayorder, private, userlist, lastadd, password, status, creatoronly, views, items, ownermoney) VALUES ('', '0', '$self[uid]', '$catname', '$description', '$displayorder', '3|1', '|', '', '$password', '$catstatus', 'off', 0, 0, 'off')");

		$outputtext = $lang['shop_admin_newcat_update'];
		eval("echo (\"".template('shop_info')."\");");
		redirect("shop_edit.php?action=newcat", 2, X_REDIRECT_JS);
	}
}

// Edit Category

if($action == "editcat") {
	$cid = (isset($cid) && is_numeric($cid)) ? (int) $cid : 0;

	$query = $db->query("SELECT * FROM $table_shop_cats WHERE id='$cid'");
	$cat = $db->fetch_array($query);
	$db->free_result($query);

	$private = explode("|", $set['private']);
	$userlist = explode("|", $set['userlist']);

	$authorization = privfcheck($private[0], $userlist[0]);

	if(($cat['creatoronly'] == "on" && $cat['owner'] != $self['uid'] && !$authorization) || ($cat['creatoronly'] == "off" && !$authorization)) {
		error($lang['shop_admin_editcat_noupdate'], false);
	}

	if(!isset($submit) || !$submit) {
		if($cat['status'] == "on") {
			$statusoff = "";
			$statuson = "selected";
		} else {
			$statusoff = "selected";
			$statuson = "";
		}

		$cat['description'] = stripslashes($cat['description']);

		eval("echo (\"".template('shop_edit_cat_edit')."\");");
	} else {
		$catname	= isset($catname) ? checkInput($catname, '', '', 'javascript', false) : '';
		$description	= isset($description) ? checkInput($description, '', '', 'javascript', false) : '';
		$displayorder	= (isset($displayorder) && is_numeric($displayorder)) ? (int) $displayorder : 0;
		$catstatus	= (isset($catstatus) && $catstatus == 'on') ? 'on' : 'off';

		$description = addslashes($description);

		if(ereg('"', $password) || ereg("'", $password)) {
			error($lang['shop_admin_password_invalid'], false);
		}

		$db->query("UPDATE $table_shop_cats SET catname='$catname', description='$description', displayorder='$displayorder', password='$password', status='$catstatus' WHERE id='$cid'");

		$outputtext = $lang['shop_admin_editcat_update'];
		eval("echo (\"".template('shop_info')."\");");
		redirect("shop_category.php?cid=$cid", 2, X_REDIRECT_JS);
	}
}

// Delete Category

if($action == "deletecat") {
	$cid = (isset($cid) && is_numeric($cid)) ? (int) $cid : 0;

	$query = $db->query("SELECT * FROM $table_shop_cats WHERE id='$cid'");
	$cat = $db->fetch_array($query);
	$db->free_result($query);

	$private = explode("|", $set['private']);
	$userlist = explode("|", $set['userlist']);

	$authorization = privfcheck($private[0], $userlist[0]);

	if(($cat['creatoronly'] == "on" && $cat['owner'] != $self['uid'] && !$authorization) || ($cat['creatoronly'] == "off" && !$authorization)) {
		error($lang['shop_admin_deletecat_noupdate'], false);
	}

	if(!isset($submit) || !$submit) {
		eval("echo (\"".template('shop_edit_cat_delete')."\");");
	} else {
		$db->query("DELETE FROM $table_shop_cats WHERE id='$cid'");

		$nbitems = 0;

		$query = $db->query("SELECT * FROM $table_shop_items WHERE cid='$cid'");

		while($item = $db->fetch_array($query)) {
			if($item['imageurl'] != "") {
				unlink($item['imageurl']);
			}

			$db->query("DELETE FROM $table_shop_votes WHERE iid='$item[id]'");
			$db->query("DELETE FROM $table_shop_items WHERE id='$item[id]'");
			$db->query("DELETE FROM $table_member_items WHERE iid='$item[id]'");

			$nbitems++;
		}

		$db->free_result($query);

		if($cat['cid'] != 0) {
			$db->query("UPDATE $table_shop_cats SET items=items-'$nbitems' WHERE id='$cat[cid]'");
		}

		$outputtext = $lang['shop_admin_deletecat_update'];
		eval("echo (\"".template('shop_info')."\");");
		redirect("shop.php", 2, X_REDIRECT_JS);
	}
}

// New Sub Category

if($action == "newsubcat") {
	$cid = (isset($cid) && is_numeric($cid)) ? (int) $cid : 0;

	$query = $db->query("SELECT * FROM $table_shop_cats WHERE id='$cid'");
	$cat = $db->fetch_array($query);
	$db->free_result($query);

	$private = explode("|", $cat['private']);
	$userlist = explode("|", $cat['userlist']);

	$authorization = privfcheck($private[0], $userlist[0]);

	if(($cat['creatoronly'] == "on" && $cat['owner'] != $self['uid'] && !$authorization) || ($cat['creatoronly'] == "off" && !$authorization)) {
		error($lang['shop_admin_newsubcat_noupdate'], false);
	}

	if(!isset($submit) || !$submit) {
		eval("echo (\"".template('shop_edit_subcat_new')."\");");
	} else {
		$cid		= (isset($cid) && is_numeric($cid)) ? (int) $cid : 0;
		$catname	= isset($catname) ? checkInput($catname, '', '', 'javascript', false) : '';
		$description	= isset($description) ? checkInput($description, '', '', 'javascript', false) : '';
		$displayorder	= (isset($displayorder) && is_numeric($displayorder)) ? (int) $displayorder : 0;
		$catstatus	= (isset($catstatus) && $catstatus == 'on') ? 'on' : 'off';

		$description = addslashes($description);

		if(ereg('"', $password) || ereg("'", $password)) {
			error($lang['shop_admin_password_invalid'], false);
		}

		$db->query("INSERT INTO $table_shop_cats (id, cid, owner, catname, description, displayorder, private, userlist, lastadd, password, status, creatoronly, views, items, ownermoney) VALUES ('', '$cid', '$self[uid]', '$catname', '$description', '$displayorder', '3|1', '|', '', '$password', '$catstatus', 'off', 0, 0, 'off')");

		$outputtext = $lang['shop_admin_newsubcat_update'];
		eval("echo (\"".template('shop_info')."\");");
		redirect("shop_category.php?cid=$cid", 2, X_REDIRECT_JS);
	}
}

// New Item

if($action == "newitem") {
	$cid = (isset($cid) && is_numeric($cid)) ? (int) $cid : 0;

	$query = $db->query("SELECT * FROM $table_shop_cats WHERE id='$cid'");
	$cat = $db->fetch_array($query);
	$db->free_result($query);

	$private = explode("|", $cat['private']);
	$userlist = explode("|", $cat['userlist']);

	$authorization = privfcheck($private[0], $userlist[0]);

	if(($cat['creatoronly'] == "on" && $cat['owner'] != $self['uid'] && !$authorization) || ($cat['creatoronly'] == "off" && !$authorization)) {
		error($lang['shop_admin_newitem_noupdate'], false);
	}

	$query = $db->query("SELECT COUNT(*) FROM $table_shop_items WHERE cid='$cid' && owner='$self[uid]'");
	$items = $db->result($query, 0);
	$db->free_result($query);

	if($items >= $set['maxitems'] && $status != "Super Administrator" && $status != "Administrator" && $status != "Super Moderator" && $status != "Moderator") {
		error($lang[shop_admin_newitem_limit].' '.$set[maxitems].'!', false);
	}

	if(!isset($submit) || !$submit) {
		eval("echo (\"".template('shop_edit_item_new')."\");");
	} else {
		$itemname	= isset($itemname) ? checkInput($itemname, '', '', 'javascript', false) : '';
		$description	= isset($description) ? checkInput($description, '', '', 'javascript', false) : '';
		$displayorder	= (isset($displayorder) && is_numeric($displayorder)) ? (int) $displayorder : 0;
		$itemstatus	= (isset($itemstatus) && $itemstatus == 'on') ? 'on' : 'off';
		$multiple	= (isset($multiple) && $multiple == 'on') ? 'on' : 'off';
		$price		= (isset($price) && is_numeric($price)) ? (int) $price : 0;
		$stock		= (isset($stock) && is_numeric($stock)) ? (int) $stock : 0;

		$description = addslashes($description);

		if(!is_uploaded_file($HTTP_POST_FILES['flocation']['tmp_name'])) {
			$imageurl = "";
		} else {
			$upload_file = $HTTP_POST_FILES['flocation']['name'];
			$temp = $HTTP_POST_FILES['flocation']['tmp_name'];
			$extension = substr($upload_file, -4);

			if($extension == ".jpg" XOR $extension == ".png" XOR $extension == ".gif" XOR $extension == ".JPG" XOR $extension == ".PNG" XOR $extension == ".GIF" XOR $extension == "jpeg" XOR $extension == "JPEG") {
				if($extension == "JPEG" xor $extension == "jpeg") {
					$extension = ".jpeg";
				}

				$filename = $set['imagename'] + 1;
				$imageurl = "images/items/$filename$extension";
				move_uploaded_file($temp, $imageurl);

				$size = filesize($imageurl);

				if($size > $set['maxsize']) {
					unlink($imageurl);
					error($lang['shop_admin_item_toobig'].' '.$set['maxsize'].' bytes!', false);
				}

				$SizeArray = getimagesize($imageurl);

				if($SizeArray[0] > $set['maxwidth'] || $SizeArray[1] > $set['maxheight']) {
					unlink($imageurl);
					error($lang['shop_admin_item_toobig'].' '.$set['maxwidth'].' * '.$set['maxheight'].'!', false);
				}

				$db->query("UPDATE $table_shop_settings SET imagename=imagename+1");
			} else {
				error($lang['shop_item_wrongtype'], false);
			}
		}

		$thatime = time();

		$db->query("INSERT INTO $table_shop_items (id, cid, feature, owner, itemname, description, displayorder, imageurl, dateline, status, multiple, sold, rate, votes, comments, price, stock) VALUES ('', '$cid', '', '$self[uid]', '$itemname', '$description', '$displayorder', '$imageurl', '$thatime', '$itemstatus', '$multiple', 0, 0, 0, 0, '$price', '$stock')");
		$db->query("UPDATE $table_shop_cats SET lastadd='$thatime|$xmbuser', items=items+1 WHERE id='$cid'");

		if($cat['cid'] != 0) {
			$db->query("UPDATE $table_shop_cats SET items=items+1 WHERE id='$cat[cid]'");
		}

		$outputtext = $lang['shop_admin_newitem_update'];
		eval("echo (\"".template('shop_info')."\");");
		redirect("shop_edit.php?action=newitem&cid=$cid", 2, X_REDIRECT_JS);
	}
}

// Edit Item

if($action == "edititem") {
	$iid = (isset($iid) && is_numeric($iid)) ? (int) $iid : 0;

	$query = $db->query("SELECT * FROM $table_shop_items WHERE id='$iid'");
	$item = $db->fetch_array($query);
	$db->free_result($query);

	$query = $db->query("SELECT * FROM $table_shop_cats WHERE id='$item[cid]'");
	$cat = $db->fetch_array($query);
	$db->free_result($query);

	$private = explode("|", $cat['private']);
	$userlist = explode("|", $cat['userlist']);

	$authorization = privfcheck($private[0], $userlist[0]);

	if(($cat['creatoronly'] == "on" && $cat['owner'] != $self['uid'] && !$authorization) || ($cat['creatoronly'] == "off" && !$authorization)) {
		error($lang['shop_admin_edititem_noupdate'], false);
	}

	if(!isset($submit) || !$submit) {
		if($item['status'] == "on") {
			$statusoff = "";
			$statuson = "selected";
		} else {
			$statusoff = "selected";
			$statuson = "";
		}

		if($item['multiple'] == "on") {
			$multipleoff = "";
			$multipleon = "selected";
		} else {
			$multipleoff = "selected";
			$multipleon = "";
		}

		$item['description'] = stripslashes($item['description']);

		eval("echo (\"".template('shop_edit_item_edit')."\");");
	} else {
		$itemname	= isset($itemname) ? checkInput($itemname, '', '', 'javascript', false) : '';
		$description	= isset($description) ? checkInput($description, '', '', 'javascript', false) : '';
		$displayorder	= (isset($displayorder) && is_numeric($displayorder)) ? (int) $displayorder : 0;
		$itemstatus	= (isset($itemstatus) && $itemstatus == 'on') ? 'on' : 'off';
		$multiple	= (isset($multiple) && $multiple == 'on') ? 'on' : 'off';
		$price		= (isset($price) && is_numeric($price)) ? (int) $price : 0;
		$stock		= (isset($stock) && is_numeric($stock)) ? (int) $stock : 0;

		$description = addslashes($description);

		if(!is_uploaded_file($HTTP_POST_FILES['flocation']['tmp_name'])) {
			$image = "";
		} else {
			$upload_file = $HTTP_POST_FILES['flocation']['name'];
			$temp = $HTTP_POST_FILES['flocation']['tmp_name'];
			$extension = substr($upload_file, -4);

			if($extension == ".jpg" || $extension == ".png" || $extension == ".gif" || $extension == ".JPG" || $extension == ".PNG" || $extension == ".GIF" || $extension == "jpeg" || $extension == "JPEG") {
				if($extension == "JPEG" xor $extension == "jpeg") {
					$extension = ".jpeg";
				}

				$filename = $set['imagename'] + 1;
				$imageurl = "images/items/$filename$extension";
				move_uploaded_file($temp, $imageurl);

				$size = filesize($imageurl);

				if($size > $set['maxsize']) {
					unlink($imageurl);
					error($lang['shop_admin_item_toobig'].' '.$set['maxsize'].' bytes!', false);
				}

				$SizeArray = getimagesize($imageurl);

				if($SizeArray[0] > $set['maxwidth'] || $SizeArray[1] > $set['maxheight']) {
					unlink($imageurl);
					error($lang['shop_admin_item_toobig'].' '.$set['maxwidth'].' * '.$set['maxheight'].'!', false);
				}

				$query = $db->query("SELECT imageurl FROM $table_shop_items WHERE id='$iid'");
				$itemimage = $db->result($query, 0);

				if($itemimage != "") {
					unlink($itemimage);
				}

				$image = ", imageurl='$imageurl'";

				$db->query("UPDATE $table_shop_settings SET imagename=imagename+1");
			} else {
				error($lang['shop_item_wrongtype'], false);
			}
		}

		$db->query("UPDATE $table_shop_items SET itemname='$itemname', description='$description', displayorder='$displayorder', status='$itemstatus', multiple='$multiple', price='$price', stock='$stock' $image WHERE id='$iid'");

		$outputtext = $lang['shop_admin_edititem_update'];
		eval("echo (\"".template('shop_info')."\");");
		redirect("shop_item.php?iid=$iid", 2, X_REDIRECT_JS);
	}
}

// Delete Item

if($action == "deleteitem") {
	$iid = (isset($iid) && is_numeric($iid)) ? (int) $iid : 0;

	$query = $db->query("SELECT * FROM $table_shop_items WHERE id='$iid'");
	$item = $db->fetch_array($query);
	$db->free_result($query);

	$query = $db->query("SELECT * FROM $table_shop_cats WHERE id='$item[cid]'");
	$cat = $db->fetch_array($query);
	$db->free_result($query);

	$private = explode("|", $cat['private']);
	$userlist = explode("|", $cat['userlist']);

	$authorization = privfcheck($private[0], $userlist[0]);

	if(($cat['creatoronly'] == "on" && $cat['owner'] != $self['uid'] && !$authorization) || ($cat['creatoronly'] == "off" && !$authorization)) {
		error($lang['shop_admin_deleteitem_noupdate'], false);
	}

	if(!isset($submit) || !$submit) {
		eval("echo (\"".template('shop_edit_item_delete')."\");");
	} else {
		if($item['imageurl'] != "") {
			unlink($item['imageurl']);
		}

		$db->query("DELETE FROM $table_shop_votes WHERE iid='$iid'");
		$db->query("DELETE FROM $table_shop_items WHERE id='$iid'");
		$db->query("DELETE FROM $table_member_items WHERE iid='$iid'");
		$db->query("UPDATE $table_shop_cats SET items=items-1 WHERE id='$item[cid]'");

		if($cat['cid'] != 0) {
			$db->query("UPDATE $table_shop_cats SET items=items-1 WHERE id='$cat[cid]'");
		}

		$outputtext = $lang['shop_admin_deleteitem_update'];
		eval("echo (\"".template('shop_info')."\");");
		redirect("shop.php", 2, X_REDIRECT_JS);
	}
}

eval("echo (\"".template('shop_footer')."\");");

end_time();

eval("echo (\"".template('footer')."\");");

?>