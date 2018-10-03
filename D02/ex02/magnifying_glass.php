#!/usr/bin/php
<?php
	if ($argc == 2)
	{
		$fn = $argv[1];
		if (!is_readable($fn))
		{
			echo "Can't open file\n";
			exit();
		}
		$info = file_get_contents($fn);
		echo $info . "\n";
	}
	else
		echo "No information to work with\n";
?>