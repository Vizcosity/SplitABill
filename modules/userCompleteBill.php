<?php

// Handles deleting bills for a specific user once they have completed it.

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("database.php");
$db = new Database();

// Import the notification module to create the notifications when users complete their bills.
$noPostRequest = true;
include("notificationHandler.php");

$_POST['billID'];
$_POST['userID'];
$_POST['amtPaid'];

// Run a SQL query to update the bill and remove the user from the Bill.

// Need to check if there are any users left, and if there aren't, remove the bill entirely.

$statement = $db->prepare("DELETE FROM usersInBill WHERE userID=:userID AND billID=:billID");
$statement->bindValue(":billID", $_POST['billID'], SQLITE3_INTEGER);
$statement->bindValue(":userID", $_POST['userID'], SQLITE3_INTEGER);

$statement->execute();

// User should not be associated with the bill anymore.
// Update the remaining balance for the bill.
$query = $db->prepare("SELECT * FROM bills WHERE id=:billID");
$query->bindValue(":billID", $_POST['billID'], SQLITE3_INTEGER);

$query = $query->execute()->fetchArray();

if ($_POST['amtPaid'] >= getRemainingBalance($_POST['billID'])) markBillAsPaid($_POST['billID']);

updateRemaining($_POST['billID'], $_POST['amtPaid']);

// Send a notification to alert people of the new bill status.
if (getGroupByBillID($_POST['billID']) != -1) createGroupNotification(getGroupByBillID($_POST['billID']), "[".getGroupName(getGroupByBillID($_POST['billID']))."] <strong>".escape(getUserName($_POST['userID']))."</strong> has paid bill: ".escape(getBillName($_POST['billID'])));
else {
  $user = escape(getUserName($_POST['userID']));
  createBillNotification($_POST['billID'], "<strong>".$user."</strong> has paid bill: ".escape(getBillName($_POST['billID'])));
}

echo true;

// Marks the bill with passed ID has paid.
function markBillAsPaid($billID){

  global $db;

  $statement = $db->prepare("UPDATE bills SET paid=:paid WHERE id=:billID");
  $statement->bindValue(":paid", TRUE, SQLITE3_INTEGER);
  $statement->bindValue(":billID", $billID, SQLITE3_INTEGER);

  $statement = $statement->execute();

}

function updateRemaining($billID, $amtToRemove){

  global $db;

  $currentBalanceLeft = getRemainingBalance($billID);

  // If the amount being removed is greater than the remaining balance, set the amtToRemove to the balance
  // such that the new balance will be 0 (indiicating the payment is paid).
  if ($amtToRemove >= $currentBalanceLeft) $amtToRemove = $currentBalanceLeft;

  $newBalance = $currentBalanceLeft - $amtToRemove;

  $statement = $db->prepare("UPDATE bills SET remaining=:newBalance WHERE id=:billID");
  $statement->bindValue(":newBalance", $newBalance, SQLITE3_INTEGER);
  $statement->bindValue(":billID", $billID, SQLITE3_INTEGER);

  // Update the bill.
  $statement->execute();

}

// Get the remaining balance for a particular bill.
function getRemainingBalance($billID){

  global $db;

  $statement = $db->prepare("SELECT remaining FROM bills WHERE id=:billID");
  $statement->bindValue(":billID", $billID, SQLITE3_INTEGER);

  $statement = $statement->execute()->fetchArray();

  return $statement['remaining'];

}

function getGroupByBillID($billID){

  global $db;

  $statement = $db->prepare("SELECT group_id FROM bills where id=:id");
  $statement->bindValue(":id", $billID, SQLITE3_INTEGER);
  $statement = $statement->execute()->fetchArray();

  return $statement['group_id'];

}

?>
