<?php 
session_start();

session_destroy(); // destroy the session
$_SESSION = [];    // reinitialize session array
header("Location: index.php"); //redirect to login page
 ?>