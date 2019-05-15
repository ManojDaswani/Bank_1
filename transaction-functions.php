<?php 
function transact($from,$to,$amount,$des)
{
	if(!checkIfAccountExists($to))
	{
		return "Beneficiary Account Does Not Exist";
	}
	if(getAmountFromAccount($from)<$amount)
	{
	 return "Insufficient Amount";
	}
	//Process Payment
	if(deductAmountFromSender($from,$amount) &&	addAmountToBeneficiary($to,$amount)){
	$descriptionSender=$des."( To ".$to." )";
	$descriptionReceiver=$des." ( From ".$from." )";
	addInwardTransaction($descriptionReceiver,$amount,$to);
	addOutwardTransaction($descriptionSender,$amount,$from);
	return "Transfer Successful!";
	}
	
	}
	
	
	function getTransactions($acc)
	{
		
	global $databaseConnection;

	$sql = "SELECT * FROM bank_transactions";

	if($acc !== null){

		$sql = $sql . " WHERE ACCOUNT_ID = '$acc'ORDER by DATECREATED desc";

	}

	$queryResult = mysqli_query($databaseConnection, $sql);

	$transactions = [];

	while($resultData = mysqli_fetch_assoc($queryResult)){
        $transaction;
		$transaction['DESCRIPTION'] = $resultData['DESCRIPTION'];
		$transaction['AMOUNT'] = $resultData['AMOUNT'];
		$transaction['ACCOUNT_ID'] = $resultData['ACCOUNT_ID'];
		$transaction['TYPE'] = $resultData['TYPE'];
		$transaction['DATECREATED'] = $resultData['DATECREATED'];
		$transaction['CLOSING_BALANCE'] = $resultData['CLOSING_BALANCE'];

		array_push($transactions, $transaction);

	}

	
	return $transactions;
		
		
	}
function addInwardTransaction($des,$amount,$to)
{
	
	global $databaseConnection;
	   
	$closing_balance=getAmountFromAccount($to);
	$sql = "INSERT INTO bank_transactions(DESCRIPTION, AMOUNT,ACCOUNT_ID,TYPE,CLOSING_BALANCE) values('$des',$amount,$to,'CR',$closing_balance)";

	$queryResult = mysqli_query($databaseConnection, $sql);

	if($queryResult !== true){

		echo mysqli_error($databaseConnection);
		return false;

	}
	return true;
	
	
}
function addOutwardTransaction($des,$amount,$from)
{
		global $databaseConnection;
		$closing_balance=getAmountFromAccount($from);
	   
	
	$sql = "INSERT INTO bank_transactions(DESCRIPTION, AMOUNT,ACCOUNT_ID,TYPE,CLOSING_BALANCE) values('$des',$amount,$from,'DR',$closing_balance)";

	$queryResult = mysqli_query($databaseConnection, $sql);

	if($queryResult !== true){

		echo mysqli_error($databaseConnection);
		return false;

	}
	return true;
	
	
}
function addAmountToBeneficiary($acc,$amount)
{
	global $databaseConnection;
	   
	$balance=getAmountFromAccount($acc);
	$updatedBalance=$balance+$amount;
	$sql = "update bank_accounts set balance='$updatedBalance' WHERE id = '$acc'";

	$queryResult = mysqli_query($databaseConnection, $sql);

	if($queryResult !== true){

		echo mysqli_error($databaseConnection);
		return false;

	}
	return true;
}
function deductAmountFromSender($acc,$amount)
{
	global $databaseConnection;
	   
	$balance=getAmountFromAccount($acc);
	$updatedBalance=$balance-$amount;
	$sql = "update bank_accounts set balance='$updatedBalance' WHERE id = '$acc'";

	$queryResult = mysqli_query($databaseConnection, $sql);

	if($queryResult !== true){

		echo mysqli_error($databaseConnection);
		return false;

	}
	return true;
}


function getAmountFromAccount($acc)
{
	global $databaseConnection;

	$sql = "SELECT * FROM bank_accounts WHERE id = '$acc'";

	$queryResult = mysqli_query($databaseConnection, $sql);

	if($queryResult !== true){

		echo mysqli_error($databaseConnection);

	}

	if(mysqli_num_rows($queryResult) == 1){

		while($resultData = mysqli_fetch_assoc($queryResult)){

			return  $resultData['BALANCE'];
		}

		}

	return 0;
}

function checkIfAccountExists($acc)
{
	global $databaseConnection;

	$sql = "SELECT * FROM bank_accounts WHERE id = '$acc'";

	$queryResult = mysqli_query($databaseConnection, $sql);

	if($queryResult !== true){

		echo mysqli_error($databaseConnection);

	}

	if(mysqli_num_rows($queryResult) == 1){

	return  true;

		}

	return false;
}

?>
