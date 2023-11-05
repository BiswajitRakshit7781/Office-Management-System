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

// Fetch all employee IDs from the 'employee' table
$employeeIds = [];
$sqlEmployeeIds = "SELECT emp_id FROM employee";
$resultEmployeeIds = $conn->query($sqlEmployeeIds);

if ($resultEmployeeIds->num_rows > 0) {
    while ($row = $resultEmployeeIds->fetch_assoc()) {
        $employeeIds[] = $row['emp_id'];
    }
}

// Initialize variables
$selectedEmployeeName = "";
$selectedEmployeeId = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedEmployeeId = $_POST["employee_id"];

    // Fetch corresponding employee name
    $sqlEmployeeName = "SELECT emp_name FROM employee WHERE emp_id = '$selectedEmployeeId'";
    $resultEmployeeName = $conn->query($sqlEmployeeName);

    if ($resultEmployeeName->num_rows > 0) {
        $row = $resultEmployeeName->fetch_assoc();
        $selectedEmployeeName = $row["emp_name"];
    }
}

// Update employee details in the database
if (isset($_POST['update'])) {
    $emailId = $_POST["email_id"];
    $address = $_POST["address"];
    $phoneNo = $_POST["phone_no"];
    $post = $_POST["post"];
    $password = $_POST["password"];
    $basic = $_POST["basic"];

    // SQL query to update employee details
    $sqlUpdateEmployee = "UPDATE employee SET email_id = '$emailId', address = '$address', 
                           phone_no = '$phoneNo', post = '$post', password = '$password', 
                           basic = '$basic' WHERE emp_id = '$selectedEmployeeId'";

    if ($conn->query($sqlUpdateEmployee) === TRUE) {
        echo "<script>alert('Employee details updated successfully');</script>";
    } else {
        echo "Error updating employee details: " . $conn->error;
    }
}
?>
    <?php if ($selectedEmployeeName): ?>
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

<?php
// Close the database connection
$conn->close();
?>

