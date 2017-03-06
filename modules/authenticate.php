<?php

include("database.php");
$db = new Database();

$username = $_POST['username'];
$id = $_POST['id'];
$rawPassword = $_POST['password'];

// Need to grab the salt for the user.
$saltQuery = $db->prepare("SELECT salt FROM users WHERE id=':id'");
$saltQuery->bindValue(':id', $id, SQLITE3_INTEGER);

$saltQuery = $saltQuery->execute()->fetchArray();

$salt = $saltQuery['salt'];

$enteredPassword = sha1($rawPassword.$salt);

$userQuery = $db->prepare("SELECT password FROM users WHERE id=':id'");
$userQuery->bindValue(':id', $id, SQLITE3_INTEGER);

$userQuery = $userQuery->execute()->fetchArray();

$password = $userQuery['password'];

if ($enteredPassword == $password){
  // Successfully entered password. Send to the dashboard!
  echo "{
    success: true
  }"''
} else {
  echo "{
    success: false,
    reason: 'Incorrect password.'
  }";
}

?>
