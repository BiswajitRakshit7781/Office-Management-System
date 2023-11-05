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