#!/usr/bin/php
<?php
	function ft_split($str)
	{
		$str = trim($str, " ");
		$ret = preg_split('/\s+/', $str);
		return ($ret);
	}
	$split = ft_split(trim($argv[1], " "));
	for ($x = 0; x < count($split); $x++)
	{
		echo $split[$x];
		if ($x < count($split) - 1)
			echo " ";
		if ($x == count($split))
		{
			echo "\n";
			break ;
		}
	} 
?>