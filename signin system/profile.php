<?php
session_start();
include('lib/connection.php');

$username=$_SESSION['username'];

$sql="SELECT * FROM users WHERE Username='$username'";

$result=mysqli_query($conn,$sql) or die("Your query is not correct");

$row=mysqli_fetch_array($result);


?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="signin system/style.css"/>
<title>Login System in Php and Mysql</title>
</head>
<body>
	<a href="signin system/logout.php"><button class="loginbutton" type="submit">Logout</button></a>
	<div id="section">
		<h1>Profile Details</h1>
		<input type="text" readonly value="<?php echo $row['Name'];?>"/>
		<input type="text" readonly name="username" value="<?php echo $row['UserName'];?>"/>
		<input type="email" readonly name="email" value="<?php echo $row['Email'];?>"/>
		<a href="signin system/changepassword.php"><button type="submit">Change Password</button></a>
		<a href="signin system/deleteaccount.php"><button type="submit">Delete Account</button></a>
	</div>
</body>
	</html>
