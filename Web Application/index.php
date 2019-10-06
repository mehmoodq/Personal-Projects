<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
html, body {
    height: 100%;
}
</style>

<body style="background-color:rgb(50,0,255);">
    <form data-toggle="validator" role="form" action="login.php" method="post">
	<div class="container h-100 d-flex d-flex justify-content-center">
	  <div class="jumbotron my-auto">
              <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == "nouser"){
                        echo '<p class="text-danger">User does not exist!</p>';
                    }
                    else if($_GET['error'] == "emptyfields"){
                        echo '<p class="text-danger">Write in required fields!</p>';
                    }
                    else if($_GET['error'] == "wrongpwd"){
                        echo '<p class="text-danger">Wrong password!</p>';
                    }
                }
                else if(isset($_GET['register'])){
                    if($_GET['register'] == 'success'){
                        echo '<p class="text-success">Created Account!</p>';
                    }
                }
              ?>
		<h1 class="display-4">Log in</h1>
			<div class="form-group">
				<label for="user">Username</label>
                                <input type="text" class="form-control" name="user" placeholder="Username" required>
			</div>
				  
			<div class="form-group">
				<label for="pass">Password</label>
                                <input type="password" class="form-control" name="pass" placeholder="Password"  required>
			</div>
			
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="login-submit">Log in</button>
                        </div>
                        <a class="btn btn-primary btn-lg" href="register.php">Register</a>
		</div>
	</div>
			
    </form>		
</body>
</html>
