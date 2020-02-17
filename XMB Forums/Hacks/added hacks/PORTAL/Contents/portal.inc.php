<?php
/*
    Mod Name: Portal System v1.0

	Mod Author: John Briggs

	Copyright © 2004 The XMBXtreme Group
	Site: http://www.xmbxtreme.com

	File Name: portal.inc.php

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

function portalerrormsg($portalerrormsg) {
	global $footerstuff;

	reset ($GLOBALS);
	while (list ($key, $val) = each ($GLOBALS)) {
		$$key = $val;
	}

	eval("echo (\"".template('padmin_error')."\");");

	eval("echo (\"".template('padmin_copyright')."\");");

	end_time();

	eval("echo (\"".template('footer')."\");");

	exit;
}

function portalconfirmmsg($portalconfirmmsg, $url) {
	global $altbg1, $altbg2, $lang, $imgdir, $bordercolor, $borderwidth, $tablespace, $cattext, $tablewidth;

	eval("echo (\"".template('padmin_confirm')."\");");

	if (!empty($url)) {
		?>
		<script language="javascript" type="text/javascript">
		function redirect() {
			window.location.replace("<?=$url?>");
		}
		setTimeout("redirect();", 1200);
		</script>
		<?php
	}
}

$bbname   = stripslashes($bbname);
$sitename = stripslashes($sitename);
?>