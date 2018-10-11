<?php

	class Ship
	{
		public static $verbose = false;
		private $_name;
		private $_size = array();
		private $_shape;
		private $_hullPoints;
		private $_pp;
		private $_speed;
		private $_handling;
		private $_bouclier;
		private $_weapons;

		public function doc()
		{
			return get_file_contents("./Ship.doc.txt");
		}

		function __constructor(array $array)
		{
			if (array_key_exists("Name", $array))
				$_name = $array['Name'];
			if (array_key_exists("Size", $array) && $array['Size'] instanceof Size)
				$_size = $array['Size'];
			if (array_key_exists("Shape", $array) && $array['Shape'] instanceof Shape)
				$_shape = $array['Shape'];
			if (array_key_exists("HullPoints", $array))
				$_hullPoints = $array['HullPoints'];
			if (array_key_exists("PP", $array))
				$_pp = $array['PP'];
			if (array_key_exists("Speed", $array))
				$_speed = $array['Speed'];
			if (array_key_exists("Handling", $array))
				$_handling = $array['Handling'];
			if (array_key_exists("Bouclier", $array))
				$_bouclier = $array['Bouclier'];
			if (array_key_exists("Weapons", $array) && $array['Weapons'] instanceof Weapons)
				$_weapons = $array['Weapons'];
			if (Self::$verbose == TRUE)
				print ($this . " constructed." . PHP_EOL);
		}
		
		function __destructed()
		{
			if (Self::$verbose == FALSE)
				print ($this . " destructed." . PHP_EOL);	
		}
	}

?>