<?php  

function view($path, $data = null) {
	if ($data) { // if data was provided
		extract($data); // takes names from associative array and converts them to variables
	}

	$path = $path . '.view.php';

	include 'views/layout.php';
}

?>