<?php
	session_start();
	if ($_SESSION['login'] != $_GET['login'] && $_GET['login'])
		$_SESSION['login'] = $_GET['login'];
	if ($_SESSION['password'] != $_GET['passwd'] && $_GET['passwd'])
		$_SESSION['password'] = $_GET['passwd'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<form method="GET" action="./index.php">
		Username : <input name="login" value="<?php echo $_SESSION['login']; ?>">
		<br />
		Password : <input name="passwd" type="password" value="<?php echo $_SESSION['password'];?>">
		<br />
		<button type="Submit" value="OK">Submit</button>
	</form>
</body>
</html>
<?php
?>