<?php

class Database {
    private $conn;

    public function __construct($servername, $username, $password, $database) {
        $this->conn = new mysqli($servername, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addNotice($notice) {
        $sqlInsertNotice = "INSERT INTO notice (time, notice) VALUES (CURRENT_TIME(), '$notice')";

        if ($this->conn->query($sqlInsertNotice) === TRUE) {
            return true;
        } else {
            return false;
        }
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $notice = $_POST["notice"];

    $db = new Database($servername, $username, $password, $database);
    if ($db->addNotice($notice)) {
        echo "<script>alert('Notice submitted successfully');</script>",
        header('Location: hr_dashboard.php');
    } else {
        echo "Error submitting notice: " . $conn->error;
    }
    $db->closeConnection();
}

?>
