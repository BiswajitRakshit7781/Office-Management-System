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
    <h2>Welcome <?php echo $_SESSION["emp_name"]; ?> <br>Employee ID : <?php echo $_SESSION["emp_id"]; ?> </h2>
        <a href="logout.php" style="float: right;"><h3>Logout</h3></a>
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
<h1>Add Tasks</h1>
<?php require_once("fetchtask.php");?>
<form method="post" action="addtask.php">
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

    <div id="payrollSlip" class="tabcontent">
        <h3>Payroll Slip Content</h3>
        <?php require_once("emp_payroll.php");?>
    </div>

<div id="notice" class="tabcontent">
  <h1>Notice</h1>
  <?php require_once("viewNotice.php"); ?>
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
