<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("database.php");
$db = new Database();

$username = $_POST['username'];
$rawPassword = $_POST['password'];
$noRedirect = $_POST['noRedirect'];

// Need to grab the salt for the user.
$userQuery = $db->prepare("SELECT * FROM users WHERE username=':username'");
$userQuery->bindValue(':username', $username, SQLITE3_TEXT);

$userQuery = $userQuery->execute()->fetchArray();

$salt = $userQuery['salt'];

$enteredPassword = sha1($rawPassword.$salt);

$password = $userQuery['password'];

// $userQuery = $db->prepare("SELECT password FROM users WHERE id=':id'");
// $userQuery->bindValue(':id', $id, SQLITE3_INTEGER);

// $userQuery = $userQuery->execute()->fetchArray();

$password = $userQuery['password'];

if ($enteredPassword != $password){
  if (!$noRedirect){header("Location: ../pages/login.php?fail=true");}
  else {echo '{ "success": false, "reason": "Incorrect username or password."}';}
} else {
  if (!$noRedirect){ header("Location: ../pages/dashboard.php?id=".$userQuery['id']);}
  else {echo '{ "success": true, "id":'.$userQuery['id'].'}';}
}

?>
