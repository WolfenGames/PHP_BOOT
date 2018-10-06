<?php
	session_start();

	include("../inc/config.php");
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		if ($_POST['login'] == "ok")
		{
			$db = mysqli_connect(SERVERNAME, DB_USERNAME, DB_PASS, "rush00");
			if (!$db)
				die ("eh?");
			$_SESSION['Logged in'] = true;
			$myusername = $_POST['Uname'];
			$mypassword = hash("whirlpool", $_POST['Passwd']);
			$sql = "SELECT * FROM `persons` WHERE `Username` = '$myusername' and `hashedPassword` = '$mypassword'";
			$result = mysqli_query($db,$sql);
			if (!$result)
			{
				die("Error creating Item Table " . mysqli_error($db));
			}
			$row = mysqli_fetch_array($result);
			$count = mysqli_num_rows($result);
			if($count == 1) {
			   $_SESSION['username'] = $myusername;
			   $_SESSION['UI'] = $row;
			}
		 }
		 if ($_POST['logout'] == "ok")
		 {
			 unset($_SESSION['UI']);
			 session_destroy();
		 }
	}
	header("Location: ../index.php");
?>