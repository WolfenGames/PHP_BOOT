<?php

	class Color{
		public static $verbose = False;

		var $red;
		var $blue;
		var $green;

		public static function doc()
		{
			return file_get_contents("./Color.doc.txt");
		}

		private static function limit_col($v)
		{
			if ($v > 255)
				$v = 255;
			if ($v < 0)
				$v = 0;
				return $v;
		}

		function __construct(array $args)
		{
			if (array_key_exists("rgb", $args))
			{
				$this->red = Color::limit_col($args['rgb']>>16);
				$this->blue = Color::limit_col($args['rgb']&255);
				$this->green = Color::limit_col($args['rgb']>>8&255);
			}
			else if (isset($args['red']) && isset($args['blue']) && isset($args['green']))
			{
				$this->red = Color::limit_col(intval($args['red'], 10));
				$this->blue = Color::limit_col(intval($args['blue'], 10));
				$this->green = Color::limit_col(intval($args['green'], 10));
			}
			else
				invalid();

			if (Color::$verbose == TRUE)
				print ($this . " constructed." . PHP_EOL);
		}

		function __destruct()
		{
			if (Color::$verbose == TRUE)
				print ($this . " destructed." . PHP_EOL);
		}

		function invalid()
		{
			print("Invalid Args");
			exit(1);
		}

		function __toString()
		{
			return (sprintf("Color( red: %3d, green: %3d, blue: %3d )", 
					$this->red, $this->green, $this->blue));
		}

		public function add( Color $v ) {
			return new Color( array( 'red' => $v->red + $this->red
									 , 'green' => $v->green + $this->green
									 , 'blue' => $v->blue + $this->blue ) );
		}
		public function sub( Color $v ) {
			return new Color( array( 'red' => $this->red - $v->red
									 , 'green' => $this->green - $v->green
									 , 'blue' => $this->blue - $v->blue ) );
		}
		public function mult( $v ) {
			return new Color( array( 'red' => $this->red * $v
									 , 'green' => $this->green * $v
									 , 'blue' => $this->blue * $v ) );
		}
	}

?>