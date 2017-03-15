<?php session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("database.php");
$db = new Database();

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];
$email = $_POST['email'];
$noRedirect = isset($_POST['noRedirect']);

// Validate the input.
if ($password != $confirmPassword) return invalidationHandler("Passwords do not match.");
if (strlen($name) > 50) return invalidationHandler("Name exceeds 50 characters. Please enter a shorter name.");
if (strlen($username) > 50) return invalidationHandler("Username exceeds 50 characters. Please enter a shorter name");

if (!isset($_POST['name']) ||
  !isset($_POST['username']) ||
  !isset($_POST['password']) ||
  !isset($_POST['confirm_password']) ||
  !isset($_POST['email']))
  return invalidationHandler("Please fill in all the fields.");

// Check to see if the user does not already exist.
$userQueryCheck = $db->prepare("SELECT * FROM users WHERE username=:username");
$userQueryCheck->bindValue(":username", $username, SQLITE3_TEXT);

$userQueryResult = $userQueryCheck->execute()->fetchArray();

if (isset($userQueryResult['username'])) return invalidationHandler("Username already exists.");

// Prepare the SQL statement to add the user.
$statement = $db->prepare("INSERT INTO users VALUES(NULL, :username, NULL, :name, :email, :imageURL, :password, :salt, :created_at);");

// Get the salt value based on the current date time.
$salt = time();

// Save a hashed password.
$hashedPassword = sha1($password.$salt);

// Bind the values for the statement.
$statement->bindValue(':username', $username, SQLITE3_TEXT);
$statement->bindValue(':imageURL', NULL, SQLITE3_TEXT);
$statement->bindValue(':name', $name, SQLITE3_TEXT);
$statement->bindValue(':email', $email, SQLITE3_TEXT);
$statement->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
$statement->bindValue(':salt', $salt, SQLITE3_INTEGER);
$statement->bindValue(':created_at', $salt, SQLITE3_INTEGER);

$statement->execute();

$createdUserID = $db->lastRowId();

// Once the user has been created, log them in automatically.
// Set the sessionID and sesssionName
$_SESSION['id'] = $createdUserID;
$_SESSION['name'] = $name;

if (!$noRedirect) return header("Location: ../pages/welcome.php");

// Need to collect the details of the user's new id, and return a successful response back to the client.
echo '{
  "success": true,
  "id": "'.$createdUserID.'"
}';

// This function handles invalid requests. Takes in a message which is either sent back
// as a JSON response, or appended to the URL as a GET parameter in case JS is turned off.
function invalidationHandler($message){

    global $noRedirect;

    if ($noRedirect){
      echo '{
        "success": false,
        "reason": "'.$message.'"
      }';
    } else {
      header("Location: ../pages/register.php?message=".$message);
    }
}

?>
