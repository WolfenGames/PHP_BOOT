#!/usr/bin/php
<?php
	$search = $argv[1];
	unset($argv[0]);
	unset($argv[1]);
	
	foreach ($argv as $key)
	{
		$expl = explode(":", $key);
		$ret[$expl[0]] = $expl[1];
	}

	$ans = $ret[$search];

	echo $ans . "\n";
?>