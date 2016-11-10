
<!-- <h1 id="headline">Feed</h1> -->
<div id="feed">
<?php foreach ($posts as $post): ?>	
	<article id="post">
		<p><?= $post['message']; ?></p>
		<time><?= $post['post_date']; ?></time>
		<b id="author"><?= $post['username'];?></b>
	</article>
<?php endforeach ?>
</div>