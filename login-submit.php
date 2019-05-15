<?php

session_start();

ini_set('display_errors', 'On'); 
error_reporting(E_ALL);

if(isset($_POST['login'])){

	//Proceed with login logic

	require("includes/functions/user-functions.php");

	$email = $_POST['email'];
	$password = $_POST['password'];

	$userLogin = loginUser($email, $password);

	if($userLogin !== false){

		$_SESSION['authenticatedSession'] = $userLogin;

		//Redirect to dashboard

		header("Location: dashboard.php");
		
	} else {

		header("Location: login.php?msg=Invalid Credentials, Please Check UserID/Password");

	}

	

} else {

	header("Location: index.php");

}


?>