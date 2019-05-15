<?php

require_once(__DIR__ . "/../db.php");

function createUser($firstName, $lastName, $email, $phone, $address, $password){

	global $databaseConnection;

	$sql = "INSERT INTO bank_users (FIRSTNAME, LASTNAME, EMAIL, PHONE, ADDRESS, PASSWORD) VALUES ('$firstName', '$lastName', '$email', '$phone', '$address', '$password')";

	$queryResult = mysqli_query($databaseConnection, $sql);

	if($queryResult !== true){

		return [
			"error" => true,
			"message" => mysqli_error($databaseConnection)
		];


	}

	$insertId = mysqli_insert_id($databaseConnection);

	return [
		"error" => false,
		"ID" => $insertId,
		"message" => "User Created"
	];


}

function deleteUser($userId){

	global $databaseConnection;

	$sql = "DELETE FROM bank_users WHERE ID = '$userId'";

	$queryResult = mysqli_query($databaseConnection, $sql);

	if($queryResult !== true){

		return mysqli_error($databaseConnection);

	}

	return true;

}

function loginUser($email, $password){

	global $databaseConnection;

	$sql = "SELECT * FROM bank_users WHERE EMAIL = '$email' AND PASSWORD = '$password'";

	$queryResult = mysqli_query($databaseConnection, $sql);

	if($queryResult !== true){

		echo mysqli_error($databaseConnection);

	}

	if(mysqli_num_rows($queryResult) == 1){

		while($resultData = mysqli_fetch_assoc($queryResult)){

			$userData['userId'] = $resultData['ID'];
			$userData['manager'] = $resultData['MANAGER'];

		}

		return $userData;

	}

	return false;

}

function getUsers($userId = null){

	global $databaseConnection;

	$sql = "SELECT * FROM bank_users";

	if($userId !== null){

		$sql = $sql . " WHERE ID = '$userId'";

	}

	$queryResult = mysqli_query($databaseConnection, $sql);

	if($queryResult !== true){

		echo mysqli_error($databaseConnection);

	}

	$users = [];

	while($resultData = mysqli_fetch_assoc($queryResult)){

		$userData['userId'] = $resultData['ID'];
		$userData['manager'] = $resultData['MANAGER'];
		$userData['firstName'] = $resultData['FIRSTNAME'];
		$userData['lastName'] = $resultData['LASTNAME'];
		$userData['email'] = $resultData['EMAIL'];
		$userData['phone'] = $resultData['PHONE'];
		$userData['dateCreated'] = $resultData['DATECREATED'];

		array_push($users, $userData);

	}

	return $users;

}



?>