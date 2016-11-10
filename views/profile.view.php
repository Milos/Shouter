<div id="container">

<h2><?=$profile; ?> 
<?php if ( ($_SESSION['admin'] === 1) && (strtolower($_SESSION['username']) === strtolower($profile)) || !empty($is_admin)): ?>
	<b id="admin">Admin</b>
<?php endif ?>
</h2>

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
<h2>Latest Shouts</h2>
<?php if ($posts): ?>
		<?php foreach ($posts as $post): ?>
			<div id="articont">
				<article id="message">	
					<p><?= $post['message']; ?></p>
					<time><?= $post['post_date']; ?></time>
				</article>
				<?php if ( ($_SESSION['user_id'] === $_GET['id']) || ($_SESSION['admin'] === 1) ): ?>
					<form action="" method="POST">
					<input type="hidden" name="id" value="<?= $post['id']?>">
					<button id="delete" name="delete" onClick="window.opener.history.go(0);">delete</button>
				</form>
				<?php endif ?>
				
				<!-- <a href="#">delete</a> -->
			</div>
		<?php endforeach ?>
	<?php else: echo "<b id='no-posts'>This User has not shouted yet.</b>";?>
	<?php endif ?>	
</div>