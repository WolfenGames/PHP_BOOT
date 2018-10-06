<?php
	session_start();

	include("../inc/config.php");
	$db = mysqli_connect(SERVERNAME, DB_USERNAME, DB_PASS, "rush00");
	if (!$db)
		die ("eh?");
	$sql = "SELECT * FROM `items`";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result);
	$count = mysqli_num_rows($result);
	if ($count >= 1)
	{

	}
?>