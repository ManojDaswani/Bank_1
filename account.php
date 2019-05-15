<?php
session_start();
require("initialize.php");
if (!isset($_SESSION['username'])) header ("location: ./")
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile Page </title>
<link rel="stylesheet" type="text/css" href="/staff.css">
</head>
<body>
	<div id="container">
		<div id="menu">
			<a href="index.php">Profile</a>
			<a href="account.php">Account</a>
			<a href="logout.php">Logout</a>
		</div>
		<?php $usersData = getUsersData(getId($_SESSION['username'])); ?>
		<strong><u>Update your name</u></strong>
		<form action="account.php?update=name" method="POST">
			First Name: <input type="text" name="fName" value="<?php echo $usersData['firstname']; ?>" />
			Last Name: <input type="text" name="lName" value="<?php echo $usersData['lastname']; ?>" />
			<input type="submit" name="nameSubmit" value="Update">
		</form>
	</div>
</body>
</html>