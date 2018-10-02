#!/usr/bin/php
<?php
	if ($argc == 1)
	{
		$stat = $argv[1];
		if ($stat == "Why this demo ?")
			echo "To avoid people noticing this while going over";
		
		if ($stat == "Why this song ?")
		echo "Because we're all children inside";
	
		if ($stat == "really ?")
		{
			$i = rand(0, 1);
			if ($i == 0)
				echo "No it's because it's april's fool";
			else
				echo "Yeah we really are all children inside";
		}
	}
?>