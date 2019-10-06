<?php
session_start();
if(isset($_POST['profile-submit'])){
    require 'Db.php';
    
    $username = $_SESSION['userId'];
    
    $full_name = $_POST['name'];
    $address1 = $_POST['addr1'];
    $address2 = $_POST['addr2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zipcode'];
    $zip_length = strlen((string)$zip);
    
    if(empty($full_name) || empty($address1) || empty($city) || empty($state) || empty($zip)){
        header("Location: profile.php?error=emptyfields&name=".$full_name."&addr1=".$address1."&city=".$city."&state=".$state."&zipcode=".$zip);
        exit();
    }
    else if(preg_match("/^[0-9]*$/", $full_name)){
        header("Location: profile.php?error=nonumbersinname&addr1=".$address1."&city=".$city."&state=".$state."&zipcode=".$zip);
        exit();
    }
    else if($zip_length < 5){
        header("Location: profile.php?error=zipcodetooshort&name=".$full_name."&addr1=".$address1."&city=".$city."&state=".$state."&zipcode=".$zip);
        exit();
    }
    else if($zip_length > 9){
        header("Location: profile.php?error=zipcodetoolong&name=".$full_name."&addr1=".$address1."&city=".$city."&state=".$state."&zipcode=".$zip);
        exit();
    }
    else{
        $sql = "INSERT INTO clientinfo (userID, fullname, address1, address2, city, state, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: profile.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ssssssi", $username, $full_name, $address1, $address2, $city, $state, $zip);
            mysqli_stmt_execute($stmt);
            header("Location: home.php?signup=success");
            exit();
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: profile.php");
    exit();
}


