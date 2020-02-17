<?php
// index.php - by Hermawan Haryanto <hermawan@dmonster.com>
// Example PHP Script, demonstrating Storing Image in Database
// Detailed Information can be found at http://www.codewalkers.com

// database connection
$conn = mysql_connect("localhost", "switchsk_adam", "drummer") OR DIE (mysql_error());
@mysql_select_db ("switchsk_switch2006", $conn) OR DIE (mysql_error());

// Do this process if user has browse the file and click the submit button
if ($_FILES) {
  $image_types = Array ("image/bmp",
                        "image/jpeg",
                        "image/pjpeg",
                        "image/gif",
                        "image/x-png");

  $userfile  = addslashes (fread (fopen ($_FILES["userfile"]["tmp_name"], "r"), filesize ($_FILES["userfile"]["tmp_name"])));
  $file_name = $_FILES["userfile"]["name"];
  $file_size = $_FILES["userfile"]["size"];
  $file_type = $_FILES["userfile"]["type"];

  if (in_array (strtolower ($file_type), $image_types)) {
    $sql = "INSERT INTO image (image_type, image, image_size, image_name, image_date) ";
    $sql.= "VALUES (";
    $sql.= "'{$file_type}', '{$userfile}', '{$file_size}', '{$file_name}', NOW())";
    @mysql_query ($sql, $conn);
    Header("Location:".$_SERVER["PHP_SELF"]);
    exit();
  }
}

// Do this process of user has click a file name to view or remove
if ($_GET) {
  $iid = $_GET["iid"];
  $act = $_GET["act"];
  switch ($act) {
    case rem:
      $sql = "DELETE FROM image WHERE image_id=$iid";
      @mysql_query ($sql, $conn);
      Header("Location:./index.php");
      exit();
      break;
    default:
      print "<img src=\"image.php?iid=$iid\">";
      break;
  }
}

?>
<html>
<head>
<title>Storing Images in DB</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
Select Image File: <input type="file" name="userfile"  size="40"><input type="submit" value="submit">
</form>
<?php
  $sql = "SELECT * FROM image ORDER BY image_date DESC";
  $result = mysql_query ($sql, $conn);
  if (mysql_num_rows($result)>0) {
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
      $i++;
      $str .= $i.". ";
      $str .= "<a href=\"index.php?iid=".$row["image_id"]."\">".$row["image_name"]."</a> ";
      $str .= "[".$row["image_date"]."] ";
      $str .= "[".$row["image_size"]."] ";
      $str .= "[<a href=\"index.php?act=rem&iid=".$row["image_id"]."\">Remove</a>]<br>";
    }
    print $str;
  }
?>
</body>
</html>
