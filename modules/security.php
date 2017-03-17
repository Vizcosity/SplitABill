<?php

if (!isset($db))
{
  include("database.php");

  $db = new Database();
}


// Function returns true if the user has access to a specific bill, and false otherwise.
function hasBillAccess($userID, $billID){

  global $db;

  // $statement = $db->prepare("SELECT * FROM usersInBill WHERE billID=:billID AND userID=:userID");
  $statement = $db->prepare("SELECT * FROM bills WHERE group_id IN (SELECT groupID FROM usersInGroup WHERE userID=:userID) AND id=:billID");
  $statement->bindValue(":billID", $billID, SQLITE3_INTEGER);
  $statement->bindValue(":userID", $userID, SQLITE3_INTEGER);

  $statement = $statement->execute()->fetchArray();

  return isset($statement['userID']);

}

// Returns true if the user has access to a specific group, and false otherwise.
function hasGroupAccess($userID, $groupID){

  global $db;

  $statement = $db->prepare("SELECT * FROM usersInGroup WHERE userID=:userID AND groupID=:groupID");

  $statement->bindValue(":userID", $userID, SQLITE3_INTEGER);
  $statement->bindValue(":groupID", $groupID, SQLITE3_TEXT);

  $statement = $statement->execute()->fetchArray();

  return isset($statement['userID']);

}

?>
