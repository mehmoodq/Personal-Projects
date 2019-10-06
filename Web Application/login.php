<?php

if(isset($_POST['login-submit'])){
    require 'Db.php';
    
    $username = '';
    $password = '';
    
    $username = $_POST['user'];
    $password = $_POST['pass'];
    
    if(empty($username) || empty($password)){
        header("Location index.php?error=emptyfields");
        exit();        
    }
    else{
        $sql = "SELECT * FROM login WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['pass']);
                if($pwdCheck == false){
                    header("Location: index.php?error=wrongpwd");
                    exit();
                }
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION['userId'] = $row['userID'];
                    
                    $sql = "SELECT userID FROM clientinfo WHERE userID=?";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: login.php?error=sqlerror");
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        $resultCheck = mysqli_stmt_num_rows($stmt);
                        if($resultCheck > 0){
                            header("Location: home.php?login=success");
                            exit();
                        }
                        else{
                            header("Location: profile.php?login=success");
                            exit();
                        }
                    }
                }
                else{
                    header("Location: index.php?error=wrongpwd");
                    exit();
                }
            }
            else{
                header("Location: index.php?error=nouser");
                exit();
            }
            
        }
    }
    
}
else{
    header("Location index.php");
    exit();
}