<div id="users">
<!-- <h2>Users</h2> -->

<?php if ($following): ?>
	<?php foreach ($following as $follower) {
	$followers[] = $follower['id']; // 1,4	
}?>
<?php else: $followers = [];?>
<?php endif ?>

<?php $length = count($followers);?>
	
<table>
	<tr>
	  <th id="left">Username</th>
	  <th>Follow</th> 
	  <th>Posts</th>
	  <th>Admin</th>
	</tr>
	<?php foreach ($users as $user): ?>
		<tr>
			<td id="left"><a href="profile.php?id=<?=$user['id']; ?>"><?=$user['username']; ?></a>
			
			<!-- If Admin show remove button -->
			<?php if ($_SESSION['admin'] === 1 && $user['id'] != $_SESSION['user_id']): ?>
				<form id="remove-container" action="" method="POST">
					<input type="hidden" name="id" value="<?= $user['id']?>">
					<button id="remove" name="remove"><img src="cross.svg" alt="remove"></button>
				</form>
				<!-- <span id="delete-list">Remove</span> -->
			<?php endif ?></td>
				
				<!-- don't show button for logged in user-->
				<?php if ($user['id'] != $_SESSION['user_id']): ?>
					<td><form action="" method="POST">
					<?php  
					$counter=0;
					$status ="Follow";
					while ($counter < $length) {
						if ($user['id'] === $followers[$counter] ) {
							// $temp= "Un"; break;
							$status="Unfollow"; break;
						} 	
						$counter++; 
					}
					?>
					<input type="hidden" name="id" value="<?= $user['id']?>">
					<button id="follow" class="follow-table" name="follow"><?= $status; ?></button>
				</form>
				<?php else: echo "<td><div id='circle' class='circle-table'></div></td>";?> <!-- Logged in User -->
				<?php endif ?></td>
				<td>
				<?php
					echo $user['posts_count'];
				?>
				</td>
				<td id="wide">
						<?php if ($user['admin'] != 0): ?>
							<?= "<span class='green'>Yes</span>" ?>
						<?php else: echo "<span>No</span>";?>
						<?php endif ?>
						<?php if ( ($_SESSION['admin'] === 1) && ($user['username'] != $_SESSION['username']) ): ?>   <!-- && ($user['admin'] == 0) -->
								<form id="change-admin" action="" method="POST">
								<input type="hidden" name="id" value="<?= $user['id']?>">
								<button id="change" name="change"><img src="edit.svg" alt="edit"></button>
								</form>
						<?php endif ?>				
				</td>
			</tr>
		
		<?php endforeach ?>
</table>
</div>