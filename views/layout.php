<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<title>Shoouuter</title>
</head>
<body>
	<header role="banner">
		<a href="index.php"><h1>Shoouuter</h1></a>
		<?php if (isset($_SESSION["username"])): ?>	
			<nav>
				<ul>
					<li><a href="user.php">My Profile</a></li>
					<li><a href="feed.php">Feed </a></li>
					<li><a href="users-copy.php">Users</a></li>
				</ul>
			</nav>
			<form id="search" action="search.php" method="POST">
				<input type="text" name="search-input" maxlength="20">
			</form>
			<a id="logout" href="logout.php">Logout</a>
		<?php endif ?>
		
	</header>
		<?php include($path); ?>
</body>
</html>