<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Log In</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="wrapper">
    <form action="adminconn.php" method="post">
      <h1>Admin Login</h1>
      <div class="input-box">
        <input type="email" name="email" placeholder="Email Id" required>  
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" required>  
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox">Remember Me</label>
        <a href="#">Forgot Password</a>
      </div>
      <button type="submit" class="btn">Log In</button>
      <div class="home">
        <a href="home.html"> < Back To Home </a></div>
      </div>
    </form>
</body>
</html>