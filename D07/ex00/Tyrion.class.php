<?php

	class Tyrion extends Lannister
	{
		public static $verbose = false;
		public function __construct()
		{
			parent::__construct();
			print("My name is Tyrion.". PHP_EOL);
			if (Self::$verbose)
				print ($this . " constructed." . PHP_EOL);
		}

		public function __destruct()
		{
			if (Self::$verbose == TRUE)
				print ($this . " destructed." . PHP_EOL);
		}

		public function getSize()
		{
			print("Short");
		}
	}

?>