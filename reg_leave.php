<?php
// Assuming you have a database connection established
// $servername = "localhost";
// $username = "username";
// $password = "password";
// $dbname = "project_database";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Assuming you have form fields named employee_id and leave_days
//     $employee_id = $_POST["employee_id"];
//     $leave_days = $_POST["leave_days"];

//     // Insert data into the leave table
//     $sql = "INSERT INTO leave (employee_id, leave_days) VALUES ('$employee_id', '$leave_days')";

//     if ($conn->query($sql) === TRUE) {
//         echo "Leave assigned successfully";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }

// // Close the database connection
// $conn->close();
?>

<!-- HTML part for the tab -->
<!DOCTYPE html>
<html>
<head>
    <title>HR Dashboard - Assign Attendance</title>
</head>
<body>
    <h2> Leave days</h2>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 20px;
}

h2 {
    color: #333;
}

form {
    max-width: 400px;
    margin: 20px 0;
    padding: 15px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
    color: #555;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}


    </style>
    <form method="post" action="">
        <label for="employee_id">Employee ID:</label>
        <input type="text" name="employee_id" required><br>

        <label for="leave_days">Leave Days:</label>
        <input type="number" name="leave_days" required><br>

        <input type="submit" value="Assign Attendance">
    </form>
</body>
</html>
