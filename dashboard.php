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
    <div class="form" style="width:50%px;">
        <p>Hey, <?php echo $_SESSION['username']; ?>! Just a side-note here, just as a common courtesy, please delete all links once your done. We need to keep this space neat!</p>
        
        <p><a href="add.html" style="color:black;">Add New Link</a>&nbsp;&nbsp;&nbsp;<a href="logout.php" style="color:black;">Logout</a></p>
		

	<table width='80%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td>Name</td>
		<td>Link</td>
		<td>Options</td>
	</tr>
	<?php 
	//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
	while($res = mysqli_fetch_array($result)) { 		
		echo "<tr>";
		echo "<td>".$res['name']."</td>";
		echo "<td>".$res['age']."</td>";	
		echo "<td><a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete Link</a></td>";		
	}
	?>
    </div>
	</center>
</body>
</html>
