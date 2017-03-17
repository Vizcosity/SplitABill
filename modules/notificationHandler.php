<?php

// This php module handles adding notifications to the notification queue.
error_reporting(E_ALL);
ini_set("display_errors", 1);

if (!isset($db)){
  include("database.php");
  $db = new Database();
}

$groupID = (isset($_POST['groupID']) ? $_POST['groupID'] : false);
$userID = (isset($_POST['userID']) ? $_POST['userID'] : false);
$billID = (isset($_POST['billID']) ? $_POST['billID'] : false);
$message = (isset($_POST['message']) ? $_POST['message'] : false); // The message must be defined for a notification to be created.

// For every variable that is defined from the post request, create a notification of that nature.

// Check to see if post request is desired. This module is included in other php files to create
// notifications so to prevent multiple entries it checks to see whether a post request is desired or not.
if (!isset($noPostRequest)) {
  if ($groupID) createGroupNotification($groupID, $message);
  if ($userID) createUserNotification($userID, $message);
  if ($billID) createBillNotification($billID, $message);
}

// Return a successful response.
// echo true;

// Creates a notification specific to a group such that the notification will appear for
// members of this specific group.
function createGroupNotification($groupID, $message){

  global $db;

  $statement = $db->prepare("INSERT INTO notifications VALUES(NULL, :msg, :uID, :gID, :bID, :create_date)");
  $statement->bindValue(":msg", $message, SQLITE3_TEXT);
  $statement->bindValue(":uID", -1, SQLITE3_INTEGER);
  $statement->bindValue(":gID", $groupID, SQLITE3_INTEGER);
  $statement->bindValue(":bID", -1, SQLITE3_INTEGER);
  $statement->bindValue(":create_date", time(), SQLITE3_INTEGER);

  // Add the row entry to the database.
  $statement->execute();

}

// Create a notification specific to a user.
function createUserNotification($userID, $message){

  global $db;

  $statement = $db->prepare("INSERT INTO notifications VALUES(NULL, :msg, :uID, :gID, :bID, :create_date)");
  $statement->bindValue(":msg", $message, SQLITE3_TEXT);
  $statement->bindValue(":uID", $userID, SQLITE3_INTEGER);
  $statement->bindValue(":gID", -1, SQLITE3_INTEGER);
  $statement->bindValue(":bID", -1, SQLITE3_INTEGER);
  $statement->bindValue(":create_date", time(), SQLITE3_INTEGER);

  // Add the row entry to the database.
  $statement->execute();

}

// Create a notification for all those that belong to a specific bill.
function createBillNotification($billID, $message){

  global $db;

  $statement = $db->prepare("INSERT INTO notifications VALUES(NULL, :msg, :uID, :gID, :bID, :create_date)");
  $statement->bindValue(":msg", $message, SQLITE3_TEXT);
  $statement->bindValue(":uID", -1, SQLITE3_INTEGER);
  $statement->bindValue(":gID", -1, SQLITE3_INTEGER);
  $statement->bindValue(":bID", $billID, SQLITE3_INTEGER);
  $statement->bindValue(":create_date", time(), SQLITE3_INTEGER);

  // Add the row entry to the database.
  $statement->execute();

}

function dismissNotification($nID){

  // Dismisses the notification from the database.
  global $db;

  $statement = $db->prepare("DELETE FROM notifications WHERE id=:id");
  $statement->bindValue(":id", $nID, SQLITE3_INTEGER);

  $statement->execute();

  // The notification should no longer appear in the queue.

}

// Grabs the name of the user from the id.
function getUserName($userID){

  global $db;

  $statement = $db->prepare("SELECT name FROM users WHERE id=:id");
  $statement->bindValue(":id", $userID, SQLITE3_INTEGER);

  $statement = $statement->execute()->fetchArray();

  return $statement['name'];
}

// Gets the group name based on the id of the group passed
function getGroupName($groupID){

  global $db;

  $statement = $db->prepare("SELECT name FROM groups WHERE id=:id");
  $statement->bindValue(":id", $groupID, SQLITE3_TEXT);

  $statement = $statement->execute()->fetchArray();

  return $statement['name'];

}

// Get the bill name from the id of the bill.
function getBillName($billID){

  global $db;

  $statement = $db->prepare("SELECT name FROM bills WHERE id=:id");
  $statement->bindValue(":id", $billID, SQLITE3_INTEGER);

  $statement = $statement->execute()->fetchArray();

  return $statement['name'];
}

?>
