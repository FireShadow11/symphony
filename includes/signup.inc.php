<?php
if(isset($_POST['signup-submit'])){

    require 'dbh.inc.php';

    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['mail'];
    $username = $_POST['uid'];
    $password = $_POST['pass'];
    $passwordRepeat = $_POST['pass-repeat'];

    if(empty($first) || empty($last) || empty($email) || empty($username) || empty($password) || empty($passwordRepeat)){
        header("Location: ../signup.php?error=emptyfield&first=" . $first . "&last=" . $last . "&mail=" . $email . "&uid=" . $username . "&pass=" . $password . "&pass-repeat=" . $password);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup.php?error=invalidmail&uid&first=" . $first . "&last=" . $last);
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidmail&uid=" . $username . "&first=" . $first . "&last=" . $last);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup.php?error=invaliduid&mail=" . $email . "&first=" . $first . "&last=" . $last);
        exit();
    }
    else if(!($password == $passwordRepeat)){
        header("Location: ../signup.php?error=passwordcheck&first=" . $first . "&last=" . $last . "&mail=" . $email . "&uid=" . $username);
        exit();
    }
    else{
        $sql = "SELECT uid FROM users WHERE uid=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=sqlerror"); //might need to change this to index
            exit();
        }
        else{

            mysqli_stmt_bind_param($stmt, "s", $username);

            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt); 
            if($resultCheck > 0){
                header("Location: ../signup.php?error=usertaken&mail=" . $email . "&first=" . $first . "&last=" . $last);
                exit();
            }
            else{
                $sql = "INSERT INTO users (fname, lname, email, uid, pwd) VALUES(?, ?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else{
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $username, $hashedPwd);
                    mysqli_stmt_execute($stmt);

                    $sql = "INSERT INTO week (uid) VALUES (?);";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($stmt, "s", $username);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../signup.php?signup=success");
                        exit();
                    }
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else{
    header("Location: ../signup.php");
    exit();
}