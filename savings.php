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

$usersData = getUsers($_SESSION['authenticatedSession']['userId']);

$usersAccounts = getSavingsAccounts($_SESSION['authenticatedSession']['userId'], null);

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
      echo "Manager's Portal";
    }else {
      echo "Internet Banking Dashboard";
    }
    ?>

  </h2>



  <p> Welcome, <?php echo $usersData[0]['firstName'] ?> </p>
  <br/>

  <h3> Your Savings Accounts </h3>

  <table>
    <thead>
      <tr>
        <th> S/N </th>
        <th> Account Number </th>
        <th> Balance </th>
        </tr>
    </thead>
    <tbody>

      <?php
        $sn = 1;
        foreach($usersAccounts as $account){

          echo "<tr>
          <td> $sn </td>
          <td> {$account['accountId']} </td>
          <td> $" . number_format($account['balance'], 2) ." </td>
          </tr>";

          $sn++;

        }
      ?>
      
    </tbody>
  </table>

</div>
</main>

<?php include(INCLUDE_PATH . '/staff_footer.php'); ?>