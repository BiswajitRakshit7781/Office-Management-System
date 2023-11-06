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
        <a href="logout.php" style="float: right;"><h3>Logout</h3></a>
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
<h2>Tasks</h2>
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
<div id="updateProjectStatistics" class="tabcontent">
<h2>Update Project Statistics</h2>
<?php require_once("updateStat.php"); ?>
 <form method="post" action="updateStat.php">
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

<label for="status">Update Status:</label>
<input type="text" id="status" name="status" required>
<label for="progression">Update Progression:</label>
<input type="text" id="progression" name="progression" required>
<br><br>

<input type="submit" value="Update Statistics">
</form>
</div>

    <div id='viewAttendance' class="tabcontent">
    <?php 
    $db = mysqli_connect("localhost", "root", "", "project_database") or die("Connectivity Failed");

    $firstDayOfMonth = date("1-m-Y");
    $totalDaysInMonth = date("t", strtotime($firstDayOfMonth));
   
    // Fetching Students 
    $fetchingEmp = mysqli_query($db, "SELECT * FROM employee") OR die(mysqli_error($db));
    $totalNumberOfEmp= mysqli_num_rows($fetchingEmp);

    $EmpNamesArray = array();
    $EmpIDsArray = array();
    $counter = 0;
    while($Emp= mysqli_fetch_assoc($fetchingEmp))
    {
        $EmpNamesArray[] = $Emp['emp_name'];
        $EmpIDsArray[] = $Emp['emp_id'];
    }


?>

<div class="container-fluid">
        <header class="bg-primary text-white text-center mb-3 py-3">
            <div class="row">
                <div class="col-12">
                    <h2>Attendance</h2>
                    <h2>Month: <u><?php echo strtoupper(date("F")); ?></u></h2>
                </div>
            </div>

           
        </header>
<table border="1" cellspacing="0">
<?php 
    for($i = 1; $i<=$totalNumberOfEmp+ 2; $i++)
    {
        if($i == 1)
        {
            echo "<tr>";
            echo "<td rowspan='2'>Names</td>";
            for($j = 1; $j<=$totalDaysInMonth; $j++)
            {
                echo "<td>$j</td>";
            }
            echo "</tr>";
        }else if($i == 2)
        {
            echo "<tr>";
            for($j = 0; $j<$totalDaysInMonth; $j++)
            {
                echo "<td>" . date("D", strtotime("+$j days", strtotime($firstDayOfMonth))) . "</td>";
            }
            echo "</tr>";
        }else 
        {
            echo "<tr>";
            echo "<td>" . $EmpNamesArray[$counter] . "</td>";
            for($j = 1; $j<=$totalDaysInMonth; $j++)
            {
                $dateOfAttendance = date("Y-m-$j");
                $fetchingEmpAttendance = mysqli_query($db, "SELECT status FROM attendance WHERE emp_id = '". $EmpIDsArray[$counter] ."' AND curr_date = '". $dateOfAttendance ."'") OR die(mysqli_error($db));
                
                $isAttendanceAdded = mysqli_num_rows($fetchingEmpAttendance);
                if($isAttendanceAdded > 0)
                {
                    $EmpAttendance = mysqli_fetch_assoc($fetchingEmpAttendance);
                    if($EmpAttendance['status'] == "P")
                    {
                        $color = "green";
                    }else if($EmpAttendance['status'] == "A")
                    {
                        $color = "red";
                    }else if($EmpAttendance['status'] == "H")
                    {
                        $color = "blue";
                    }else if($EmpAttendance['status'] == "L")
                    {
                        $color = "brown";
                    }

                    echo "<td style='background-color: $color; color:white'>" . $EmpAttendance['status'] . "</td>";
                }else {
                    echo "<td></td>";
                }
               

            }
            echo "</tr>";
            $counter++;
        }
    }
?>
</table>
</div>
        </div>
<div id="payrollSlip" class="tabcontent">
    <h2>Payroll Slip</h2>
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