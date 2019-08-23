<?php require 'db.php' ;?>	
<?php include 'functions.php' ;?>	
<?php 
	
	
	use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		
		require('PHPMailer/src/Exception.php');
		require('PHPMailer/src/PHPMailer.php');
		require('PHPMailer/src/SMTP.php');
		
	if(isset($_POST['signup']))
	{
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = md5(mysqli_real_escape_string($conn, $_POST['password']));
		
		$signup_posts = array($name, $father, $username, $email, $password);
		
		$postStatus = checkEmpty($signup_posts);
		
		if($postStatus)
		{
			$rand_num = mt_rand();
			$activation_key  = sha1($rand_num.$username.$rand_num);
			$insertUser = mysqli_query($con, "Insert into users 
			(id, name, email, username, password,activationKey) values('', '$name','$email', '$username','$password','$activation_key')");
			
			if($insertUser)
			{
				$subject = 'Verify your Book Store account.';
				$message = "Dear ".$name.", Click below to verify your CVB account.<br><a href='http://localhost/cvb/admin/login.php?u_=".$username."&key=".$activation_key."'>".$activation_key."</a>";
				
				$mail = new PHPMailer();
				
				$mail->SMTPDebug = 0;                                 //0 for false or 2 to Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = "hearthacker.0314@gmail.com";			//	email address
				$mail->Password = "superstar8300";           // SMTP password
				$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				
				$mail->SMTPOptions = array(
					'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true
					)
				);
				
				$mail->Port = 465;                                    // TCP port to connect to

				//Recipients
				$mail->setFrom($email, 'CVB');
				$mail->addAddress($email, 'Local Mailer');     // Add a recipient

				//Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = $subject;
				$mail->Body   = $message;
				//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
				
				if($mailSent = $mail->send())
				{
					echo "<h1 style='color: green;'>Email sent! <br>Check your inbox and verify your Book store account.</h1>";
				}
			}
		}
		else
		{
			echo "<h2>kindly fill out form again</h2>";
		}	
	}else{
?>
<!--End footer-->
<?php include 'header-scripts.php'; ?>
<body>
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

		<form class="details">
				<div class="input-container">
						<input class="col-sm-12 myname text-input with-placeholder" name="name" id="name" type="text" placeholder="Your Name" />
				</div>
				<div class="input-container">
						<input class="col-sm-12 email-input with-placeholder" name="email" id="email" type="email" placeholder="Email" />
				</div>
				<div class="input-container">
						<input class="col-sm-5 username-input with-placeholder" name="username" id="username" type="text" placeholder="Username" maxlength="8" />
				</div>
				<div class="input-container">
						<input class="col-sm-5 col-sm-push-2 password-input with-placeholder" name="password" id="password" type="password" placeholder="Password" />
				</div>

				<input id="sign-up-button" name="signup"type="submit" value="Sign Up">

				<p>Already have an account? <a href="login.php">Sign in</a></p>

		</form>
</div>
		</div>
<?php } ?>
</body>
</html>
