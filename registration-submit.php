<?php

ini_set('display_errors', 'On'); 
error_reporting(E_ALL);

if(isset($_POST['registration'])){

	//Proceed with registration logic

	require_once("includes/functions/user-functions.php");

	require_once("includes/functions/account-functions.php");

	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$password = $_POST['password'];

	$userCreation = createUser($firstName, $lastName, $email, $phone, $address, $password);

	if($userCreation['error'] === true){
		die($userCreation['message']);
	}

	if(isset($_POST['savingsaccount'])){

		$savingsAccountCreation = createAccount($userCreation['ID'], "SAVINGS");

	}

	if(isset($_POST['businessaccount'])){

		$businessAccountCreation = createAccount($userCreation['ID'], "BUSINESS");

	}
	

	header("Location: login.php");

} else {

	header("Location: index.php");

}


?>