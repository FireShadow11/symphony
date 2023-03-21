<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Music Shuffle</title>

        <link rel = "stylesheet" type = "text/css" href = "style.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
        <script src = "function.js"></script>
    </head>
    <body id = "index">
        <div class = "polygon">
            <img src="routine.jpg" class = "background-image">
        </div>
        
        <div class = "hero-content">
            <div class = "hero-text">
                <p id = "welcome">Keep it all in one place!</p>
                <br>
                <p id = "intro">Being organized is hard, so we're here to help! A personal calendar, a to-do list, and much more to keep your routine clean! </p>
            </div>
            <div id = "login-button">
                <a href = "login.php" id = "bt1">Login</a>
                <a href = "signup.php" id = "bt1">Sign Up Today!</a>
            </div>
        </div>
    </body>
    <p >
</html>