#!/usr/bin/php
<?php
	$file = fopen("php://stdin", "r");
	$i = 0;
	while ($input = fgetcsv($file, 0, ";"))
	{
		if (!$arr[$input[0]])
			$arr[$input[0]] = [0, 0, 0];
		if ($input[2] == "moulinette")
			$arr[$input[0]][2] = $input[1];
		else
		{
			if (is_numeric($input[1]))
			{
				$arr[$input[0]][0] += $input[1];
				$arr[$input[0]][1]++;
			}
		}
	}
	unset($arr["User"]);
	ksort($arr);
	if ($argc == 2)
	{
		$opt = $argv[1];
		if ($opt == "average_user")
		{
			foreach ($arr as $key => $val)
				echo  $key . ":" . $val[0] / $val[1] . "\n";
		}
		if ($opt == "average")
		{
			$avg = 0;
			$tot = 0;
			foreach ($arr as $key => $val)
			{
				$tot += $val[1];
				$avg += $val[0];
			}
			echo $avg / $tot . "\n";
		}
		if ($opt == "moulinette_variance")
		{
			foreach ($arr as $key => $val)
				echo  $key . ":" . (($val[0] / $val[1]) - $val[2]) . "\n";
		}
	}
?>