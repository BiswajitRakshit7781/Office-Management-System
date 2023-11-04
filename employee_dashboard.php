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
    <?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Calculate payroll and deduction
$sql = "SELECT employee.emp_id, emp_name, basic, payroll_year, da, hra, pf, deduction, gross_salary, net_salary
        FROM employee
        INNER JOIN payroll ON employee.emp_id = payroll.emp_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Basic Salary</th>
                <th>Payroll Year</th>
                <th>DA</th>
                <th>HRA</th>
                <th>PF</th>
                <th>Deduction</th>
                <th>Gross Salary</th>
                <th>Net Salary</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        
        echo "<tr>
                <td>" . $row['emp_id'] . "</td>
                <td>" . $row['emp_name'] . "</td>
                <td>" . $row['basic'] . "</td>
                <td>" . $row['payroll_year'] . "</td>
                <td>" . $row['da'] . "</td>
                <td>" . $row['hra'] . "</td>
                <td>" . $row['pf'] . "</td>
                <td>" . $deduction . "</td>
                <td>" . $row['gross_salary'] . "</td>
                <td>" . $row['net_salary'] . "</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "No records found";
}

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