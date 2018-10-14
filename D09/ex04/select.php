<?php
	if (file_exists("list.csv"))
	{
		$data = unserialize(file_get_contents("list.csv"));
		foreach ($data as $key => $val)
		{
			echo "<h1 id='".$val['id']."' onclick='del(".$val['id'].")'>".$val['value']."</h1><br />";
		}
	}else
		echo "<h1>No file found</h1><br />";
?>