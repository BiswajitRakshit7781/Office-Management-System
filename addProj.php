<?php

class Database {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addProject($project_id, $project_name, $description, $starting_date, $ending_date) {
        $sql = "INSERT INTO project (project_id, project_name, description, starting_date, ending_date) 
                VALUES ('$project_id', '$project_name', '$description', '$starting_date', '$ending_date')";

        if ($this->conn->query($sql) === TRUE) {
            echo '<script>';
            echo 'alert("Project added successfully");';
            echo 'window.location.href = "hr_dashboard.php";';
            echo '</script>';
        } else {
            echo "Error adding project: " . $this->conn->error;
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST["project_id"];
    $project_name = $_POST["project_name"];
    $description = $_POST["description"];
    $starting_date = $_POST["starting_date"];
    $ending_date = $_POST["ending_date"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_database";

    $db = new Database($servername, $username, $password, $dbname);
    $db->addProject($project_id, $project_name, $description, $starting_date, $ending_date);
    $db->closeConnection();
}

?>
