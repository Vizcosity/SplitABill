<?php session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("database.php");
$db = new Database();

$noRedirect = isset($_POST['noRedirect']);

if (!isset($_SESSION['id'])) invalidationHandler("Must be logged in to create a group.");

$name = $_POST['name'];
$image = $_POST['image'];
$size = $_POST['size'];
$description = $_POST['desc'];

// Validate the input.
if (!isset($_POST['name'])) return invalidationHandler("Please enter a valid name for the group.");

// Prepare the SQL statement to add the user.
$statement = $db->prepare("INSERT INTO groups VALUES(NULL, :owner_id, :name, :image, :size, :description);");

// Bind the values for the statement.
$statement->bindValue(':owner_id', $_SESSION['id'], SQLITE3_INTEGER);
$statement->bindValue(':name', $name, SQLITE3_TEXT);
$statement->bindValue(':image', $image, SQLITE3_TEXT);
$statement->bindValue(':size', $size, SQLITE3_INTEGER);
$statement->bindValue(':description', $description, SQLITE3_TEXT);

$statement->execute();

if (!$noRedirect) return header("Location: ../pages/dashboard.php");

// Need to collect the details of the user's new id, and return a successful response back to the client.
echo '{
  "success": true
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
      header("Location: ../pages/addGroupPage.php?message=".$message);
    }
}

?>
