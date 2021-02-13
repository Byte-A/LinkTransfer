<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Homepage | Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        } else {
            echo "<center><div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div></center>";
        }
    } else {
?>
<center>
	<div style="background-color:white;width:30%;margin: 60px;padding:20px;display: inline-block;">
	<h1 class="login-title">LinkTransfer</h1>
	<p>Ever browsing on your phone and want to browse it one the computer? Just open our site, upload the URL, go to our site on your computer, then all you have to do to is click the link!</p>
	<p>Developed by <a style="color:black;" href="https://github.com/Byte-A">Byte-A</a></p><br><a href="https://www.buymeacoffee.com/bytea">
	<img src="buymeacoffee.png" style="width:50%"/></a>
	<br><br></div>
    <form class="form" method="post" name="login" style="width:330px;margin: 60px;padding:20px;display: inline-block;">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php">Register Now</a></p>
  </form>
  </center>
<?php
    }
?>
</body>
</html>
