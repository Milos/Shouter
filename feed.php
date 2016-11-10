<?php  

require 'shouter.php';
session_start();
use Shouter\DB;
// $posts1 = DB\get('posts', $conn, 18);

$posts = $conn->query("SELECT * FROM posts inner join users ON users.id = posts.author_id ORDER BY posts.id DESC LIMIT 21");

view('feed', [
	'posts' => $posts,
]);
?>
