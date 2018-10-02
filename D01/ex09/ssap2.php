#!/usr/bin/php
<?php
	function cmp_type($s)
	{
		$s = ord($s);
		if ($s >= ord('a') && $s <= ord('z'))
			return (0);
		else if ($s >= ord('0') && $s <= ord('9'))
			return (1);
		return (2);
	}
	function ssap_cmp($a, $b)
	{
		$a = strtolower($a);
		$b = strtolower($b);
		$len = min(strlen($a), strlen($b));
		for ($i = 0; $i < $len; $i++)
		{
			if (($tmp = cmp_type($a[$i]) - cmp_type($b[$i])) != 0)
				return ($tmp);
			else if (($tmp = ord($a[$i]) - ord($b[$i])) != 0)
				return ($tmp);
		}
		return (strlen($a) - strlen($b));
	}
    $arr = array();
    unset($argv[0]);
    foreach ($argv as $val) {
		if (trim($val))
		{
			$temp = preg_split('/\s+/', trim($val));
			foreach ($temp as $key) {
				$arr[] = $key;
			}
			usort($arr, ssap_cmp);
		}
    }
    foreach ($arr as $val) {
        echo $val."\n";
    }
?>