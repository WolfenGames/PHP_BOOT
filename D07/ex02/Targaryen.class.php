<?php

Class Targaryen{

	public static $verbose = false;

	public function __construct()
	{
		if (Self::$verbose)
			print ($this . " constructed." . PHP_EOL);
	}

	public function __destruct()
	{
		if (Self::$verbose)
			print ($this . " destructed." . PHP_EOL);
	}

	public function getBurned()
	{
		if ($this->resistsFire())
			return "emerges maked but unharmed";
		return "burns alive";
	}

	public function resistsFire()
	{
		return false;
	}
}

?>