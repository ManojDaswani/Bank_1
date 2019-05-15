<?php
$databaseServerName = 'localhost';
$databaseUsername = 'USERNAME';
$databasePassword = '';
$theDatabase = 'DATABASENAME';

//connection to database

$databaseConnection = mysqli_connect('localhost', $databaseUsername, $databasePassword, $theDatabase);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


?>
