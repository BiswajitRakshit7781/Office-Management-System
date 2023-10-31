<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $email = $_POST['email'];
  $post = $_POST['dropdown'];
  $password = $_POST['password'];

  $host = "localhost";
  $dbusername = "root";
  $dbname = "project_database";
  $dbpasword = " ";

  $conn = new mysqli($host,$dbusername,$dbname,$dbpasword);

  if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
  }

  $query = "SELECT *FROM employee WHERE email_id='$email' AND post='$post' AND password='$password'";
  $result = $conn->query($query);

  if($result->num_rows == 1){
    header("Location: emp.html");
    exit();
  }
  else{
    echo "<script>alert('Invalid Email or Password')</script>";
    exit();
  }
  $conn->close();
}
?>