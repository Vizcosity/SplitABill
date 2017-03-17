<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("database.php");
$db = new Database();

$groupID = (isset($_POST['groupID']) ? $_POST['groupID'] : false);
$userID = (isset($_POST['userID']) ? $_POST['userID'] : false);
$billID = (isset($_POST['billID']) ? $_POST['billID'] : false);

// If the userID parameter exists, then return all the notifications specific to that user.
if ($userID) echo getNotificationsForUser($userID);

function getNotificationsForUser($userID){

  // This function grabs the notifications that are specifically directed toward the user,
  // and also of all the bills and groups that the user is a part of.

  global $db;

  $statement = $db->prepare("SELECT * FROM notifications WHERE uID=:uID OR gID IN (SELECT groupID FROM usersInGroup WHERE userID=:uID) or bID in (SELECT billID FROM usersInBill WHERE userID=:uID)");
  $statement->bindValue(":uID", $userID, SQLITE3_INTEGER);

  $statement = $statement->execute();

  $output = "";

  // For each notification, render it appropriately.
  while ($row = $statement->fetchArray()){
    $output = $output.stringifyNotificationItem($row);
  }

  // Filled output.
  return $output;

}


function stringifyNotificationItem($item){
  if (!isset($item['msg'])) return;
  return
  '    <div class="notification">
        <i class="material-icons circle notify-important-icon">priority_high</i>
        <p class="notify-important-text">'.$item['msg'].'</p>
      </div>';
}

// function escape($string){
//   return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
// }
?>
