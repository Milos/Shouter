<div id="description"><h2>Twitters Ugly Brother</h2></div>
	
	<div id="modalbox">
		<div id="register">
			<form action="" method="POST">
			<h2>Register</h2>
			<ul>	
				<li>
					<input type="text" placeholder="Username" name="username">
				</li>
				<li>
					<input type="emal" placeholder="Email" name="email">
				</li>
				<li>
					<input type="password" placeholder="Password" name="password">
				</li>
					<li>
						<button name="registerForm">Register</button>					
					</li>
			</ul>
		</form>
		</div>
		<div id="login">
			<form action="" method="POST">
			<h2>Login</h2>
			<ul>	
				<li>
					<input type="text" placeholder="Username" name="username">
				</li>
				
				<li>
					<input type="password" placeholder="Password" name="password">
				</li>
				<li>
						<button name="loginForm">Login</button>					
					</li>
			</ul>
		</form>
		</div>

	<?php if (isset($status) ): ?>
		<p id="status"><?= $status; ?></p>
	<?php endif ?>
	</div>
	