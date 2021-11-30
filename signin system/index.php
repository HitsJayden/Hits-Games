<?php
session_start();
$error="";
if(isset($_POST['submit']))
{
include('lib/connection.php');
if(empty($_POST['name']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']))
{
	$error="Please enter all the details first";
}

$name=mysqli_escape_string($conn,filter_var(strip_tags($_POST['name']),FILTER_SANITIZE_STRIPPED));
$username=mysqli_escape_string($conn,filter_var(strip_tags($_POST['username']),FILTER_SANITIZE_STRIPPED));
$password=mysqli_escape_string($conn,filter_var(strip_tags($_POST['password']),FILTER_SANITIZE_STRIPPED));
$email=mysqli_escape_string($conn,filter_var(strip_tags($_POST['email']),FILTER_VALIDATE_EMAIL));


$hash_password = hash('sha256', $password);

$activation_code = hash('sha256',rand(0,1000));

    $sql="SELECT UserName FROM users WHERE UserName='$username'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
		$error="UserName already Exists";
	}
	$sql="SELECT Email FROM users WHERE Email='$email'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
		$error.="And Email already exists";
	}
    if(empty($error))
	{
	$sql="INSERT INTO users (Name,UserName,Email,Activation_Code,Password) VALUES('$name','$username','$email','$activation_code','$hash_password')";
	$result=mysqli_query($conn,$sql);
	if($result)
	{
	$_SESSION['email']=$email;	
	$_SESSION['username']=$username;
	$_SESSION['password']=$password;
	$_SESSION['hash_password']=$hash_password;
	$_SESSION['activation_code']=$activation_code;
	include('activateemail.php');
	$message="Please check your email to activate your account";
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
	<a href="login.php"><button class="loginbutton" type="submit">SignIn</button></a>
	<div id="section">
		<h1>SignUp Form</h1>
		<form method="post" action="index.php">
		<input type="text" name="name" placeholder="name"/>
		<input type="text" name="username" placeholder="username"/>
		<input type="email" name="email" placeholder="email"/>
		<input type="password" name="password" placeholder="password" />
		<button type="submit" name="submit">SignUp</button><br>
		<span class="text"><?php if(isset($message)) {echo $message;}?></span>
		<span class="text"><?php if(isset($error)){ echo $error ;}?></span>
	</div>
</body>
</html>
