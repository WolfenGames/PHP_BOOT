#!/usr/bin/php
<?php
	date_default_timezone_set('Europe/Paris');

    $month = array(
        1 => "janvier",
        2 => "février",
        3 => "mars",
        4 => "avril",
        5 => "mai",
        6 => "juin",
        7 => "juillet",
        8 => "août",
        9 => "septembre",
        10 => "octobre",
        11 => "novembre",
		12 => "décembre");
		
    $week = array(
        1 => "lundi",
        2 => "mardi",
        3 => "mercredi",
        4 => "jeudi",
        5 => "vendredi",
        6 => "samedi",
        7 => "dimanche");

	function ft_split($str)
	{
		$ret = array_filter(preg_split('/\s+/', $str));
		return ($ret);
	}
	if ($argc == 2)
	{
		$split = ft_split(trim($argv[1], " "));
		if (count($split) == 5)
		{
			// dotw = Day of the Week;
			// notd = Name of the Day;
			$dotw = $split[1];
			$notd = array_search(lcfirst($split[0]), $week);
			$mnth = array_search(lcfirst($split[2]), $month);
			if ($mnth == FALSE || $notd == FALSE)
			{
				echo "Wrong Format\n";
				exit();
			}
			$year = $split[3];
			$time = $split[4];
			if (!preg_match('/^(?:[2][0-4]|[01][1-9]|10):([0-5][0-9]):([0-5][0-9])$/', $time))
			{
				"Wrong Format\n";
				exit();
			}
			$split_time = preg_split("/:/", $time);
			echo mktime($split_time[0], $split_time[1], $split_time[2], $mnth, $dotw, $year) . "\n";
		}else
			echo "Wrong Format\n";
	}
?>