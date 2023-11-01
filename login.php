<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $email = $_POST['email'];
  $post = $_POST['post'];
  $password = $_POST['password'];

      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "project_database";

      $conn = mysqli_connect($servername, $username, $password, $database);

  if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
  }

  $query = "SELECT * FROM employee WHERE email_id='$email' AND post='$post' AND password='$password'";
  $result = $conn->query($query);

  if($result->num_rows == 1){
    switch ($post) {
      case 'HR':
          header('Location: hr_dashboard.php');
          break;
      case 'Manager':
          header('Location: manager_dashboard.php');
          break;
      case 'Employee':
          header('Location: employee_dashboard.php');
          break;
      }
  }
  else{
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>ERROR ⚠️</strong> Check Your Login Credentials !!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    // header('Location: login.html');
  }
  $conn->close();
}
?>