<?php
// session_save_path("/tmp");

 session_start();

// This module grabs all the groups that a particular user is a part of.
// First grabs the ID of associated groups, then collects full information for each group.
//
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

include("database.php");

$db = new Database();

function getGroupsByUser($userID){

  global $db;

  $query = $db->prepare("SELECT * FROM groups WHERE id IN (SELECT groupID FROM usersInGroup WHERE userID=:userID)");
  $query->bindValue(":userID", $userID, SQLITE3_INTEGER);

  $query = $query->execute();

  return $query;

}
?>
