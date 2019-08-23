<?php require 'db.php'; ?>
<?php

		//$user_data_sql = "SELECT email from user where id='$user_id'";
		//$user_data_result = mysqli_query($conn, $user_data_sql);
		//$user_row = mysqli_fetch_array($user_data_result);
	
		//$profile_user_email = $user_row['email'];
		
		/*$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];*/
		
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		
		require('PHPMailer/src/Exception.php');
		require('PHPMailer/src/PHPMailer.php');
		require('PHPMailer/src/SMTP.php');
		
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
		$mail->setFrom($email, $name);
		$mail->addAddress($profile_user_email, 'Local Mailer');     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body   = 'Email: '.$email.'<br>'.$message;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
		//Send mail
		
		//$mailSent = $mail->send();
		
		$mail->send();
?>