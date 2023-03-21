<?php

if(isset($_POST['login-submit'])){
    require 'dbh.inc.php';

    $uid = $_POST['mailuid'];
    $pass = $_POST['password'];

    if(empty($uid) || empty($pass)){
        header("Location: ../login.php?error=emptyfield&mailuid=" . $uid . "&password=" . $pass);
        exit();
    }
    else{
        $sql = "SELECT * FROM users WHERE uid= ? or email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../login.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($pass, $row['pwd']);
                if($pwdCheck == FALSE){
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                }
                else if($pwdCheck == TRUE){
                    session_start();
                    $_SESSION['userId'] = $row['idUser'];
                    $_SESSION['userUid'] = $row['uid'];

                    header("Location: ../login.php?login=success");
                    header("Location: ../main.php");
                    exit();
                }
                else{
                    header("Location: ../login.php?error=pwdcheckerror");
                    exit();
                }
            }
            else{
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }
}
else{
    header("Location: ../login.php");
    exit();
}
