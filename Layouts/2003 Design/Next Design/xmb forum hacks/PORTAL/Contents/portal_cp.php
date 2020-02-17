<?php
/*
    Mod Name: Portal System v1.0

	Mod Author: John Briggs

	Copyright © 2004 The XMBXtreme Group
	Site: http://www.xmbxtreme.com

	File Name: portal_cp.php

	Last Updated: 11/09/04

	Copyright: All copyright information must remain visible and cannot be removed.

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

require('./header.php');
require('./include/portal.inc.php');

loadtemplates('footer_load', 'footer_querynum', 'footer_phpsql', 'footer_totaltime', 'css', 'header', 'footer', 'error_nologinsession', 'padmin_copyright', 'padmin_error', 'padmin_confirm', 'padmin_admin_menu', 'padmin_admin_settings', 'padmin_admin_blockselect', 'padmin_admin_blockadd', 'padmin_admin_editselect', 'padmin_admin_blockedit');

$action = isset($action) ? $action : '';
$selHTML = 'selected="selected"';
$cheHTML = 'checked="checked"';

eval("\$css = \"".template("css")."\";");

nav('<a href="cp.php">'.$lang['textcp'].'</a>');
nav(stripslashes($portal_title));

eval("echo (\"".template('header')."\");");

if (!X_ADMIN) {
    eval('echo stripslashes("'.template('error_nologinsession').'");');
    end_time();
    eval("echo (\"".template('footer')."\");");
    exit();
}

smcwcache();

$auditaction = $_SERVER['REQUEST_URI'];
$aapos = strpos($auditaction, "?");
if ($aapos !== false) {
    $auditaction = substr($auditaction, $aapos + 1);
}

$auditaction = addslashes("$onlineip|#|$auditaction");
audit($xmbuser, $auditaction, 0, 0);

eval("echo (\"".template('padmin_admin_menu')."\");");

if ($action == "psettings") {
	if (!isset($_POST['psettingsubmit']) || empty($_POST['psettingsubmit'])) {
		$portal_title = stripslashes($portal_title);
		$portal_postsnull = stripslashes($portal_postsnull);

		$show_avatar_on = $show_avatar_off = '';
		if ($SETTINGS['show_avatar'] == 'on') {
			$show_avatar_on = $cheHTML;
		} else {
			$show_avatar_off = $cheHTML;
		}

		$portalon = $portaloff = '';
		if ($SETTINGS['portalstatus'] == 'on') {
			$portalon = $selHTML;
		} else {
			$portaloff = $selHTML;
		}

		$portal_tickeron = $portal_tickeroff = '';
		if ($SETTINGS['portal_ticker'] == 'on') {
			$portal_tickeron = $selHTML;
		} else {
			$portal_tickeroff = $selHTML;
		}

		$portal_whosonlineon = $portal_whosonlineoff = '';
		if ($SETTINGS['portal_whosonline'] == 'on') {
			$portal_whosonlineon = $selHTML;
		} else {
			$portal_whosonlineoff = $selHTML;
		}

		eval("echo (\"".template('padmin_admin_settings')."\");");
	}

	if (isset($_POST['psettingsubmit']) || !empty($_POST['psettingsubmit'])) {
		if (empty($_POST['portaltitle'])) {
			portalerrormsg($lang['portalnotitle']);
		}

		if (empty($_POST['dgif'])) {
			portalerrormsg($lang['portalnodgif']);
		}

		$_POST['portaltitle'] = addslashes($_POST['portaltitle']);
		$_POST['dgif'] = addslashes($_POST['dgif']);
		$_POST['postsnull'] = addslashes($_POST['postsnull']);

		$db->query("UPDATE $table_settings SET portal_title = '$_POST[portaltitle]', portal_newsfid = '$_POST[newsfid]', portal_newsdisplays = '$_POST[newsdisplays]', portal_mposts = '$_POST[mposts]', portal_hotdate = '$_POST[hotdate]', portal_hottopics = '$_POST[hottopics]', portal_dgif = '$_POST[dgif]', portal_newmembers = '$_POST[newmebers]', portal_rmods = '$_POST[rmods]', show_avatar = '$_POST[show_avatar]', portal_topmembers = '$_POST[topmembers]', portal_postsnull = '$_POST[postsnull]', portalstatus = '$_POST[portalstatus]', portal_ticker = '$_POST[portal_ticker]', portal_whosonline = '$_POST[portal_whosonline]'");
		portalconfirmmsg($lang['portalsettingsupdated'], "portal_cp.php?action=psettings");
	}
}

if ($action == "blocks") {
	if ($blocks == "delete") {
		if (!isset($_POST['blockdeletesubmit']) || empty($_POST['blockdeletesubmit'])) {
			$listblocks = "\n<select name=\"pid\">\n";
			$listblocks .= "<option value=\"\">$lang[portalselectblock]:</option>\n";
			$listblocks .= "<option value=\"\">--------------------</option>\n";

			$portalquery = $db->query("SELECT * FROM ".$tablepre."portal_templates ORDER BY name");
			while ($t = $db->fetch_array($portalquery)) {
				$t['name'] = stripslashes($t['name']);
				$listblocks .= "<option value=\"$t[id]\">$t[name]</option>\n";
			}
			$listblocks .= "</select>\n";

			$listtemplates = "\n<select name=\"tid\">\n";
			$listtemplates .= "<option value=\"\">$lang[portalselectblock]:</option>\n";
			$listtemplates .= "<option value=\"\">--------------------</option>\n";

			$query = $db->query("SELECT * FROM $table_templates WHERE name LIKE 'portal_%' ORDER BY name");
			while ($p = $db->fetch_array($query)) {
				$p['name'] = stripslashes($p['name']);
				$listtemplates .= "<option value=\"$p[id]\">$p[name]</option>\n";
			}
			$listtemplates .= "</select>\n";

			eval("echo (\"".template('padmin_admin_blockselect')."\");");
		}

		if (isset($_POST['blockdeletesubmit']) || !empty($_POST['blockdeletesubmit'])) {
			$db->query("DELETE FROM ".$tablepre."portal_templates WHERE id = '$_POST[pid]'");
			$db->query("DELETE FROM $table_templates WHERE id ='$_POST[tid]'");
			portalconfirmmsg($lang['portalblockdeleted'], "portal_cp.php?action=blocks&blocks=delete");
	}
}

if ($blocks == "add") {
	if (!isset($_POST['addsubmit']) || empty($_POST['addsubmit'])) {
		eval("echo (\"".template('padmin_admin_blockadd')."\");");
	}

	if (isset($_POST['addsubmit']) || !empty($_POST['addsubmit'])) {
		if (empty($_POST['newname'])) {
			portalerrormsg($lang['templateempty']);
		}

		$check = $db->query("SELECT * FROM $table_templates WHERE name ='$_POST[newname]'");
		if ($check && $db->num_rows($check) != 0) {
			portalerrormsg($lang['templateexists']);
		}

		$check = $db->query("SELECT * FROM ".$tablepre."portal_templates WHERE name ='$_POST[newname]'");
		if ($check && $db->num_rows($check) != 0) {
			portalerrormsg($lang['templateexists']);
		}

		$_PSOT['newname'] = addslashes($_POST['newname']);
		$_POST['newtemplate'] = addslashes($_POST['newtemplate']);

		$db->query("INSERT INTO $table_templates (id, name, template) VALUES ('', '$_POST[newname]', '$_POST[newtemplate]')");
		$db->query("INSERT INTO ".$tablepre."portal_templates (id, name, direction, status, displayorder) VALUES ('', '$_POST[newname]', '$_POST[newdirection]', '$_POST[newstatus]',  '$_POST[newdisplayorder]')");
		portalconfirmmsg($lang['portalbadded'], "portal_cp.php?action=blocks&blocks=add");
	}
}

if ($blocks == "edit") {
	if (!isset($_POST['blockeditsubmit']) && !isset($_POST['blockeditselect']) && empty($_POST['blockeditsubmit'])&& empty($_POST['blockeditselect'])) {
		$selectblocks = "\n<select name=\"tid\">\n";
		$selectblocks .= "<option value=\"\">$lang[portalselectblock]:</option>\n";
		$selectblocks .= "<option value=\"\">--------------------</option>\n";
		$results = $db->query("SELECT * FROM ".$tablepre."portal_templates ORDER BY name");
		while ($t = $db->fetch_array($results)) {
			$t['name'] = stripslashes($t['name']);
			$selectblocks .= "<option value=\"$t[id]\">$t[name]</option>\n";
		}
		$selectblocks .= "</select>\n";

		eval("echo (\"".template('padmin_admin_editselect')."\");");
	}
}

if (isset($_POST['blockeditselect']) || !empty($_POST['blockeditselect'])) {
	if (empty($_POST['tid'])) {
		portalerrormsg($lang['selecttemplate']);
	}

	$query = $db->query("SELECT * FROM ".$tablepre."portal_templates WHERE id='$_POST[tid]'");
	while ($t = $db->fetch_array($query)) {
		$t['name'] = stripslashes($t['name']);

		$status_on = $status_off = '';
		if ($t['status'] == 'on') {
			$status_on = $cheHTML;
		} else {
			$status_off = $cheHTML;
		}

		$left = $center = $right = '';
		if ($t['direction'] == 'left') {
			$left = $selHTML;
		} elseif ($t['direction'] == 'center') {
			$center = $selHTML;
		} elseif ($t['direction'] == 'right') {
			$right = $selHTML;
		}

		$tquery = $db->query("SELECT * FROM $table_templates WHERE name='$t[name]'");
		while ($tm = $db->fetch_array($tquery)) {
			$tm['template'] = stripslashes($tm['template']);
			$tm['template'] = htmlspecialchars($tm['template']);

			eval("echo (\"".template('padmin_admin_blockedit')."\");");
		}
	}
}

	if (isset($_POST['blockeditsubmit']) || !empty($_POST['blockeditsubmit'])) {
		$_POST['newtemplate'] = addslashes($_POST['newtemplate']);
		$db->query("UPDATE ".$tablepre."portal_templates SET direction='$_POST[newdirection]', status='$_POST[newstatus]', displayorder='$_POST[newdisplayorder]' WHERE id='$id'");
		$db->query("UPDATE $table_templates SET template ='$_POST[newtemplate]' WHERE name='$_POST[name]'");
		portalconfirmmsg($lang['portalbedited'], "portal_cp.php?action=blocks&blocks=edit");
	}
}

eval("echo (\"".template('padmin_copyright')."\");");

end_time();

eval("echo (\"".template('footer')."\");");
?>