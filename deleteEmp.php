<?php

class Database {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function deleteEmployee($emp_id) {
        $sql = "DELETE FROM employee WHERE emp_id = $emp_id";

        if ($this->conn->query($sql) === TRUE) {
            echo '<script>';
            echo 'alert("Employee deleted successfully");';
            echo 'window.location.href = "hr_dashboard.php";';
            echo '</script>';
        } else {
            echo "Error deleting employee data: " . $this->conn->error;
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
$dbname = "project_database";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve employee ID from the form
    $emp_id = $_POST["emp_id"];

    $db = new Database($servername, $username, $password, $dbname);
    $db->deleteEmployee($emp_id);
    $db->closeConnection();
}

?>
