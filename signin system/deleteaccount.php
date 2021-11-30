<?php

session_start();

include('lib/connection.php');

$username=$_SESSION['username'];


$sql="DELETE FROM users WHERE UserName='$username'";

$result=mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html>
<head>
<title>Delete Account</title>
<link rel="stylesheet" type="text/css" href="signin server/style.css"/>
<body>
	<div class="verification">
		<?php if($result){
			
			echo "Your account has been deleted successfully";
			
		}  ?>
	</div>
</body>
</head>
</html>