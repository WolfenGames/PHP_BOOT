<?php

	class Weapon
	{
		public static $verbose = false;

		

		public function doc()
		{
			return get_file_contents("./Weapon.doc.txt");
		}

		function __constructor()
		{
				if (Self::$verbose == TRUE)
				print ($this . " constructed." . PHP_EOL);
		}

		function __destructor()
		{
			if (Self::$verbose == FALSE)
				print ($this . " destructed." . PHP_EOL);	
		}
	}

?>