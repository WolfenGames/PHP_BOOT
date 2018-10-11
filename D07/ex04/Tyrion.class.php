<?php

	class Tyrion extends Lannister
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

		public function sleepWith($a)
		{
			if ($a instanceof Jaime || $a instanceof Cersei)
				print("Not event if I'm drunk !" .PHP_EOL);
			if ($a instanceof Sansa)
				print("Let's do this." .PHP_EOL);
		}
	}

?>