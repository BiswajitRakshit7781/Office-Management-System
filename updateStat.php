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

// Fetch project data
$sql = "SELECT * FROM project";
$result = $conn->query($sql);

// Update project statistics
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$projectId = $_POST["project_id"];
$status = $_POST["status"];
$progression = $_POST["progression"];

// Perform update query (replace 'statistics' with your actual column name)
$updateSql = "UPDATE project SET status='$status' && progression='$progression' WHERE project_id='$projectId'";
if ($conn->query($updateSql) === TRUE) {
echo "Project statistics updated successfully";
} else {
echo "Error updating project statistics: " . $conn->error;
}
}
$conn->close();
?>