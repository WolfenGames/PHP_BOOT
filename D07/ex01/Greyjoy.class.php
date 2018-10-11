<?php

	Class Greyjoy
	{
		public static $verbose = false;

		protected $familyMotto = "We do not sow";
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
	}

?>