#!/usr/bin/php
<?php
	function	is_valid($top, $in)
	{
		for ($i = 0; $top[$i]; $i++)
		{
			if ($top[$i] == $in)
				return ($i);
		}
		return (-1);
	}
	if ($argc == 3)
	{
		if ($file = @fopen($argv[1], "r"))
		{
			$top = fgetcsv($file, 0, ";");
			if (($i = is_valid($top, $argv[2])) != -1)
			{
				while ($in = fgetcsv($file, 0, ";"))
				{
					$name[$in[$i]] = $in[0];
					$surname[$in[$i]] = $in[1];
					$email[$in[$i]] = $in[2];
					$IP[$in[$i]] = $in[3];
					$pseudo[$in[$i]] = $in[4];
				}
				$stdin = fopen("PHP://stdin", "r");
				while (1)
				{
					echo "Enter a command : ";
					$input = fgets($stdin);
					$input = substr($input, 0, -1);
					if (!$input)
					{
						echo "\n";
						break;
					}
					try
					{
						eval($input);
					}
					catch (ParseError $t)
					{
						echo "Parse error " . $t->getMessage() . " in " . $t->getFile() . " on line " . $t->getLine() . PHP_EOL;
					}
					echo "\n";
				}
			}
			fclose($file);
		}
	}
?>