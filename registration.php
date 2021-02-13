<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    // When form submitted, insert values into the database.
	
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
		$connec = new mysqli("localhost","root","","loginsystem");
		$sql="SELECT * FROM users WHERE username='$username' LIMIT 1";
		$result1 = mysqli_query($connec,$sql);
		$user = mysqli_fetch_assoc($result1);
       
	   if ($result1) {
			  if ($user) { // if user exists
				if ($user['username'] === $username) {
					echo "<center><div class='form'>
							<h3>Username Taken</h3><br/>
							<p class='link'>Choose another username</p>
							</div></center>";
			  }
			  }
			else{
							echo "<center><div class='form'>
							<h3>You are registered successfully.</h3><br/>
							<p class='link'>Click here to <a href='login.php'>Login</a></p>
			</div></center>";
			        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
					$result   = mysqli_query($con, $query);}
			}else {
						echo "<center><div class='form'>
						<h3>Required fields are missing.</h3><br/>
						<p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
						</div></center>";
					}
			

	   } else {
?>
	<center>
    <form class="form" action="" method="post" style="width:330px;margin: 50 60px;padding:20px;">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
	</center>
<?php
	}
?>
</body>
</html>