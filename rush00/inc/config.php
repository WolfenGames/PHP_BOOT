<?php
	define("SERVERNAME", "127.0.0.1");
	define("DB_USERNAME", "rush00");
	define("DB_PASS", "rush00");

	$conn = new mysqli(SERVERNAME, DB_USERNAME, DB_PASS);

	if (!$conn) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}
?>