<?php session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("database.php");
$db = new Database();

$groupID = $_GET['groupID'];

$query = $db->prepare("SELECT * FROM usersInGroup WHERE groupID=:groupID");

$query->bindValue(":groupID", $groupID, SQLITE3_INTEGER);

$query = $query->execute();

$index = 0;
while ($row = $query->fetchArray()){


  $userInfo = $db->prepare("SELECT * FROM users WHERE id=:id");
  $userInfo->bindValue(":id", $row['userID'], SQLITE3_INTEGER);
  $userInfo = $userInfo->execute()->fetchArray();

  $outputTarray[$index] = $userInfo;
  $index++;
}

if (!isset($outputTarray)) {echo false; return;}

$output = json_encode($outputTarray);

echo $output;

?>
