<?php
// session_save_path("/tmp");

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("database.php");
$db = new Database();

// include("notificationHandler.php");


// Assume that GET request is being performed first, and then post, and then return errors if necessary.
if (isset($_GET['token'])){

  // Attempt to join has been made from link.
  $recievedToken = $_GET['token'];
  $userID = $_SESSION['id'];
  // echo $recievedToken;
  $groupID = getGroupIDFromToken($recievedToken);
  // echo $userID;

  if (!userNotJoined($userID, $groupID)) return invalidTokenHandler("You have already joined this group.");

  $addResult = joinByToken($recievedToken, $userID);
  // echo $addResult;

  if (!$addResult) return invalidTokenHandler("Token entered was incorrect.");

  // If the code execution reaches this point, can return a success.
  if (!$noRedirect) return header("Location: ../pages/dashboard.php");
  return;

}

if (!isset($_POST['token']) || !isset($_POST['userID'])) return invalidTokenHandler("Field empty.");

$recievedToken = $_POST['token'];
$userID = $_POST['userID'];
$noRedirect = isset($_POST['noRedirect']);

// Assumes that a POST request is being made to add by token.

// echo 'test';

if (!userNotJoined($userID, $recievedToken)) return invalidTokenHandler("You have already joined this group.");

$addResult = joinByToken($recievedToken, $userID);

if (!$addResult) return invalidTokenHandler("Token entered was incorrect.");

// if ($addResult) createUserNotification($userID, "<strong>You</strong> joined group: ".getGroupName($groupID));

// If the code execution reaches this point, can return a success.
if (!$noRedirect) return header("Location: ../pages/dashboard.php");

// Echo true.
echo '{
  "result": true
}';

// Takes in the join token and attempts to check if it is a valid token for a group.
function getGroupIDFromToken($token){
  global $db;

  $statement = $db->prepare("SELECT * FROM groups WHERE joinToken=:joinToken");
  $statement->bindValue(":joinToken", $token, SQLITE3_TEXT);

  $statement = $statement->execute()->fetchArray();

  if (!isset($statement['id'])) return false;

  // Returns a boolean value if the statement returns a meaningful value from the database,
  // indicating that the token itself is valid.
  return $statement['id'];
}

function joinByToken($token, $userID){

  global $db;

  $groupID = getGroupIDFromToken($token);

  // First check to see if the token itself is valid.
  if (!$groupID) return false;

  $statement = $db->prepare("INSERT INTO usersInGroup VALUES(:userID, :groupID)");
  $statement->bindValue(":userID", $userID, SQLITE3_INTEGER);
  $statement->bindValue(":groupID", $groupID, SQLITE3_INTEGER);

  $statement->execute();

  // If code execution reaches this point it can be assumed insertion was successful.
  return true;

}

// Checks to see if the user has already joined the group or not.
function userNotJoined($userID, $groupID){

  global $db;

  $statement = $db->prepare("SELECT * FROM usersInGroup WHERE userID=:userID AND groupID=:groupID");
  $statement->bindValue(":userID", $userID, SQLITE3_INTEGER);
  $statement->bindValue(":groupID", $groupID, SQLITE3_INTEGER);

  $statement = $statement->execute()->fetchArray();

  // If the userID of the db row entry is not set, then it can be assumed that the user
  // has not joined the group.
  return !isset($statement['userID']);

}

function invalidTokenHandler($message){

  if (!$noRedirect) return header("Location: ../pages/joinGroup.php?message=".$message);

  // If noRedirect is set, prints a JSON encoded response with result and reason.
  echo '{
    "result": false,
    "reason": '.$message.'
  }';

}

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

?>
