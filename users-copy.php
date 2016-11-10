<?php 
session_start(); 
require 'shouter.php';
use Shouter\DB;

if (!isset($_SESSION["username"])) { // if the username has not been set
	header("Location: index.php");
	die();
} 


// Fetch all the users

$users = DB\get('users', $conn, 40);
$temp = "";
$user_id = $_SESSION['user_id'];
$status = "Follow";

// Who is logged in user following
$following = DB\query("SELECT * FROM users inner join following where  users.id = following_id and user_id= :user_id",
	['user_id' => $_SESSION['user_id']], 
	$conn);


//Follow / UnFollow
if (isset($_POST["follow"])) {
	$following_id = $_POST["id"];

	$validate_user = DB\validate_user("SELECT * FROM following WHERE user_id =:user_id and following_id =:following_id",
					['user_id' => $_SESSION['user_id'],
					 'following_id' => $following_id],
					$conn);
		if (count($validate_user) == 1) { // if row has been found
			// Unfollow 
			DB\query("DELETE FROM following WHERE user_id =:user_id and following_id =:following_id",
				['user_id' => $user_id,
				 'following_id' => $following_id],
			$conn);
			// $status ="Follow";
			// Follow
		} else { 
			DB\query("INSERT INTO following(user_id, following_id) VALUES(:user_id, :following_id)",
				['user_id' => $user_id,
				 'following_id' => $following_id],
			$conn);
			// $status ="Unfollow";
		}
		header('location:users-copy.php');
}	

// Remove user	
if (isset($_POST['remove'])) {
	$user_id = $_POST['id'];
	$remove = $conn->query("DELETE FROM users WHERE id = $user_id"); // delete user
	$remove = $conn->query("DELETE FROM posts WHERE author_id= $user_id"); // delete users posts
	$remove = $conn->query("DELETE FROM following WHERE user_id = $user_id"); // delete users following list
	header('location:users-copy.php'); 

}

//Set or Remove Admin privileges
if (isset($_POST['change'])) {
	$user_id = $_POST['id'];
	$change = DB\is_admin($user_id,$conn); //returns 0 or 1
	$bla= $change;
	if ($change == 1) {
	 	$conn->query("UPDATE users SET admin =0 WHERE id =$user_id"); // Set Admin
	 } else {
	 	$conn->query("UPDATE users SET admin =1 WHERE id =$user_id"); // Remove Admin
	 }
	header('location:users-copy.php');
}

view('users-copy', [
	'users' => $users,
	'following' => $following,
	'temp' => $temp,
	'status' =>$status

]);
?>