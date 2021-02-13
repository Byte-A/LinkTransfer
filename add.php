<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC"); // using mysqli_query instead
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Links</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<center>
    <div class="form" style="width:50%px;width:330px;padding:20px;margin:60px">
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$age = mysqli_real_escape_string($mysqli, $_POST['age']);
		
	// checking empty fields
	if(empty($name) || empty($age)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Link field is empty.</font><br/>";
		}
		
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO users(name,age) VALUES('$name','$age')");
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='dashboard.php'>View Result</a>";
	}
}
?>
    </div>
	</center>
</body>
</html>
