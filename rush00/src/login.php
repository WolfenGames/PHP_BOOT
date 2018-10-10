<?php
	session_start();

	include("../inc/config.php");
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($_POST['login'] == "ok")
		{
		    if (isset($_SESSION['cart']))
		        $temp = $_SESSION['cart'];
		    $_SESSION = array();
		    $_SESSION['cart'] = $temp;
            $_SESSION['Logged in'] = false;
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
				die(mysqli_error($db));
			}
			mysqli_close($db);
			$row = mysqli_fetch_array($result);
			$count = mysqli_num_rows($result);
			if($count == 1) {
			   $_SESSION['username'] = $myusername;
			   unset($row['HashedPassword']);
			   $_SESSION['UI'] = $row;
			   $_SESSION['Logged in'] = true;
			}
			else
            {
                $_SESSION = array();
                if (ini_get("session.use_cookies")) {
                    $params = session_get_cookie_params();
                    setcookie(session_name(), '', time() - 42000,
                        $params["path"], $params["domain"],
                        $params["secure"], $params["httponly"]
                    );
                }
                session_destroy();
            }
		 }
		 if ($_POST['logout'] == "ok")
		 {
		     if (isset($_SESSION['cart']))
             $temp = $_SESSION['cart'];
             $_SESSION = array();
             if (ini_get("session.use_cookies")) {
                 $params = session_get_cookie_params();
                 setcookie(session_name(), '', time() - 42000,
                     $params["path"], $params["domain"],
                     $params["secure"], $params["httponly"]
                 );
             }
             session_destroy();
		 }
	}
	header("Location: ../index.php");
?>