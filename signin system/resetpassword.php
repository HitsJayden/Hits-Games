<?php

session_start();
include('lib/connection.php');
if(isset($_POST['submit']))
{
	if(isset($_POST['newpassword']) && isset($_POST['confirmpassword']))
	{
		$newpassword=mysqli_escape_string($conn,filter_var(strip_tags($_POST['confirmpassword']),FILTER_SANITIZE_STRIPPED));
		$confirmpassword=mysqli_escape_string($conn,filter_var(strip_tags($_POST['confirmpassword']),FILTER_SANITIZE_STRIPPED));
		$email=$_GET['email'];
		$email=mysqli_escape_string($conn,filter_var(strip_tags($_GET['email']),FILTER_VALIDATE_EMAIL));
		$hash_password = hash('sha256', $newpassword);
		
		$sql="UPDATE users SET Password='$hash_password' WHERE Email='$email'";
		
		$result=mysqli_query($conn,$sql);
		
		if($result)
		{
			$sql="UPDATE users SET Forgot_Password_Active=1 WHERE Email='$email'";
			
			$result=mysqli_query($conn,$sql);
		}
	}
	
}
if(isset($_GET['email']) && isset($_GET['activation_code']))
{
	    $email = mysqli_escape_string($conn,$_GET['email']); // Set email variable
        $activation_code = mysqli_escape_string($conn,$_GET['activation_code']); // Set hash variable
		
		$sql="SELECT * FROM users WHERE Email='$email' AND Password_Code='$activation_code' AND Forgot_Password_Active=0";
		
		$result=mysqli_query($conn,$sql);
		
		if($result)
		{
			echo '<!DOCTYPE html>
                  <html lang="en">
                  <head>
                  <link rel="stylesheet" type="text/css" href="style.css"/>
                  <title>Login System in Php and Mysql</title>
                  </head>
                  <body>
			      <div id="section">
		          <h1>Update Password</h1>
				  <form method="post" action="">
		          <input type="password" placeholder="New Password" name="newpassword"/>
		          <input type="password" placeholder="Confirm Password" name="confirmpassword"/>
		          <button type="submit" name="submit">Change Password</button>
				  </form>
	              </div>';
		}
}
?>