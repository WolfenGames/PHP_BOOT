#!/usr/bin/php
<?php
	function ft_split_unsorted($str)
	{
		$ret = preg_split('/\s+/', $str);
		return ($ret);
	}

	unset($argv[0]);
	$str = ft_split_unsorted(trim($argv[1], " "));
	$i = 1;
	while ($str[$i])
	{
		echo $str[$i] . " ";
		$i++;
	}
	echo $str[0] . "\n";
?>