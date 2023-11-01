<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard - View Project Statistics</title>
    <style>
        /* Add any custom styles here */
    </style>
</head>
<body>
    <h1>HR Dashboard</h1>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

h1, h2 {
    color: #333;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    background-color: #333;
    overflow: hidden;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #555;
}

.active {
    background-color: #4CAF50;
}

div {
    padding: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #4CAF50;
    color: white;
}

/* Add any additional styles as needed */

    </style>
    
    <!-- Tabs navigation -->
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="employees.php">Employees</a></li>
        <li><a href="view_project_statistics.php" class="active">View Project Statistics</a></li>
    </ul>

    <!-- Content for "View Project Statistics" tab -->
    <div>
        <h2>View Project Statistics</h2>

        <?php
            Connect to the database
            $servername = "your_server_name";
            $username = "your_username";
            $password = "your_password";
            $dbname = "project_database";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from the "project" table
            $sql = "SELECT * FROM project";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Display data in a table
                echo "<table border='1'>
                        <tr>
                            <th>Project ID</th>
                            <th>Project Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <!-- Add more columns as needed -->
                        </tr>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["project_id"]."</td>
                            <td>".$row["project_name"]."</td>
                            <td>".$row["start_date"]."</td>
                            <td>".$row["end_date"]."</td>
                            <!-- Add more columns as needed -->
                        </tr>";
                }

                echo "</table>";
            } else {
                echo "No projects found.";
            }

            // Close the connection
            $conn->close();
        ?>
    </div>
</body>
</html>
