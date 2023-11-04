<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="manager_dashboard.css">
    <title>Manager Dashboard</title>
</head>

<body>
    <div class="navbar">
    <h1>Welcome <?php echo $_SESSION["emp_name"]; ?> </h1>
    <h3>Employee ID : <?php echo $_SESSION["emp_id"]; ?> </h3>
        <a href="login.php" style="float: right;"><h3>Logout</h3></a>
    </div>

    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'addTask')"><span></span>Add Task to Employee</button>
        <button class="tablinks" onclick="openTab(event, 'projectStatistics')"><span></span>View Project Statistics</button>
        <button class="tablinks" onclick="openTab(event, 'viewAttendance')"><span></span>View Attendance</button>
        <button class="tablinks" onclick="openTab(event, 'payrollSlip')"><span></span>Payroll Slip</button>
        <button class="tablinks" onclick="openTab(event, 'notice')"><span></span>Notice</button>
    </div>

    <!-- Tabs Content -->
    <div id="addTask" class="tabcontent">
        <<?php
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

// Fetch project IDs from the 'project' table
$projects = [];
$sqlProjects = "SELECT project_id, project_name FROM project";
$resultProjects = $conn->query($sqlProjects);

// Fetch employee IDs with post=Employee from the 'employee' table
$employees = [];
$sqlEmployees = "SELECT emp_id FROM employee WHERE post='Employee'";
$resultEmployees = $conn->query($sqlEmployees);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST["project_id"];
    $emp_id = $_POST["emp_id"];
    $role = $_POST["role"];

    // SQL query to insert task data into the 'task' table
    $sqlInsertTask = "INSERT INTO task (project_id, emp_id, role) VALUES ('$project_id', '$emp_id', '$role')";

    if ($conn->query($sqlInsertTask) === TRUE) {
        echo "Task added successfully.";
    } else {
        echo "Error adding task: " . $conn->error;
    }
}

$conn->close();
?>
<h1>Add Tasks</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="project_id">Select Project:</label>
    <select id="project_id" name="project_id" required>
        <?php
        // Output project options
        while ($row = $resultProjects->fetch_assoc()) {
            echo "<option value=".$row["project_id"].">".$row["project_name"]."</option>";
        }
        ?>
    </select><br><br>

    <label for="emp_id">Select Employee:</label>
    <select id="emp_id" name="emp_id" required>
        <?php
        // Output employee options
        while ($row = $resultEmployees->fetch_assoc()) {
            echo "<option value=".$row["emp_id"].">".$row["emp_id"]."</option>";
        }
        ?>
    </select><br><br>

    <label for="role">Role:</label>
    <input type="text" id="role" name="role" required><br><br>

    <input type="submit" value="Assign Task">
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

    <div id="viewAttendance" class="tabcontent">
        <h3>View Attendance Content</h3>
        <!-- View attendance content goes here -->
    </div>

    <div id="payrollSlip" class="tabcontent">
        <h3>Payroll Slip Content</h3>
        <!-- Payroll slip content goes here -->
    </div>

    <div id="notice" class="tabcontent">
        <h1>Notice</h1>
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
?>

<h3>Existing Notices:</h3>
    <ul>
        <?php
        foreach ($notices as $notice) {
            echo "<li> {$notice['time']} - {$notice['notice']}</li>";
        }
        ?>
    </ul>

    <!-- Form to submit new notice -->
    <h3>Write New Notice:</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="notice">Notice:</label><br>
        <textarea id="notice" name="notice" rows="4" cols="50" required></textarea><br><br>
        <input type="submit" value="Submit Notice">
    </form>
    <?php
// Close the database connection
$conn->close();
?>
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
