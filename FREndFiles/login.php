<?php 
	require 'html-builder.php';
<<<<<<< HEAD
	require 'database.php';
	
	// Sign up indicator
	$signup = 1;
=======
	require_once 'db_connect.php';
>>>>>>> 86d317222a8269415be083f7760ba10c0a27552f
	
	//enable sessions
	session_start();
	
<<<<<<< HEAD
	$connection = dbConnect();
	
	// Check if user is signing Up or signing in
	if(isset($_POST["passwordReenter"]) && $_POST["passwordReenter"] != '' ||
		  isset($_POST["name"]) && $_POST["name"] != '' ||
			isset($_POST["email"]) && $_POST["email"] != ''){
		$signup = 0;
	}
=======
	//connect to DB
	$connection= connect_to_db();
>>>>>>> 86d317222a8269415be083f7760ba10c0a27552f
	
	//if username and password were submitted, check them
	if(isset($_POST["username"])&&isset($_POST["password"]) && $signup == 1 ){
		//prepare sql
		$sql=sprintf("SELECT * from users where username='%s' AND password=PASSWORD('%s')",
						$connection->real_escape_string($_POST["username"]),
						$connection->real_escape_string($_POST["password"]));
		
		//execute query
		$result=$connection->query($sql) or die(mysqli_error());
		
		//check whether we found a row
		if($result->num_rows==1){
		
			$row=mysqli_fetch_assoc($result);
			$_SESSION["authenticated"]=true;
			$_SESSION['userName'] = $row['username'];
			$_SESSION['password']=$row['password'];
			$_SESSION['emailID']=$row['email'];
			$_SESSION['typeOfLogin']=$row['normalLogin'];
			
			//reditect user to dashboard, using absolute path
			$host=$_SERVER["HTTP_HOST"];
			$path=rtrim(dirname($SERVER["PHP_SELF"]),"/\\");
			header("Location: ./dashboard.php");
			exit;
		}
		
	}
	elseif (isset($_POST["username"])&&isset($_POST["password"])&&isset($_POST["passwordReenter"])&&isset($_POST["email"])&&isset($_POST["name"])) {
		$username=$_POST["username"];
		if(!($_POST["password"]==$_POST["passwordReenter"]) || $_POST["password"] === ''){
			echo "<script type='text/javascript'> alert(\"Passwords don't match\"); </script>";
		}
		else{
			$password=$_POST["password"];
			$email=$_POST["email"];
			$name=$_POST["name"];
			
			addUser($connection,array('password' => $password,'username' => $username, 'email' => $email, 'name' => $name));
			
			// Check if adding the user was successful by signing them in
			
			// Prep sql
			$sql=sprintf("SELECT * from users where username='%s' AND password=PASSWORD('%s')",
							$connection->real_escape_string($username),
							$connection->real_escape_string($password));
			
			// Query
			$result=$connection->query($sql) or die(mysqli_error());
			
			// Check if a row was returned
			if($result->num_rows==1){
				$_SESSION["authenticated"]=true;
				$row=mysqli_fetch_assoc($result);
				$_SESSION['userName'] = $row['username'];
				$_SESSION['password']=$row['password'];
				$_SESSION['emailID']=$row['email'];
				$_SESSION['typeOfLogin']=$row['normalLogin'];
				//reditect user to dashboard, using absolute path
				$host=$_SERVER["HTTP_HOST"];
				$path=rtrim(dirname($SERVER["PHP_SELF"]),"/\\");
				header("Location: ./dashboard.php");
				exit;
			}
		}
	}
	
?>

<!DOCTYPE html>

<html>

	<head>
		
		 <!-- PHP Header call [Title, Charset, and Icon Link] -->
        <?php insertHeader("Login"); ?>
        
	    <meta name="google-signin-client_id" content="783497289681-md44u43oh563o2jrf0gjsfbtgr6oh2qg.apps.googleusercontent.com">
	    
	    <!-- Bootstrap and font awesome-->
	    <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css">
	    <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<script src="./js/login.js"></script>
		
	</head>

	<body>
	
		<!-- BEGIN NAVBAR -->
	            
        <?php insertNav(); ?>
            
        <!-- END NAVBAR -->
        
        
        <!-- BEGIN MAIN -->
		<div class="container">
			<div class="omb_login">
				<h2 class="omb_authTitle" id="status">Login / <a href="#signup" onclick="showSignUp()">Sign up</a></h2>

				<div class="row omb_row-sm-offset-3 omb_socialButtons">
					<!--remove this for previous look. this is added from FB website -->
					<div class="col-xs-4 col-sm-3">
						<div class="fb-login-button" data-max-rows="1" onlogin="checkLoginState();" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
						<!--<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>-->
					</div>
					<div class="col-xs-4 col-sm-4">
						<div class="g-signin2" data-onsuccess="onSignIn" data-width="200px" data-height="40px" data-longtitle="true"></div>
					</div>
				</div>

				<div class="row omb_row-sm-offset-3 omb_loginOr">
					<div class="col-xs-12 col-sm-6">
						<hr class="omb_hrOr">
						<span class="omb_spanOr">or</span>
					</div>
				</div>

				<div class="row omb_row-sm-offset-3">
					<div class="col-xs-12 col-sm-6">
						<form class="omb_loginForm" action="" onsubmit="return signupValidate(this);" autocomplete="off" method="POST">
							
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user">
									</i>
								</span>
								<input type="text" class="form-control" name="username" id="username" 
								<?php
									if(isset($_POST["username"]))
										echo 'value="' . $_POST["username"] . '"'; 
								?> placeholder="username">
							</div>

							<span class="help-block" id="usernameError">Username error</span>

							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i>
								</span>
								<input type="password" class="form-control" name="password" id="password" placeholder="Password">
							</div>
							
							<span class="help-block" id="passwordError">Password error</span>
							
							<div class="input-group" 
								<?php
									if($signup == 1)
										echo 'style="display:none;"'; 
								?> id="passwordDiv">
								<span class="input-group-addon"><i class="fa fa-lock"></i>
								</span>
								<input type="password" class="form-control" name="passwordReenter" id="passwordReenter" placeholder="Re-enter Password">
							</div>
							
							<span class="help-block" id="passwordReenterError">Password Doesn't Match</span>
							
							<div class="input-group" 	<?php
									if($signup == 1)
										echo 'style="display:none;"'; 
								?> id="nameDiv">
								<span class="input-group-addon"><i class="fa fa-envelope"></i>
								</span>
								<input type="text" class="form-control" name="name" id="name" 
								<?php
									if(isset($_POST["name"]))
										echo 'value="' . $_POST["name"] . '"'; 
								?>
								placeholder="Name">
							</div><br>
							
							<div class="input-group" 	
								<?php
									if($signup == 1)
										echo 'style="display:none;"'; 
								?> id="emailDiv">
								<span class="input-group-addon"><i class="fa fa-envelope"></i>
								</span>
								<input type="text" class="form-control" name="email" id="email" 
								<?php
									if(isset($_POST["email"]))
										echo 'value="' . $_POST["email"] . '"'; 
								?>
								placeholder="email@example.com">
							</div>
							
							<span class="help-block" id="emailError">Email error</span>

							<button class="btn btn-lg btn-primary btn-block" id="login_b" type="submit">
								<?php
								if($signup == 1){
									echo 'Login';
								}
								else{
									echo 'Sign Up';
								}
								?>
								</button>
						</form>
					</div>
				</div>
				<div class="row omb_row-sm-offset-3">
					<div class="col-xs-12 col-sm-3">
						<label class="checkbox">
					<input type="checkbox" value="remember-me">Remember Me
				</label>
					</div>
					<div class="col-xs-12 col-sm-3">
						<p class="omb_forgotPwd">
							<a href="#" id="forgotPass">Forgot password?</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<!-- END MAIN -->
		
		
		<!--- Facebook and Google Login Scripts-->
		<script src="./js/login.js"></script>
	</body>

</html>
