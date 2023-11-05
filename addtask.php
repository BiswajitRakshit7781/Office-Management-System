<<?php
// Database connection parameters
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "project_database"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST["project_id"];
    $emp_id = $_POST["emp_id"];
    $role = $_POST["role"];

    // SQL query to insert task data into the 'task' table
    $sqlInsertTask = "INSERT INTO task (project_id, emp_id, role) VALUES ('$project_id', '$emp_id', '$role')";

    if ($conn->query($sqlInsertTask) === TRUE) {
        echo "Task added successfully.";
    } else {
        echo "Error adding task: " . $conn->error;
    }
}

$conn->close();
?>
