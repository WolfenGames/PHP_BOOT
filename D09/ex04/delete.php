<?php
	if (file_exists("list.csv"))
	{
		$valtodel = $_GET['id'];
		$data = unserialize(file_get_contents("list.csv"));
		foreach ($data as $key => $val)
		{
			if ($val['id'] == $valtodel)
			{
				echo "Deleted";
				unset($data[$key]);
			}
		}
		file_put_contents("list.csv", serialize($data));
	}
?>