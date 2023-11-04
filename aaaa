<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="emp_dash.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="navbar">
    <h1>Welcome, <?php echo $_SESSION["emp_name"]; ?> </h1>
    <h3>Employee ID : <?php echo $_SESSION["emp_id"]; ?> </h3>
        <a href="login.php" style="float: right;"><h3>Logout</h3></a>
    </div>
    
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'viewTask')"><span></span>View Task</button>
        <button class="tablinks" onclick="openTab(event, 'updateProjectStatistics')"><span></span>Update Project Statistics</button>
        <button class="tablinks" onclick="openTab(event, 'viewAttendance')"><span></span>View Attendance</button>
        <button class="tablinks" onclick="openTab(event, 'payrollSlip')"><span></span>Payroll Slip</button>
        <button class="tablinks" onclick="openTab(event, 'notice')"><span></span>Notice</button>
    </div>

    <div id="viewTask" class="tabcontent">
        <h3>View Task Content</h3>
        <table>
        <tr>
            <th>Task ID</th>
            <th>Task Name</th>
            <th>Task Description</th>
            <th>Assigned To</th>
            <th>Status</th>
        </tr>

        <?php
        $servername = "localhost"; // Change this to your database server name
        $username = "root"; // Change this to your database username
        $password = ""; // Change this to your database password
        $database = "project_database"; // Change this to your database name
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $database);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // SQL query to fetch tasks
        $sql = "SELECT * FROM task";
        $result = $conn->query($sql);
        
        $conn->close();

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["task_id"]."</td>
                        <td>".$row["task_name"]."</td>
                        <td>".$row["task_description"]."</td>
                        <td>".$row["assigned_to"]."</td>
                        <td>".$row["status"]."</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No tasks found</td></tr>";
        }
        ?>
    </table>
    </div>


    <div id="updateProjectStatistics" class="tabcontent">

        <h2>Update Project Statistics</h2>
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

// Fetch project data
$sql = "SELECT * FROM project";
$result = $conn->query($sql);

// Update project statistics
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectId = $_POST["project_id"];
    $newStatistics = $_POST["new_statistics"];

    // Perform update query (replace 'statistics' with your actual column name)
    $updateSql = "UPDATE project SET statistics='$newStatistics' WHERE project_id=$projectId";
    if ($conn->query($updateSql) === TRUE) {
        echo "Project statistics updated successfully";
    } else {
        echo "Error updating project statistics: " . $conn->error;
    }
}
$conn->close();
?>
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <label for="project_id">Select Project:</label>
            <select id="project_id" name="project_id">
            <?php
            // Output project options
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value=".$row["project_id"].">".$row["project_name"]."</option>";
                }
            } else {
                echo "<option value=''>No projects found</option>";
            }
            ?>
        </select><br><br>

        <label for="new_statistics">New Statistics:</label>
        <input type="text" id="new_statistics" name="new_statistics" required><br><br>

        <input type="submit" value="Update Statistics">
    </form>
    </div>




    <div id="viewAttendance" class="tabcontent">
    <?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the attendance table
$sql = "SELECT * FROM attendance";
$result = $conn->query($sql);
?>
        <h3>View Attendance Content</h3>
        <table border="1">
        <tr>
            <th>Employee Name</th>
            <th>Date</th>
            <th>Status</th>
        </tr>

        <?php
        // Display data from the attendance table
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["employee_name"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No tasks found</td></tr>";
        }
        ?>

    </table>

    <?php
    // Close the database connection
    $conn->close();
    ?>
    </div>

    <div id="payrollSlip" class="tabcontent">
        <h3>Payroll Slip Content</h3>
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

$employeeId = ""; // Initialize the variable to store the searched employee ID
$payrollData = array(); // Array to store payroll details

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeId = $_POST["employee_id"];

    // SQL query to fetch payroll details based on employee ID
    $sql = "SELECT * FROM payroll WHERE emp_id = '$employeeId'";
    $result = $conn->query($sql);

    // Check if the employee ID is found in the payroll table
    if ($result->num_rows > 0) {
        // Fetch and store payroll details in an array
        $payrollData = $result->fetch_assoc();
    } else {
        // Employee ID not found, show an error message
        $error = "Employee ID not found";
    }
}

$conn->close();
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="employee_id">Search Employee ID:</label>
        <input type="text" id="employee_id" name="employee_id" value="<?php echo $employeeId; ?>" required>
        <input type="submit" value="Search">
    </form>

    <?php
    // Display payroll details if found
    if (!empty($payrollData)) {
        echo "<h3>Payroll Details for Employee ID: " . $employeeId . "</h3>";
        echo "<p>Salary: $" . $payrollData["salary"] . "</p>";
        echo "<p>Bonus: $" . $payrollData["bonus"] . "</p>";
        // Display other payroll details as needed
    }

    // Display error message if employee ID not found
    if (isset($error)) {
        echo "<p style='color: red;'>Error: " . $error . "</p>";
    }
    ?>
</body>
    </div>

    <div id="notice" class="tabcontent">
        <h3>Notice</h3>
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

// SQL query to fetch notices
$sql = "SELECT * FROM notice ORDER BY date DESC";
$result = $conn->query($sql);
?>
<div class="notice-container">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='notice'>
                        <strong>Date: </strong>".$row["date"]."<br>
                        <strong>Notice: </strong>".$row["notice"]."<br><br>
                      </div>";
            }
        } else {
            echo "No notices available.";
        }
        ?>
    </div>
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
