#!/usr/bin/php
<?php

	function calc($str)
	{
		switch($str[3])
		{
			case "+":
				return $str[1] + $str[5];
			case "-":
				return $str[1] - $str[5];
			case "*":
				return $str[1] * $str[5];
			case "/":
				return $str[1] / $str[5];
			case "%":
				return $str[1] % $str[5];
		}
	}

	if ($argc == 2)
	{
		if (!preg_match("/^([+-]?[0-9]{1,})( +)?([+-\/%*])( +)?([+-]?[0-9]{1,})$/",trim($argv[1], " \t")))
			echo "Syntax Error\n";
		else
			echo preg_replace_callback("/^([+-]?[0-9]{1,})( +)?([+-\/%*])( +)?([+-]?[0-9]{1,})$/", calc, trim($argv[1], " \t")) . "\n";
	}
	else
		echo "Incorrect Parameters\n";
?>