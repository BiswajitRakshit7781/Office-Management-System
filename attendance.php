<?php
// Replace these variables with your own database connection details
// $servername = "localhost";
// $username = "your_username";
// $password = "your_password";
// $dbname = "project_database";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Fetch and display attendance data
// $sql = "SELECT * FROM attendance";
// $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Attendance</title>
    <!-- Add your CSS styling here -->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div id="assignAttendanceTab">
    <h2>View Attendance</h2>

    <?php
    // if ($result->num_rows > 0) 
    {
        echo "<table>
            <tr>
                <th>Date</th>
                <th>Employee ID</th>
                <th>Present</th>
                <th>Absent</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['date'] . "</td>
                    <td>" . $row['employee_id'] . "</td>
                    <td>" . $row['present'] . "</td>
                    <td>" . $row['absent'] . "</td>
                  </tr>";
        }

        echo "</table>";
    }
    //  else {
    //     echo "0 results";
    // }

    // $conn->close();
    ?>
</div>

</body>
</html>
