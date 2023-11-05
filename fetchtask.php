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

$projects = [];
$sqlProjects = "SELECT project_id, project_name FROM project";
$resultProjects = $conn->query($sqlProjects);

// Fetch employee IDs with post=Employee from the 'employee' table
$employees = [];
$sqlEmployees = "SELECT emp_id FROM employee WHERE post='Employee'";
$resultEmployees = $conn->query($sqlEmployees);

$conn->close();
?>