<?php
/*
	SHOP HACK v1.3 by NFPUNK/FLIXON

	If you require support please post in the forum
	at www.flixon.com/shop/forum.  Thanks

	- nfpunk/Flixon
*/

require "./header.php";

if(!X_ADMIN) {
	eval("\$notadmin = \"".template('error_nologinsession')."\";");
	echo $notadmin;
	exit();
}

eval("\$css = \"".template('css')."\";");

?>

<html>
<head>
<title>Installation Shop Hack v1.3</title>
<?php echo $css?>
</head>
<body text="<?php echo $text?>">

<table cellspacing="0" cellpadding="0" width="<?php echo $tablewidth?>" align="center">
<tr>
<td bgcolor="<?php echo $bordercolor?>">
<table cellspacing="<?php echo $borderwidth?>" cellpadding="<?php echo $tablespace?>" width="100%">
<tr>
<td class="category">Installation Shop Hack v1.3</td>
</tr>
<tr>
<td bgcolor="<?php echo $altbg2?>" class="tablerow">

<?php

if(!$action) {
	echo "<center>This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.<br />
	<br />
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.<br />
	<br />
	<a href=\"http://www.gnu.org/copyleft/gpl.html\" target=\"_blank\">http://www.gnu.org/copyleft/gpl.html</a>
	<br /><br />
	<a href=\"install.php?action=accept\">ACCEPT</a>
	</center>";
}

if($action == "accept") {
	echo "Starting instalation...<br />";

	echo "Creating ".$tablepre."member_items...<br />";

	$db->query("DROP TABLE IF EXISTS ".$tablepre."member_items");
	$db->query("CREATE TABLE ".$tablepre."member_items (
		iid smallint(6) NOT NULL,
		uid smallint(6) NOT NULL,
		quantity int(10) NOT NULL default '0'
	)");

	echo "Altering ".$tablepre."members...<br />";

	$db->query("ALTER TABLE ".$tablepre."members
		ADD money int(10) NOT NULL default '0',
		ADD bank_balance int(10) NOT NULL default '0',
		ADD glowcolor varchar(6) NOT NULL default '',
		ADD hexcolor varchar(6) NOT NULL default '',
		ADD pphoto varchar(75) NOT NULL default ''
	");

	echo "Altering ".$tablepre."settings...<br />";

	$db->query("ALTER TABLE ".$tablepre."settings
		ADD bank_lastdate varchar(10) NOT NULL default '0|0|0',
		ADD bank_hour int(2) NOT NULL default '0',
		ADD bank_interest int(3) NOT NULL default '2'
	");

	echo "Creating ".$tablepre."shop_bank...<br />";

	$db->query("DROP TABLE IF EXISTS ".$tablepre."shop_bank");
	$db->query("CREATE TABLE ".$tablepre."shop_bank (
		fromuid smallint(6) NOT NULL,
		touid smallint(6) NOT NULL,
		dateline bigint(30) NOT NULL,
		amount int(10) NOT NULL default '0',
		comment text NOT NULL,
		type varchar(10) NOT NULL
	)");

	echo "Creating ".$tablepre."shop_cats...<br />";

	$db->query("DROP TABLE IF EXISTS ".$tablepre."shop_cats");
	$db->query("CREATE TABLE ".$tablepre."shop_cats (
		id smallint(6) NOT NULL auto_increment,
		cid smallint(6) NOT NULL default '0',
		owner smallint(6) NOT NULL,
		catname varchar(100) NOT NULL,
		description text NOT NULL,
		displayorder int(10) NOT NULL,
		private char(3) NOT NULL,
		userlist text NOT NULL,
		lastadd varchar(64) NOT NULL,
		password varchar(32) NOT NULL default '',
		status char(3) NOT NULL,
		creatoronly char(3) NOT NULL,
		views int(10) NOT NULL default '0',
		items int(10) NOT NULL default '0',
		ownermoney char(3) NOT NULL,
		PRIMARY KEY (id)
	)");

	$db->query("INSERT INTO ".$tablepre."shop_cats VALUES (1, 0, 0, 'Features Store', 'You can buy different abilities here!', 1, '3|1', '|', '', '', 'on', 'off', 0, 7, 'off');");
	$db->query("INSERT INTO ".$tablepre."shop_cats VALUES (2, 0, 0, 'Item Store', 'You can buy different items here!', 2, '3|1', '|', '', '', 'off', 'off', 0, 0, 'off');");

	echo "Creating ".$tablepre."shop_items...<br />";

	$db->query("DROP TABLE IF EXISTS ".$tablepre."shop_items");
	$db->query("CREATE TABLE ".$tablepre."shop_items (
		id smallint(6) NOT NULL auto_increment,
		cid smallint(6) NOT NULL,
		feature varchar(32) NOT NULL default '',
		owner smallint(6) NOT NULL,
		itemname varchar(100) NOT NULL,
		description text NOT NULL,
		displayorder int(10) NOT NULL,
		imageurl varchar(64) NOT NULL,
		dateline bigint(30) NOT NULL,
		status char(3) NOT NULL,
		multiple char(3) NOT NULL,
		sold int(10) NOT NULL default '0',
		rate int(10) NOT NULL default '0',
		votes int(10) NOT NULL default '0',
		comments int(10) NOT NULL default '0',
		price int(10) NOT NULL default '0',
		stock int(10) NOT NULL default '0',
		PRIMARY KEY (id)
	)");

	$db->query("INSERT INTO ".$tablepre."shop_items VALUES (1, 1, 'cusername', 0, 'Change Username', 'With this action you can change your username.', 1, '', ".time().", 'on', 'on', 0, 0, 0, 0, 10000, 9999);");
	$db->query("INSERT INTO ".$tablepre."shop_items VALUES (2, 1, 'glow', 0, 'Glowing Username', 'With this action you can add an attractive glowing color to your username.', 2, '', ".time().", 'on', 'on', 0, 0, 0, 0, 7500, 9999);");
	$db->query("INSERT INTO ".$tablepre."shop_items VALUES (3, 1, 'color', 0, 'Change Username Colour', 'With this action you can change your username color.', 3, '', ".time().", 'on', 'on', 0, 0, 0, 0, 5000, 9999);");
	$db->query("INSERT INTO ".$tablepre."shop_items VALUES (4, 1, 'pp', 0, 'Personal Photo', 'Upload your own personal photo which members can view in your profile.', 4, '', ".time().", 'on', 'on', 0, 0, 0, 0, 5000, 9999);");
	$db->query("INSERT INTO ".$tablepre."shop_items VALUES (5, 1, 'avatar100', 0, 'Upload Avatar (100*100)', 'Upload your own avatar (Maxsize - 100*100).', 5, '', ".time().", 'on', 'on', 0, 0, 0, 0, 1000, 9999);");
	$db->query("INSERT INTO ".$tablepre."shop_items VALUES (6, 1, 'avatar200', 0, 'Upload Avatar (200*200)', 'Upload your own avatar (Maxsize - 200*200).', 6, '', ".time().", 'on', 'on', 0, 0, 0, 0, 2500, 9999);");
	$db->query("INSERT INTO ".$tablepre."shop_items VALUES (7, 1, 'cstatus', 0, 'Change Custom Status', 'Change your custom status which appears under username in posts.', 7, '', ".time().", 'on', 'on', 0, 0, 0, 0, 1000, 9999);");

	echo "Creating ".$tablepre."shop_settings...<br />";

	$db->query("DROP TABLE IF EXISTS ".$tablepre."shop_settings");
	$db->query("CREATE TABLE ".$tablepre."shop_settings (
		shoprules char(3) NOT NULL,
		shoprulestxt text NOT NULL,
		private char(3) NOT NULL,
		userlist text NOT NULL,
		search char(3) NOT NULL,
		stats char(3) NOT NULL,
		rating char(3) NOT NULL,
		subcats char(3) NOT NULL,
		maxitems int(10) NOT NULL,
		hotcat int(10) NOT NULL,
		hotitem int(10) NOT NULL,
		maxwidth int(10) NOT NULL,
		maxheight int(10) NOT NULL,
		maxsize int(10) NOT NULL,
		mpr int(10) NOT NULL,
		mpt int(10) NOT NULL,
		mpp int(10) NOT NULL,
		std int(10) NOT NULL,
		spd int(10) NOT NULL,
		imagename int(10) NOT NULL,
		bank char(3) NOT NULL,
		bank_sellitempercent int(3) NOT NULL,
		bank_fee int(3) NOT NULL
	)");

	$db->query("INSERT INTO ".$tablepre."shop_settings VALUES('on', 'You can modify this by going to the shop admin panel! Alternatively you can turn off this feature!', '3|1', '|', 'on', 'on', 'on', 'on', 50, 20, 50, 80, 80, 100000, 50, 30, 20, 40, 30, 0, 'on', 80, 2);");

	echo "Creating ".$tablepre."shop_votes...<br />";

	$db->query("DROP TABLE IF EXISTS ".$tablepre."shop_votes");
	$db->query("CREATE TABLE ".$tablepre."shop_votes (
		iid smallint(6) NOT NULL,
		uid smallint(6) NOT NULL
	)");

	echo "Inserting data into ".$tablepre."templates...<br />";

	$db->query("DELETE FROM ".$tablepre."templates WHERE name='member_profile_pphoto'");
	$db->query("DELETE FROM ".$tablepre."templates WHERE name LIKE 'shop%'");

	$filesize = filesize('templates2.xmb');
	$fp = fopen('templates2.xmb','r');
	$templatesfile = fread($fp,$filesize);
	fclose($fp);
	$templates = explode("|#*XMB TEMPLATE FILE*#|", $templatesfile);

	while(list($key, $val) = each($templates)) {
		$template = explode("|#*XMB TEMPLATE*#|", $val);
		$template['1'] = addslashes($template['1']);
		$db->query("INSERT INTO ".$tablepre."templates VALUES('', '".addslashes($template[0])."', '".addslashes($template[1])."')");
	}

	$db->query("DELETE FROM ".$tablepre."templates WHERE name=''");

	echo "Installation complete! Read Installation.txt for the next step! Remember to remove this file, upgrade.php & templates2.xmb!";
}

?>

</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>