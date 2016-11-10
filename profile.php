<?php  
require 'shouter.php';
use Shouter\DB;
session_start();

if (!isset($_SESSION["username"]) || !isset($_GET['id']) )  { // if the username has not been set or get[id] has not been provided
	header("Location: index.php");
	die();
}

$following = DB\query("SELECT * FROM users inner join following where  users.id = following_id and user_id= :user_id",
	['user_id' => $_GET['id']], 
	$conn);

$followed = DB\query("SELECT * FROM users inner join following where  users.id = user_id and following_id= :user_id",
	['user_id' => $_GET['id']], 
	$conn);

$profile = DB\get_username($conn)['username']; 

$is_admin = $conn->query("SELECT id FROM users WHERE username = '$profile' AND admin = 1");
$is_admin = $is_admin->fetch(\PDO::FETCH_ASSOC);

if (isset($_POST['delete'])) {
	$post_id = $_POST['id'];
	$delete = DB\query("DELETE FROM posts WHERE id = :id LIMIT 1", ['id' => $post_id], $conn);
}

$posts = DB\query("SELECT * FROM posts WHERE author_id =:user_id ORDER BY id  DESC LIMIT 6",
	['user_id' => $_GET['id']],
	$conn);

if ($profile) {
	view('profile', [
	'posts' => $posts,
	'following' => $following,
	'profile' => $profile,
	'followed' => $followed,
	'is_admin' =>$is_admin
	]);	
} else {
	header('location: users-copy.php');
}
