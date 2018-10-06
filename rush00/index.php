<?php
	session_start();
	?>
	<?php

		if (!$_SESSION['Logged in'])
		{
			?>
			<form method="POST" action="src/login.php">
				Username	: <input name="Uname" value="" style="width: 100%;">
				<br />
				Password	: <input name="Passwd" type="password" value="" style="Width: 100%">
				<br />
				<button type="submit" name="login" value="ok">Login</button>
				<br />
			</form>
			<form method="POST" action="src/register.php">
				<button type="submit" name="register" value="ok">Register</button>
			</form>
		<?php
		}
		else if ($_SESSION['Logged in'])
		{
			?>
			Welcome to the Jungle => <?php echo $_SESSION['UI']['Username']; ?><br />
			<form method="POST" action="src/login.php">
				<button type="submit" name="logout" value="ok">logout</button>
			</form>
			<?php
		}
		?>
	<?php

?>