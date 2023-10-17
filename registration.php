<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $doj = $_POST['doj'];
        
      $servername = "localhost";
      $username = "project_database";
      $password = "";
      $database = "employee";

      $conn = mysqli_connect($servername, $username, $password, $database);

      if (!$conn){
          die("Sorry we failed to connect: ". mysqli_connect_error());
      }
      else{ 
        $sql = "INSERT INTO `contactus` (`name`, `email`, `concern`, `dt`) VALUES ('$name', '$email', '$address','$phone','$doj')";
        $result = mysqli_query($conn, $sql);
 
        if($result){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been submitted successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        }

      }

    }
    ?>
    <div class="wrapper">
        <form action="Project\Office-Management-System\registration.php" method="post">
            <h1>Registration</h1>
            <div class="input-box">
                <div class="input-field">
                    <input type="text" name="name" placeholder="Full Name" required>
                </div>
                <div class="input-field">
                    <input type="email" name="email" placeholder="Email ID" required>
                </div>
                <div class="input-field">
                    <input type="text" name="address" placeholder="Address" required>
                </div>
                <div class="input-field">
                    <input type="number" name="phone" placeholder="Phone Number" required>
                </div>
                <div class="input-field">
                    <input type="date" name="doj" placeholder="Date Of Join" required>
                </div>
                <select name="post">
                    <option value="employee">Employee</option>
                    <option value="hr">HR</option>
                    <option value="manager">Project Manager</option>
                </select>
                <div class="input-field">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
            </div>
            <label><input type="checkbox" required>I hereby declare that the above information provided is true and correct</label>

            <button type="submit" class="btn">Register</button>
            <div class="login">
                <a href="login.html"> < Back </a></div>
              </div>
        </form>
    </div>
</body>
</html>