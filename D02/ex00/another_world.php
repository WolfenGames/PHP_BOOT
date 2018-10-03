#!/usr/bin/php
<?php
	if ($argc > 1)
	{
		$string = trim($argv[1], " ");
		echo preg_replace('/[ \t\r]+/', " ", $string) ."\n";
	}
?>