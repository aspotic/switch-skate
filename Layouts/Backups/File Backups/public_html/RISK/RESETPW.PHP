<?php

session_start();

echo "
<html>
 <head>
  <title>Register @ PHP RiSK</title>
  <style>
   .cell {font-family:Tahoma; background-color:#444444; border:1px #DDDDDD solid; font-size:16px; color:DDDDDD;};
   .msg {font-family:Tahoma; font-size:12px; font-weight:bold;  color:red;};
   .head {font-family:Tahoma; font-size:12px; font-weight:bold;  color:blue;};
   table {border:0px;};
   .link {color: blue; text-decoration:none; font-size:12px; font-family:Tahoma;}
   .stats {font-family:Tahoma; color:#DDDDDD; font-size:12px; font-weight:bold; text-align:right}
   .text {font-family:Tahoma; color:#DDDDDD; font-size:12px; text-align:center;}
   input, select {font-family:Tahoma; background-color:black; border:1px ridge #DDDDDD; color:#DDDDDD; font-size:12px};

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

 <body bgcolor='black'>
  <form name='reset' method='POST' action='resettunnel.php'>
  <table width='800' cellspacing='8' cellpadding='5' align='center'>
   <tr><td colspan='2' align='center' class='cell'>PHP RiSK";


if ($_SESSION['msg'] != $null)
{
 echo "<br><div class='msg'>".$_SESSION['msg']."</div>";
 $_SESSION['msg'] = $null;
}

echo"</td>

    <tr>
     <td width='50%' class='head' colspan='2' align='center'>
      <br>Complete this form to reset your password.<br>
      <br>Your new password will be e-mailed to you if the username and the e-mail match.<br><br>
     </td>
    </tr>
    <tr>
     <td width='33%' class='stats'>Your Username : </td>
     <td width='66%' class='text' ><input type='text' name='username' size='20'></td>
    </tr>
    <tr>
     <td width='33%' class='stats'>Your E-mail Address : </td>
     <td width='66%' class='text' ><input type='text' name='email' size='20'></td>
    </tr>
    <tr>
     <td colspan='2' align='center'><br><br><input type='submit' value='Reset'><br><br></td>
    </tr>

    <tr>
     <td colspan='2' class='cell' align='center'>&copy;2003 TheWulf</td>
    </tr>
   </table>
  </form>
 </body>
</html>";
?>
