<?php
class Database {
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $database = "imdb_database";
    protected $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection Failed: " . $this->conn->connect_error);
        }
    }

    public function getDBConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>

