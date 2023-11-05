<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $project_id = $_POST["project_id"];
    $project_name = $_POST["project_name"];
    $description = $_POST["description"];
    $starting_date = $_POST["starting_date"];
    $ending_date = $_POST["ending_date"];

    // Insert project data into the database
    $sql = "INSERT INTO project (project_id,project_name, description, starting_date, ending_date) 
            VALUES ('$project_id','$project_name', '$description', '$starting_date', '$ending_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Project added successfully";
    } else {
        echo "Error adding project: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>