<?php 

session_start();

ini_set('display_errors', 'On'); 
error_reporting(E_ALL);

//Logic to secure the page

if(!(isset($_SESSION['authenticatedSession']) && strlen($_SESSION['authenticatedSession']['userId']) > 0)){

	//Redirect to login
	header("Location: index.php");

	exit();

}

require_once("includes/functions/user-functions.php");
require_once("includes/functions/account-functions.php");
require_once("includes/functions/transaction-functions.php");

$usersData = getUsers($_SESSION['authenticatedSession']['userId']);

$usersAccounts = getAccounts($_SESSION['authenticatedSession']['userId'], null);

ini_set('display_errors', 'On'); 
error_reporting(E_ALL);


require_once('includes/initialize.php');

include(INCLUDE_PATH . '/staff_header.php'); 


?>

<main>
<?php include('includes/menu.php'); ?>
<div class = "main-content">

  <h2> 

    <?php 
    if(isset($_SESSION['manager']) && $_SESSION['manager'] === true){
      echo "Manager's Portal | Transactions";
    }else {
      echo "Internet Banking Dashboard | Transactions";
    }
    ?>

  </h2>



  <p> Account Number:<b style="font-family:comic sans ms;color:green"> <?php echo $_GET['account'] ?></b> </p>
  <br/>

  <h3> Transactions </h3>

  <table>
    <thead>
      <tr>
        <th> S/N </th>
        <th> Account Number </th>
        <th> Amount </th>
        <th> Type </th>
        <th> Description </th>
        <th> Date </th>
		<th> Closing Balance </th>
      </tr>
    </thead>
    <tbody>

      <?php
	  $transactions=getTransactions($_GET['account']);
        $sn = 1;
        foreach($transactions as $transaction){

          echo "<tr>
          <td> $sn </td>
          <td> {$transaction['ACCOUNT_ID']} </td>
          <td> $ {$transaction['AMOUNT']} </td>
		  <td> {$transaction['TYPE']} </td>
          <td> {$transaction['DESCRIPTION']} </td>
		  <td> {$transaction['DATECREATED']} </td>
		  <td> $ {$transaction['CLOSING_BALANCE']} </td>
          </tr>";

          $sn++;

        }
      ?>
      
    </tbody>
  </table>

</div>
</main>

<?php include(INCLUDE_PATH . '/staff_footer.php'); ?>