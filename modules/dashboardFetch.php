<?php
// session_save_path("/tmp");

session_start();
//
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

include("database.php");
$db = new Database();

// This module fetches the dashboard items from the database, i.e. the group
// information as well as associated bills and prints them on the page.

// Fetches Groups from DB and returns formatted string.
function fetchGroups($id){

  global $db;

  $query = $db->prepare("SELECT * FROM groups WHERE id IN (SELECT groupID from usersInGroup WHERE userID=:id)");
  $query->bindValue(":id", $id, SQLITE3_INTEGER);

  $result = $query->execute();

  $output = "";

  while ($item = $result->fetchArray()){
    $output = $output.stringifyGroupItem($item);
  }

  return $output;

}

// Takes in the group item details and returns the HTML markup.
function stringifyGroupItem($item){
  $users = 0;
  return '<a href="group.php?id='.$item['id'].'" class="collection-item"><span class="badge">'.$users.'/'.$item['size'].'</span>'.escape($item['name']).'</a>';
}

function stringifyBillItem($userID, $item){

  // Need to get the specific cost for the user,
  // need to get the amount of users for a specific bill.

  $cost = getCostForUser($userID, $item['id']);

  return '<a href="bill.php?id='.$item['id'].'" class="collection-item"><span class="badge">£'.$cost.'</span>'.escape($item['name']).'</a>';

}

function getUserCountForBill($billID){
  global $db;

  $query = $db->prepare("SELECT COUNT(*) FROM usersInBill WHERE billID=:billID");
  $query->bindValue(":billID", $billID, SQLITE3_INTEGER);

  return $query->execute();
}

function getCostForUser($userID, $billID){
  global $db;

  $query = $db->prepare("SELECT selfCost FROM usersInBill WHERE billID=:billID AND userID=:userID");
  $query->bindValue(":billID", $billID, SQLITE3_INTEGER);
  $query->bindValue(":userID", $userID, SQLITE3_INTEGER);

  $query = $query->execute()->fetchArray();

  return $query['selfCost'];
}

function fetchBills($userID){

  global $db;

  $statement = $db->prepare("SELECT * FROM bills WHERE id IN (SELECT billID FROM usersInBill WHERE userID=:userID)");
  $statement->bindValue(":userID", $userID, SQLITE3_INTEGER);

  $result = $statement->execute();

  $output = "";

  while($row = $result->fetchArray()){
    $output = $output.stringifyBillItem($userID, $row);
  }

  return $output;

}

?>
