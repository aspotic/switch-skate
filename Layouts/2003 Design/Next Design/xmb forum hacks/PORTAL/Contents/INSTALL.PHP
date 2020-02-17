<?php
/*
    Mod Name: Portal System v1.0

	Mod Author: John Briggs

	Copyright © 2004 The XMBXtreme Group
	Site: http://www.xmbxtreme.com

	File Name: install.php

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

@set_time_limit(1000);

if (!defined('ROOT')) {
    define('ROOT', './');
}

require ROOT."header.php";

if (!X_SADMIN) {
	eval("\$css = \"".template("css")."\";");
	error($lang['superadminonly']);
}

// BEGIN CONFIGURATION SETTINGS
$hackname = "Portal System v1.0"; // Hack Name
$fontstyle = "Tahoma"; // Font Type
$fontsize = "10px"; // Font Size
$txtcolor = "#000000";  // Text Color
$bgcolor = "#EDF0F7";  // Background Color
$bordercolor = "#C4C8D4";  // Border Color
$altbg1 = "#EDF0F7";  // Alternate Color 1
$altbg2 = "#FFFFFF";  // Alternate Color 2
$tablewidth = "400";  // Table Width
$borderwidth = "1";  // Border Width
$tablespace = "5";  // Table Spacing
$usetemplatefile = "yes";  // Does this hack use a template (.xmb) file?  yes or no
$templatefilename = "portal.xmb";  // Template file name, if any is used
$checkfiles = array(ROOT."portal.php", ROOT."portal_cp.php", ROOT."include/portal.inc.php", ROOT."portal.xmb", ROOT."lang/English.portal.php");  // Files that need to be uploaded
// END CONFIGURATION SETTINGS
?>

<html>
<head>
<title><?php echo $hackname?> Installer</title>
<style type="text/css">
<!--
body { scrollbar-base-color: #EDF0F7; scrollbar-arrow-color: #FFFFFF }
a { color: #000000; text-decoration: none }
a:hover { text-decoration: underline }
.header { font-family: <?php echo $fontstyle?>; color: #000000; font-size: <?php echo $fontsize?>; font-weight: bold; background-color: #FFFFFF }
.tablerow { font-family: <?php echo $fontstyle?>; color: #000000; font-size: <?php echo $fontsize?>; font-weight: normal }
textarea, select, input, object { font-family: <?php echo $fontstyle?>; color: #000000; font-size: <?php echo $fontsize?>; font-weight: normal; background-color: #EDF0F7 }
//-->
</style>
</head>
<body text="<?php echo $txtcolor?>" bgcolor="<?php echo $bgcolor?>" link="<?php echo $bgcolor?>">
<!--
<?php echo $hackname?>

© 2004 The XMBXtreme Group
http://www.xmbxtreme.com

All copyright information must remain visible and cannot be removed.
-->
<table cellspacing="0" cellpadding="0" border="0" width="100%" height="100%" align="center">
<tr><td align="center" valign="center">

<?php
if (empty($_POST['confirmsubmit']) && empty($_POST['licensesubmit']) && empty($_POST['installsubmit']) && empty($_POST['removesubmit'])) {
	$removebutton = '';
	if (file_exists("portal.php")) {
		$removebutton = "<input type=\"submit\" name=\"removesubmit\" value=\"Uninstall\" />";
	}
	?>

	<form method="post" action="install.php">
	<table cellspacing="0" cellpadding="0" border="0" width="<?php echo $tablewidth?>" align="center">
	<tr>
	<td bgcolor="<?php echo $bordercolor?>">
	<table cellspacing="<?php echo $borderwidth?>" cellpadding="<?php echo $tablespace?>" border="0" width="100%" align="center">
	<tr>
	<td class="tablerow" bgcolor="<?php echo $altbg1?>" align="center"><strong><?php echo $hackname?></strong></td>
	</tr>
	<tr>
	<td class="tablerow" bgcolor="<?php echo $altbg2?>" align="center">
	Thanks for choosing to install another XMBXtreme hack!<br /><br /><br />
	This part of the installation will create all necessary database tables and templates, insert any necessary data, and configure any necessary settings.<br /><br /><br />
	Before continuing, be sure that you have completed the instructions provided in the hack installation text file.<br /><br /><br />
	<input type="submit" name="confirmsubmit" value="Install" /> <?php echo $removebutton?>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</form>

	<?php
}

if (isset($_POST['removesubmit'])) {
	$db->query("ALTER TABLE ".$tablepre."settings
		DROP portal_title,
		DROP portal_newsfid,
		DROP portal_newsdisplays,
		DROP portal_mposts,
		DROP portal_hotdate,
		DROP portal_hottopics,
		DROP portal_dgif,
		DROP portal_newmembers,
		DROP portal_rmods,
		DROP show_avatar,
		DROP portal_topmembers,
		DROP portal_postsnull,
		DROP portalstatus,
		DROP portal_ticker,
		DROP portal_whosonline
	");

	$db->query("DROP TABLE IF EXISTS ".$tablepre."portal_templates");
	$db->query("DELETE FROM ".$tablepre."templates WHERE name LIKE 'portal_%'");
	$db->query("DELETE FROM ".$tablepre."templates WHERE name LIKE 'padmin_%'");
	$db->query("DELETE FROM ".$tablepre."templates WHERE name = ''");
	?>

	<table cellspacing="0" cellpadding="0" border="0" width="<?php echo $tablewidth?>" align="center">
	<tr>
	<td bgcolor="<?php echo $bordercolor?>">
	<table cellspacing="<?php echo $borderwidth?>" cellpadding="<?php echo $tablespace?>" border="0" width="100%" align="center">
	<tr>
	<td class="tablerow" bgcolor="<?php echo $altbg1?>" align="center"><strong>Uninstall</strong></td>
	</tr>
	<tr>
	<td class="tablerow" bgcolor="<?php echo $altbg2?>" align="center">
	<strong><?php echo $hackname?></strong> has been successfully removed!<br /><br /><br />
	To complete the uninstall, please delete the file <strong>install.php</strong>.
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>

	<?php
}

if (isset($_POST['confirmsubmit'])) {
	?>

	<form method="post" action="install.php">
	<table cellspacing="0" cellpadding="0" border="0" width="<?php echo $tablewidth?>" align="center">
	<tr>
	<td bgcolor="<?php echo $bordercolor?>">
	<table cellspacing="<?php echo $borderwidth?>" cellpadding="<?php echo $tablespace?>" border="0" width="100%" align="center">
	<tr>
	<td class="tablerow" bgcolor="<?php echo $altbg1?>" align="center"><strong>Important!</strong></td>
	</tr>
	<tr>
	<td class="tablerow" bgcolor="<?php echo $altbg2?>" align="center">
	As with any hack, we recommend backing up your current database, templates, and files.<br /><br /><br />
	This safety precaution can mean the difference between a successful installation or an evening full of headaches.<br /><br /><br />
	Did you make a backup of your database and templates?<br /><br /><br />
	<input type="submit" name="licensesubmit" value="Yes"> <input type="submit" name="cancelsubmit" value="No" />
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</form>

	<?php
}

if (isset($_POST['licensesubmit'])) {
	?>

	<form method="post" action="install.php">
	<table cellspacing="0" cellpadding="0" border="0" width="<?php echo $tablewidth?>" align="center">
	<tr>
	<td bgcolor="<?php echo $bordercolor?>">
	<table cellspacing="<?php echo $borderwidth?>" cellpadding="<?php echo $tablespace?>" border="0" width="100%" align="center">
	<tr>
	<td class="tablerow" bgcolor="<?php echo $altbg1?>" align="center"><strong>License Agreement</strong></td>
	</tr>
	<tr>
	<td class="tablerow" bgcolor="<?php echo $altbg2?>" align="center">
	This hack and all code contained within are released under the GPL license.<br /><br /><br />
	All copyright information, found within this hack, may not be removed for any reason and must remain visible at all times.<br /><br /><br />
	Do you agree to these terms?<br /><br /><br />
	<input type="submit" name="installsubmit" value="Agree"> <input type="submit" name="cancelsubmit" value="Disagree" />
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</form>

	<?php
}

if (isset($_POST['installsubmit'])) {
	?>

	<form method="post" action="install.php">
	<table cellspacing="0" cellpadding="0" border="0" width="<?php echo $tablewidth?>" align="center">
	<tr>
	<td bgcolor="<?php echo $bordercolor?>">
	<table cellspacing="<?php echo $borderwidth?>" cellpadding="<?php echo $tablespace?>" border="0" width="100%" align="center">
	<tr>
	<td class="tablerow" bgcolor="<?php echo $altbg1?>" align="center"><strong><?php echo $hackname?></strong></td>
	</tr>
	<tr>
	<td class="tablerow" bgcolor="<?php echo $altbg2?>" align="center">

	<?php
	for ($i = 0; $i < count($checkfiles); $i++) {
		if (!file_exists($checkfiles[$i])) {
			echo "<strong>Error!</strong> The installation has been halted.<br /><br /><br />";
			echo "The file, <strong>$checkfiles[$i]</strong>, does not exist.<br /><br /><br />";
			echo "Please upload the file and click restart to continue.<br /><br /><br />";
			echo "<input type=\"submit\" name=\"cancelsubmit\" value=\"Restart\" />";
			exit;
		}
	}
	?>

	Now installing! Please be patient as this process may take a few minutes.<br /><br /><br />

	<?php
	// BEGIN SETTINGS
	echo "Updating table <strong>".$tablepre."settings</strong> and inserting any necessary data.<br /><br />";
	$db->query("ALTER TABLE ".$tablepre."settings ADD (
	  portal_title varchar(50) NOT NULL default 'Portal',
	  portal_newsfid smallint(30) NOT NULL default '1',
	  portal_newsdisplays smallint(30) NOT NULL default '5',
	  portal_mposts smallint(30) NOT NULL default '10',
	  portal_hotdate smallint(30) NOT NULL default '3',
	  portal_hottopics smallint(30) NOT NULL default '5',
	  portal_dgif varchar(50) NOT NULL default 'info.gif',
	  portal_newmembers smallint(30) NOT NULL default '5',
	  portal_rmods smallint(30) NOT NULL default '5',
	  show_avatar char(3) NOT NULL default 'on',
	  portal_topmembers smallint(30) NOT NULL default '5',
	  portal_postsnull text NOT NULL,
	  portalstatus char(3) NOT NULL default 'on',
	  portal_ticker char(3) NOT NULL default 'on',
	  portal_whosonline char(3) NOT NULL default 'on'
	)");
	// END SETTINGS

	// BEGIN PORTAL TEMPLATES
	echo "Creating table <strong>".$tablepre."portal_templates</strong> and inserting any necessary data.<br /><br />";
	$db->query("DROP TABLE IF EXISTS ".$tablepre."portal_templates");
	$db->query("CREATE TABLE ".$tablepre."portal_templates (
	  id smallint(6) NOT NULL auto_increment,
	  name varchar(75) NOT NULL default '',
	  direction varchar(10) NOT NULL default '',
	  status char(3) NOT NULL default '',
	  displayorder int(50) NOT NULL default '0',
	  PRIMARY KEY  (id),
	  KEY name (name),
	  KEY displayorder (displayorder)
	)");
	// END PORTAL TEMPLATES

	// BEGIN INSERTING PORTAL TEMPLATES
	echo "Inserting <strong>".$tablepre."portal_templates</strong> and any necessary data.<br /><br />";
	$db->query("INSERT INTO ".$tablepre."portal_templates (id, name, direction, status, displayorder) VALUES ('', 'portal_main_block', 'center', 'on', '1');");
	$db->query("INSERT INTO ".$tablepre."portal_templates (id, name, direction, status, displayorder) VALUES ('', 'portal_main_menu', 'left', 'on', '1');");
	$db->query("INSERT INTO ".$tablepre."portal_templates (id, name, direction, status, displayorder) VALUES ('', 'portal_member_mood', 'right', 'on', '2');");
	$db->query("INSERT INTO ".$tablepre."portal_templates (id, name, direction, status, displayorder) VALUES ('', 'portal_newmember', 'left', 'on', '2');");
	$db->query("INSERT INTO ".$tablepre."portal_templates (id, name, direction, status, displayorder) VALUES ('', 'portal_newposts', 'left', 'on', '3');");
	$db->query("INSERT INTO ".$tablepre."portal_templates (id, name, direction, status, displayorder) VALUES ('', 'portal_search', 'left', 'on', '4');");
	$db->query("INSERT INTO ".$tablepre."portal_templates (id, name, direction, status, displayorder) VALUES ('', 'portal_google', 'right', 'on', '3');");
	$db->query("INSERT INTO ".$tablepre."portal_templates (id, name, direction, status, displayorder) VALUES ('', 'portal_top_members', 'right', 'on', '1');");
	$db->query("INSERT INTO ".$tablepre."portal_templates (id, name, direction, status, displayorder) VALUES ('', 'portal_websearch', 'left', 'on', '5');");
	// END INSERTING PORTAL TEMPLATES

	// BEGIN TEMPLATES
	if ($usetemplatefile == "yes") {
		echo "Creating any necessary templates.<br /><br />";
		$db->query("DELETE FROM ".$tablepre."templates WHERE name LIKE 'portal_%'");
		$db->query("DELETE FROM ".$tablepre."templates WHERE name LIKE 'padmin_%'");
		$filesize = @filesize($templatefilename);
		$fp = @fopen($templatefilename, 'r');
		$templatesfile = @fread($fp, $filesize);
		@fclose($fp);
		$templates = explode("|#*XMB TEMPLATE FILE*#|", $templatesfile);
		while (list($key,$val) = each($templates)) {
			$template = explode("|#*XMB TEMPLATE*#|", $val);
			if (isset($template['1'])) {
				$template['1'] = addslashes($template['1']);
				$db->query("INSERT INTO ".$tablepre."templates (id, name, template) VALUES ('', '".addslashes($template['0'])."', '".addslashes($template['1'])."')");
			}
		}
		$db->query("DELETE FROM ".$tablepre."templates WHERE name = ''");
	}
	// END TEMPLATES
	?>

	<br />
	The installation of <strong><?php echo $hackname?></strong> is now complete!<br /><br /><br />
	Please delete files <strong>install.php and portal.xmb</strong> and click finish to continue.<br /><br /><br />
	<input type="button" onclick="location.href='portal_cp.php'" value="Finish" />
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</form>

	<?php
    @unlink(ROOT."portal.xmb");
    @unlink(ROOT."install.php");
}
?>

<br />
<span class="tablerow"><a href="http://www.xmbxtreme.com" target="_blank"><strong>The XMBXtreme Group</strong></a> &copy; 2004</span>
</td>
</tr>
</table>
</form>
</body>
</html>