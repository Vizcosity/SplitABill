<?php session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("database.php");
$db = new Database();

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

$statement = $db->prepare("INSERT INTO bills VALUES(NULL, :billName, :billDesc, :billAmt, :userID, :groupID)");

$statement->bindValue(":billName", $billName, SQLITE3_TEXT);
$statement->bindValue(":billDesc", $billDesc, SQLITE3_TEXT);
$statement->bindValue(":billAmt", $billAmt, SQLITE3_INTEGER);
$statement->bindValue(":userID", $userID, SQLITE3_INTEGER);
$statement->bindValue(":groupID", $groupID, SQLITE3_INTEGER);

$statement->execute();



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

// Now that the bill has been created, add to the usersInBill table.
$addUsersStatement = $db->prepare(buildSqlQuery($users, $db->lastRowId(), $selfCost));
$addUsersStatement->execute();

echo true;

function buildSqlQuery($userArray, $billID, $selfCost){
  $output = "INSERT INTO usersInBill VALUES";
  // echo var_dump($userArray);
  // echo $userArray[0]['id'];
  for ($i = 0; $i < count($userArray); $i++){
    $output = $output." (".$userArray[$i]['id'].", ".$billID.", ".$selfCost.")";
  }

  return $output;

}

function containsUser($userArray, $userID){
  for ($i = 0; $i < count($userArray); $i++){
    if ($userArray[$i]['id'] == $userID) return true;
  }
  return false;
}

?>
