<?php

require_once(__DIR__ . "/../db.php");

function createAccount($userId, $type){

	global $databaseConnection;

	$sql = "INSERT INTO bank_accounts (USER_ID, TYPE) VALUES ('$userId', '$type')";

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
		"message" => "Account Created"
	];

}

function deleteAccount($accountId){

	global $databaseConnection;

	$sql = "DELETE FROM bank_accounts WHERE ID = '$accountId'";

	$queryResult = mysqli_query($databaseConnection, $sql);

	if($queryResult !== true){

		return mysqli_error($databaseConnection);

	}

	return true;

}

function getAccounts($userId = null, $accountId = null){

	global $databaseConnection;

	$sql = "SELECT * FROM bank_accounts";

	if($userId !== null){

		$sql = $sql . " WHERE USER_ID = '$userId'";

	}

	if($accountId !== null){

		$sql = $sql . " WHERE ID = '$accountId'";

	}

	$queryResult = mysqli_query($databaseConnection, $sql);

	$accounts = [];

	while($resultData = mysqli_fetch_assoc($queryResult)){

		$accountData['accountId'] = $resultData['ID'];
		$accountData['userId'] = $resultData['USER_ID'];
		$accountData['balance'] = $resultData['BALANCE'];
		$accountData['type'] = $resultData['TYPE'];
		$accountData['dateCreated'] = $resultData['DATECREATED'];

		array_push($accounts, $accountData);

	}

	return $accounts;

}
function getSavingsAccounts($userId = null, $accountId = null){

	global $databaseConnection;

	$sql = "SELECT * FROM bank_accounts";

	if($userId !== null){

		$sql = $sql . " WHERE USER_ID = '$userId'";

	}

	if($accountId !== null){

		$sql = $sql . " WHERE ID = '$accountId'";

	}
    $sql=$sql." AND type='SAVINGS'";
	$queryResult = mysqli_query($databaseConnection, $sql);

	$accounts = [];

	while($resultData = mysqli_fetch_assoc($queryResult)){

		$accountData['accountId'] = $resultData['ID'];
		$accountData['userId'] = $resultData['USER_ID'];
		$accountData['balance'] = $resultData['BALANCE'];
		$accountData['type'] = $resultData['TYPE'];
		$accountData['dateCreated'] = $resultData['DATECREATED'];

		array_push($accounts, $accountData);

	}

	return $accounts;

}
function getBusinessAccounts($userId = null, $accountId = null){

	global $databaseConnection;

	$sql = "SELECT * FROM bank_accounts";

	if($userId !== null){

		$sql = $sql . " WHERE USER_ID = '$userId'";

	}

	if($accountId !== null){

		$sql = $sql . " WHERE ID = '$accountId'";

	}
    $sql=$sql." AND type='BUSINESS'";
	$queryResult = mysqli_query($databaseConnection, $sql);

	$accounts = [];

	while($resultData = mysqli_fetch_assoc($queryResult)){

		$accountData['accountId'] = $resultData['ID'];
		$accountData['userId'] = $resultData['USER_ID'];
		$accountData['balance'] = $resultData['BALANCE'];
		$accountData['type'] = $resultData['TYPE'];
		$accountData['dateCreated'] = $resultData['DATECREATED'];

		array_push($accounts, $accountData);

	}

	return $accounts;

}

?>