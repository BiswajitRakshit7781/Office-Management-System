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
    <h2>Welcome, <?php echo $_SESSION["emp_name"]; ?><br> Employee ID : <?php echo $_SESSION["emp_id"]; ?> </h2>
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
    <?php
// Start session to access session variables
// session_start();

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

// Check if employee is logged in (you might want to add additional authentication logic)
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$emp_id = $_SESSION['emp_id'];

// Fetch tasks assigned to the logged-in employee
$tasks = [];
$sqlTasks = "SELECT e.emp_id, e.emp_name, p.project_id, p.project_name, t.role
            FROM task t
            INNER JOIN employee e ON t.emp_id = e.emp_id
            INNER JOIN project p ON t.project_id = p.project_id
            WHERE t.emp_id = '$emp_id'";
$resultTasks = $conn->query($sqlTasks);

if ($resultTasks->num_rows > 0) {
    while ($row = $resultTasks->fetch_assoc()) {
        $tasks[] = $row;
    }
}
?>
<table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Project ID</th>
                <th>Project Name</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tasks as $task) {
                echo "<tr>
                        <td>{$task['emp_id']}</td>
                        <td>{$task['emp_name']}</td>
                        <td>{$task['project_id']}</td>
                        <td>{$task['project_name']}</td>
                        <td>{$task['role']}</td>
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