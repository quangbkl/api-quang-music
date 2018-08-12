<?php
function connectToDatabase() {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "music-player";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	    // return null;
	}

	return $conn;
}
?>