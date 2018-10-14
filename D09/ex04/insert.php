<?php

	function get_max($dat)
	{
		$ret = -1;
		foreach($dat as $key => $val)
		{
			if ($val['id'] > $ret)
				$ret = $val['id'];
		}
		return ($ret);
	}

	if (isset($_GET['data']))
	{
		if (file_exists("list.csv"))
		{
			$data = unserialize(file_get_contents("list.csv"));
			if (empty($data))
				$tmp['id'] = 0;
			else
				$tmp['id'] = get_max($data) + 1;
			$tmp['value'] = $_GET['data'];
			$data[] = $tmp;
			file_put_contents("list.csv", serialize($data));
		}
	}else
	{
		echo "Eish?";
	}

?>