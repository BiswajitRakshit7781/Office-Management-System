<?php

class Database {
    private $conn;

    public function __construct($servername, $username, $password, $database) {
        $this->conn = new mysqli($servername, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getNotices() {
        $notices = [];
        $sqlNotices = "SELECT * FROM notice ORDER BY time DESC";
        $resultNotices = $this->conn->query($sqlNotices);

        if ($resultNotices->num_rows > 0) {
            while ($row = $resultNotices->fetch_assoc()) {
                $notices[] = $row;
            }
        }
        return $notices;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "project_database";

$db = new Database($servername, $username, $password, $database);
$notices = $db->getNotices();
$db->closeConnection();

// Now, $notices array contains the fetched notice data
?>
