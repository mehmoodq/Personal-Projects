<?php
session_start();
include_once 'Db.php';

$current_date = date("Y/m/d");
$gallons = 0;
$suggested_price = 0.0;
$total = 0.0;

$current_user = $_SESSION['userId'];
$query = "SELECT * FROM clientinfo WHERE userID = '$current_user'";
$result = mysqli_query($conn, $query);
if($result){
    $rows = mysqli_fetch_assoc($result);
    if($rows['address1'] == ''){
        header("Location: profile.php?error=finishprofile");
        exit();
    }
}
else{
    header("Location: profile.php?error=finishprofile");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php
require 'header.php';
?>

<body style="background-color:rgb(50,0,255);">
<form data-toggle="validator" role="form" action="fuelquote_db.php" method="post">
	<div class="container h-100 d-flex d-flex justify-content-center">
		<div class="jumbotron my-auto">
			<h1 class="display-4">Fuel Quote Form</h1>
                        <?php
                        if(isset($_GET['error'])){
                            if($_GET['error'] == "nopastdates"){
                                echo '<p class="text-danger">Cannot deliver to past dates!</p>';
                            }
                        }
                        if(isset($_GET['success'])){
                            if($_GET['success'] == "done"){
                                $gallons = $_GET['gallons'];
                                $current_date = $_GET['deldate'];
                                $suggested_price = $_GET['sugPrice'];
                                $total = $_GET['total'];
                            }
                        }
			?>
			<div class="form-group">
				<label for="gallons" class="control-label">Gallons Requested</label>
				<input type="number" class="form-control" name="gallons" id="gallons" required value="<?php echo $gallons;?>">
				<i class="text-danger"><label>* required</label></i>
			</div>
			
			<div class="form-group">
				<label for="delAddr">Delivery Address</label>
				<input type="text" class="form-control" name="delAddr" id="delAddr" readonly placeholder='<?php echo $rows['address1'].' '.$rows['address2'].' '.$rows['city'].' '.$rows['state'].' '.$rows['zipcode']; ?>'>
			</div>
			
			<div class="form-group">
				<label for="deldate">Delivery Date</label>
                                <input type="date" class="form-control" name="deldate" id="deldate" required value="<?php echo $current_date;?>">
				<i class="text-danger"><label>* required</label></i>
			</div>
			<div class="form-group">
				<label for="sugPrice">Suggested Price</label>
                                <input type="number" class="form-control" name="sugPrice" id="sugPrice" value="<?php echo $suggested_price; ?>" readonly>
                                
			</div>
			
			<div class="form-group">
				<label for="total">Total Amount Due</label>
				<input type="number" class="form-control" name="total" id="total" value="<?php echo $total; ?>" readonly>
			</div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="get-quote">Get Price</button>
			</div>
			
			<div class="form-group">
                            <button type="submit" class="btn btn-primary" name="quote-submit">Submit</button>
			</div>
		</div>
		
	</div>
</form>
</body>
</html>