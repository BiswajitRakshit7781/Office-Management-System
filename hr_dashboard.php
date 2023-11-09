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
    <h2>Welcome <?php echo $_SESSION["emp_name"]; ?><br> Employee ID : <?php echo $_SESSION["emp_id"]; ?> </h2>
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
    <button class="tablinks" onclick="openTab(event, 'viewAttendance')"><span></span>View Attendance</button>
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
<form method="post" action="updateEmp.php">
        <label for="emp_id">Select Employee ID:</label>
        <select id="emp_id" name="emp_id" required>
            <?php require_once("fetchEmp.php");
            foreach ($employeeIds as $empId) {
                echo "<option value='$empId'>$empId</option>";
            }
            ?>
        </select><br>

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
        <input type="number" id="basic" name="basic" required><br>

        <input type="submit" value="Update Employee Details">
    </form>
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
    <h2>View Employees</h2>
<?php require_once("viewEmp.php"); ?>
      </div>

<div id="addProject" class="tabcontent">
    <h2>Add Project</h2>
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
    <table border="1" cellspacing="0">
    <form method="POST">
        <tr>
            <th>Employee Name</th>
            <th> P </th>
            <th> A </th>
            <th> L </th>
            <th> H </th>
        </tr>
        <?php
            $db = mysqli_connect("localhost", "root", "", "project_database") or die("Connectivity Failed");
            $fetchingEmp = mysqli_query($db, "SELECT * FROM employee") OR die(mysqli_error($db));
            while($data = mysqli_fetch_assoc($fetchingEmp))
            {
                $Emp_name = $data['emp_name'];
                $Emp_id = $data['emp_id'];
        ?>
                <tr>
                    <td><?php echo $Emp_name; ?></td>
                    <td> <input type="checkbox" name="empPresent[]" value="<?php echo $Emp_id; ?>" /></td>
                    <td> <input type="checkbox" name="empAbsent[]" value="<?php echo $Emp_id; ?>" /></td>
                    <td> <input type="checkbox" name="empLeave[]" value="<?php echo $Emp_id; ?>" /></td>
                    <td> <input type="checkbox" name="empHoliday[]" value="<?php echo $Emp_id; ?>" /></td>
                </tr>
        <?php

            }
        ?>
        <tr>
            <td>Select Date</td>
            <td colspan="4"> <input type="date" name="selected_date" /> </td>
        </tr>
        <tr>
            <th colspan="5"> <input type="submit" name="addAttendanceBTN" /></th>
        </tr>
    </form>
</table>


<?php 
    if(isset($_POST['addAttendanceBTN']))
    {
        date_default_timezone_set("Asia/Kolkata");

        // Date Logic Starts 
        if($_POST['selected_date'] == NULL)
        {
            $selected_date = date("Y-m-d");
        }else {
            $selected_date = $_POST['selected_date'];
        }
        // Date Logic Ends
        $attendance_month = date("M", strtotime($selected_date));
        $attendance_year = date("Y", strtotime($selected_date));

        if(isset($_POST['empPresent']))
        {
            $EmpPresent = $_POST['empPresent'];
            $attendance = "P";

            foreach($EmpPresent as $atd)
            {
                mysqli_query($db, "INSERT INTO attendance(emp_id, curr_date, attendance_month, attendance_year, status) VALUES('" . $atd . "', '". $selected_date ."', '". $attendance_month ."', '". $attendance_year ."', '". $attendance ."')") OR die(mysqli_error($db));
            }

        }

        if(isset($_POST['empAbsent']))
        {
            $EmpAbsent = $_POST['empAbsent'];
            $attendance = "A";

            foreach($EmpAbsent as $atd)
            {
                mysqli_query($db, "INSERT INTO attendance(emp_id, curr_date, attendance_month, attendance_year, status) VALUES('" . $atd . "', '". $selected_date ."', '". $attendance_month ."', '". $attendance_year ."', '". $attendance ."')") OR die(mysqli_error($db));
            }
        }

        if(isset($_POST['empLeave']))
        {
            $EmpLeave = $_POST['empLeave'];
            $attendance = "L";

            foreach($EmpLeave as $atd)
            {
                mysqli_query($db, "INSERT INTO attendance(emp_id, curr_date, attendance_month, attendance_year, status) VALUES('" . $atd . "', '". $selected_date ."', '". $attendance_month ."', '". $attendance_year ."', '". $attendance ."')") OR die(mysqli_error($db));
            }
        }

        if(isset($_POST['empHoliday']))
        {
            $EmpHoliday = $_POST['empHoliday'];
            $attendance = "H";

            foreach($EmpHoliday as $atd)
            {
                mysqli_query($db, "INSERT INTO attendance(emp_id, curr_date, attendance_month, attendance_year, status) VALUES('" . $atd . "', '". $selected_date ."', '". $attendance_month ."', '". $attendance_year ."', '". $attendance ."')") OR die(mysqli_error($db));
            }
        }



        echo "Attendance added successfully";

    }
?>
  </div>

  <div id="viewAttendance" class="tabcontent">
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
                    <h2>Attendance<br>
                    Month: <u><?php echo strtoupper(date("F")); ?></u></h2>
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