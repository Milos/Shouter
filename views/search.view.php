<div id="search">

	<h2>Results for: <span id="searching"><?= $search_user ?></span></h2>
	<?php if ($results_count > 0): ?>
		<h3>I've Found <?= $results_count ?> results:</h3>
		<ul id="results-list">
			<?php foreach ($results as $result): ?>
			<li>
				<a href='profile.php?id=<?=$result['id'];?>'><?= $result['username'] ?></a>
			</li>
			<?php endforeach ?>
		</ul>
	<?php else: echo "<h3>No such user in my database</h3>";?>
	<?php endif ?>
	
</div>
<h2></h2>