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
      echo "Manager's Portal | Transfer Funds";
    }else {
      echo "Internet Banking Dashboard | Transfer Funds";
    }
    ?>

  </h2>
  <?php
  if(isset($_POST['transferAction'])){
	if($_POST['transferAction']=="No")
		header("Location: dashboard.php");
	if($_POST['transferAction']=="Yes")
	{
		//Code for Transaction
		$from=$_POST['account'];
		$to=$_POST['beneficiary'];
		$amount=$_POST['amount'];
		$des=$_POST['description'];
		$transactionMessage=transact($from,$to,$amount,$des);
		
     echo $transactionMessage;
	 echo "<br><a href='dashboard.php'>Go Home</a>";
	}
  }else{

?>
<form method="post">

Transfer Message:<br>
  <font face="comic sans ms" color="red"><p> Transferring $<?php echo $_POST['amount'] ?> from Account Number: <?php echo $_POST['account'] ?> to Account Number: <?php echo $_POST['beneficiary'] ?>, Description : <?php echo $_POST['description'] ?>
  </font><br/>
  <?php
    foreach ($_POST as $a => $b) {
        echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
    }
?>

  <h3> Action </h3>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" style="padding:10px" name="transferAction" value="Yes">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" style="padding:10px" name="transferAction" value="No">

</form>


</div>
</main>

<?php }include(INCLUDE_PATH . '/staff_footer.php');?>