<?php

class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "project_database";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function insertEmployeeRecord($empid, $empName, $email, $address, $phone, $post, $pwd, $dateOfJoin, $basicSalary) {
        $insertSql = "INSERT INTO employee (emp_id, emp_name, email_id, address, phone_no, post, password, date_of_join, basic) 
                      VALUES ('$empid', '$empName', '$email', '$address', '$phone', '$post', '$pwd', '$dateOfJoin', '$basicSalary')";

        if ($this->conn->query($insertSql) === TRUE) {
            echo '<script>';
            echo 'alert("Employee added successfully");';
            echo 'window.location.href = "hr_dashboard.php";';
            echo '</script>';
        } else {
            echo "Error: " . $insertSql . "<br>" . $this->conn->error;
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class EmployeeManager {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addEmployee() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $empid = $_POST["emp_id"];
            $empName = $_POST["emp_name"];
            $email = $_POST["email_id"];
            $address = $_POST["address"];
            $phone = $_POST["phone_no"];
            $post = $_POST["post"];
            $pwd = $_POST["password"];
            $dateOfJoin = $_POST["date_of_join"];
            $basicSalary = $_POST["basic"];

            $this->db->insertEmployeeRecord($empid, $empName, $email, $address, $phone, $post, $pwd, $dateOfJoin, $basicSalary);
        }
    }
}

$employeeManager = new EmployeeManager();
$employeeManager->addEmployee();

?>
