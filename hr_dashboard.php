<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="hr_dashboard.css">
  <title>HR Dashboard</title>
</head>

<body>
<div class="navbar">
    <h2>Welcome, <?php echo $_SESSION["emp_name"]; ?><br> Employee ID : <?php echo $_SESSION["emp_id"]; ?> </h2>
        <a href="login.php" style="float: right;"><h3>Logout</h3></a>
    </div>

  <div class="tab">
    <button class="tablinks" onclick="openTab(event, 'addEmployee')"> <span></span>Add Employee</button>
    <button class="tablinks" onclick="openTab(event, 'updateEmployee')"><span></span>Update Employee</button>
    <button class="tablinks" onclick="openTab(event, 'deleteEmployee')"><span></span>Delete Employee</button>
    <button class="tablinks" onclick="openTab(event, 'viewEmployee')"><span></span>View Employee</button>
    <button class="tablinks" onclick="openTab(event, 'addProject')"><span></span>Add Project</button>
    <button class="tablinks" onclick="openTab(event, 'projectStatistics')"><span></span>View Project Statistics</button> 
    <button class="tablinks" onclick="openTab(event, 'payroll')"><span></span>Payroll</button> 
    <button class="tablinks" onclick="openTab(event, 'leaveRegister')"><span></span>Leave Register</button> 
    <button class="tablinks" onclick="openTab(event, 'attendanceRegister')"><span></span>Attendance Register</button>
    <button class="tablinks" onclick="openTab(event, 'notice')"><span></span>Notice</button>
  </div>
 
  <div id="addEmployee" class="tabcontent">
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
  <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <h1>Add Employee</h1>
            <div class="input-box">
                <div class="input-field">
                    <input type="text" name="emp_id" placeholder="Employee ID" required>
                </div>
                <div class="input-field">
                    <input type="text" name="emp_name" placeholder="Full Name" required>
                </div>
                <div class="input-field">
                    <input type="email" name="email_id" placeholder="Email ID" required>
                </div>
                <div class="input-field">
                    <input type="text" name="address" placeholder="Address" required>
                </div>
                <div class="input-field">
                    <input type="number" name="phone_no" placeholder="Phone Number" required>
                </div>
                <div class="input-field">
                    <input type="date" name="date_of_join" placeholder="Date Of Join" required>
                </div>
                <select name="post">
                    <option value="employee">Employee</option>
                    <option value="manager">Project Manager</option>
                </select>
                <div class="input-field">
                    <input type="int" name="basic" placeholder="Salary" required>
                </div>
                <div class="input-field">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
            </div>
         <button type="submit" class="btn">Add</button>
        </form>
    </div>
</div>

<div id="updateEmployee" class="tabcontent">
        
    </div>

<div id="deleteEmployee" class="tabcontent">
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
    $sql = "DELETE FROM employee WHERE emp_id = $emp_id";

    if ($conn->query($sql) === TRUE) {
        echo "Employee data deleted successfully";
    } else {
        echo "Error deleting employee data: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
<form action="delete_employee.php" method="post">
    <label for="emp_id">Employee ID to Delete:</label>
    <input type="text" name="emp_id" required><br>

    <input type="submit" value="Delete Employee">
</form>
    </div>


<div id="viewEmployee" class="tabcontent">
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
      </div>

<div id="addProject" class="tabcontent">
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
            VALUES ('$project_id'.'$project_name', '$description', '$starting_date', '$ending_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Project added successfully";
    } else {
        echo "Error adding project: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
<form action="add_project.php" method="post">
    <label for="project_id">Project ID:</label>
    <input type="text" name="project_id" required><br>

    <label for="project_name">Project Name:</label>
    <input type="text" name="project_name" required><br>

    <label for="description">Description:</label>
    <textarea name="description" rows="4" required></textarea><br>

    <label for="starting_date">Starting Date:</label>
    <input type="date" name="starting_date" required><br>

    <label for="ending_date">Ending Date:</label>
    <input type="date" name="ending_date" required><br>

    <input type="submit" value="Add Project">
</form>
</div>
  <div id="projectStatistics" class="tabcontent">
    <h1>Project Statistics</h1>
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
  </div>

  <div id="payroll" class="tabcontent">
    <h3>Payroll Content</h3><!-- Payroll content goes here -->
  </div>
  <div id="leaveRegister" class="tabcontent">
    <h3>Leave Register Content</h3><!-- Leave register content goes here -->
  </div>


  <div id="attendanceRegister" class="tabcontent">
    <h3>Attendance Register Content</h3>
    
  </div>



  
  <div id="notice" class="tabcontent">
        <h1>Notice</h1>
        <!-- <?php
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
?> -->

<!-- <h3>Existing Notices:</h3>
    <ul>
        <?php
        foreach ($notices as $notice) {
            echo "<li> {$notice['time']} - {$notice['notice']}</li>";
        }
        ?>
    </ul>

    <!-- Form to submit new notice -->
    <!-- <h3>Write New Notice:</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="notice">Notice:</label><br>
        <textarea id="notice" name="notice" rows="4" cols="50" required></textarea><br><br>
        <input type="submit" value="Submit Notice">
    </form> -->
    <?php
// Close the database connection
$conn->close();
?>
</div> -->
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