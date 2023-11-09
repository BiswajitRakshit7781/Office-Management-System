<?php
// Start session to access session variables
session_start();

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

// Check if employee is logged in (you might want to add additional authentication logic)
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$emp_id = $_SESSION['emp_id'];

// Fetch projects assigned to the logged-in employee from the task table
$projects = [];
$sqlProjects = "SELECT t.project_id, p.project_name
                FROM task t
                INNER JOIN project p ON t.project_id = p.project_id
                WHERE t.emp_id = '$emp_id'";
$resultProjects = $conn->query($sqlProjects);

if ($resultProjects->num_rows > 0) {
    while ($row = $resultProjects->fetch_assoc()) {
        $projects[] = $row;
    }
}
?>