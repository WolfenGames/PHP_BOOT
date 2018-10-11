<?php

	class Game
	{
		public static $verbose = false;

		private $_width = 150;
		private $_height = 100;
		

		public function doc()
		{
			return get_file_contents("./Game.doc.txt");
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