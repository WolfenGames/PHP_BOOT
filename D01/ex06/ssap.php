#!/usr/bin/php
<?php
	unset($argv[0]);
	foreach ($argv as $av)
	{
		$temp = array_filter(explode(' ', trim($av, " ")));
		foreach ($temp as $key)
			$arr[] = $key;
		sort($arr);
	}
	foreach ($arr as $key)
		echo $key . "\n";
?>