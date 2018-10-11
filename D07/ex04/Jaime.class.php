<?php

	class Jaime extends Lannister
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
			if ($a instanceof Tyrion)
				print("Not event if I'm drunk !" .PHP_EOL);
			else if ($a instanceof Sansa)
				print("Let's do this." .PHP_EOL);
			else if ($a instanceof Cersei)
				print("With pleasure, but only in a tower in Winterfell, them." .PHP_EOL);
		}
	}
?>