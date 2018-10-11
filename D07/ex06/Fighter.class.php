<?php

	class Fighter
	{
		private $name;	
		public static $verbose = false;

		public function __destruct()
		{
			if (Self::$verbose)
				print ($this . " destructed." . PHP_EOL);
		}

		public function __construct($name)
		{
			$this->name = $name;
			if (Self::$verbose)
				print ($this . " constructed." . PHP_EOL);
		}
		public function getName()
		{
			return $this->name;
		}
	}

?>