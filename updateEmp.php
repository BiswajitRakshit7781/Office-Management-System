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

// Handle form submission for updating employee details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedEmpId = $_POST["emp_id"];
    $emailId = $_POST["email_id"];
    $address = $_POST["address"];
    $phoneNo = $_POST["phone_no"];
    $post = $_POST["post"];
    $password = $_POST["password"];
    $basic = $_POST["basic"];

    // SQL query to update employee details
    $sqlUpdateEmployee = "UPDATE employee SET 
                          email_id = '$emailId', 
                          address = '$address', 
                          phone_no = '$phoneNo', 
                          post = '$post', 
                          password = '$password', 
                          basic = '$basic' 
                          WHERE emp_id = '$selectedEmpId'";

    if ($conn->query($sqlUpdateEmployee) === TRUE) {
        // Display a success message (if needed)
        echo '<script>';
            echo 'alert("Employee updated successfully");';
            echo 'window.location.href = "hr_dashboard.php";';
            echo '</script>';
    } else {
        echo "Error updating employee details: " . $conn->error;
    }
}
// Close the database connection
$conn->close();
?>
