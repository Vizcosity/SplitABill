<?php
class Database {

	private $database;

	function __construct() {
		$this->database = $this->getConnection();
	}

	function __destruct() {
		$this->database->close();
	}

	function exec($query) {
		$this->database->exec($query);
	}

	function query($query) {
		$result = $this->database->query($query);
		return $result;
	}

	function querySingle($query) {
		$result = $this->database->querySingle($query,true);
		return $result;
	}

	function prepare($query) {
		return $this->database->prepare($query);
	}

	function escapeString($string) {
		return $this->database->escapeString($string);
	}

	function lastRowId() {
		return $this->database->lastInsertRowId();
	}

	private function getConnection() {
		$conn = new SQLite3('../database/database.db');
		return $conn;
	}
}


  // Define function for escaping strings
  // This is defined here because the database is included in every page and so it can propagate throughout.
  function escape($string){
    return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
  }
?>
