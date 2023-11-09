<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST["project_id"];
    $status = $_POST["status"];
    $progression = $_POST["progression"] ;

    // SQL query to update project status and progression
    $sqlUpdateProject = "UPDATE project SET status = '$status', progression = '$progression' WHERE project_id = '$project_id'";

    if ($conn->query($sqlUpdateProject) === TRUE) {
        // Display a success message
        echo "Project statistics updated successfully";
    } else {
        echo "Error updating project statistics: " . $conn->error;
    }
} 

?>