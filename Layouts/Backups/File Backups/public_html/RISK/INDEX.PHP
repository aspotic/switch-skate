<?php

session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$timeout = time() - 900;

$result = mysql_query("SELECT COUNT(*) AS NumOnline FROM risk_players WHERE status > '0' AND stamp > '$timeout'");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

$result = mysql_query("UPDATE risk_config SET NumOnline='".$row['NumOnline']."'");

if ($_SESSION['RISK_USERNUM'] != $null)
{
 $result = mysql_query("SELECT stamp FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
 $row = mysql_fetch_array($result, MYSQL_ASSOC);
 if ((time() - $row['stamp']) > 900)
 {
  $_SESSION['msg'] = 'You have been logged out for inactivity.';
  header("Location: logout.php");
 }
 else
  $result = mysql_query("UPDATE risk_players SET stamp='".time()."' WHERE num='".$_SESSION['RISK_USERNUM']."'");
}

$result = mysql_query("SELECT * FROM risk_config");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

$_SESSION['RISK_CURRENTGAME'] = $row['CurrentGame'];

echo "
<html>
 <head>
  <title>Welcome @ PHP RiSK</title>
  <style>
   .cell {font-family:Tahoma; background-color:#444444; border:1px #DDDDDD solid; font-size:16px; color:DDDDDD;};
   .msg {font-family:Tahoma; font-size:12px; font-weight:bold;  color:#FF0000;};
   table {border:0px;};
   .link {color: blue; text-decoration:none; font-size:12px; font-family:Tahoma;}
   .stats {font-family:Tahoma; color:#DDDDDD; font-size:12px; font-weight:bold;}
   .text {font-family:Tahoma; color:#DDDDDD; font-size:12px;}
   .err {font-family:Tahoma; color:red; font-size:12px; font-weight:bold;}
   a {color: blue; text-decoration:none; font-size:12px; font-family:Tahoma;}
   a:visited {color: blue; text-decoration:none; font-size:12px; font-family:Tahoma;}
   a:hover {color: blue; text-decoration:underline; font-size:12px; font-family:Tahoma;}
   input, select {font-family:Tahoma; background-color:black; border:1px ridge #DDDDDD; color:#DDDDDD; font-size:10px};

   HTML, BODY {
   scrollbar-3dlight-color : #000000;
   scrollbar-arrow-color : #C0C0C0;
   scrollbar-base-color : #808080;
   scrollbar-darkshadow-color : #000000;
   scrollbar-face-color : #000000;
   scrollbar-highlight-color : #C0C0C0;
   scrollbar-shadow-color : #000000;
   scrollbar-track-color : #202020;
   }
  </style>

 </head>

 <body bgcolor='black'>";

if ($_SESSION['launch'] != $null)
{
  echo "<script language='javascript'>
         window.open('lobby.php', 'lobby', 'toolbar=no,menubar=no,status=no,location=no,height=425,width=800');
        </script>";
  $_SESSION['launch'] = $null;
}

if ($_SESSION['spectate'] != $null)
{
  echo "<script language='javascript'>
         window.open('spectate.php', 'risk', 'toolbar=no,menubar=no,status=no,location=no,height=485,width=900');
        </script>";
  $_SESSION['spectate'] = $null;
}

echo"
  <table width='800' cellspacing='8' cellpadding='5' align='center'>
   <tr><td colspan='2' align='center' class='cell'>PHP RiSK";


if ($_SESSION['msg'] != $null)
{
 echo "<br><div class='msg'>".$_SESSION['msg']."</div>";
 $_SESSION['msg'] = $null;
}


echo"</td><tr><td width='50%' valign='top'>";

   LeftSide(); 
 
   echo "</td><td width='50%'>";
    
   RightSide();

echo "</td></tr><tr><td colspan='2'>";

if ($_SESSION['RISK_USERLEVEL'] > '1')
{
  DisplayAdminPanel($_SESSION['RISK_USERLEVEL']);
}

echo "</td></tr><tr><td colspan='2' align='center' class='cell'>&copy;2003 TheWulf</td></tr></table></body></html>";


function RightSide()
{
 if (!isset($_SESSION['RISK_USERNUM']))
 {
  DisplayLoginForm();
 }
 else
 {
  DisplayUserPanel();
 }
}

function LeftSide()
{
 global $row;

 echo "<table width='100%' cellpadding='3' valign='top'>
        <tr><td class='cell' align='center'>:: Server Stats ::</td></tr>
        <tr><td align='center'>
          <br><br>
          <table width='80%'>
           <tr>
            <td class='stats' width='50%'>Server Status : </td>
            <td class='text'>".$row['ServerStatus']."</td>
           </tr>
           <tr>
            <td class='stats' width='50%'>Current Match : </td>
            <td class='text'>".$row['CurrentGame']."</td>
           </tr>
           <tr>
            <td class='stats' width='50%'>Players Online :</td>
            <td class='text'>".$row['NumOnline']."</td>
           </tr>
           <tr>
            <td class='stats' width='50%'><br><br>Read Game Logs :</td>
            <td class='text'><br><br><a href='readlogs.php'>Read</a></td>
           </tr>
          </table>          
        </td></tr>
       </table>";

}

function DisplayLoginForm()
{
  global $errlogin;

  echo "<form method='POST' action='login.php'>
        <table width='100%' cellpadding='3'>
         <tr><td align='center' valign='top' class='cell'>:: Login To Join ::</td></tr>
         <tr><td align='center'> 
          <table>";

  if ($errlogin == '1')
  {
    echo " <tr><td colspan='2' class='err' align='center'><br>Your Username and/or Password is invalid.</td></tr>";
  }

  echo "   <tr><td colspan='2'><br><br></td></tr> 
           <tr><td class='text'> Login : </td><td> <input type='text' name='username'></td></tr>
           <tr><td class='text'> Password : </td><td> <input type='password' name='password'></td></tr>
           <tr><td colspan='2' align='center'><br> <input type='submit' value=':: Login ::'> </td></tr>
          </table>
         <tr>
          <td align='center' class='link'><br>
            ( <a href='register.php'>Register</a> - <a href='resetpw.php'>Reset Password</a> )
          </td>
        </tr></table>
        </form>";
}

function DisplayUserPanel()
{
  $result = mysql_query("SELECT victories, losses, unfinished FROM risk_players WHERE num='".$_SESSION['RISK_USERNUM']."'");
  $row = mysql_fetch_array($result, MYSQL_ASSOC);

  echo "<table width='100%' cellpadding='3'>
         <tr><td align='center' valign='top' class='cell'>:: Welcome ". $_SESSION['RISK_USERNAME'] ."::</td></tr>
         <tr><td align='center'><br><br>
          <table width='80%'>
           <tr>
            <td class='stats' style='color:green' width='50%'> Victories :</td>
            <td class='text' align='center'> ".$row['victories']." </td>
           </tr>
           <tr>
            <td class='stats' style='color:yellow' width='50%'> Unfinished :</td>
            <td class='text' align='center'> ".$row['unfinished']." </td>
           </tr>
           <tr>
            <td class='stats' style='color:red' width='50%'> Losses :</td>
            <td class='text' align='center'> ".$row['losses']." </td>
           </tr>
           <tr><td><br></td></tr>
           <tr>
            <td class='stats' style='color:blue'>Join New Match:</td>
            <td align='center'><input type='button' value=' Join ' onclick=document.location.replace('join.php')>
                        <input type='button' value='Watch' onclick=document.location.replace('launchspectate.php')></td>
           </tr>
           <tr>
            <td align='center' colspan='2' class='link'><br>
             ( <a href='changepw.php'>Change Password</a> - <a href='logout.php'>Logout</a> )
            </td>
           </tr>
          </table>
         </td></tr></table>";
}

function DisplayAdminPanel($level)
{
echo "<table width='800' cellspacing='8' cellpadding='5' align='center'>
       <tr><td colspan='3' align='center' class='cell'> :: Admin Panel :: </td></tr>
       <tr><td valign='top'>

        <table width='100%' cellpadding='3'>
         <tr><td align='center' class='cell'>:: Match Manager ::</td></tr>
         <tr><td align='center'>
          <br><br>
          <table width='80%'>
           <tr><td align='center'>
            <form method='POST' action='admin.php?c=newmatch'><input type='submit' value=' :: New Match :: '></form>";

if ($level == '3')
{
 echo "     <form method='POST' action='admin.php?c=endmatch'><input type='submit' value=' :: End Match :: '></form>";
}

echo "     </td></tr>
          </table>
         </td></tr>
        </table>";

if ($level == '3')
{
 echo "</td><td valign='top'>
        <table width='100%' cellpadding='3'>
         <tr><td align='center' class='cell'>:: Change Levels ::</td></tr>
         <tr><td align='center'>
          <br><br>
          <form method='POST' action='admin.php?c=chlevel'>
          <table width='80%'>
           <tr>
            <td class='stats' width='50%'>Username :</td>
            <td class='text' align='center'><input type='text' name='username'></td>
           </tr>
           <tr>
            <td class='stats' width='50%'>Level :</td>
            <td class='text' align='center'><select name='level'><option value='1'>User</option><option value='2'>Administrator</option><option value='3'>Super Admin</option></select</td>
           </tr>
           <tr>
            <td></td><td align='center'><br><input type='submit' value=' :: Change :: '></td>
           </tr>
          </table></form>
         </td></tr>
        </table>


        </td><td valign='top'>

        <table width='100%' cellpadding='3'>
         <tr><td align='center' class='cell'>:: Delete Users ::</td></tr>
         <tr><td align='center'>
          <br><br>
          <form method='POST' action='admin.php?c=deluser'>
          <table width='80%'>
           <tr>
            <td class='stats' width='50%'>Username :</td>
            <td class='text' align='center'><input type='text' name='username'></td>
           </tr>
           <tr>
            <td class='stats' width='50%'>Confirm :</td>
            <td class='text' align='center'><input type='checkbox' name='confirm'></td>
           </tr>
           <tr>
            <td></td><td align='center'><br><input type='submit' value=' :: Delete :: '></td>
           </tr>
          </table></form>
         </td></tr>
        </table></td></tr>";
}
echo "</table>";

}
?>
