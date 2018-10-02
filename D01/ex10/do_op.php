#!/usr/bin/php
<?php
	unset($argv[0]);
	function	add($a, $b)
	{
		return ($a + $b);
	}

	function	minus($a, $b)
	{
		return ($a - $b);
	}

	function	mult($a, $b)
	{
		return ($a * $b);
	}

	function	divide($a, $b)
	{
		return ($a / $b);
	}

	function	mod($a, $b)
	{
		return ($a % $b);
	}

	if ($argc == 4)
	{
		$argv[2] = trim($argv[2], " ");
		if ($argv[2] == "+")
			echo add(trim($argv[1], " \t"), trim($argv[3], " \t")) . "\n";
		if ($argv[2] == "-")
			echo minus(trim($argv[1], " \t"), trim($argv[3], " \t")) . "\n";
		if ($argv[2] == "*")
			echo mult(trim($argv[1], " \t"), trim($argv[3], " \t")) . "\n";
		if ($argv[2] == "/")
			echo divide(trim($argv[1], " \t"), trim($argv[3], " \t")) . "\n";
		if ($argv[2] == "%")
			echo mod(trim($argv[1], " \t"), trim($argv[3], " \t")) . "\n";
	}else
		echo "Incorrect Parameters\n";
?>