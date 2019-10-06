<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
p .signuperror{
    color: red;
}
</style>

<form data-toggle="validator" role="form" action="register_db.php" method="post">
	<body style="background-color:rgb(50,0,255);">
		<div class="container h-100 d-flex d-flex justify-content-center">
			<div class="jumbotron">
			  <h1 class="display-4">Create An Account</h1>
                          <?php
                          if(isset($_GET['error'])){
                              if($_GET['error'] == "emptyfields"){
                                  echo'<p class="signuperror">Fill in all fields!</p>';
                              }
                              else if($_GET['error'] == "invaliduid"){
                                echo'<p class="signuperror">Invalid Username!</p>';
                              }
                              else if($_GET['error'] == "passwordcheck"){
                                echo'<p class="signuperror">Your passwords do not match!</p>';
                              }
                              else if($_GET['error'] == "usertaken"){
                                echo'<p class="signuperror">Username is already taken!</p>';
                              }
                          }             
                          ?>
                          
			  <div class="form-group">
			  <label for="usr">Create Username</label>
                          <input type="text" class="form-control" id="usr" name="uid" placeholder="Username">
			  </div>
			  
			  <div class="form-group">
				<label for="inputPass" class="control-label">Password</label>
				  <div>
                                      <input type="password" data-minlength="6" pattern=".{6,12}" class="form-control" id="inputPass" placeholder="Password" name="pwd" required>
					<div class="help-block"></div><br>
				  </div>
				  <div>
                                      <input type="password" class="form-control" id="inputPassConfirm" data-match="#inputPass" data-match-error="Whoops, these don't match" placeholder="Confirm Password" name="pwd-repeat" required>
					<div class="help-block with-errors"></div>
				  </div>
			  </div>
			  
			  <div class="form-group">
                              <button type="submit" name="signup-submit" class="btn btn-primary">Register</button>
			  </div>
			</div>  
		</div>
	</form>	
	</body>

</html>