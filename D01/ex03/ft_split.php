#!/usr/bin/php
<?php
	function ft_split($str)
	{
		$str = trim($str, " ");
		$ret = preg_split('/\s+/', $str);
		return ($ret);
	}
?>