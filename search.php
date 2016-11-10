<?php  
require 'shouter.php';
use Shouter\DB;

session_start();

if (isset($_POST['search-input']) ) {
	$search_user= $_POST['search-input'];
}
$results = $conn->prepare("select username, id from users where username LIKE '%$search_user%'");
$results->bindParam('username', $search_user, \PDO::PARAM_STR);
$results->execute();
$results_count = $results->rowCount();
$results = $results->fetchALL();

view('search',
['search_user' => $search_user,
'results' => $results,
'results_count' => $results_count
]);

?>