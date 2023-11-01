<?php
// Assuming you have a connection to the database
// $servername = "your_server_name";
// $username = "your_username";
// $password = "your_password";
// $dbname = "project_database";

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Process form submission
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Assuming you have form fields for employee ID and attendance date
//     $employee_id = $_POST["employee_id"];
//     $attendance_date = $_POST["attendance_date"];

//     // Insert data into the attendance table
//     $sql = "INSERT INTO attendance (employee_id, attendance_date) VALUES ('$employee_id', '$attendance_date')";

//     if ($conn->query($sql) === TRUE) {
//         echo "Attendance recorded successfully";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }

// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Attendance</title>
    <style>
        body {
    font-family: Arial, sans-serif;
}

h2 {
    color: #333;
}

form {
    max-width: 400px;
    margin: 20px auto;
}

input {
    width: 100%;
    padding: 8px;
    margin: 5px 0;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Add more styles as needed */

    </style>
</head>
<body>
    <h2>Assign Attendance</h2>
    
    <!-- Assuming you have a form to input employee ID and attendance date -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Employee ID: <input type="text" name="employee_id" required><br>
        Attendance Date: <input type="date" name="attendance_date" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
