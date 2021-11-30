<?php
if(isset($_POST['submit']))
{
session_start();	
include('lib/connection.php');
include('function.php');


$success="";
$error="";

if(empty($_POST['username']) || empty($_POST['password']))
{
	$error="Please enter all the details first";
}
else{
$username=$_POST['username'];
$password=$_POST['password'];	
$username=mysqli_escape_string($conn,filter_var(strip_tags($username),FILTER_SANITIZE_STRIPPED));
$password=mysqli_escape_string($conn,filter_var(strip_tags($password),FILTER_SANITIZE_STRIPPED));

$hash_password = hash('sha256', $password);

$sql="SELECT * FROM users WHERE UserName='$username' AND Password='$hash_password'";

$result=mysqli_query($conn,$sql) or die("Your query is not right");

$row=mysqli_fetch_array($result);

$count=mysqli_num_rows($result);

if($count==1)
{
	if($row['Active']==0)
	{
		$error = "Please activate your Account first";
	}
	else{
		$_SESSION['username']=$username;
			if(isset($_POST["rememberme"])) {
				setcookie ("username",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
				header('Location:profile.php');
			} else {
				header('Location:profile.php');
				if(isset($_COOKIE["username"])) {
					setcookie ("username","");}
				if(isset($_COOKIE["password"])) {
					setcookie ("password","");}
			}
	}
}
if($count==0)
{
	$error = "You have entered wrong username and password";
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
	<a href="signing system/index.php"><button class="loginbutton" type="submit">SignUp</button></a>
	<div id="section">
		<h1>SignIn Form</h1>
		<form method="post" action="signin system/login.php">
		<input type="text" name="username" value="<?php if(isset($_COOKIE['username'])) {echo $_COOKIE['username'];}?>" placeholder="username"/>
		<input type="password" name="password" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];}?>" placeholder="password" />
		<input type="checkbox" name="rememberme">
		<span class="checkboxtext">Remember me</span><br>
		<button type="submit" name="submit">SignIn</button>
		<a style="display:block;color:white;margin-top:10px;" href="forgotpassword.php">Forgot Password</a>
		<span style="color:white;position:relative;top:20px;"><?php if(isset($error))
		{
			echo $error;
		}
		?>
		</span>
	</div>
</body>
</html>