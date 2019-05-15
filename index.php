<?php 

session_start();

ini_set('display_errors', 'On'); 
error_reporting(E_ALL);



require_once('includes/initialize.php');

$page_title = 'Staff Menu';

include(INCLUDE_PATH . '/staff_header.php'); 


?>

<main>
<?php include('includes/menu.php'); ?>
<div class = "main-content">

  <h2> Home </h2>
  <p> Welcome to the beautiful bank app </p>

</div>
</main>

<?php include(INCLUDE_PATH . '/staff_footer.php'); ?>
