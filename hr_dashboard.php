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
        <a href="logout.php" style="float: right;"><h3>Logout</h3></a>
    </div>

  <div class="tab">
    <button class="tablinks" onclick="openTab(event, 'addEmployee')"> <span></span>Add Employee</button>
    <button class="tablinks" onclick="openTab(event, 'updateEmployee')"><span></span>Update Employee</button>
    <button class="tablinks" onclick="openTab(event, 'deleteEmployee')"><span></span>Delete Employee</button>
    <button class="tablinks" onclick="openTab(event, 'viewEmployee')"><span></span>View Employee</button>
    <button class="tablinks" onclick="openTab(event, 'addProject')"><span></span>Add Project</button>
    <button class="tablinks" onclick="openTab(event, 'projectStatistics')"><span></span>View Project Statistics</button> 
    <button class="tablinks" onclick="openTab(event, 'payroll')"><span></span>Payroll</button> 
    <button class="tablinks" onclick="openTab(event, 'attendanceRegister')"><span></span>Attendance Register</button>
    <button class="tablinks" onclick="openTab(event, 'notice')"><span></span>Notice</button>
  </div>
 
  <div id="addEmployee" class="tabcontent">
  <div class="wrapper">
        <form action="addEmployee.php" method="post">
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
<h2>Update Employee</h2>
<?php require_once("fetchEmp.php"); ?>
    <form method="post" action="fetchEmp.php">
        <label for="employee_id">Select Employee ID:</label>
        <select id="employee_id" name="employee_id" required>
            <option value="" disabled selected>Select Employee ID</option>
            <?php
            foreach ($employeeIds as $empId) {
                echo "<option value='$empId'>$empId</option>";
            }
            ?>
        </select>
        <input type="submit" value="Select Employee">
    </form>
    <?php require_once("fetchEmp.php");
    if ($selectedEmployeeName): ?>
        <h3>Selected Employee: <?php echo $selectedEmployeeName; ?></h3>
        <form method="post" action="updateEmp.php">
            <input type="hidden" name="employee_id" value="<?php echo $selectedEmployeeId; ?>">
            <label for="email_id">Email ID:</label>
            <input type="email" id="email_id" name="email_id" required><br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br>
            <label for="phone_no">Phone Number:</label>
            <input type="tel" id="phone_no" name="phone_no" required><br>
            <label for="post">Post:</label>
            <input type="text" id="post" name="post" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <label for="basic">Basic:</label>
            <input type="text" id="basic" name="basic" required><br>
            <input type="submit" name="update" value="Update Details">
        </form>
    <?php endif; ?>
    </div>

<div id="deleteEmployee" class="tabcontent">
<h2>Delete Employee</h2>
<form action="deleteEmp.php" method="post">
    <label for="emp_id">Employee ID to Delete:</label>
    <input type="text" name="emp_id" required><br>

    <input type="submit" value="Delete Employee">
</form>
</div>


<div id="viewEmployee" class="tabcontent">
<?php require_once("viewEmp.php"); ?>
      </div>

<div id="addProject" class="tabcontent">
<form action="addProj.php" method="post">
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
   <?php require_once("projectStat.php"); ?>
  </div>

  <div id="payroll" class="tabcontent">
    <?php 
    // require_once("payroll.php"); 
    ?>
  </div>

  <div id="attendanceRegister" class="tabcontent">
    <h3>Attendance Register Content</h3>
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
    <h3>Write New Notice:</h3>
    <form method="post" action="editNotice.php">
        <label for="notice">Notice:</label><br>
        <textarea id="notice" name="notice" rows="4" cols="50" required></textarea><br><br>
        <input type="submit" value="Submit Notice">
    </form>
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