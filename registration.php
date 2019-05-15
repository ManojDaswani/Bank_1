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

  <h2> Create a Bank Account  </h2>
  <p> Please fill the form below to open an account</p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  <form action = "registration-submit.php">

  	<input type = "hidden" name = "registration"/>

  	<div class = "form-group">
  		<label> First Name </label>
  		<input type = "text" name = "firstName"/>
  	</div>

    <div class = "form-group">
      <label> Last Name </label>
      <input type = "text" name = "lastName"/>
    </div>

    <div class = "form-group">
      <label> Email </label>
      <input type = "text" name = "email"/>
    </div>

    <div class = "form-group">
      <label> Phone </label>
      <input type = "text" name = "phone"/>
    </div>

    <div class = "form-group">
      <label> Address </label>
      <textarea name = "address"></textarea>
    </div>

  	<div class = "form-group">
  		<label> Password </label>
  		<input type="password" id="pass" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
  	</div>

    <div class = "form-group">
      <label> Confirm Password </label>
      <input type = "password" name = "password_confirmation"/>
    </div>

    <div class = "form-group">
      <label> Create Savings Account </label>
      <input type = "checkbox" name = "savingsaccount"/>
    </div>

    <div class = "form-group">
      <label> Create Business Account </label>
      <input type = "checkbox" name = "businessaccount"/>
    </div>

  	<div class = "form-group">
  		<button type = "submit"> Create Account </button>
  	</div>	
  	

  </form>

</div>
</main>

<?php include(INCLUDE_PATH . '/staff_footer.php'); ?>
