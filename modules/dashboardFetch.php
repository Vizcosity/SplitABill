<?php

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

include("database.php");
$db = new Database();

// This module fetches the dashboard items from the database, i.e. the group
// information as well as associated bills and prints them on the page.

// Fetches Groups from DB and returns formatted string.
function fetchGroups($id){

  global $db;

  $query = $db->prepare("SELECT * FROM groups WHERE owner_id=:id");
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
  return '<a href="group.php?id='.$item['id'].'" class="collection-item"><span class="badge">'.$users.'/'.$item['size'].'</span>'.$item['name'].'</a>';
}

?>
