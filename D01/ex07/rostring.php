#!/usr/bin/php
<?php
	function ft_split_unsorted($str)
	{
		$ret = array_filter(explode(' ', $str));
		return ($ret);
	}
	unset($argv[0]);
	$str = ft_split_unsorted($argv[1]);
	$i = 1;
	while ($str[$i])
	{
		echo $str[$i] . " ";
		$i++;
	}
	echo $str[0] . "\n";
?>