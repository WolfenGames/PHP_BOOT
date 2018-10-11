<?php

	abstract class House
	{
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

		public function introduce()
		{
			print ("House " . $this->getHouseName() . " of " . $this->getHouseSeat() . ' : "' . $this->getHouseMotto() . '"' . PHP_EOL);	
		}

		abstract function getHouseName();
		abstract function getHouseMotto();
		abstract function getHouseSeat();
	}

?>