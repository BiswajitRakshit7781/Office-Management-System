<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            
	background-color: #fff;
}
       table {
	width: 100%;
	border-collapse: collapse;
	margin-top: 20px;
}
th, td {
	border: 1px solid #ccc;
	padding: 10px;
	text-align: left;
}
th {
	background-color: #f2f2f2;
}
        </style>
</head>
<body bgcolor="black">
    

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
</body>
</html>