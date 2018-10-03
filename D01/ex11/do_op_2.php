#!/usr/bin/php
<?php
	unset($argv[0]);
	function	add($a, $b)
	{
		if (is_numeric($a) && is_numeric($b))
			return ($a + $b);
		else	
			return (0);
	}

	function	minus($a, $b)
	{
		if (is_numeric($a) && is_numeric($b))
			return ($a - $b);
		else	
			return (0);
	}

	function	mult($a, $b)
	{
		if (is_numeric($a) && is_numeric($b))
			return ($a * $b);
		else	
			return (0);
	}

	function	divide($a, $b)
	{
		if (is_numeric($a) && is_numeric($b))
			return ($a / $b);
		else	
			return (0);
	}

	function	mod($a, $b)
	{
		if (is_numeric($a) && is_numeric($b))
			return ($a % $b);
		else	
			return (0);
	}

	function ft_split($str)
	{
		$i = 0;
		$sign = NULL;
		while ($str[$i])
		{
			if (ord($str[$i]) == ord("+") || ord($str[$i]) == ord("-") || ord($str[$i]) == ord("*") ||
				ord($str[$i]) == ord("/") || ord($str[$i]) == ord("%"))
			{
				echo "Found Sign";
				$sign = $str[$i];
				break ;
			}
			$i++;
		}
		var_dump($sign);
		$ret = array_filter(preg_split('/\s+/', $str));
		var_dump($ret);
		if (count($ret) != 3)
		{
			$ret2 = explode($sign, $str);
			var_dump($ret2);
			$hold = $ret2[1];
			$ret2[1] = $sign;
			$ret2[2] = $hold;
			return ($ret2);
		}
		var_dump($ret);
		return ($ret);
	}
	if ($argc == 2)
	{
		$split = ft_split(trim($argv[1], " \t"));
		if (is_numeric($split[0]) && is_numeric($split[2]))
		{
			if ($split[1] == "+")
				echo add(trim($split[0], " \t"), trim($split[2], " \t")) . "\n";
			else if ($split[1] == "-")
				echo minus(trim($split[0], " \t"), trim($split[2], " \t")) . "\n";
			else if ($split[1] == "*")
				echo mult(trim($argv[0], " \t"), trim($split[2], " \t")) . "\n";
			else if ($split[1] == "/")
				echo divide(trim($split[0], " \t"), trim($split[2], " \t")) . "\n";
			else if ($split[1] == "%")
				echo mod(trim($split[0], " \t"), trim($split[2], " \t")) . "\n";
			else
				echo "Syntax Error\n";
		}
		else
			echo "Syntax Error\n";
	}else
		echo "Incorrect Parameters\n";
?>