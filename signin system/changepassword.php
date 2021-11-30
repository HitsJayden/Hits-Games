<?php
session_start();
$error="";
if(isset($_POST['submit']))
{
include('lib/connection.php');

if($_POST['newpassword']==$_POST['confirmpassword'])
{

$username=$_SESSION['username'];

$confirmpassword=mysqli_escape_string($conn,filter_var(strip_tags($_POST['confirmpassword']),FILTER_SANITIZE_STRIPPED));


$hash_password = hash('sha256', $confirmpassword);

$sql="UPDATE users SET Password='$hash_password' WHERE Username='$username'";

$result=mysqli_query($conn,$sql);


}
else{
	$error = "The Passwords doesn't match each other";
}
}
?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="signin system/style.css"/>
<title>Login System in Php and Mysql</title>
</head>
<body>
	<?php if(isset($result))
	{
		echo '<div class="verification">Your Password has been changed successfully</div>';
		die();
	}
	?>
	<a href="signin system/logout.php"><button class="loginbutton" type="submit">Logout</button></a>
	<div id="section">
		<form method="post" action="">
		<h1>Edit Password</h1>
		<input type="password" name="newpassword" placeholder="newpassword"/>
		<input type="password" name="confirmpassword" placeholder="confirmpassword"/>
		<a href="signin system/changepassword.php"><button type="submit" name="submit">Change Password</button></a><br><br><br><br>
		<span style="color:white;"><?php if(isset($error)){echo $error;}?></span>
		</form>
	</div>
</body>
</html>