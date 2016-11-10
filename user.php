<?php  

require 'shouter.php';
use Shouter\DB;
session_start();

$status="";
// $user_id="";

if (!isset($_SESSION["username"])) { // if the username has not been set
	header("Location: index.php");
	die();
}

$user_id = $_SESSION['user_id'];

// Fetch all the following users
$following = DB\query("SELECT * FROM users inner join following where  users.id = following_id and user_id= :user_id",
	['user_id' => $user_id], 
	$conn);

$followed = DB\query("SELECT * FROM users inner join following where  users.id = user_id and following_id= :user_id",
	['user_id' => $user_id], 
	$conn);

$posts = DB\query("SELECT message, post_date, username, posts.id FROM posts INNER JOIN following ON author_id = following_id AND user_id= :user_id  INNER JOIN users ON author_id = users.id ORDER BY posts.id  DESC LIMIT 6",
	['user_id' => $user_id],
	$conn);


if (isset($_POST['shout'])) {
	$message = htmlspecialchars($_POST['message']);
	$author_id = $user_id;
	$post_date = date('Y-m-d H:i:s');

	if (empty($message) ) {
		$status = 'You can not shout an empty message';
	} else {
		// create a new row in the table
		DB\query('INSERT INTO posts(message, author_id, post_date) VALUES(:message, :author_id, :post_date)', 
			['message' => $message,
			 'author_id' => $author_id,
			 'post_date' => $post_date
			],
			$conn);

		$status = 'Message has been shouted';
	}	
}


if (isset($_POST['delete'])) {
	$post_id = $_POST['id'];
	$delete = DB\query("DELETE FROM posts WHERE id = :id LIMIT 1", ['id' => $post_id], $conn);
	header('location:user.php'); // Reload page to see the effect
}

// Get number of posts
$posts_count = $conn->query("SELECT COUNT(*) FROM posts WHERE author_id = $user_id");
$posts_count = $posts_count->fetch(\PDO::FETCH_ASSOC);
$posts_count = reset($posts_count); // return first key in array
//Insert number of posts
$posts_count_update = $conn->query("UPDATE USERS SET posts_count = $posts_count WHERE id = $user_id");

view('user', [
	'posts' => $posts,
	'status' => $status,
	'following' => $following,
	'followed' => $followed,
	'posts_count' =>$posts_count
]);
?>

<!-- Fetch following users posts;
SELECT users.id, username, posts.id as post_id, posts.message FROM posts INNER JOIN following ON author_id = following_id AND user_id= 1  INNER JOIN users ON author_id = users.id ORDER BY posts.id  DESC LIMIT 6
 -->

<!-- Fetch my posts -->
 <!-- SELECT * FROM posts WHERE author_id = :user_id ORDER BY id DESC LIMIT 6 -->

<!-- Follow by query -->
<!-- SELECT * FROM users inner join following where  users.id = user_id and following_id= :user_id; -->
