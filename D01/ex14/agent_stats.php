#!/usr/bin/php
<?php
	$file = fopen("php://stdin", "r");
	while ($input = fgetcsv($file, 0, ";"))
	{
		$uinfo[$input[0]] = $input[1];
		$minfo[$input[2]] = $input[3];
	}
	var_dump($uinfo);
	var_export($minfo);
	if ($argc == 1)
	{
		$opt = $argv[1];
		if ($opt == "Average")
		{
			foreach ($uinfo as $val)
				$ret[$uinfo] += $val;
		}
	}
?>