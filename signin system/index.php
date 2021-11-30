<html>
  <head>
  <title>IT SourceCode</title>
  <link rel="stylesheet" href="libs/css/bootstrap.min.css">
  <link rel="stylesheet" href="libs/style.css">
  </head>
  <h1>User Log In</h1>
<div class="input-field">
        <h3>Please Fill-out All Fields</h3>
        <form method="post" action="#" >
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="user" style="width:20em;" placeholder="Enter your Username" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="pass" style="width:20em;" placeholder="Enter your Password" required />
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary submitBtn" style="width:20em; margin:0;" /><br><br>
            <center>
             <a href="register.php">register</a>
           </center>
          </div>
          
        </form>
      </div>
      </html>
      <?php
      session_start();
      include 'connection.php';
if(isset($_POST['submit'])){
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $query=mysqli_query($db,"SELECT * FROM users WHERE username = '$user' AND password = '$pass'");
  $num_rows=mysqli_num_rows($query);
  $row=mysqli_fetch_array($query);
  $_SESSION["id"]=$row['user_id'];
if ($num_rows>0)
{
    ?>
    <script>
      alert('Successfully Log In');
      document.location='profile.php'
    </script>
    <?php
}
}
      ?>
</html>
