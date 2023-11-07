<?php

class Database {
    private $conn;

    public function __construct($servername, $username, $password, $database) {
        $this->conn = new mysqli($servername, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAllEmployees() {
        $employees = [];
        $sqlEmployees = "SELECT * FROM employee";
        $resultEmployees = $this->conn->query($sqlEmployees);

        if ($resultEmployees->num_rows > 0) {
            while ($row = $resultEmployees->fetch_assoc()) {
                $employees[] = $row;
            }
        }
        return $employees;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "project_database";

$db = new Database($servername, $username, $password, $database);
$employees = $db->getAllEmployees();
$db->closeConnection();
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
