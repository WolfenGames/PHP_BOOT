#!/usr/bin/php
<?php
	function ft_is_sort($tab)
	{
		$unsort = $tab;
		sort($tab);
		return ($unsort == $tab);
	}
?>