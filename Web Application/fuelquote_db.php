<?php
session_start();
if(isset($_POST['quote-submit'])){
    require 'Db.php';
    $current_user = $_SESSION['userId'];
    
    $query = "SELECT * FROM clientinfo WHERE userID = '$current_user'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_assoc($result);
    
    
    
    $gallons = $_POST['gallons'];
    $address = $rows['address1'].' '.$rows['address2'].' '.$rows['city'].' '.$rows['state'].' '.$rows['zipcode'];
    $deldate = $_POST['deldate'];
    $suggested_price = $_POST['sugPrice'];
    $total = $_POST['total'];
    
    $sql = "INSERT INTO fuelquote (userID, gallons, address, deliverydate, suggestedprice, totalamountdue) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: profile.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "sissii", $current_user, $gallons, $address, $deldate, $suggested_price, $total);
        mysqli_stmt_execute($stmt);
        header("Location: fuelhistory.php?request=success");
        exit();
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else if(isset($_POST['get-quote'])){
    require 'Db.php';
    
    $current_user = $_SESSION['userId'];
    
    $query = "SELECT * FROM clientinfo WHERE userID=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $query)){
        header("Location: fuelquote.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $current_user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if($resultCheck > 0){
            $rate_hist_fact = 0.01;
        }
        else{
            $rate_hist_fact = 0;
        }
    }
    
    $company_profit = 0.1;
    $gallons = $_POST['gallons'];
    $deldate = $_POST['deldate'];
    $date_elements = explode('-', $deldate);
    $month = $date_elements[1];
    $current_date = date("Y-m-d");
    
    if($deldate < $current_date){
        header("Location: fuelquote?error=nopastdates&gallons=".$gallons);
        exit();
    }
    $sql = "SELECT * FROM clientinfo WHERE userID = '$current_user'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    $state = $rows['state'];
    if($state == 'TX'){
        $location = 0.02;
    }
    else{
        $location = 0.04;
    }
    if($gallons > 1000){
        $gall_req_fact = 0.02;
    }
    else{
        $gall_req_fact = 0.03;
    }
    if($month == '06' || $month == '07' || $month == '08'){
        $rate_fluct = 0.04;
    }
    else{
        $rate_fluct = 0.03;
    }
    
    $margin = 1.5 * ($location - $rate_hist_fact + 
            $gall_req_fact + $company_profit + $rate_fluct);
    $suggested_price = 1.5 + $margin;
    $total = $gallons * $suggested_price;
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: fuelquote.php?success=done&gallons=".$gallons."&deldate="
            .$deldate."&sugPrice=".$suggested_price."&total=".$total);
    exit();
}
else{
    header("Location: fuelquote.php");
    exit();
}