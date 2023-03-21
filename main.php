<?php
    require "header.php";
    require 'includes/dbh.inc.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "style.css">
</head>
<body id = "general">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
    <?php
        date_default_timezone_set('America/New_York');
        $uid = $_SESSION['userUid'];

        $sql = "SELECT * FROM users WHERE uid = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../calendar.php?error=sqlerror"); //might need to change this to index
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $uid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $first = $row['fname'];

                $day_of_week = strtolower(date("l")); //Day of week, which we will use to look through database
                $sql = "SELECT * FROM week WHERE uid = ?;"; //Now we will look for what tasks we have today
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../calendar.php?error=sqlerror"); //might need to change this to index
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "s", $uid);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if($row = mysqli_fetch_assoc($result)){
                        $content = $row[$day_of_week];
                        $date = date("n/d"); //gives month without extra digit
                        $list = explode("~ ", $content);
                        $index = array_search($date, $list);
                        if($list[$index+1] == ""){
                            $date_content = "Nothing for today!";
                        }
                        else{
                            $date_content = $list[$index+1];
                        }
                        
                        
                        echo "<div class = 'hello-name-container'><p class = 'hello-name'>Welcome " . $first . "! Today is " . date("l F j, Y") .". <br><br>These are the tasks you have assigned for today: <br><br>" . $date_content . "</p></div>";
                    }
                }
            }
            else{
                echo "<div class = 'hello-name-container'><p class = 'hello-name'>Uh oh</p></div>";
            }
        }       
    ?>
</body>
</html>
<?php
    require "footer.php";
?>