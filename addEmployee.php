<?php
        
        $servername = "localhost"; 
        $username = "root";
        $password = ""; 
        $database = "project_database"; 

       
        $conn = new mysqli($servername, $username, $password, $database);

       
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $empName = $email = $address = $phone = $post = $password = $dateOfJoin = $basicSalary = "";

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

          
            $insertSql = "INSERT INTO employee (emp_id,emp_name, email_id, address, phone_no, post, password, date_of_join, basic) VALUES ('$empid','$empName', '$email', '$address', '$phone', '$post', '$pwd', '$dateOfJoin', '$basicSalary')";

            if ($conn->query($insertSql) === TRUE) {
                echo "New employee record created successfully";
            } else {
                echo "Error: " . $insertSql . "<br>" . $conn->error;
            }
        }

        $conn->close();
        ?>