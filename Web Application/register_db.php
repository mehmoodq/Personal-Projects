<?php

if(isset($_POST['signup-submit'])){
    require 'Db.php';
    $username = filter_input(INPUT_POST, 'uid');
    $password = filter_input(INPUT_POST, 'pwd');
    $confirm = filter_input(INPUT_POST, 'pwd-repeat');
    
    if(empty($username) || empty($password) || empty($confirm)){
        header("Location: register.php?error=emptyfields&uid=".$username);
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: register.php?error=invaliduid");
        exit();
    }
    elseif($password !== $confirm){
        header("Location: register.php?error=passwordcheck&uid=".$username);
        exit();
    }
    else{
        $sql = "SELECT userID FROM login WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: register.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: register.php?error=usertaken");
                exit();
            }
            else{
                $sql = "INSERT INTO login (pass, userID) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: register.php?error=sqlerror");
                    exit();
                }
                else{
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $username);
                    mysqli_stmt_execute($stmt);
                    header("Location: index.php?register=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
}
else{
    header("Location: register.php");
    exit();
}



