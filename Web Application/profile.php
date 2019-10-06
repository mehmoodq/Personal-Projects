<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php
require 'header.php';
?>

<body style="background-color:rgb(50,0,255);">
    
    <form data-toggle="validator" role="form" action="profile_db.php" method="post">
	<div class="container h-100 d-flex d-flex justify-content-center">
		<div class="jumbotron my-auto">
			<h1 class="display-4">Profile Management</h1>
                        <?php
                        if(isset($_GET['error'])){
                            if($_GET['error'] == "zipcodetooshort"){
                                echo '<p class="text-danger">Zipcode should be at least 5 characters long!</p>';
                            }
                            else if($_GET['error'] == "zipcodetoolong"){
                                echo '<p class="text-danger">Zipcode should be no more than 9 characters long!</p>';
                            }
                            else if($_GET['error'] == "finishprofile"){
                                echo '<p class="text-danger">Finish Profile!</p>';
                            }
                        }
                        else if(isset($_GET['login'])){
                            echo '<p class="text-success">Log in Successful!</p>';
                        }
                        ?>
			<div class="form-group">
				<label for="name" class="control-label">Full Name</label>
				<input type="text" class="form-control" name="name" id="name" maxlength="50" placeholder="Full name" required>
				<i class="text-danger"><label>* required</label></i>
			</div>
			<div class="form-group">
				<label for="addr1" class="control-label">Address 1</label>
				<input type="text" class="form-control" name="addr1" id="addr1" maxlength="100" placeholder="Address" required>
				<i class="text-danger"><label>* required</label></i>
			</div>
			<div class="form-group">
				<label for="addr2">Address 2</label>
				<input type="text" class="form-control" name="addr2" id="addr2" maxlength="100">
				<i class="text-secondary"><label>optional</label></i>
			</div>
			<div class="form-group">
				<label for="city">City</label>
				<input type="text" class="form-control" name="city" id="city" maxlength="100" placeholder="City" required>
				<i class="text-danger"><label>* required</label></i>
			</div>
			<div class="form-group">
				<label for="state">State</label>
				<div>
					<select class="form-control" id="state" name="state" required>
						<option value="">N/A</option>
						<option value="AK">Alaska</option>
						<option value="AL">Alabama</option>
						<option value="AR">Arkansas</option>
						<option value="AZ">Arizona</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DC">District of Columbia</option>
						<option value="DE">Delaware</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="IA">Iowa</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="MA">Massachusetts</option>
						<option value="MD">Maryland</option>
						<option value="ME">Maine</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MO">Missouri</option>
						<option value="MS">Mississippi</option>
						<option value="MT">Montana</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="NE">Nebraska</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NV">Nevada</option>
						<option value="NY">New York</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="PR">Puerto Rico</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VA">Virginia</option>
						<option value="VT">Vermont</option>
						<option value="WA">Washington</option>
						<option value="WI">Wisconsin</option>
						<option value="WV">West Virginia</option>
						<option value="WY">Wyoming</option>
					</select>
				</div>
				<i class="text-danger"><label>* required</label></i>
			</div>
			<div class="form-group">
				<label for="zipcode">Zipcode</label>
				<input type="number" class="form-control" name="zipcode" id="usr" maxlength="9" placeholder="Zipcode" required>
				<i class="text-danger"><label>* at least 5 characters required</label></i>
			</div>
				
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="profile-submit">Enter</button>
			</div>
		
		
		</div>
	</div>
</form>
</body>
</html>