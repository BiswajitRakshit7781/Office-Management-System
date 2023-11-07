<?php

class Database {
    private $conn;

    public function __construct($servername, $username, $password, $database) {
        $this->conn = new mysqli($servername, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getEmployeeTasks($emp_id) {
        $tasks = [];
        $sqlTasks = "SELECT e.emp_id, e.emp_name, p.project_id, p.project_name, t.role
                    FROM task t
                    INNER JOIN employee e ON t.emp_id = e.emp_id
                    INNER JOIN project p ON t.project_id = p.project_id
                    WHERE t.emp_id = '$emp_id'";
        $resultTasks = $this->conn->query($sqlTasks);

        if ($resultTasks->num_rows > 0) {
            while ($row = $resultTasks->fetch_assoc()) {
                $tasks[] = $row;
            }
        }
        return $tasks;
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

// Check if employee is logged in (you might want to add additional authentication logic)
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$emp_id = $_SESSION['emp_id'];

$db = new Database($servername, $username, $password, $database);
$tasks = $db->getEmployeeTasks($emp_id);
$db->closeConnection();

// Now, $tasks array contains the fetched tasks assigned to the logged-in employee
?>
