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


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedEmployeeId = $_POST["employee_id"];

    // Fetch corresponding employee name
    $sqlEmployeeName = "SELECT emp_name FROM employee WHERE emp_id = '$selectedEmployeeId'";
    $resultEmployeeName = $conn->query($sqlEmployeeName);

    if ($resultEmployeeName->num_rows > 0) {
        $row = $resultEmployeeName->fetch_assoc();
        $selectedEmployeeName = $row["emp_name"];
    }
}

// Update employee details in the database
if (isset($_POST['update'])) {
    $emailId = $_POST["email_id"];
    $address = $_POST["address"];
    $phoneNo = $_POST["phone_no"];
    $post = $_POST["post"];
    $password = $_POST["password"];
    $basic = $_POST["basic"];

    // SQL query to update employee details
    $sqlUpdateEmployee = "UPDATE employee SET email_id = '$emailId', address = '$address', 
                           phone_no = '$phoneNo', post = '$post', password = '$password', 
                           basic = '$basic' WHERE emp_id = '$selectedEmployeeId'";

    if ($conn->query($sqlUpdateEmployee) === TRUE) {
        echo "<script>alert('Employee details updated successfully');</script>";
    } else {
        echo "Error updating employee details: " . $conn->error;
    }
}
$conn->close();
?>