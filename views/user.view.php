<div id="container">	
	<h2>My Profile - <?= $_SESSION['username']; ?>
	<?php if ($_SESSION['admin'] === 1): ?>
	<b id="admin">Admin</b>
	<?php endif ?>
	</h2>
	 <a href="profile.php?id=<?=$_SESSION['user_id'];  ?>"><div id="profile">View profile</div></a>
	<div id="follow-list">
		<div class="left">
			<h3>Following:</h3>
			<ul>
				<?php if ($following): ?>
					<?php foreach ($following as $row): ?>
					<li>
						
						<a href="profile.php?id=<?=$row['id']; ?>"><?=$row['username']; ?></a>
					</li>
				<?php endforeach ?>
			<?php else: echo "No one for now";?>
				<?php endif ?>
			</ul>
		</div>
		<div class="right">
			<h3>Followed by:</h3>
			<ul>
				<?php if ($followed): ?>
					<?php foreach ($followed as $row): ?>
					<li>
						
						<a href="profile.php?id=<?=$row['id']; ?>"><?=$row['username']; ?></a>
					</li>
				<?php endforeach ?>
			<?php else: echo "No one for now";?>
				<?php endif ?>
				
			</ul>
		</div>
	</div>
	<div id="form">
	<form action="" method="POST">
		<textarea name="message" id="message" maxlength="100"></textarea><br>
		<button name="shout">Shout</button>
	</form>
	</div>
	
	<?php if (isset($status)): ?>
		<p id="status"><?= $status; ?></p>
	<?php endif ?>
	
	<h2>My Feed:</h2>
	<?php if ($posts): ?>
		<?php foreach ($posts as $post): ?>

			<div id="articont">
				<article id="message">	
					<p><?= $post['message']; ?></p>
					<time><?= $post['post_date']; ?></time>
					<b id="author"><?= $post['username'];?></b>
				</article>
				<?php if ($_SESSION['admin'] === 1): ?>
					<form action="" method="POST">
						<input type="hidden" name="id" value="<?= $post['id']?>">
						<button id="delete" name="delete" onClick="window.opener.history.go(0);">delete</button>
					</form>
				<?php endif ?>
				
				<!-- <a href="#">delete</a> -->
			</div>
		<?php endforeach ?>
	<?php endif ?>	
</div>
