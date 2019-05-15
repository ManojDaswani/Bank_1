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



  <p> Account Number: <?php echo $_GET['account'] ?> </p>
  <br/>

  <h3> Transfer </h3>

  <form action = "transfer-submit.php" method = "post">

    <input type = "hidden" name = "transfer"/>

    <?php

      if(isset($_GET['manager'])){
        echo  "<input type = 'hidden' name = 'manager'/>";
      }

    ?>

    <div class = "form-group">
      <label> From </label>
      <input type = "text" name = "account" value = "<?php echo $_GET['account']; ?>" readonly/>
    </div>

    <div class = "form-group">
      <label> To </label>
      <input type = "number" name = "beneficiary"/>
    </div>

    <div class = "form-group">
      <label> Amount </label>
      <input type = "number" name="amount"/>
    </div>
<div class = "form-group">
      <label> Description </label>
      <input type = "textarea" style="height:200px;font-family:comic sans ms" name = "description"/>
    </div>

    <div class = "form-group">
      <label> Password </label>
      <input type = "password" name = "password"/>
    </div>
	

    <div class = "form-group">
      <button type = "submit"> Transfer </button>
    </div>  
    

  </form>

</div>
</main>

<?php include(INCLUDE_PATH . '/staff_footer.php'); ?>