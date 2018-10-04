#!/usr/bin/php
<?php

	function replace($str)
	{
		return ($str[1].strtoupper($str[2]).$str[3]);
	}

	function change($str)
	{
		$in = TRUE;
		for ($i = 0; $str[$i]; $i++)
		{
			if ($str[$i] == ">")
				$in = TRUE;
			if ($str[$i] == "<")
				$in = FALSE;
			if ($in)
				$ret .= ucfirst($str[$i]);
			else
				$ret .= $str[$i];
		}
		return $ret;
	}

	function replace_s($str)
	{
		return ($str[1].change($str[2]).$str[3]);
	}

	if ($argc == 2)
	{
		$fn = $argv[1];
		if (!is_readable($fn))
		{
			echo "Can't open file\n";
			exit();
		}
		$info = file_get_contents($fn);
		$info = preg_replace_callback('/(<.*title=\")(.*)(\".*>)/isU', replace, $info);
		$info = preg_replace_callback('/(<a.*>)(.*)(<\/a>)/Uis', replace_s, $info);
		echo $info;
	}
	else
		echo "No information to work with\n";
?>