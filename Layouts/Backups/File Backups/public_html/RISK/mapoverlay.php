<?php
session_start();
require("config.inc.php");

mysql_connect($dbhost, $dbuname, $dbpass) or die("Could not connect: " . mysql_error());
mysql_select_db($dbname);

$result = mysql_query("SELECT TurnStatus FROM risk_config");
$row = mysql_fetch_array($result, MYSQL_ASSOC);

echo "
<html>
 <head>
  <style type='text/css'>
   body{background-color: transparent; cursor:default};
   div {font-family:Tahoma; font-size:12px; font-weight:bold; position:absolute; cursor:hand;
        filter: DropShadow(Color=#000000, OffX=1, OffY=1, Positive=1)};   
  </style>
 </head>
 <script language='javascript'>
  function SelCountry(cNum)
  {";

if ($row['TurnStatus'] == "Deploying")
{
 echo "
  with (window.parent.document.bottom.deploy.country)
  {
   for (i=0; i < length; i++)
    if (options[i].value == cNum) value = cNum;
  }";
}
else if ($row['TurnStatus'] == "Attacking")
{
 echo "
  with (window.parent.document.bottom.attack)
  {
   for (i=0; i < from.length; i++)
    if (from.options[i].value == cNum) from.value = cNum;
  }

  with (window.parent.document.bottom.attack)
  {
   for (i=0; i < to.length; i++)
    if (to.options[i].value == cNum) to.value = cNum;
  }";

}
else if ($row['TurnStatus'] == "Fortify")
{
 echo "if (window.parent.document.bottom.fortify.flag.value == 0)
       {
        window.parent.document.bottom.fortify.from.value = cNum;
        window.parent.document.bottom.fortify.flag.value = 1;
       }
       else
       {
        window.parent.document.bottom.fortify.to.value   = cNum;
        window.parent.document.bottom.fortify.flag.value = 0;
       }";
}

echo "
  }
 </script>
 <body>";

$result = mysql_query("SELECT risk_countries.armies, top, `left`, risk_countries.num, color FROM risk_countries 
                         LEFT JOIN risk_players ON risk_countries.owner = risk_players.num
                         ORDER BY risk_countries.num");

while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
  echo "<div style='color:".$row['color']."; top:".$row['top']."px; left:".$row['left']."px' onmousedown='SelCountry(".$row['num'].")'>
          ".$row['armies']."
        </div>";
}
echo "</body></html>";
?>
