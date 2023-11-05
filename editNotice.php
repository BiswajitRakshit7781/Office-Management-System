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

// Handle new notice submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $notice = $_POST["notice"];

    // SQL query to insert new notice into the 'notice' table with current timestamp
    $sqlInsertNotice = "INSERT INTO notice (time, notice) VALUES (CURRENT_TIME(), '$notice')";

    if ($conn->query($sqlInsertNotice) === TRUE) {
        // Display a success message (if needed)
        echo "<script>alert('Notice submitted successfully');</script>";
    } else {
        echo "Error submitting notice: " . $conn->error;
    }
}

// Fetch existing notices from the 'notice' table
$notices = [];
$sqlNotices = "SELECT * FROM notice ORDER BY time DESC";
$resultNotices = $conn->query($sqlNotices);

if ($resultNotices->num_rows > 0) {
    while ($row = $resultNotices->fetch_assoc()) {
        $notices[] = $row;
    }
}
$conn->close();
?>