<?php 

session_start();

ini_set('display_errors', 'On'); 
error_reporting(E_ALL);



require_once('includes/initialize.php');

$page_title = 'Staff Menu';

include('includes/staff_header.php'); 


?>

<main>
<?php include('includes/menu.php'); ?>
<div class = "main-content">

  <h2> Login to  

  	<?php

  		if(isset($_GET['manager'])){
  			echo  "Manager's Portal";
  		} else {
  			echo "Internet Banking";
  		}

  	?>

  </h2>
  <p> Please fill the form below to login </p>

  <form action = "login-submit.php" method = "post">

  	<input type = "hidden" name = "login"/>

  	<?php

  		if(isset($_GET['manager'])){
  			echo  "<input type = 'hidden' name = 'manager'/>";
  		}

  	?>

  	<div class = "form-group">
  		<label> UserID </label>
  		<input type = "email" name = "email"/>
  	</div>

  	<div class = "form-group">
  		<label> Password </label>
  		<input type = "password" name = "password"/>
  	</div>

  	<div class = "form-group">
  		<button type = "submit"> Login </button>
  	</div>	
  	
  <?php
  if(isset($_GET['msg']))
	  echo "<font color='red'>".$_GET['msg']."</font>";
  
  ?>

  </form>

</div>
</main>

<?php include(INCLUDE_PATH . '/staff_footer.php'); ?>
