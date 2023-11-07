<?php

class Database {
    private $conn;

    public function __construct($servername, $username, $password, $database) {
        $this->conn = new mysqli($servername, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addTask($project_id, $emp_id, $role) {
        $sqlInsertTask = "INSERT INTO task (project_id, emp_id, role) VALUES ('$project_id', '$emp_id', '$role')";

        if ($this->conn->query($sqlInsertTask) === TRUE) {
            echo "Task added successfully.";
        } else {
            echo "Error adding task: " . $this->conn->error;
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
    $project_id = $_POST["project_id"];
    $emp_id = $_POST["emp_id"];
    $role = $_POST["role"];

    $db = new Database($servername, $username, $password, $database);
    $db->addTask($project_id, $emp_id, $role);
    $db->closeConnection();
}

?>
