<?php
// session_save_path("/tmp");

 session_start();

// Generates a join link for a particular group.

error_reporting(E_ALL);
ini_set("display_errors", 1);

$groupID = $_POST['id'];


include("database.php");

$db = new Database();



?>
