<?php
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

// Fetch all employee IDs from the 'employee' table
$employeeIds = [];
$sqlEmployeeIds = "SELECT emp_id FROM employee";
$resultEmployeeIds = $conn->query($sqlEmployeeIds);

if ($resultEmployeeIds->num_rows > 0) {
    while ($row = $resultEmployeeIds->fetch_assoc()) {
        $employeeIds[] = $row['emp_id'];
    }
}

// Close the database connection
$conn->close();
?>

