
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
    // Retrieve employee ID from the form
    $emp_id = $_POST["emp_id"];

    // Delete employee data from the database
    $sql = "DELETE FROM employee WHERE emp_id = '$emp_id' ";

    if ($conn->query($sql) === TRUE) {
        echo "Employee data deleted successfully";
    } else {
        echo "Error deleting employee data: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
