<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="{{ url_for('static', filename='style.css')}}">
    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
  </head>
  <body id = "login">
    <div class="signup-box">
        <h1>Sign Up</h1>
        
        <?php
            if(isset($_GET['error'])){
                if($_GET['error'] == "emptyfield"){
                    echo '<p id = "signuperror">Fill in all fields!</p>';
                }
            }
        ?>
        
      <h4>Your journey starts here!</h4>
      <form action = includes/signup.inc.php method = "post" class = "form1"> 
        <label>First Name</label>
        <input class = "login-input" type="text" name = "first" placeholder="First Name..." />
        <label>Last Name</label>
        <input class = "login-input" type="text" name = "last" placeholder="Last Name..." />
        <label>Email</label>
        <input class = "login-input" type="text" name = "mail" placeholder="Enter your email..." />
        <label>Username</label>
        <input class = "login-input" type="text" name = "uid" placeholder="Enter your new Username..." />
        <label>Password</label>
        <input class = "login-input" type="password" name = "pass" placeholder="Enter your new Password..." />
        <label>Confirm Password</label>
        <input class = "login-input" type="password" name = "pass-repeat" placeholder="Enter your Password again..." />
        <button type="submit" class = "button" name = "signup-submit">Sign Up!</button>
      </form>
    </div>
    <p class="para-1">
      Already have an account? <a href="login.php">Login here</a>
    </p>
  </body>
</html>
