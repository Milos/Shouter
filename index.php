<?php 
session_start();
require 'shouter.php';
use Shouter\DB;
$data = [];

//-----------------------------------------------------------
//        L O G I N   V A L I D A T I O N 
//-----------------------------------------------------------
if (isset($_POST['loginForm']) ) { // If form has been posted
	// get their values
	$username = htmlspecialchars($_POST["username"]);
	$password = htmlspecialchars($_POST["password"]);
	
	// validate that against the records
	if (empty($username) || empty($password) ) {
		$data['status'] = 'Please fill out both inputs';
	}
	else {
		$validate_user = DB\validate_user("SELECT username, password id FROM users WHERE username=:username and password=:password",
					['username' => $username,
					 'password' => $password
					], $conn);
		if (count($validate_user) == 1) { // if row has been found
			$_SESSION["username"] = $username;
			
			//Check if admin
			$admin= DB\query('SELECT * FROM users where username = :username AND admin = 1',
				['username' => $username],$conn);
			if ($admin) {
				$_SESSION['admin'] = 1;
			} else {$_SESSION['admin'] = 0;}
			
			$user_id = DB\get_user_id($conn);
			$_SESSION['user_id'] = $user_id['id'];
			
			header("Location: user.php");
		} else {
			$data['status'] = 'Wrong username or password';
		}
	}
}

//-----------------------------------------------------------
//        R E G I S T E R   V A L I D A T I O N 
//-----------------------------------------------------------
if (isset($_POST['registerForm']) ) { // If form has been posted
	// get their values
	$username = htmlspecialchars($_POST["username"]);
	$password = htmlspecialchars($_POST["password"]);
	$email = htmlspecialchars($_POST["email"]);
	$data = [];
	// validate that against the records

	// Check if inputs are filled out
	if (empty($username) || empty($password) || empty($email) ) {
		$data['status'] = 'Please fill out all the inputs';
	}
	// Check if email is valid
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    	$data['status'] = "This {$email} email address is not considered valid.";
	}
	else { // Check if username exists
		$validate_user = DB\validate_user("SELECT username, password FROM users WHERE username=:username",
					['username' => $username],
					 $conn);
		if (count($validate_user) > 0) { // if row has been found
			$data['status'] = 'Username already exists.';
		}
		 // Insert row in the db
		 else {
			DB\query("INSERT INTO users(username, email, password) VALUES(:username, :email, :password)",
				['username' => $username,
				 'email' => $email,
				 'password' => $password],
			$conn);
			$data['status'] = '<span class="green">You have been registered, please Login</span>'; 
		}
	}
}
view('index',$data);
?>
