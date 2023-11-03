<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="hr_dashboard.css">
  <title>HR Dashboard</title>
</head>
<body>
  <div class="navbar">
    <h1>HR Dashboard</h1><a href="logout.php" style="float: right;">
    <h3>Logout</h3></a>
  </div>
  <h2>Tabs</h2>
  <div class="tab">
    <button class="tablinks" onclick="openTab(event, 'addEmployee')"> <span></span>Add Employee</button> <button class="tablinks" onclick="openTab(event, 'projectStatistics')"><span></span>View Project Statistics</button> <button class="tablinks" onclick="openTab(event, 'payroll')"><span></span>Payroll</button> <button class="tablinks" onclick="openTab(event, 'leaveRegister')"><span></span>Leave Register</button> <button class="tablinks" onclick="openTab(event, 'attendanceRegister')"><span></span>Attendance Register</button>
  </div><!-- Tabs Content -->
  <div id="addEmployee" class="tabcontent">
    <h3>Add Employee Content</h3><?php
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

        // Define variables to store form data
        $empName = $email = $address = $phone = $post = $password = $dateOfJoin = $basicSalary = "";

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $empName = $_POST["emp_name"];
            $email = $_POST["email_id"];
            $address = $_POST["address"];
            $phone = $_POST["phone_no"];
            $post = $_POST["post"];
            $pwd = $_POST["password"];
            $dateOfJoin = $_POST["date_of_join"];
            $basicSalary = $_POST["basic"];

            // SQL query to insert data into 'employee' table
            $insertSql = "INSERT INTO employee (emp_name, email_id, address, phone_no, post, password, date_of_join, basic) VALUES ('$empName', '$email', '$address', '$phone', '$post', '$pwd', '$dateOfJoin', '$basicSalary')";

            if ($conn->query($insertSql) === TRUE) {
                echo "New employee record created successfully";
            } else {
                echo "Error: " . $insertSql . "<br>" . $conn->error;
            }
        }

        $conn->close();
        ?>
    <form method="post" action="%3C?php%20echo%20htmlspecialchars($_SERVER[">
      "&gt; <label for="emp_name">Employee Name:</label> <input type="text" id="emp_name" name="emp_name" required=""><br>
      <br>
      <label for="email_id">Email ID:</label> <input type="email" id="email_id" name="email_id" required=""><br>
      <br>
      <label for="address">Address:</label> 
      <textarea id="address" name="address" required=""></textarea><br>
      <br>
      <label for="phone_no">Phone Number:</label> <input type="text" id="phone_no" name="phone_no" required=""><br>
      <br>
      <label for="post">Post:</label> <input type="text" id="post" name="post" required=""><br>
      <br>
      <label for="password">Password:</label> <input type="password" id="password" name="password" required=""><br>
      <br>
      <label for="date_of_join">Date of Join:</label> <input type="date" id="date_of_join" name="date_of_join" required=""><br>
      <br>
      <label for="basic">Basic Salary:</label> <input type="text" id="basic" name="basic" required=""><br>
      <br>
      <input type="submit" value="Add Employee">
    </form>
  </div>
  <!-- <div id="projectStatistics" class="tabcontent">
    <h3>Project Statistics Content</h3><?php
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

        // SQL query to fetch all data from the 'project' table
        $sql = "SELECT * FROM project";
        $result = $conn->query($sql);
        ?>
    <table>
      <tr>
        <th>Project ID</th>
        <th>Project Name</th>
        <th>Description</th>
        <th>Status</th>
        <th>Progression</th>
        <th>Starting Date</th>
        <th>Ending Date</th>
      </tr><?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>".$row["project_id"]."</td>
                                    <td>".$row["project_name"]."</td>
                                    <td>".$row["description"]."</td>
                                    <td>".$row["status"]."</td>
                                    <td>".$row["progression"]."</td>
                                    <td>".$row["starting_date"]."</td>
                                    <td>".$row["ending_date"]."</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No projects found</td></tr>";
                    }
                    ?>
    </table>
  </div> -->
  <div id="payroll" class="tabcontent">
    <h3>Payroll Content</h3><!-- Payroll content goes here -->
  </div>
  <div id="leaveRegister" class="tabcontent">
    <h3>Leave Register Content</h3><!-- Leave register content goes here -->
  </div>
  <div id="attendanceRegister" class="tabcontent">
    <h3>Attendance Register Content</h3><!-- Attendance register content goes here -->
  </div>
  <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
  </script>
</body>
</html>