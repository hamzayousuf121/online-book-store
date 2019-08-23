<!--Start header-scripts-->
	<?php //include 'header-scripts.php'; ?>
	<?php include 'db.php';?>
	<?php include 'functions.php'; ?>
	
<!--End header-scripts-->
<!--<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">-->
<?php
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		
		require('PHPMailer/src/Exception.php');
		require('PHPMailer/src/PHPMailer.php');
		require('PHPMailer/src/SMTP.php');
		
	//$countries_result = mysqli_query($conn, "Select * from countries");
	
	if(isset($_POST['submit']))
	{
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		//$father = mysqli_real_escape_string($conn, $_POST['father']);
		//$gender = mysqli_real_escape_string($conn, $_POST['gender']);
		//$dob = mysqli_real_escape_string($conn, $_POST['dob']);
		//$username = mysqli_real_escape_string($conn, $_POST['username']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = md5(mysqli_real_escape_string($conn, $_POST['password']));
		//$country = mysqli_real_escape_string($conn, $_POST['country']);
		
		$signup_posts = array($name, $father, $username, $email, $password);
		
		$postStatus = checkEmpty($signup_posts);
		
		if($postStatus)
		{
			$rand_num = mt_rand();
			$activation_key  = sha1($rand_num.$username.$rand_num);
			$insertUser = mysqli_query($conn, "Insert into user 
			(id, name, father, user_name, dob, gender, password, email, country_id, activation_key) values('', '$name', '$father', '$username', '$dob', '$gender', '$password', '$email', '$country', '$activation_key')");
			
			if($insertUser)
			{
				$subject = 'Verify your CVB account.';
				$message = "Dear ".$name.", Click below to verify your CVB account.<br><a href='http://localhost/cvb/admin/login.php?u_=".$username."&key=".$activation_key."'>".$activation_key."</a>";
				
				$mail = new PHPMailer();
				
				$mail->SMTPDebug = 0;                                 //0 for false or 2 to Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'bleechgai@gmail.com';                 // SMTP username
				$mail->Password = '125619125';                           // SMTP password
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
					echo "<h1 style='color: green;'>Email sent! <br>Check your inbox and verify your email.</h1>";
				}
			}
		}
		else
		{
			echo "It's empty! Try again.";
		}	
	}else{
?>
  <!--Signup-->
<div id="signup-wrapper">
<form name="signup-form" id="signup-form" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
<div class="row">
	<div class="col-lg-6">
		<div class="form-group">
			<div class="card">
			 <div class="card-header text-uppercase">Name</div>
			  <div class="card-body">
				<input name="name" type="text" class="form-control" placeholder="Your name">
			  </div>
			</div>
		</div>
		<div class="form-group">
			<div class="card">
			 <div class="card-header text-uppercase">Father</div>
			  <div class="card-body">
				<input name="father" type="text" class="form-control" placeholder="Your father's name">
			  </div>
			</div>
		</div>
		<div class="form-group">
			<div class="card">
			 <div class="card-header text-uppercase">Gender</div>
			  <div class="card-body">
				<select name="gender" class="form-control">
				  <option value="1">Male</option>
				  <option value="2">Female</option>
				</select>
			  </div>
			</div>
		</div>
		<div class="form-group">
			<div class="card">
			 <div class="card-header text-uppercase">Username</div>
			  <div class="card-body">
				<input name="username" type="text" class="form-control" placeholder="Choose a username">
			  </div>
			</div>
		</div>
		<div class="form-group">
			<div class="card">
			 <div class="card-header text-uppercase">Email</div>
			  <div class="card-body">
				<input name="email" type="email" class="form-control" placeholder="Enter Email Address">
			  </div>
			</div>
		</div>
		<div class="form-group">
			<div class="card">
			 <div class="card-header text-uppercase">Password</div>
			  <div class="card-body">
				<input name="password" type="password" class="form-control" placeholder="min 8-20 character">
			  </div>
			</div>
		</div>
		<div class="form-group">
			<div class="card">
			 <div class="card-header text-uppercase">Date of birth</div>
			  <div class="card-body">
				<input name="dob" id="dob" type="text" class="form-control">
			  </div>
			</div>
		</div>
		<div class="form-group">
			<div class="card">
			 <div class="card-header text-uppercase">Country</div>
			  <div class="card-body">
				<select name="country" class="form-control">
				<?php while($country = mysqli_fetch_array($countries_result)){ 
					if($country['id']==167){
				?>
				  <option selected value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
				<?php }else{ ?> 
				  <option value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
				<?php } } ?>
				</select>
			  </div>
			</div>
		</div>
		<div class="form-group">
            <button name="signup" id="signup" type="submit" class="btn btn-light px-5"><i class="icon-lock"></i> Register</button>
		</div>
	</div>
</div>
</form>
</div>
<?php } ?>
  <!--Signup end-->
<script>
  $(function(){
    $("#dob" ).datepicker({
		dateFormat: "yy-mm-dd"
	});
  }); 
</script>
<!--Start footer-->
	<?php include 'footer.php'; ?>
<!--End footer-->