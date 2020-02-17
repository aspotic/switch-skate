<?php
/*
	SHOP HACK v1.3 by NFPUNK/FLIXON

	If you require support please post in the forum
	at www.flixon.com/shop/forum.  Thanks

	- nfpunk/Flixon
*/

require "./header.php";
loadtemplates('header', 'footer', 'footer_load', 'footer_querynum', 'footer_phpsql', 'footer_totaltime', 'css', 'shop_bank', 'shop_bank_finances', 'shop_bank_received', 'shop_bank_received_row', 'shop_bank_sent', 'shop_bank_sent_row', 'shop_bank_items', 'shop_bank_items_row', 'shop_bank_sellitem', 'shop_bank_senditem', 'shop_bank_send', 'shop_info', 'shop_links', 'shop_footer');

$query = $db->query("SELECT * FROM $table_shop_settings");
$set = $db->fetch_array($query);
$db->free_result($query);

$navigation = "&raquo; <a href=\"shop.php\">$lang[shop_title]</a> &raquo; $lang[shop_textbank]";

eval("\$css = \"".template('css')."\";");
eval("echo (\"".template('header')."\");");

$private = explode("|", $set['private']);
$userlist = explode("|", $set['userlist']);

$authorization = privfcheck($private[1], $userlist[1]);

if(!$authorization || X_GUEST) {
    	error($lang['shop_nopage'], false);
}

if($set['bank'] != "on") {
	error($lang['shop_bank_off'], false);
}

$bankpage = "";

// Finances

if(!isset($action) || $action == "finances") {
	$amount = (isset($amount) && is_numeric($amount)) ? (int) $amount : 0;

	if(!isset($deposit) && !isset($withdraw)) {
		eval("\$bankpage = \"".template('shop_bank_finances')."\";");
	} elseif(isset($deposit)) {
		if($self['money'] >= $amount && $amount > 0) {
			$db->query("UPDATE $table_members SET money=money-'$amount', bank_balance=bank_balance+'$amount' WHERE username='$xmbuser'");

			$outputtext = $lang['shop_bank_finances_deposit_update'];
			eval("echo (\"".template('shop_info')."\");");
			redirect("shop_bank.php?action=finances", 2, X_REDIRECT_JS);
		} else {
			$outputtext = $lang['shop_bank_finances_deposit_noupdate'];
			eval("echo (\"".template('shop_info')."\");");
			redirect("shop_bank.php?action=finances", 2, X_REDIRECT_JS);
		}
	} else {
		if($self['bank_balance'] >= $amount && $amount > 0) {
			// Calculate Withdraw Fee

			$amountmf = ((100 - $set['bank_fee']) / 100) * $amount;

			$db->query("UPDATE $table_members SET money=money+'$amountmf', bank_balance=bank_balance-'$amount' WHERE username='$xmbuser'");

			$outputtext = $lang['shop_bank_finances_withdraw_update'];
			eval("echo (\"".template('shop_info')."\");");
			redirect("shop_bank.php?action=finances", 2, X_REDIRECT_JS);
		} else {
			$outputtext = $lang['shop_bank_finances_withdraw_noupdate'];
			eval("echo (\"".template('shop_info')."\");");
			redirect("shop_bank.php?action=finances", 2, X_REDIRECT_JS);
		}
	}
}

// Received

if($action == "received") {
	$page = (isset($page) && is_numeric($page)) ? (int) $page : 1;
	$start_limit = ($page - 1) * 10;

	$query = $db->query("SELECT COUNT(*) FROM $table_shop_bank WHERE touid='$self[uid]'");
	$nbrows = $db->result($query, 0);
	$db->free_result($query);

	$mpurl = "shop_bank.php?action=received";
    	$multipage = multi($nbrows, 10, $page, $mpurl);

	$receivedrows = '';

	$query = $db->query("SELECT b.*, m.username FROM $table_shop_bank b LEFT OUTER JOIN $table_members m ON b.fromuid=m.uid WHERE b.touid='$self[uid]' ORDER BY b.dateline DESC LIMIT $start_limit, 10");

	while($received = $db->fetch_array($query)) {
		if($received['fromuid'] != 0) {
			$encodeuser = rawurlencode($received['username']);
			$receivedfrom = "<a href=\"member.php?action=viewpro&amp;member=$encodeuser\">$received[username]</a>";
		}

		if($received['type'] == "shop") {
			$receivedfrom = "Shop";
		}

		if($received['type'] == "lottery") {
			$receivedfrom = "Lottery";
		}

		$received['comment'] = stripslashes($received['comment']);

		$date = gmdate("$dateformat", $received['dateline'] + ($timeoffset * 3600) + ($addtime * 3600));
		$time = gmdate("$timecode", $received['dateline'] + ($timeoffset * 3600) + ($addtime * 3600));

		eval("\$receivedrows .= \"".template('shop_bank_received_row')."\";");
	}

	$db->free_result($query);

	eval("\$bankpage = \"".template('shop_bank_received')."\";");
}

// Sent

if($action == "sent") {
	$page = (isset($page) && is_numeric($page)) ? (int) $page : 1;
	$start_limit = ($page - 1) * 10;

	$query = $db->query("SELECT COUNT(*) FROM $table_shop_bank WHERE fromuid='$self[uid]'");
	$nbrows = $db->result($query, 0);
	$db->free_result($query);

	$mpurl = "shop_bank.php?action=sent";
    	$multipage = multi($nbrows, 10, $page, $mpurl);

	$sentrows = '';

	$query = $db->query("SELECT b.*, m.username FROM $table_shop_bank b LEFT OUTER JOIN $table_members m ON b.touid=m.uid WHERE b.fromuid='$self[uid]' ORDER BY b.dateline DESC LIMIT $start_limit, 10");

	while($sent = $db->fetch_array($query)) {
		if($sent['touid'] != 0) {
			$encodeuser = rawurlencode($sent['username']);
			$sentto = "<a href=\"member.php?action=viewpro&amp;member=$encodeuser\">$sent[username]</a>";
		}

		if($sent['type'] == "shop") {
			$sentto = "Shop";
		}

		if($sent['type'] == "lottery") {
			$sentto = "Lottery";
		}

		$sent['comment'] = stripslashes($sent['comment']);

		$date = gmdate("$dateformat", $sent['dateline'] + ($timeoffset * 3600) + ($addtime * 3600));
		$time = gmdate("$timecode", $sent['dateline'] + ($timeoffset * 3600) + ($addtime * 3600));

		eval("\$sentrows .= \"".template('shop_bank_sent_row')."\";");
	}

	$db->free_result($query);

	eval("\$bankpage = \"".template('shop_bank_sent')."\";");
}

// Send money

if($action == "send") {
	if(!isset($submit) || !$submit) {
		$sendoptions = '';

		$query = $db->query("SELECT uid, username FROM $table_members ORDER BY username");

		while($member = $db->fetch_array($query)) {
			$sendoptions .= "<option value=\"$member[uid]\">$member[username]</option>\n";
		}

		$db->free_result($query);

		eval("\$bankpage = \"".template('shop_bank_send')."\";");
	} else {
		$amount = (isset($amount) && is_numeric($amount)) ? (int) $amount : 0;
		$sendto = (isset($sendto) && is_numeric($sendto)) ? (int) $sendto : 0;

		if($self['money'] >= $amount && $sendto != "" && $amount > 0) {
			$comment = isset($comment) ? checkInput($comment, '', '', 'javascript', false) : '';
			$comment = addslashes($comment);

			$thatime = time();

			$db->query("INSERT INTO $table_shop_bank (fromuid, touid, dateline, amount, comment, type) VALUES ('$self[uid]', '$sendto', '$thatime', '$amount', '$comment', 'sent')");
			$db->query("UPDATE $table_members SET money=money+'$amount' WHERE uid='$sendto'");
			$db->query("UPDATE $table_members SET money=money-'$amount' WHERE username='$xmbuser'");

			$query = $db->query("SELECT username FROM $table_members WHERE uid='$sendto'");
			$sendtousername = $db->result($query, 0);
			$db->free_result($query);

			eval($lang['shop_bank_evalmessage']);
			eval($lang['shop_bank_evalsubject']);

			$lang['shop_bank_message'] = addslashes($lang['shop_bank_message']);
			$lang['shop_bank_subject'] = addslashes($lang['shop_bank_subject']);

			$db->query("INSERT INTO $table_u2u VALUES('', '$sendtousername', '$bbname', 'incoming', '$sendtousername', 'Inbox', '$lang[shop_bank_subject]', '$lang[shop_bank_message]', $thatime, 'no', 'yes')");

			$outputtext = $lang['shop_bank_send_update'];
			eval("echo (\"".template('shop_info')."\");");
			redirect("shop_bank.php?action=send", 2, X_REDIRECT_JS);
		} else {
			$outputtext = $lang['shop_bank_send_noupdate'];
			eval("\$info = \"".template('shop_info')."\";");
			echo $info;

			redirect("shop_bank.php?action=send", 2, X_REDIRECT_JS);
		}
	}
}

if($action == "items") {
	$itemsrows = "";

	$query = $db->query("SELECT m.quantity, i.* FROM $table_member_items m, $table_shop_items i WHERE m.uid='$self[uid]' && m.iid=i.id ORDER BY i.itemname");

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

		$item['description'] = stripslashes($item['description']);

		eval("\$itemsrows .= \"".template('shop_bank_items_row')."\";");
	}

	$db->free_result($query);

	if($itemsrows == "") {
		$bankpage = $lang['shop_bank_items_noitems'];
	} else {
		eval("\$bankpage = \"".template('shop_bank_items')."\";");
	}
}

// Sell item

if($action == "sellitem") {
	$iid = (isset($iid) && is_numeric($iid)) ? (int) $iid : 0;

	if(!isset($submit) || !$submit) {
		$itemquery = $db->query("SELECT itemname, imageurl FROM $table_shop_items WHERE id='$iid'");
		$item = $db->fetch_array($itemquery);
		$db->free_result($query);

		if($item['imageurl'] == "") {
			$image = "images/shop/noitempic.gif";
		} else {
			$image = $item['imageurl'];
		}

		eval("\$bankpage = \"".template('shop_bank_sellitem')."\";");
	} else {
		$query = $db->query("SELECT quantity FROM $table_member_items WHERE iid='$iid' && uid='$self[uid]'");
		$memberitem = $db->fetch_array($query);
		$nbrows = $db->num_rows($query);
		$db->free_result($query);

		if($nbrows != 0) {
			$itemquery = $db->query("SELECT itemname, price, multiple FROM $table_shop_items WHERE id='$iid'");
			$item = $db->fetch_array($itemquery);
			$db->free_result($query);

			$amount = ceil(($set['bank_sellitempercent'] / 100) * $item['price']);

			if($memberitem['quantity'] <= 1) {
				$db->query("DELETE FROM $table_member_items WHERE iid='$iid' && uid='$self[uid]'");
			} else {
				$db->query("UPDATE $table_member_items SET quantity=quantity-1 WHERE iid='$iid' && uid='$self[uid]'");
			}

			$thatime = time();

			$db->query("INSERT INTO $table_shop_bank (fromuid, touid, dateline, amount, comment, type) VALUES (0, '$self[uid]', '$thatime', '$amount', '$item[itemname]', 'shop')");
			$db->query("UPDATE $table_shop_items SET stock=stock+1 WHERE id='$iid'");
			$db->query("UPDATE $table_members SET money=money+'$amount' WHERE uid='$self[uid]'");

			$outputtext = "$lang[shop_bank_sellitem_update] $amount!";
			eval("echo (\"".template('shop_info')."\");");
			redirect("shop_bank.php?action=items", 2, X_REDIRECT_JS);
		} else {
			$outputtext = $lang['shop_bank_sellitem_noupdate'];
			eval("echo (\"".template('shop_info')."\");");
			redirect("shop_bank.php?action=items", 2, X_REDIRECT_JS);
		}
	}
}

// Send Item

if($action == "senditem") {
	$iid = (isset($iid) && is_numeric($iid)) ? (int) $iid : 0;
	$senditemto = (isset($senditemto) && is_numeric($senditemto)) ? (int) $senditemto : 0;

	if(!isset($submit) || !$submit) {
		$query = $db->query("SELECT itemname FROM $table_shop_items WHERE id='$iid'");
		$itemname = $db->result($query, 0);
		$db->free_result($query);

		$senditemoptions = '';

		$query = $db->query("SELECT uid, username FROM $table_members ORDER BY username");

		while($member = $db->fetch_array($query)) {
			$senditemoptions .= "<option value=\"$member[uid]\">$member[username]</option>\n";
		}

		$db->free_result($query);

		eval("\$bankpage = \"".template('shop_bank_senditem')."\";");
	} else {
		$query = $db->query("SELECT quantity FROM $table_member_items WHERE iid='$iid' && uid='$self[uid]'");
		$memberitem = $db->fetch_array($query);
		$nbrows = $db->num_rows($query);
		$db->free_result($query);

		if($nbrows != 0) {
			$query = $db->query("SELECT quantity FROM $table_member_items WHERE iid='$iid' && uid='$senditemto'");
			$senditem = $db->fetch_array($query);
			$nbsendrows = $db->num_rows($query);
			$db->free_result($query);

			if($nbsendrows != 0) {
				if($memberitem['quantity'] <= 1) {
					$db->query("DELETE FROM $table_member_items WHERE iid='$iid' && uid='$self[uid]'");
					$db->query("UPDATE $table_member_items SET quantity=quantity+1 WHERE iid='$iid' && uid='$senditemto'");
				} else {
					$db->query("UPDATE $table_member_items SET quantity=quantity-1 WHERE iid='$iid' && uid='$self[uid]'");
					$db->query("UPDATE $table_member_items SET quantity=quantity+1 WHERE iid='$iid' && uid='$senditemto'");
				}
			} else {
				if($memberitem['quantity'] <= 1) {
					$db->query("UPDATE $table_member_items SET uid='$senditemto' WHERE iid='$iid' && uid='$self[uid]'");
				} else {
					$db->query("UPDATE $table_member_items SET quantity=quantity-1 WHERE iid='$iid' && uid='$self[uid]'");
					$db->query("INSERT INTO $table_member_items (iid, uid, quantity) VALUES ('$iid', '$senditemto', 1)");
				}
			}

			$outputtext = $lang['shop_bank_senditem_update'];
			eval("echo (\"".template('shop_info')."\");");
			redirect("shop_bank.php?action=items", 2, X_REDIRECT_JS);
		} else {
			$outputtext = $lang['shop_bank_senditem_noupdate'];
			eval("echo (\"".template('shop_info')."\");");
			redirect("shop_bank.php?action=items", 2, X_REDIRECT_JS);
		}
	}
}

if(!isset($submit) && !isset($deposit) && !isset($withdraw)) {
	eval("echo (\"".template('shop_bank')."\");");
}

// Links

$displaylinks = array();

if(X_ADMIN) {
	$displaylinks[] = "<img src=\"images/shop/admin.gif\" alt=\"$lang[shop_textadminpanel]\" border=\"0\" /> <a href=\"shop_admin.php\">$lang[shop_textadminpanel]</a>";
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