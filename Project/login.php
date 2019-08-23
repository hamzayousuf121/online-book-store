<!--Start header-scripts-->
	<?php 
		session_start(); 
		if(isset($_GET['logout'], $_SESSION['user_id'])){ session_destroy(); }
		if(isset($_SESSION['user_id'])){ header('Location: index.php'); }
	?>
	<?php require 'db.php'; ?>
	<?php include 'functions.php'; ?>
	<?php include 'header-scripts.php'; ?>
	<?php 
		$query = mysqli_query($con,"SELECT status FROM users where id='1'");
		
	?>
<!--End header-scripts-->
<?php
	$verificationMsg = "";
	// Login process
	if(isset($_POST['submit']))
	{
		$emailInp = mysqli_real_escape_string($con, $_POST['email']);
		$passwordInp = mysqli_real_escape_string($con, $_POST['password']);
		$login_params = array($emailInp, $passwordInp);
		$postStatus = checkEmpty($login_params);
		$passwordInp = md5($passwordInp);
		
		if($postStatus)
		{
			$loginUserResult = mysqli_query($con, "Select id, email, password from user where email='$emailInp' AND password='$passwordInp'");
			
			if(mysqli_num_rows($loginUserResult))
			{
				$logedInUserrecord = mysqli_fetch_array($loginUserResult);
				$_SESSION['user_id'] = $logedInUserrecord['id'];
				header('Location: dashboard.php');
			}
			else{ $verificationMsg = "<h1>Your email or password is incorrect! Try again</h1>"; }
		}
		else{ $verificationMsg = "<h1>Please fill all the required fields.</h1>";}
	}
	
	// Verification process
	if(isset($_GET['u_'], $_GET['key']))
	{
		$usernameQueryStr = mysqli_real_escape_string($con, $_GET['u_']);
		$keyQueryStr = mysqli_real_escape_string($con, $_GET['key']);
		$verific_params = array($usernameQueryStr, $keyQueryStr);
		$postStatus = checkEmpty($verific_params);
		
		if($postStatus)
		{
			$user_activResult = mysqli_query($con, "Select username, activationKey from users where username='$usernameQueryStr' and activationKey='$keyQueryStr'");
			$user_activNumRow = mysqli_num_rows($user_activResult);
			
			if($user_activNumRow > 0)
			{
				
					mysqli_query($con, "Update users set activationKey='activated' AND status='1'");
					
					$recordUpdate = mysqli_affected_rows($con);
					
					if($recordUpdate > 0)
					{
						$verificationMsg = "<h1>Registration successfull!</h1>"; 
					}
					else{ $verificationMsg = "<h1>Registration faild!</h1>"; }
			}
			else
			{
				header('Location: login.php?errmsg=fail');
			}
		}
	}
	// Verification end
?>
		<center><?php 
			echo $verificationMsg; 
			if(isset($_GET['errmsg']))
			{
				echo "<h1>Try again!</h1>";
			}
		?></center>
<!--Login-->
<br>
<br>
<div class="sign-up-modal">
		<div class="logo-container">
				<svg class="logo" width="94.4px" height="56px">
						<g>
								<polygon points="49.3,56 49.3,0 0,28 	" />
								<path d="M53.7,3.6v46.3l40.7-23.2L53.7,3.6z M57.7,10.6l28.4,16.2L57.7,42.9V10.6z" />
						</g>
				</svg>
		</div>

		<form class="details" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<div class="input-container">
						<input name="email" class="col-sm-12 myname text-input with-placeholder" id="email" type="email" placeholder="Your email" />
				</div>
				<div class="input-container">
						<input password="password" class="col-sm-12 email-input with-placeholder" id="password" type="password" placeholder="password" />
				</div>
				<input id="sign-up-button" type="submit" value="Log in">
				<?php while($statusCheck = mysqli_fetch_array($query)){ 
					if($statusCheck['status'] == 0){?>
					<a href="signup.php" title="Registration">
						<button type="button" class="btn btn-primary waves-effect waves-light m-1">Register</button>
					</a>
					<?php } 
				}
				?>
	</form>
</div>
</div>
</body>
</html>