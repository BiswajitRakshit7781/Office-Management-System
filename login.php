<?php

session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
  $email = $_POST['email'];
  $post = $_POST['post'];
  $pwd = $_POST['password'];

      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "project_database";

      $conn = mysqli_connect($servername, $username, $password, $database);

  if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
  }
  $query = "SELECT * FROM employee WHERE email_id='$email' AND post='$post' AND password='$pwd'";
  $result = $conn->query($query);

  if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $_SESSION['emp_id'] = $row['emp_id']; // Set user ID in session variable
    $_SESSION['emp_name'] = $row['emp_name'];
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
    header('Location: error.html');
  }
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
  <div class="wrapper">
    <form action="login.php" method="post">
      <h1>Login</h1>
      <div class="input-box">
        <input type="email" name="email" placeholder="Email Id" required="">
      </div>
      <select name="post">
        <option value="Employee">Employee</option>
        <option value="HR">HR</option>
        <option value="Manager">Project Manager</option>
      </select>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" required="" ><i class="far fa-eye" id="togglePassword" style="margin-left: -30px; 
cursor: pointer;"></i>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox">Remember Me</label> <a href="home.html"> < Back To Home</a>
      </div><button type="submit" class="btn">Log In</button>
    </form>
  </div>
  <script>const togglePassword = document.querySelector('#togglePassword');
   const password = document.querySelector('#id_password');

   togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
   });
  </script>
</body>
</html>