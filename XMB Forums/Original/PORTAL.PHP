<?php
/*
    Mod Name: Portal System v1.0

	Mod Author: John Briggs

	Copyright © 2004 The XMBXtreme Group
	Site: http://www.xmbxtreme.com

	File Name: portal.php

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

loadtemplates('footer_load', 'footer_querynum', 'footer_phpsql', 'footer_totaltime', 'css', 'header', 'footer', 'padmin_error', 'padmin_copyright', 'portal_ticker', 'portal_news', 'portal_news_archive', 'portal_guest', 'portal_member', 'portal_whosonline', 'portal_home', 'portal_main_menu', 'portal_google', 'portal_search', 'portal_main_block', 'portal_member_mood', 'portal_newmember', 'portal_newposts', 'portal_top_members', 'portal_quick_reg_password', 'portal_quick_reg', 'portal_websearch');

eval("\$css = \"".template("css")."\";");

smcwcache();

nav(stripslashes($portal_title));

eval("echo (\"".template('header')."\");");

if ($SETTINGS['portalstatus'] != 'on') {
	portalerrormsg($lang['portaloffmsg']);
}

$plinks = array();

// Forums-link
$plinks[] = "&raquo;&nbsp;<a href=\"$boardurl\"><font class=\"smalltxt\">$lang[portalmainnav]</font></a>";

// Search-link
if ($SETTINGS['searchstatus'] == 'on') {
    $plinks[] = "&raquo;&nbsp;<a href=\"misc.php?action=search\"><font class=\"smalltxt\">$lang[textsearch]</font></a>";
}

// Faq-link
if ($SETTINGS['faqstatus'] == 'on') {
    $plinks[] = "&raquo;&nbsp;<a href=\"faq.php\"><font class=\"smalltxt\">$lang[textfaq]</font></a>";
}

// Memberlist-link
if ($SETTINGS['memliststatus'] == 'on') {
    $plinks[] = "&raquo;&nbsp;<a href=\"misc.php?action=list\"><font class=\"smalltxt\">$lang[textmemberlist]</font></a>";
}

// Today's posts-link
if ($SETTINGS['todaysposts'] == 'on') {
    $plinks[] = "&raquo;&nbsp;<a href=\"today.php\"><font class=\"smalltxt\">$lang[navtodaysposts]</font></a>";
}

// Stats-link
if ($SETTINGS['stats'] == 'on') {
    $plinks[] = "&raquo;&nbsp;<a href=\"stats.php\"><font class=\"smalltxt\">$lang[navstats]</font></a>";
}

// 'Forum Rules'-link
if ($SETTINGS['bbrules'] == 'on') {
    $plinks[] = "&raquo;&nbsp;<a href=\"faq.php?page=forumrules\"><font class=\"smalltxt\">$lang[textbbrules]</font></a>";
}

$plinks = implode("<br />", $plinks);

// Create the query for
$restrict = 'WHERE';
switch ($self['status']) {
    case 'member':
        $restrict .= " f.private !='3' AND";
    case 'Moderator':
    case 'Super Moderator':
        $restrict .= " f.private != '2' AND";
    case 'Administrator':
        $restrict .= " f.userlist = '' AND f.password = '' AND";
    case 'Super Administrator':
        break;
    default:
        $restrict .= " f.private !='3' AND f.private != '2' AND f.userlist = '' AND f.password = '' AND";
        break;
}

$query = $db->query("SELECT COUNT(tid) FROM $table_threads");
$portal_threads = $db->result($query, 0);
$db->free_result($query);

$query = $db->query("SELECT COUNT(pid) FROM $table_posts");
$portal_posts = $db->result($query, 0);
$db->free_result($query);

$query = $db->query("SELECT COUNT(postnum) FROM $table_members");
$portal_members = $db->result($query, 0);
$db->free_result($query);

$portal_newest_topic = '';
$query = $db->query("SELECT t.lastpost, t.tid, t.subject FROM $table_threads t, $table_forums f $restrict f.fid = t.fid ORDER BY lastpost DESC LIMIT 0,1");
while ($last = $db->fetch_array($query)) {
    $last_subject = stripslashes(censor($last['subject']));
    $portal_newest_topic .= "<a href=\"viewthread.php?tid=$last[tid]\">$last_subject</a>";
}

$query = $db->query("SELECT regdate FROM $table_members ORDER BY regdate LIMIT 0, 1");
$days = (time() - @$db->result($query, 0)) / 86400;
if ($days > 0) {
    $membersday = number_format(($portal_members / $days), 2);
} else {
    $membersday = number_format(0, 2);
}
$db->free_result($query);

$timesearch = $onlinetime - 86400;
$eval = $lang['evalnobestmember'];

$query = $db->query("SELECT author, Count(author) AS Total FROM $table_posts WHERE dateline >= '$timesearch' GROUP BY author ORDER BY Total DESC LIMIT 1");
$info = $db->fetch_array($query);

$bestmember = $info['author'];
if ($bestmember == '') {
	$portal_membesthtml = '';
    $bestmember = 'Nobody';
    $bestmemberpost = 'No';
} else {
    if ($info['Total'] != 0) {
        $portal_membesthtml = "<a href=\"member.php?action=viewpro&amp;member=".rawurlencode($bestmember)."\"><strong>$bestmember</strong></a>";
        $bestmemberpost = $info['Total'];
        $eval = $lang['evalbestmember'];
    }
}

$portal_news = '';
$query = $db->query("SELECT * FROM $table_forums WHERE fid='$portal_newsfid'");
$forum = $db->fetch_array($query);
$query = $db->query("SELECT DISTINCT * FROM $table_posts WHERE fid='$portal_newsfid' GROUP BY (tid) ORDER BY dateline DESC LIMIT 0,$portal_newsdisplays");
while ($news = $db->fetch_array($query)) {
	$readmore = '';
	$tid = '';
	$author = $news['author'];
	$tid = $news['tid'];
	$date = gmdate("$dateformat", $news['dateline'] + ($timeoffset * 3600) + ($addtime * 3600));
	$time = gmdate("$timecode", $news['dateline'] + ($timeoffset * 3600) + ($addtime * 3600));
	$formatdate = "$date $lang[textat] $time";
	if (empty($news['subject'])) {
	    $news['subject'] = "$lang[textnosub]";
	}

	$subject = stripslashes(censor($news['subject']));
	$message = stripslashes(censor($news['message']));
	$message = postify($message, 'no', 'no', $forum['allowsmilies'], $SETTINGS['sightml'], $SETTINGS['sigbbcode'], $forum['allowimgcode'], false);

	$querynext = $db->query("SELECT COUNT(*) FROM $table_posts WHERE tid = '$tid'");
	$comments = $db->result($querynext, 0);
	$comments -= 1;

	if ($comments == 1) {
		$comment_txt = $lang['portalcomment'];
	} else {
		$comment_txt = $lang['portalcomments'];
	}

	if ($comments > 0) {
		$comments = "<a href=\"viewthread.php?tid=$tid\">$comments $comment_txt</a> |";
	} else {
		$comments = '';
	}

	if (!empty($news['icon'])) {
		$icon = "<img src=\"$smdir/$news[icon]\" border=\"0\" alt=\"$news[icon]\" title=\"$news[icon]\" />";
	} else {
		$icon = "<img src=\"$smdir/$portal_dgif\" border=\"0\" alt=\"$portal_dgif\" title=\"$portal_dgif\" />";
	}

	$close = $db->query("SELECT closed FROM $table_threads WHERE tid = '$tid'");
	$closed = $db->result($close, 0);

	if ($closed == 'yes') {
		$postcomment = "Closed |";
	} else {
		$postcomment = "<a href=\"post.php?action=reply&amp;fid=$portal_newsfid&amp;tid=$tid\">$lang[textreply]</a> |";
	}
	eval("\$portal_ne = \"".template("portal_news")."\";");
	$portal_news .= $portal_ne;
}
eval("\$portal_news_archive = \"".template("portal_news_archive")."\";");

$memcount = 1;
$query = $db->query("SELECT * FROM $table_members ORDER BY postnum DESC LIMIT 0, $portal_topmembers");
while ($top_member = $db->fetch_array($query)) {
	if (empty($top_members_list)) {
		$avatar = '';
		if (!empty($top_member['avatar']) && $show_avatar == 'on') {
			$avatar = "<img src=\"$top_member[avatar]\" border=\"0\" alt=\"$lang[altavatar]\" title=\"$lang[altavatar]\" /></a></div><br />";
		}
		$top_members_list = "<div align=\"center\"><a href=\"member.php?action=viewpro&amp;member=".rawurlencode($top_member['username'])."\">$avatar<strong><a href=\"member.php?action=viewpro&amp;member=".rawurlencode($top_member['username'])."\">$top_member[username]</a></strong><br /><strong>$lang[portalrank]</strong>: $top_member[status]<br /><strong>$lang[memposts]</strong>: $top_member[postnum]<br /><br /><hr noshade color=\"$bordercolor\" size=\"1\" />";
		$memcount++;
	} else {
		$top_members_list .= "<strong>$memcount. <a href=\"member.php?action=viewpro&amp;member=".rawurlencode($top_member['username'])."\" title=\"$lang[memposts] $top_member[postnum]\">$top_member[username]</a></strong><br /><strong>$lang[portalrank]</strong>: $top_member[status]<br /><strong>$lang[memposts]</strong>: $top_member[postnum]<br /><br />";
		$memcount++;
	}
}

$portal_postsnull = stripslashes($portal_postsnull);
if (!eregi("[1-9]",$portal_postsnull)) {
	$dont_fid1 = '';
	$dont_fid2 = '';
} else {
	$dont_fid1 = "AND fid NOT IN $portal_postsnull";
	$dont_fid2 = "where fid NOT IN $portal_postsnull";
}

$portal_hot_subject = '';
$portal_hotdate = $onlinetime - ($portal_hotdate * 86400);
$query = $db->query("SELECT tid, subject FROM $table_threads WHERE (substring_index(lastpost, '|',1)+1) >= '$portal_hotdate' $dont_fid1 ORDER BY replies DESC LIMIT 0, $portal_hottopics");
while ($reply = $db->fetch_array($query)) {
	$reply_subject = stripslashes(censor($reply['subject']));
	$portal_hot_subject .= "<br /><a href=\"viewthread.php?tid=$reply[tid]\">$reply_subject</a>";
}

$count = 0;
$thisbg = $altbg2;
$post_list = '';
$query = $db->query("SELECT tid, subject FROM $table_threads $dont_fid2 ORDER BY lastpost DESC LIMIT 0, $portal_mposts");
while ($last = $db->fetch_array($query)) {
	$last['subject'] = stripslashes(censor($last['subject']));

	if (!empty($last['icon'])) {
		$last['icon'] = "<img src=\"$smdir/$last[icon]\" border=\"0\" alt=\"$last[icon]\" title=\"$last[icon]\" />";
	} else {
		$last['icon'] = "<img src=\"$smdir/$portal_dgif\" border=\"0\" alt=\"$portal_dgif\" title=\"$portal_dgif\" />";
	}

	if ($count == 0) {
		$portal_newest_topic = "<a href=\"viewthread.php?tid=$last[tid]\">$last[subject]</a>";
	}

	$post_list .= "<tr bgcolor=\"$thisbg\" class=\"tablerow\"><td width=\"1\">$last[icon]</td><td><a href=\"viewthread.php?tid=$last[tid]\">$last[subject]</a></td></tr>\n";

	if ($thisbg == "$altbg2") {
		$thisbg = $altbg1;
	} else {
		$thisbg = $altbg2;
	}
	$count++;
}

$num = 0;
$new_members_list = '';
$query = $db->query("SELECT username FROM $table_members ORDER BY regdate DESC LIMIT 0, $portal_newmembers");
while ($lastmem = $db->fetch_array($query)) {
	if ($num == 0) {
		$portal_newest_member = "<a href=\"member.php?action=viewpro&amp;member=".rawurlencode($lastmem['username'])."\"><strong>$lastmem[username]</strong></a>";
	}
	$new_members_list .= "<a href=\"member.php?action=viewpro&amp;member=".rawurlencode($lastmem['username'])."\">$lastmem[username]</a><br />\n";
	$num++;
}

if (!X_MEMBER){
	$pwtd = '';
	if ($SETTINGS['emailcheck'] != 'on') {
		eval("\$pwtd = \"".template("portal_quick_reg_password")."\";");
	}
	eval("\$portal_welcome = \"".template("portal_guest")."\";");
	eval("\$portal_welcome .= \"".template("portal_quick_reg")."\";");
}

if (X_MEMBER) {
	$query = $db->query("SELECT * FROM $table_members WHERE username = '$xmbuser'");
	$member = $db->fetch_array($query);

	$db->query("UPDATE $table_members SET avatar = '$self[avatar]' WHERE uid = '$self[uid]'");

	$avatar = '';
	if ($member['avatar']) {
		$avatar = "<img src=\"$member[avatar]\" alt=\"$lang[altavatar]\" title=\"$lang[altavatar]\" border=\"0\" /><br />";
	}
	eval("\$portal_welcome = \"".template("portal_member")."\";");
}

$ticker = '';
if ($SETTINGS['portal_ticker'] == 'on') {
    $tickercontents = str_replace("\r\n", "\n", $tickercontents);
    $tickercontents = str_replace("\r", "\n", $tickercontents);
    $news = explode("\n", $tickercontents);
    $contents = '';
    for ($i=0; $i < count($news); $i++) {
        if (strlen(trim($news[$i])) == 0) {
            continue;
        }
        $news[$i] = postify($news[$i], 'no', 'no', 'yes', 'no', 'yes', 'yes', false, 'yes', 'no');
        $news[$i] = str_replace('\"', '"', addslashes($news[$i]));
        $contents .= "\tcontents[$i]='$news[$i]';\n";
    }
    eval("\$ticker  = \"".template("portal_ticker")."\";");
}

if ($SETTINGS['portal_whosonline'] == 'on') {
	$guestcount     = 0;
	$membercount    = 0;
	$hiddencount    = 0;
	$member         = array();

	$query  = $db->query("SELECT m.status, m.username, m.invisible, w.* FROM $table_whosonline w LEFT JOIN $table_members m ON m.username=w.username ORDER BY w.username");
	while($online = $db->fetch_array($query)) {
		switch($online['username']) {
			case 'xguest123':
				$guestcount++;
				break;

			default:
				if ($online['invisible'] != 0 && X_ADMIN) {
					$member[] = $online;
					$hiddencount++;
				} elseif ( $online['invisible'] != 0) {
					$hiddencount++;
				} else {
					$member[] = $online;
					$membercount++;
				}
				break;
		}
	}

	$db->free_result($query);

	$onlinetotal = $guestcount + $membercount;

	if ($membercount != 1) {
		$membern = "<strong>$membercount</strong> $lang[textmembers]";
	} else {
		$membern = "<strong>1</strong> $lang[textmem]";
	}

	if ($guestcount != 1) {
		$guestn = "<strong>$guestcount</strong> $lang[textguests]";
	} else {
		$guestn = "<strong>1</strong> $lang[textguest1]";
	}

	if ($hiddencount != 1) {
		$hiddenn = "<strong>$hiddencount</strong> $lang[texthmems]";
	} else {
		$hiddenn = "<strong>1</strong> $lang[texthmem]";
	}

	eval($lang['whosoneval']);
	$memonmsg = "<span class=\"smalltxt\">$lang[whosonmsg]</span>";

	$memtally = array();
	$num = 1;
	$comma = "";
	$show_total = (X_ADMIN) ? ($membercount+$hiddencount) : ($membercount);

	$show_inv_key = false;

	for($mnum=0; $mnum<$show_total; $mnum++) {
		$pre = '';
		$suff = '';

		$online = $member[$mnum];
		switch($online['status']) {
			case 'Super Administrator':
				$pre = "<strong><u><em>";
				$suff = "</em></u></strong>";
				break;
			case 'Administrator':
				$pre = "<strong><u>";
				$suff = "</u></strong>";
				break;
			case 'Super Moderator':
				$pre = "<em><strong>";
				$suff = "</strong></em>";
				break;
			case 'Moderator':
				$pre = "<strong>";
				$suff = "</strong>";
				break;
			default:
				$pre = "";
				$suff = "";
				break;
		}

		if ($online['invisible'] != 0) {
			$pre .= "<strike>";
			$suff .= "</strike>";
			if (!X_ADMIN && $online['username'] != $xmbuser) {
				$num++;
				continue;
			}
		}
		if ( $online['username'] == $xmbuser && $online['invisible'] != 0) {
			$show_inv_key = true;
		}

		$memtally[] = "<a href=\"member.php?action=viewpro&amp;member=".rawurlencode($online['username'])."\">$pre$online[username]$suff</a>";

		$num++;
	}
	if (X_ADMIN || $show_inv_key === true) {
		$hidden = " - <strike>$lang[texthmem]</strike>";
	}else{
		$hidden = '';
	}
	$memtally = implode(', ', $memtally);

	if ( $memtally == "") {
		$memtally = "&nbsp;";
	}

	$datecut = time() - (3600 * 24);
	if (X_ADMIN) {
		$query = $db->query("SELECT username FROM $table_members WHERE lastvisit >= '$datecut' ORDER BY lastvisit DESC LIMIT 0, 50");
	}else{
		$query = $db->query("SELECT username FROM $table_members WHERE lastvisit >= '$datecut' AND invisible != '1' ORDER BY lastvisit DESC LIMIT 0, 50");
	}

	$todaymembersnum = 0;
	$todaymembers = '';
	$comma = '';

	while ($memberstoday = $db->fetch_array($query)) {
			$todaymembers .= "$comma <a href=\"member.php?action=viewpro&amp;member=".rawurlencode($memberstoday['username'])."\">".$memberstoday['username']."</a>";
			++$todaymembersnum;
			$comma = ", ";
	}

	$db->free_result($query);

	if ($todaymembersnum == 1) {
		$memontoday = $todaymembersnum . $lang['textmembertoday'];
	} else {
		$memontoday = $todaymembersnum . $lang['textmemberstoday'];
	}

    eval("\$whosonline = \"".template("portal_whosonline")."\";");
}

$moodmems_list = '';
$query = $db->query("SELECT username, mood FROM $table_members WHERE mood!='$lang[nomoodtext]' AND mood!=''  AND mood!='Not Defined' ORDER BY RAND() LIMIT 0, $portal_rmods");
while ($moodmems = $db->fetch_array($query)) {
    if (!empty($moodmems['mood'])) {
        $moodmems['mood'] = postify($moodmems['mood'], 'no', 'no', 'yes', 'no', 'yes', 'no', true, 'yes');
    } else {
	    $moodmems['mood'] = $lang['nomoodtext'];
    }
	$moodmems_list .= "<tr><td class=\"mediumtxt\" bgcolor=\"$altbg2\"><a href=\"member.php?action=viewpro&amp;member=".rawurlencode($moodmems['username'])."\">$moodmems[username]</a></td><td class=\"mediumtxt\" bgcolor=\"$altbg1\">$moodmems[mood]</td></tr>\n";
}

$portalquery = $db->query("SELECT p.*, t.* FROM ".$tablepre."portal_templates p LEFT JOIN $table_templates t ON t.name = p.name WHERE p.status = 'on' ORDER BY p.displayorder ASC  LIMIT 0 , 30");
while ($block = $db->fetch_array($portalquery)) {
	if ($block['direction'] == 'center' && $block['status'] == 'on' && $block['displayorder'] == $block['displayorder']) {
		eval("\$center[] = \"".template("$block[name]")."\";");
	} elseif ($block['direction'] == 'right' && $block['status'] == 'on' && $block['displayorder'] == $block['displayorder']) {
		eval("\$right[] = \"".template("$block[name]")."\";");
	} elseif ($block['direction'] == 'left' && $block['status'] == 'on' && $block['displayorder'] == $block['displayorder']) {
		eval("\$left[] = \"".template("$block[name]")."\";");
	}
}
$centerblock = implode("<br />", $center);
$rightblock = implode("<br />", $right);
$leftblock = implode("<br />", $left);

eval('echo stripslashes("'.template('portal_home').'");');

eval("echo (\"".template('padmin_copyright')."\");");

end_time();

eval("echo (\"".template('footer')."\");");
?>