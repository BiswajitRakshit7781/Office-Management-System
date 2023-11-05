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

// Fetch all employees from the 'employee' table
$employees = [];
$sqlEmployees = "SELECT * FROM employee";
$resultEmployees = $conn->query($sqlEmployees);

if ($resultEmployees->num_rows > 0) {
    while ($row = $resultEmployees->fetch_assoc()) {
        $employees[] = $row;
    }
}
?>

<table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Email ID</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Post</th>
                <th>Date of Join</th>
                <th>Basic</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($employees as $employee) {
                echo "<tr>
                        <td>{$employee['emp_id']}</td>
                        <td>{$employee['emp_name']}</td>
                        <td>{$employee['email_id']}</td>
                        <td>{$employee['address']}</td>
                        <td>{$employee['phone_no']}</td>
                        <td>{$employee['post']}</td>
                        <td>{$employee['date_of_join']}</td>
                        <td>{$employee['basic']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
// Close the database connection
$conn->close();
?>