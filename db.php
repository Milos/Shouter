<?php 
namespace Shouter\DB;

$config = ['username' => 'root',
 		   'password' => 'root',
 		   'database' => 'shouter'];

function connect($config) {
	try {
		$conn = new \PDO('mysql:host=localhost;dbname='. $config['database'],
						$config['username'],
						$config['password']);
		$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		
		return $conn;
	} catch (Exception $e) {
		return false;
	}
}

function query($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	$stmt->execute($bindings); // returning the result of the execute()

	return ($stmt->rowCount() > 0)  ? $stmt : false;  // returning the stmt object

}

function validate_user($query, $bindings, $conn)
{
	$stmt = $conn->prepare($query);
	$stmt->execute($bindings); // returning the result of the execute()

	$stmt = $stmt->fetchAll();
	return $stmt; // non object
}

function get($tableName, $conn, $limit = 10)
{
	try {
		$result = $conn->query("SELECT * FROM $tableName ORDER BY id DESC LIMIT $limit");

		return( $result->rowCount() > 0) 
			? $result 
			: false;
	} catch (Exception $e) {
		return false;
	}
}

function get_by_id($id, $conn){
	$query = query(
		'SELECT * FROM posts WHERE id = :id LIMIT 1',
		['id' => $_GET['id']],
		$conn);
	if ($query) return $query->fetchAll();
	// else
}

// Modify functions below later
function get_user_id($conn)
{
	$results = $conn->prepare('SELECT id FROM users WHERE username = :username LIMIT 1' );
	$results->bindParam('username', $_SESSION['username'], \PDO::PARAM_STR);
	$results->execute();
	$results = $results->fetch(\PDO::FETCH_ASSOC);
	return $results;
}
function get_username($conn)
{
	$results = $conn->prepare('SELECT username FROM users WHERE id = :id LIMIT 1' );
	$results->bindParam('id', $_GET['id'], \PDO::PARAM_STR);
	$results->execute();
	$results = $results->fetch(\PDO::FETCH_ASSOC);
	return $results;
}
function is_admin($id, $conn) {
	
	$results = $conn->prepare('SELECT * FROM users WHERE id = :id LIMIT 1' );
	$results->bindParam('id', $id, \PDO::PARAM_STR);
	$results->execute();
	$results = $results->fetch(\PDO::FETCH_ASSOC);
	return $results['admin'] ; // 0 or 1
}	