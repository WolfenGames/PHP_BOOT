#!/usr/bin/php
<?php
	date_default_timezone_set("Africa/Johannesburg");
	$file = fopen("/var/run/utmpx", "r");
	while	($in = fread($file, 628))
	{
		$info = unpack("a256user/a4id/a32line/ipid/itype/I2time", $in);
		if	($info["type"] == 7)
			$ret[] = $info;
	}
	fclose($file);
	$len = 0;
	foreach ($ret as $result)
		if	(count(substr($result["user"], 0, strpos($result["user"], 0))) > $len)
			$len = strlen(substr($result["user"], 0, strpos($result["user"], 0)));

	$len = max($len + 3 - ($len % 3), 9);

	foreach ($ret as $result)
	{
		echo str_pad(substr($result["user"], 0, strpos($result["user"], 0)), $len);
		echo substr($result["line"], 0, strpos($result["line"], 0))."  ";
		echo date("M  j h:i", $result["time1"])." \n";
	}
?>