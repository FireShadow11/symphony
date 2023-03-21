<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
  </head>
  <body id = "login">
    <div class="login-box">
      <h1 id = "login-heading">Login</h1>
      <form action = includes/login.inc.php method = "post" class = "form1"> <!-- we need includes/login.inc.php here but lets wait-->
        <label>Email</label>
        <input class = "login-input" type="text" name = "mailuid" placeholder="Username/Email..." />
        <label>Password</label>
        <input class = "login-input" type="password" name = "password" placeholder="Password..." />
        <button type="submit" class = "button" name = "login-submit">Login</button>
      </form>
    </div>
    <p class="para-2">
      Not have an account? <a href="signup.php">Sign Up Here</a>
    </p>
  </body>
</html>

