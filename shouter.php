<?php  

require 'functions.php';
require 'db.php';

// Connect to the db
$conn = Shouter\DB\connect($config);
if (!$conn) die('Problem connecting to the database.');	
?>