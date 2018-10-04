<?php
	function get_name($value)
	{
		echo $_COOKIE[$value] . "\n";
	}

	function set_name($value, $name)
	{
		setcookie($name, $value, time() + (86400 * 30), "/");
	}
	
	function del_name($value, $name)
	{
			setcookie($name, $navalueme, time() - ((86400 * 30) * 2), "/");
	}

	if ($_GET['action'] && $_GET["name"])
	{
		$action = $_GET["action"];
		$name = $_GET["name"];
	}

	if ($action)
	{
		if (isset($_GET["value"]))
			$value = $_GET["value"];
		if (strtolower($action) == "get" && $name)
			get_name($name);
		if (strtolower($action) == "set" && $name && $value)
			set_name($value, $name);
		if (strtolower($action) == "del" && $name && $value)
			del_name($value, $name);
	}
?>