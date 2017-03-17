<?php
// session_save_path("/tmp");

// echo "test";
session_start();

// This php module will handle grabbing details about a specific bill from the database.

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("database.php");
$db = new Database();

// echo "stuffs";


// Returns the bill row from the DB.
function fetchBillDetailsByID($userID, $billID){

  global $db;


  $statement = $db->prepare("SELECT * FROM bills WHERE id=:id");
  $statement->bindValue(":id", $billID, SQLITE3_INTEGER);

  $statement = $statement->execute()->fetchArray();

  // The selfCost for the particular user should also be obtained.
  $statement['selfCost'] = grabSelfCostForUserInBill($userID, $billID);

  return $statement;

}

// Grab the selfCost for the current User.
function grabSelfCostForUserInBill($userID, $billID){

  global $db;

  $statement = $db->prepare("SELECT selfCost FROM usersInBill WHERE userID=:userID AND billID=:billID");

  $statement->bindValue(":billID", $billID, SQLITE3_INTEGER);
  $statement->bindValue(":userID", $userID, SQLITE3_INTEGER);

  $statement = $statement->execute()->fetchArray();

  return $statement['selfCost'];

}

// Submethod for getBillDetailsByID which grabs all the users that belong to a particular bill.
function fetchUsersInBill($billID){

  global $db;

  $statement = $db->prepare("SELECT * FROM users WHERE id IN (SELECT userID FROM usersInBill WHERE billID=:billID)");
  $statement->bindValue(":billID", $billID, SQLITE3_INTEGER);

  return $statement->execute();

}

// Grabs the users for a specific bill, and then stringify's them all to be echoed on the page.
function getUsersInBill($billID){

  // Output string which will be populated with formatted string users chips.
  $output = "";

  $users = fetchUsersInBill($billID);

  while($row = $users->fetchArray()){
    $output = $output.stringifyUserItem($row);
  }

  // Return the formatted string of user chip elements.
  return $output;
}

// Stringify a user chip object.
function stringifyUserItem($userItem){

  // If there is no imageURL set for the current user being stringed
  // (they have not set a profile pic) use the default material icon.

  return (isset($userItem['imageURL']) ?
  '<a href="./user.php?id='.$userItem['id'].'" class="chip"><img src="'.escape($userItem['imageURL']).'" alt="Contact Person">'.escape($userItem['name']).'</a>' :
  '<a href="./user.php?id='.$userItem['id'].'" style="display:inline-flex; justify-content: center; align-items: center;" class="chip"><i style="margin-right: 5px;" class="material-icons">face</i>'.$userItem['name'].'</a>');
}

?>
