<?php
/* $Id: member.php,v 1.23.2.22 2004/10/27 08:52:04 Tularis Exp $ */
/*
    XMB 1.9
    © 2001 - 2004 Aventure Media & The XMB Development Team
    http://www.aventure-media.co.uk
    http://www.xmbforum.com

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

require "./header.php";
include('./include/theme.inc.php');

loadtemplates('footer_load', 'footer_querynum', 'footer_phpsql', 'footer_totaltime','member_coppa','member_reg_rules','member_reg_password','member_reg_avatarurl','member_reg_avatarlist','member_reg','member_profile_email','member_profile','member_profile_sig','header','footer','css');
smcwcache();
eval("\$css = \"".template("css")."\";");

nav(($action=='reg') ? ($lang['textregister']) : (($action == 'viewpro') ? ($lang['textviewpro']) : (($action == 'avs') ? ($lang['avs_01']) : (($action == 'coppa') ? ($lang['textcoppa']) : (($action == 'vicious') ? ($SETTINGS['VH_title']) : ($lang['error']))))));

$checked = '';

if ($action == "coppa") {
    if (X_MEMBER) {
        eval("\$featurelin = \"".template("misc_feature_not_while_loggedin")."\";");
        eval("echo (\"".template('header')."\");");
        echo $featurelin;
        end_time();
        eval("echo (\"".template('footer')."\");");
        exit();
    }

    if ($SETTINGS['coppa'] != 'on') {
        redirect("./member.php?action=reg", 0);
    }

    if ($coppasubmit) {
        redirect("member.php?action=reg", 0);
    } else {
        eval("echo (\"".template('header')."\");");
        eval("\$page = \"".template("member_coppa")."\";");
        $page = stripslashes($page);
        echo $page;
    }


} elseif ($action == "reg") {
    $time = time()-86400; // take the date and distract 24 hours from it
    $query = $db->query("SELECT count(uid) FROM $table_members WHERE regdate > '$time'");
    // Select amount of registrations since $time, which is since 24 hours.
    if ($db->result($query, 0) > $max_reg_day) {
        error($lang['max_regs']);
    }

    if ($regstatus != "on") {
        eval("\$featureoff = \"".template("misc_feature_notavailable")."\";");
        eval("echo (\"".template('header')."\");");
        echo $featureoff;
        end_time();
        eval("echo (\"".template('footer')."\");");
        exit();
    }

    if ( X_MEMBER ) {
        eval("\$featurelin = \"".template("misc_feature_not_while_loggedin")."\";");
        eval("echo (\"".template('header')."\");");
        echo $featurelin;
        end_time();
        eval("echo (\"".template('footer')."\");");
        exit();
    }

    if (!isset($regsubmit)) {
        eval("echo (\"".template('header')."\");");
        if ($bbrules == "on" && !$rulesubmit) {
            $bbrulestxt = stripslashes(stripslashes($bbrulestxt));
            $bbrulestxt = nl2br($bbrulestxt);
            eval("\$page = \"".template("member_reg_rules")."\";");
            $page = stripslashes($page);
            echo $page;
        } else {

            $newschecked = 'CHECKED';

            $currdate = gmdate($timecode, time()+ ($addtime * 3600));
            eval($lang['evaloffset']);

            $themelist = '<select name="thememem">'."\n".'<option value="">'.$lang['textusedefault'].'</option>';
            $query = $db->query("SELECT themeid, name FROM $table_themes ORDER BY name ASC");
            while ($themeinfo = $db->fetch_array($query)) {
                $themelist .= "<option value=\"" .$themeinfo['themeid']. "\">" .stripslashes($themeinfo['name']). "</option>\n";
            }
            $themelist  .= "</select>";

            $langfileselect = "<select name=\"newlangfile\">\n";
            $dir = opendir("lang");
            while ($thafile = readdir($dir)) {
                if (is_file("lang/$thafile") && false !== strpos($thafile, 'lang.php')) {
                    $thafile = str_replace(".lang.php", "", $thafile);
                    if ($thafile == $langfile) {
                        $langfileselect .= "<option value=\"$thafile\" selected=\"selected\">$thafile</option>\n";
                    } else {
                        $langfileselect .= "<option value=\"$thafile\">$thafile</option>\n";
                    }
                }
            }
            $langfileselect .= "</select>";


            $dayselect = "<select name=\"day\">\n";
            $dayselect .= "<option value=\"\">&nbsp;</option>\n";
            for ($num = 1; $num <= 31; $num++) {
                $dayselect .= "<option value=\"$num\">$num</option>\n";
            }
            $dayselect .= "</select>";

            if ($sigbbcode == "on") {
                $bbcodeis = $lang['texton'];
            } else {
                $bbcodeis = $lang['textoff'];
            }

            if ($sightml == "on") {
                $htmlis = $lang['texton'];
            } else {
                $htmlis = $lang['textoff'];
            }

            if ($emailcheck != "on") {
                eval("\$pwtd = \"".template("member_reg_password")."\";");
            }

            if ($avastatus == "on") {
                eval("\$avatd = \"".template("member_reg_avatarurl")."\";");
            } elseif ($avastatus == "list") {
                $avatars = '<option value=""/>'.$lang['textnone'].'</option>';
                $dir1 = opendir("./images/avatars");
                while ($avatar1 = readdir($dir1)) {
                    if (is_file("./images/avatars/$avatar1")) {
                        $avatars .= " <option value=\"./images/avatars/$avatar1\" />$avatar1</option>  ";
                    }
                }
                closedir($dir1);
                $avatars = str_replace("value=\"$member[avatar]\"", "value=\"$member[avatar]\" selected=\"selected\"", $avatars);

                eval("\$avatd = \"".template("member_reg_avatarlist")."\";");
            }
            eval("\$page = \"".template("member_reg")."\";");
            $page = stripslashes($page);
            echo $page;
        }

    } else {
        $find = array('<', '>', '|', '"', '[', ']', '\\', ',', '@', '\'');
        foreach ($find as $needle) {
            if (false !== strpos($username, $needle)) {
                error($lang['restricted']);
            }
        }

        if ($ipreg != 'off') {
            $time = time()-86400;
            $query = $db->query("SELECT uid FROM $table_members WHERE regip = '$onlineip' AND regdate >= '$time'");
            if ($db->num_rows($query) >= 1) {
                error($lang['reg_today']);
            }
        }

        $email = addslashes(trim($email));

        if ($doublee == "off" && false !== strpos($email, "@")) {
            $email1 = ", email";
            $email2 = "OR email='$email'";
        } else {
            $email1 = '';
            $email2 = '';
        }

        $username = trim($username);
        $query = $db->query("SELECT username$email1 FROM $table_members WHERE username='$username' $email2");

        if ($member = $db->fetch_array($query)) {
            error($lang['alreadyreg']);
        }

        if ($emailcheck == "on") {
            $password = '';
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
            mt_srand((double)microtime() * 1000000);
            for ($get = strlen($chars); $i < 8; $i++) {
                $password .= $chars[mt_rand(0, $get)];
            }
            $password2 = $password;
        }

        $password = trim($password);
        $password2 = trim($password2);

        if ($password != $password2) {
            error($lang['pwnomatch']);
        }

        $fail = false;
        $efail = false;
        $query = $db->query("SELECT * FROM $table_restricted");
        while ($restriction = $db->fetch_array($query)) {
            if ($restriction['case_sensitivity'] == 1) {
                if ($restriction['partial'] == 1) {
                    if (strpos($username, $restriction['name']) !== false) {
                        $fail = true;
                    }
                    if (strpos($email, $restriction['name']) !== false) {
                        $efail = true;
                    }
                } else {
                    if ($username == $restriction['name']) {
                        $fail = true;
                    }
                    if ($email == $restriction['name']) {
                        $efail = true;
                    }
                }
            } else {
                $t_username = strtolower($username);
                $t_email = strtolower($email);
                $restriction['name'] = strtolower($restriction['name']);

                if ($restriction['partial'] == 1) {
                    if (strpos($t_username, $restriction['name']) !== false) {
                        $fail = true;
                    }
                    if (strpos($t_email, $restriction['name']) !== false) {
                        $efail = true;
                    }
                } else {
                    if ($t_username == $restriction['name']) {
                        $fail = true;
                    }
                    if ($t_email == $restriction['name']) {
                        $efail = true;
                    }
                }
            }
        }
        
        $find = array('<', '>', '|', '"', '[', ']', '\\', ',', '@', '\'',' ');
        foreach ($find as $needle) { 
            if (false !== strpos($username, $needle)) { 
                error($lang['restricted']);
            }
        }
        
        if ($fail) {
            error($lang['restricted']);
        }

        if ($efail) {
            error($lang['emailrestricted']);
        }

        if (false === strpos($email, "@")) {
            error($lang['bademail']);
        }

        if ($password == "" || strpos($password, '"') != false || strpos($password, "'") != false) {
            error($lang['textpw1']);
        }

        if (trim($username) == '') {
            error($lang['textnousername']);
        }

        $query = $db->query("SELECT COUNT(uid) FROM $table_members");
        $count1 = $db->result($query,0);

        if ($count1 != "0") {
            $self['status'] = "Member";
        } else {
            $self['status'] = "Super Administrator";
        }

        if ($showemail != "yes") {
            $showemail = "no";
        }

        if ($newsletter != "yes") {
            $newsletter = "no";
        }

        if ($saveogu2u != "yes") {
            $saveogu2u = "no";
        }

        if ($emailonu2u != "yes") {
            $emailonu2u = "no";
        }

        if ($useoldu2u != "yes") {
            $useoldu2u = "no";
        }

        $bday = "$month $day, $year";

        if ($month == "" || $day == "" || $year == "") {
            $bday = "";
        }

        $avatar     = checkInput($avatar, '', '', "javascript", false);
        $dateformatnew    = checkInput($dateformatnew, '', '', "javascript", false);
        $locationnew    = checkInput($locationnew, '', '', "javascript", false);
        $icq        = checkInput($icq, '', '', "javascript", false);
        $yahoo        = checkInput($yahoo, '', '', "javascript", false);
        $aim        = checkInput($aim, '', '', "javascript", false);
        $msn        = checkInput($msn, '', '', "javascript", false);
        $email        = checkInput($email, '', '', "javascript", false);
        $site        = checkInput($site, '', '', "javascript", false);
        $webcam        = checkInput($webcam, '', '', "javascript", false);
        $bio        = checkInput($bio, '', '', "javascript", false);
        $bday        = checkInput($bday, '', '', "javascript", false);
        $mood        = checkInput($newmood, '', '', "javascript", false);
        $sig         = checkInput($_POST['sig']);

        $sig        = addslashes($sig);
        $bio        = addslashes($bio);
        $locationnew    = addslashes($locationnew);

        $password    = md5(trim($password));

        $size = @getimagesize($avatar);
        $max_size = explode('x', $SETTINGS['max_avatar_size']);
        if ($size === false) {
            $avatar = '';
        } elseif (($size[0] > $max_size[0] || $size[1] > $max_size[1]) && !X_SADMIN) {
            error($lang['avatar_too_big'] . $SETTINGS['max_avatar_size'] . 'px');
        }
        $db->query("INSERT INTO $table_members (uid, username, password, regdate, postnum, email, site, aim, status, location, bio, sig, showemail, timeoffset, icq, avatar, yahoo, customstatus, theme, bday, langfile, tpp, ppp, newsletter, regip, timeformat, msn, ban, dateformat, ignoreu2u, lastvisit, mood, pwdate, invisible, u2ufolders, saveogu2u, emailonu2u, useoldu2u, webcam, CustomTheme, vicious, vtime, u2uquota) VALUES ('', '$username', '$password', ".$db->time(time()).", '0', '$email', '$site', '$aim', '$self[status]',  '$locationnew', '$bio', '$sig', '$showemail', '$timeoffset1', '$icq', '$avatar', '$yahoo', '', '$thememem', '$bday', '$newlangfile', '$tpp', '$ppp',  '$newsletter', '$onlineip', '$timeformatnew', '$msn', '', '$dateformatnew', '', '', '$newmood', '', '0', '', '$saveogu2u', '$emailonu2u', '$useoldu2u', '$webcam', '', '0', '', '$u2uquota')");


        if ($SETTINGS['notifyonreg'] != "off") {
            if ($SETTINGS['notifyonreg'] == 'u2u') {
                $mailquery = $db->query("SELECT username FROM $table_members WHERE status='Super Administrator'");
                while ($admin = $db->fetch_array($mailquery)) {
                    $db->query("INSERT INTO $table_u2u ( u2uid, msgto, msgfrom, type, owner, folder, subject, message, dateline, readstatus, sentstatus ) VALUES ('', '$admin[username]', '".addslashes($bbname)."', 'incoming', '$admin[username]', 'Inbox', '$lang[textnewmember]', '$lang[textnewmember2]', '" . time() . "', 'no', 'yes')");
                }
            } else {
                $headers[] = "From: $bbname <$adminemail>";
                $headers[] = "X-Sender: <$adminemail>";
                $headers[] = 'X-Mailer: PHP';
                $headers[] = 'X-AntiAbuse: Board servername - '.$bbname;
                $headers[] = 'X-AntiAbuse: Username - '.$xmbuser;
                $headers[] = 'X-Priority: 2';
                $headers[] = "Return-Path: <$adminemail>";
                $headers[] = 'Content-Type: text/plain; charset=ASCII';
                $headers = implode("\r\n", $headers);

                $mailquery = $db->query("SELECT email FROM $table_members WHERE status = 'Super Administrator'");
                while ($notify = $db->fetch_array($mailquery)) {
                    mail($notify['email'], $lang['textnewmember'], $lang['textnewmember2'], $headers);
                }
            }
        }

        if ($emailcheck == "on") {
            mail($email, $lang['textyourpw'], $lang['textyourpwis']." \n\n$username\n$password2", "From: $bbname <$adminemail>");
        } else {
            $currtime = time() + (86400*30);
            put_cookie("xmbuser", $username, $currtime, $cookiepath, $cookiedomain);
            put_cookie("xmbpw", $password, $currtime, $cookiepath, $cookiedomain);
        }
        eval("echo (\"".template('header')."\");");
        echo ($emailcheck == "on") ? "<center><span class=\"mediumtxt \">$lang[emailpw]</span></center>" : "<center><span class=\"mediumtxt \">$lang[regged]</span></center>";

        redirect('index.php', 2, X_REDIRECT_JS);
    }

} elseif ($action == "vicious") {

    if($SETTINGS[VH_status] != "on"){
        nav($lang['error']);
        eval("echo (\"".template('header')."\");");
        eval("echo (\"".template('misc_feature_notavailable')."\");");
        end_time();
        eval("echo (\"".template('footer')."\");");
        exit;
    }
    if(!$xmbuser || !$xmbpw){ error($lang['welcomeunregnotify'], false, '', '', false, true, false, true); }
    if(!isset($member)){ error($lang['VH_o07'], false, '', '', false, true, false, true); }
    $member = rawurldecode($member); // test
    $member = checkInput($member, '', '', 'javascript', false); // test
    $xmblistname = $xmbuser . ",";
    $xmbliststatus = $self[status] . ",";
    $specialallow = ((eregi($xmblistname, $SETTINGS[VH_allow])) ? "yes" : ((eregi($xmbliststatus, $SETTINGS[VH_allow])) ? "yes" : ""));
    if($self[status] == "Banned"){ $disallow = ""; }
    $disallow = ((eregi($xmblistname, $SETTINGS[VH_banuser])) ? "" : "no");
    $derestrict = ((eregi($xmblistname, $SETTINGS[VH_timegroup])) ? "yes" : ((eregi($xmbliststatus, $SETTINGS[VH_timegroup])) ? "yes" : ""));
    if(($derestrict == "") && ((time() - $self[vtime]) < $SETTINGS[VH_timerestrict])){ $disallow = ""; }
    switch($do){
        case 'smite':
        $doit = (($SETTINGS[VH_moneysmite] != "0") ? "money=money-'$SETTINGS[VH_moneysmite]', " : "");
        if($SETTINGS[VH_bynum] != "" & $self[vicious] >= $SETTINGS[VH_bynum] & $xmbuser != $member & $disallow == "no" || $specialallow == "yes" & $xmbuser != $member & $disallow == "no" || $SETTINGS[VH_bypost] != "" & $self[postnum] >= $SETTINGS[VH_bypost] & $xmbuser != $member & $disallow == "no"){
            $db->query("UPDATE $table_members SET $doit vicious=vicious-$SETTINGS[VH_increment] WHERE username='$member'");
            $db->query("UPDATE $table_members SET vtime='".time()."' WHERE username='$xmbuser'");
            $omessage = $lang['VH_o05'];
        }else{
            nav($lang['error']);
            $omessage = $lang['VH_o06'];
        }
    break;
    case 'praise':
        $doit = (($SETTINGS[VH_moneypraise] != "0") ? "money=money+'$SETTINGS[VH_moneypraise]', " : "");
        if($SETTINGS[VH_bynum] != "" & $self[vicious] >= $SETTINGS[VH_bynum] & $xmbuser != $member & $disallow == "no" || $specialallow == "yes" & $xmbuser != $member & $disallow == "no" || $SETTINGS[VH_bypost] != "" & $self[postnum] >= $SETTINGS[VH_bypost] & $xmbuser != $member & $disallow == "no"){
            $db->query("UPDATE $table_members SET $doit vicious=vicious+$SETTINGS[VH_increment] WHERE username='$member'");
            $db->query("UPDATE $table_members SET vtime='".time()."' WHERE username='$xmbuser'");
            $omessage = $lang['VH_o05'];
        }else{
            nav($lang['error']);
            $omessage = $lang['VH_o06'];
        }
    break;
    default:
        nav($lang['error']);
        $omessage = $lang['VH_o08'];
    }
    eval("echo (\"".template('header')."\");");
    echo "<table cellspacing='0' cellpadding='0' border='0' width='$tablewidth' align='center'>
    <tr><td bgcolor='$bordercolor'>
    <table border='0' cellspacing='$borderwidth' cellpadding='$tablespace' width='100%'>
      <tr>
        <td bgcolor='$altbg1' class='mediumtxt' align='center' width='100%'>
        ".str_replace("*vicious*", $SETTINGS[VH_title], $omessage)."
        </td>
      </tr>
    </table>
    </td></tr></table>";
    redirect((($fr == "view") ? "viewthread.php?tid=$tid&pid=$pid#pid$pid" : (($fr == "pro") ? "member.php?action=viewpro&member=$member" : (($fr == "mem") ? "misc.php?action=list&order=$order&page=$page" : "index.php"))), "2", "");

} elseif ( $action == "avs" ) {

    if ( X_ADMIN && isset($deletesubmit) ) {
        if ( !empty($avs_select) ){ $in = ''; 
            foreach( $avs_select as $value ) {
                $in .= ( empty( $in ) ) ? "uid='$value'" : " OR uid='$value'";
            }
        }
        $db->query("UPDATE $table_members SET avatar='' WHERE $in");
    }
    $tlpp = '21'; $avsmultis = '';
    if ( isset($page) ) {
        if ( $page < 1 ) { $page = 1; }
        $start_limit = ($page-1) * $tlpp;
    } else {
        $start_limit = 0;
        $page = 1;
    }
    $query = $db->query("SELECT count(uid) FROM $table_members WHERE avatar!=''");
    $num = $db->result($query, 0);
    $mpurl = 'member.php?action=avs';
    if ( false !== ($multipage = multi($num, $tlpp, $page, $mpurl)) ) {
        $avsmultis = '<tr><td colspan="3" bgcolor="'.$altbg1.'" class="smalltxt">'.$multipage.'</td></tr>';
    }
    eval("echo (\"".template('header')."\");");
    echo '<form method="post" action="member.php?action=avs">
    <table cellspacing="0" cellpadding="0" border="0" width="'.$tablewidth.'" align="center"><tr><td bgcolor="'.$bordercolor.'">
    <table border="0" cellspacing="'.$borderwidth.'" cellpadding="'.$tablespace.'" width="100%">
    <tr>
    <td colspan="3" class="category"><font color="'.$cattext.'"><strong>'.$lang['avs_01'].'</strong></font></td>
    </tr>'.$avsmultis;
    $C = 0;
    $FAquery = $db->query("SELECT uid, username, avatar FROM $table_members WHERE avatar!='' ORDER BY uid ASC LIMIT $start_limit, $tlpp");
    while ($M = $db->fetch_array($FAquery)) {
        $C++;
        if ( $C == 1 ) { echo '<tr>'; }
        echo '<td bgcolor="'.$altbg1.'" class="tablerow" width="33%">
        <table cellspacing="0" cellpadding="0" border="0" width="100%" height="100%" align="center"><tr><td bgcolor="'.$bordercolor.'">
        <table border="0" cellspacing="'.$borderwidth.'" cellpadding="'.$tablespace.'" width="100%" height="100%">
        <tr>';
        if ( X_ADMIN ) {
            echo '<td class="header"><input type="checkbox" name="avs_select[]" value="'.$M['uid'].'" /> '.$lang['avs_02'].''.$M['uid'].''.$lang['avs_03'].'<a style="color: '.$headertext.';" href="member.php?action=viewpro&member='.rawurlencode($M['username']).'">'.$M['username'].'</a></td>';
        } else {
            echo '<td class="header">'.$lang['avs_02'].''.$M['uid'].''.$lang['avs_03'].'<a style="color: '.$headertext.';" href="member.php?action=viewpro&member='.rawurlencode($M['username']).'">'.$M['username'].'</a></td>';
        }
        echo '</tr>
        <tr><td bgcolor="'.$altbg2.'" width="100%" height="100%" align="center" valign="middle"><img border="0" alt="" src="'.$M['avatar'].'"></td></tr>
        </table>
        </td></tr></table>
        </td>';
        if($C == 3){ echo '</tr>'; $C = 0; }
    }
    if ( $C == 1 ) { echo '<td bgcolor="'.$altbg1.'" class="tablerow" width="33%"></td><td bgcolor="'.$altbg1.'" class="tablerow" width="33%"></td></tr>'; }
    if ( $C == 2 ) { echo '<td bgcolor="'.$altbg1.'" class="tablerow" width="33%"></td></tr>'; }
    if ( X_ADMIN ){
        echo '<tr><td colspan="3" bgcolor="'.$altbg1.'" class="smalltxt">'.$lang['avs_04'].'<input type="hidden" name="page" value="'.$page.'" /><input type="submit" class="submit" name="deletesubmit" value="'.$lang['avs_05'].'" /></td></tr>';
    }
    echo $avsmultis.'</table></td></tr></table></form>';

} elseif ($action == "viewpro") {
    if (!$member) {
        error($lang['nomember']);
    } else {
        $memberinfo = $db->fetch_array($db->query("SELECT * FROM $table_members WHERE username='$member'"));
$items = "";

$itemsquery = $db->query("SELECT i.itemname, i.imageurl, m.* FROM $table_shop_items i, $table_member_items m WHERE m.uid='$memberinfo[uid]' && i.id=m.iid ORDER BY i.itemname");

while($memberitem = $db->fetch_array($itemsquery)) {
	if($memberitem['quantity'] > 1) {
		$itemquantity = "(* $memberitem[quantity])";
	} else {
		$itemquantity = "";
	}

	if($memberitem['imageurl'] == "") {
		$items .= "<img src=\"images/shop/noitempic.gif\" border=\"0\" alt=\"$memberitem[itemname]\"> $itemquantity "; // You may wish to change this
	} else {
		$items .= "<img src=\"$memberitem[imageurl]\" border=\"0\" alt=\"$memberitem[itemname]\"> $itemquantity ";
	}
}

$db->free_result($itemsquery);
        if ($memberinfo['status'] == 'Administrator' || $memberinfo['status'] == 'Super Administrator' || $memberinfo['status'] == 'Super Moderator' || $memberinfo['status'] == 'Moderator') {
            $limit = "title = '$memberinfo[status]'";
        } else {
            $limit = "posts <= '$memberinfo[postnum]' AND title != 'Super Administrator' AND title != 'Administrator' AND title != 'Super Moderator' AND title != 'Super Moderator' AND title != 'Moderator'";
        }
        $rank = $db->fetch_array($db->query("SELECT * FROM $table_ranks WHERE $limit ORDER BY posts DESC LIMIT 1"));

        if ($memberinfo['uid'] == '') {
            error($lang['nomember']);
            end_time();
        } else {
            eval("echo (\"".template('header')."\");");

            $daysreg = (time() - $memberinfo['regdate']) / (24*3600);
            if ($daysreg > 1 ) {
                $ppd = $memberinfo['postnum'] / $daysreg;
                $ppd = round($ppd, 2);
            } else {
                $ppd = $memberinfo['postnum'];
            }

            $memberinfo['regdate'] = gmdate($dateformat , $memberinfo['regdate'] + ($addtime * 3600) + ($timeoffset * 3600));

			if (!empty($memberinfo['theme']) && $memberinfo['theme'] != 0) {
                $membertheme = ${'theme'.$memberinfo['theme']};
            } else {
                $membertheme = ${'theme'.$SETTINGS['theme']} . $lang['defaulttheme'];;
            }
			
            if (strpos($memberinfo['site'], 'http') === false) {
                $memberinfo['site'] = "http://$memberinfo[site]";
            }

            if ($memberinfo['site'] != 'http://') {
                $site = $memberinfo['site'];
            } else {
                $site = '';
            }
			
			// BEGIN SHOP HACK

if($memberinfo['hexcolor'] == "") {
	$hexcolor1 = "";
	$hexcolor2 = "";
} else {
	$hexcolor1 = "#$memberinfo[hexcolor]";
	$hexcolor2 = "color:#$memberinfo[hexcolor]";
}

if($memberinfo['glowcolor'] == "") {
	$span1 = "<font color=\"$hexcolor1\">";
	$span2 = "</font>";
} else {
	$span1 = "<font style=\"width:100%; $hexcolor2; filter:glow(color=#$memberinfo[glowcolor], strength=2)\">";
	$span2 = "</font>";
}

$username = "$span1$memberinfo[username]$span2";

if($memberinfo['pphoto'] == "") {
	$pphoto = "";
} else {
	eval("\$pphoto = \"".template("member_profile_pphoto")."\";");
}

// END SHOP HACK

            if (strpos($memberinfo['webcam'], 'http') === false) {
                $memberinfo['webcam'] = "http://$memberinfo[webcam]";
            }

            if ($memberinfo['webcam'] != 'http://') {
                $webcam = $memberinfo['webcam'];
            } else {
                $webcam = '';
            }

            if ($memberinfo['email'] != "" && $memberinfo['showemail'] == "yes") {
                $email = $memberinfo['email'];
            } else {
                $email = '';
            }

            $rank['avatarrank'] = trim($rank['avatarrank']);
            $memberinfo['avatar'] = trim($memberinfo['avatar']);

            if ($rank['avatarrank'] != '') {
                $rank['avatarrank'] = '<img src="'.$rank['avatarrank'].'" alt="'.$lang['altavatar'].'" border="0" />';
            }

            if ($memberinfo['avatar'] != '') {
                $memberinfo['avatar'] = '<img src="'.$memberinfo['avatar'].'" alt="'.$lang['altavatar'].'" border="0" />';
            }

            if ($rank['avatarrank'] || $memberinfo['avatar']) {
                if (isset($site) && strlen(trim($site)) > 0) {
                    $sitelink = $site;
                } else {
                    $sitelink = "about:blank";
                }
            } else {
                $sitelink = "about:blank";
            }

            $showtitle = $rank['title'];
            $stars = str_repeat("<img src=\"$imgdir/star.gif\" alt=\"*\" />", $rank['stars']);

            if ($memberinfo['customstatus'] != '') {
                $showtitle = $rank['title'];
                $customstatus = '<br />'.$memberinfo['customstatus'];
            } else {
                $showtitle = $rank['title'];
                $customstatus = '';
            }

            if (!($memberinfo['lastvisit'] > 0)) {
                $lastmembervisittext = $lang['textpendinglogin'];
            } else {
                $lastvisitdate = gmdate("$dateformat",$memberinfo['lastvisit'] + ($timeoffset * 3600) + ($addtime * 3600));
                $lastvisittime = gmdate("$timecode",$memberinfo['lastvisit'] + ($timeoffset * 3600) + ($addtime * 3600));
                $lastmembervisittext = "$lastvisitdate $lang[textat] $lastvisittime";
            }

            $query = $db->query("SELECT COUNT(pid) FROM $table_posts");
            $posts = $db->result($query, 0);

            $posttot = $posts;
            if ($posttot == 0) {
                $percent = "0";
            } else {
                $percent = $memberinfo['postnum']*100/$posttot;
                $percent = round($percent, 2);
            }

            $memberinfo['bio'] = stripslashes(censor($memberinfo['bio']));
            $memberinfo['bio'] = nl2br($memberinfo['bio']);
            $encodeuser = rawurlencode($memberinfo['username']);

            if ($memberinfo['showemail'] == "yes") {
                eval("\$emailblock = \"".template("member_profile_email")."\";");
            } else {
                $emailblock = '';
            }
			
            // Signature In Member Profile Mod Begin
			$sigblock = '';
            if (!empty($memberinfo['sig'])) {
	            $memberinfo['sig'] = censor($memberinfo['sig']);
	            $memberinfo['sig'] = postify($memberinfo['sig'], 'no', 'no', 'yes', 'no', 'yes', 'yes', false, 'no', 'no');
                eval("\$sigblock = \"".template("member_profile_sig")."\";");
            }
            // Signature In Member Profile Mod End

            if ($self['status'] == "Super Administrator") {
                $admin_edit = "<br />$lang[adminoption] <a href=\"./editprofile.php?user=$encodeuser\">$lang[admin_edituseraccount]</a>";
            } else {
                $admin_edit = NULL;
            }

            if ($memberinfo['mood'] != '') {
                $memberinfo['mood'] = censor($memberinfo['mood']);
                $memberinfo['mood'] = postify($memberinfo['mood'], 'no', 'no', 'yes', 'no', 'yes', 'no', true, 'yes');
            } else {
                $memberinfo['mood'] = '&nbsp;';
            }

            $memberinfo['location'] = censor($memberinfo['location']);
            $memberinfo['aim'] = censor($memberinfo['aim']);
            $memberinfo['icq'] = censor($memberinfo['icq']);
            $memberinfo['yahoo'] = censor($memberinfo['yahoo']);
            $memberinfo['msn'] = censor($memberinfo['msn']);

            $restrict = '';
            switch($self['status']) {
                case 'member':
                    $restrict .= " f.private !='3' AND";

                case 'Moderator':
                case 'Super Moderator':
                    $restrict .= " f.private != '2' AND";

                case 'Administrator':
                    $restrict .= " f.userlist = '' AND f.password = '' AND";

                case 'Super Administrator':
                    // no restrictions
                    break;

                default:
                    $restrict .= " f.private !='3' AND f.private != '2' AND f.userlist = '' AND f.password = '' AND";
                    break;
            }

            // Forum most active in
            $query = $db->query("SELECT f.name, p.fid, COUNT(DISTINCT p.pid) as posts FROM $table_posts p LEFT JOIN $table_forums f ON p.fid=f.fid WHERE $restrict p.author='$member' GROUP BY p.fid ORDER BY posts DESC LIMIT 1");
            $forum = $db->fetch_array($query);

            if (!($forum['posts'] > 0)) {
                $topforum = $lang['textnopostsyet'];
            } else {
                $topforum = "<a href=\"./forumdisplay.php?fid=$forum[fid]\">$forum[name]</a> ($forum[posts] $lang[textdeleteposts]) [".round(($forum['posts']/$memberinfo['postnum'])*100, 1)."% of total posts]";
            }

            // Last post
            $query = $db->query("SELECT t.tid, t.subject, p.dateline, p.pid FROM $table_posts p, $table_threads t LEFT JOIN $table_forums f ON p.fid=f.fid WHERE $restrict p.author='$memberinfo[username]' AND p.tid=t.tid ORDER BY p.dateline DESC LIMIT 1");
            if ($post = $db->fetch_array($query)) {
                $posts = $db->result($db->query("SELECT count(pid) FROM $table_posts WHERE tid='$post[tid]' AND pid < '$post[pid]'"), 0)+1; // +1 is faster than doing <= !
                validatePpp();

                $page = quickpage($posts, $ppp);

                $lastpostdate = gmdate("$dateformat", $post['dateline'] + ($timeoffset * 3600) + ($addtime * 3600));
                $lastposttime = gmdate("$timecode", $post['dateline'] + ($timeoffset * 3600) + ($addtime * 3600));
                $lastposttext = "$lastpostdate $lang[textat] $lastposttime";
                $post['subject'] = censor($post['subject']);
                $lastpost = "<a href=\"./viewthread.php?tid=$post[tid]&amp;page=$page#pid$post[pid]\">$post[subject]</a> ($lastposttext)";
            } else {
                $lastpost = $lang['textnopostsyet'];
            }

            $lang['searchusermsg'] = str_replace('*USER*', $memberinfo['username'], $lang['searchusermsg']);

			            // BEGIN VICIOUS HACK
                if($SETTINGS['VH_status'] == "on"){ $thaimage = '';
    	            if($memberinfo['vicious'] != "0"){ $Fvhimg = (($memberinfo[vicious] < 0) ? ($SETTINGS[VH_image1]) : ($SETTINGS[VH_image2])); $thaimage .= "$memberinfo[vicious]"; $VHpv = str_replace("-", "", $memberinfo['vicious']);
                        if($Fvhimg != "" && ($SETTINGS['VH_star'] <= $VHpv)){
                            $theimage = floor($VHpv / $SETTINGS[VH_star]); $vham = floor($theimage / $SETTINGS[VH_addbr]); $vhan = $theimage - ($vham * $SETTINGS[VH_addbr]);
                            $thaimage .= str_repeat('<br />'.str_repeat('<img alt="'.$SETTINGS[VH_title].': '.$memberinfo[vicious].'" src="'.$imgdir.'/'.$Fvhimg.'" />', $SETTINGS[VH_addbr]), $vham);
                            $thaimage .= '<br />'.str_repeat('<img alt="'.$SETTINGS[VH_title].': '.$memberinfo[vicious].'" src="'.$imgdir.'/'.$Fvhimg.'" />', $vhan);
                        }
                    }else{ $thaimage = "$lang[VH_o03]"; }
                    $vicioushtml = '<tr><td bgcolor="'.$altbg1.'" class="tablerow">'.$SETTINGS[VH_title].':'.(($Fvhimg == "") ? ('') : ('<br /><img border="0" alt="" src="'.$imgdir.'/'.$Fvhimg.'"> = '.$SETTINGS[VH_star].' Points')).'</td><td bgcolor="'.$altbg2.'" class="tablerow"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="50%" class="tablerow" align="left">'.$thaimage.'</td><td width="50%" align="right" class="tablerow"> <a href="member.php?action=vicious&do=smite&fr=pro&member='.rawurlencode($memberinfo[username]).'">'.$lang[VH_o01].'</a> '.$SETTINGS[VH_sep].' <a href="member.php?action=vicious&do=praise&fr=pro&member='.rawurlencode($memberinfo[username]).'">'.$lang[VH_o02].'</a></td></tr></table></td></tr>';
                }else{
                    $vicioushtml = '';
                }
            // END VICIOUS HACK
			
            eval('echo stripslashes("'.template('member_profile').'");');
        }
    }
} else {
    $message = $lang['textnoaction'];
    eval("echo (\"".template('header')."\");");
    eval('echo stripslashes("'.template('error').'");');
}

end_time();
eval("echo (\"".template('footer')."\");");
?>
