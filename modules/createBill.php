<?php

// session_save_path("/tmp");

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);


include("database.php");
$db = new Database();

$noPostRequest = true;

// Notification module.
include("notificationHandler.php");

// Collect all the values.
$groupID = $_POST['groupID'] != 'false' ? $_POST['groupID'] : -1; // This will be 'false' if no group id.
$userID = $_POST['userID'];
$users = isset($_POST['users']) ? $_POST['users'] : array();
// if (isset($_POST['users'])) $users = $_POST['users'];
$billName = $_POST['billName'];
$billDesc = $_POST['billDesc'];
$billAmt = $_POST['billAmt'];
$billDate = $_POST['billDate'];
$recurring = isset($_POST['recurring']);
$userID = $_SESSION['id'];

if (!isset($billName) || $billName == "") return invalidationHandler("Please enter a valid bill name.");
if (!isset($billAmt) || $billAmt == "") return invalidationHandler("Please enter a valid bill amount.");
if ($billAmt < 0) return invalidationHandler("Please enter a positive bill amount.");

$statement = $db->prepare("INSERT INTO bills VALUES(NULL, :billName, :billDesc, :billAmt, :remaining, :paid, :userID, :groupID)");

$statement->bindValue(":billName", $billName, SQLITE3_TEXT);
$statement->bindValue(":billDesc", $billDesc, SQLITE3_TEXT);
$statement->bindValue(":billAmt", $billAmt, SQLITE3_INTEGER);
$statement->bindValue(":remaining", $billAmt, SQLITE3_INTEGER);
$statement->bindValue(":paid", FALSE, SQLITE3_INTEGER);
$statement->bindValue(":userID", $userID, SQLITE3_INTEGER);
$statement->bindValue(":groupID", $groupID, SQLITE3_INTEGER);

$statement->execute();


// echo $groupID;

// Check to see if the user itself is contained within the userArray, and if not, add it.
if (!containsUser($users, $userID)){
  // echo "does not contain";
  $userObject['id'] = $userID;
  array_push($users, $userObject);
}

// Find the cost per user (proportional by default).
$selfCost = round(intval($billAmt) / count($users));

// echo $selfCost."\n";
// echo $billAmt."\n";
// echo $selfCost;
// echo buildSqlQuery($users, $db->lastRowId(), $selfCost);
// // Now that the bill has been created, add to the usersInBill table.
// $addUsersStatement = $db->prepare("INSERT INTO usersInBill VALUES (1, 47, 135737),  (1, 47, 135737),  (1, 47, 135737),  (2, 47, 135737),  (1, 47, 135737)");
// $addUsersStatement->execute();
addUsersIterativeInsertion($users, $db->lastRowId(), $selfCost);

echo '{
  "success": true
}';


// Once everything has been added, create the appropriate notifications.
// If the group is set, then send a notification to that group.
if ($groupID != -1) createGroupNotification($groupID, "[".getGroupName($groupID)."] <strong>".escape(getUserName($userID))."</strong> added Bill: '".escape($billName)."' [£".$billAmt."]");
else createUserNotification($userID, "<strong>You</strong> added Bill: ".escape($billName)." [£".$billAmt."]");

function buildSqlQuery($userArray, $billID, $selfCost){
  $output = "INSERT INTO usersInBill VALUES";
  // echo var_dump($userArray);
  // echo $userArray[0]['id'];
  for ($i = 0; $i < count($userArray); $i++){
    $output = $output." (".$userArray[$i]['id'].", ".$billID.", ".$selfCost.")".($i != count($userArray) - 1 ? ", ": "");
  }

  return $output;

}

function addUsersIterativeInsertion($userArray, $billID, $selfCost){
  global $db;
  for ($i = 0; $i < count($userArray); $i++){
    $output = $db->exec("INSERT INTO usersInBill VALUES(".$userArray[$i]['id'].", ".$billID.", ".$selfCost.")");
  }

}

function containsUser($userArray, $userID){
  for ($i = 0; $i < count($userArray); $i++){
    if ($userArray[$i]['id'] == $userID) return true;
  }
  return false;
}

// Grabs the name of the user from the id.
// function getUserName($userID){
//
//   global $db;
//
//   $statement = $db->prepare("SELECT name FROM users WHERE id=:id");
//   $statement->bindValue(":id", $userID, SQLITE3_INTEGER);
//
//   $statement = $statement->execute()->fetchArray();
//
//   return $statement['name'];
// }
//
// // Gets the group name based on the id of the group passed
// function getGroupName($groupID){
//
//   global $db;
//
//   $statement = $db->prepare("SELECT name FROM groups WHERE id=:id");
//   $statement->bindValue(":id", $groupID, SQLITE3_TEXT);
//
//   $statement = $statement->execute()->fetchArray();
//
//   return $statement['name'];
//
// }

// Invalidation handler for bill inputs that are invalid.
function invalidationHandler($message){
      echo '{
        "success": false,
        "reason": "'.$message.'"
      }';
}

?>
