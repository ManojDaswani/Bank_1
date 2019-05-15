<?php

if(!(isset($_SESSION['authenticatedSession']) && strlen($_SESSION['authenticatedSession']['userId']) > 0)){

?>

<nav>
<h3>Menu</h3>
    <ul>
      <li> <a href = "login.php"> Internet Banking </a> </li>
      <li> <a href = "registration.php"> New User Registration</a> </li>
      <li> <a href = "login.php?manager"> Manager's Portal </a> </li>
    </ul>
</nav>


<?php

} else {

	?>

<nav>
<h3>Your accounts</h3>
    <ul>
      <li> <a href = "dashboard.php"> Dashboard Home </a> </li>
       <li> <a href = "savings.php">Savings Account </a> </li>
        <li> <a href = "business.php">Business Account</a> </li>

      <?php 
      if($_SESSION['authenticatedSession']['manager'] === true){

      	echo "<li> <a href = 'manage.php'> Manage Accounts </a> </li>";

      }

      ?>
      
      <li> <a href = "logout.php"> Logout </a> </li>
    </ul>
</nav>

	<?php

}

?>