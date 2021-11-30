<?php

session_start();
$success="";
$error="";
if(isset($_POST['submit']))
{
	if(isset($_POST['email']))
	{
		include('lib/connection.php');
		$email=mysqli_escape_string($conn,filter_var(strip_tags($_POST['email']),FILTER_VALIDATE_EMAIL));
		$sql="SELECT Email FROM users WHERE Email='$email'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)==0)
		{
			$error="This email address doesn't exists";
		}
		else{
		$code=rand(999,999999);
		$password_code=$email . $code;
		$hash_password = hash('sha256', $password_code);
		
		require 'scripts/PHPMailerAutoload.php';

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = '';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';                 // SMTP username
        $mail->Password = '';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        $to=$email;
        $mail->setFrom('', 'Mailer');
        $mail->addAddress($to);     // Add a recipient

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'New Password for Your Account';
		$mail->Body = "
		
		<br><br><br><br>
		This is the New Password for you Log in with that and change it any time.<br><br><br><br>
		$password_code<br><br><br><br>
		
		Please click this link to Login into your Account ------------------<br><br><br><br>
		
		<a href='http://localhost/UserLogin/login.php'>Click here to Log in to your Account</a>";

		if($mail->send())
		{
			$sql="UPDATE users SET Password='$hash_password' WHERE Email='$email'";
			$result=mysqli_query($conn,$sql);
			$success="We have sent Password to your email";
		}
		}
	}
}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="signin system/style.css"/>
<title>Login System in Php and Mysql</title>
</head>
<body>
	<a href="signin system/login.php"><button class="loginbutton" type="submit">SignIn</button></a>
	<div id="section">
		<form action="" method="post">
		<h1>Forgot Password</h1>
		<form method="post" action="index.php">
		<input type="email" name="email" placeholder="email"/>
		<button type="submit" name="submit">Submit</button><br><br><br><br>
		<span style="color:white;"><?php if(isset($success)){ echo $success;}?></span>
		<span style="color:white;"><?php if(isset($error)){ echo $error;}?></span>
		</form>
	</div>
</body>
	</html>
