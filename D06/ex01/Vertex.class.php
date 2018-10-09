<?php
	require_once("Color.class.php");
	class Vertex{
		public static $verbose = False;

		private $_x;
		private $_y;
		private $_z;
		private $_w = 1.0;
		private $_color;

		public static function doc()
		{
			return file_get_contents("./Vertex.doc.txt");
		}

		function __construct(array $args)
		{
			if (array_key_exists("x", $args))
				$this->_x = $args['x'];
			if (array_key_exists("y", $args))
				$this->_y = $args['y'];
			if (array_key_exists("z", $args))
				$this->_z = $args['z'];
			if (array_key_exists("w", $args))
				$this->_w = $args['w'];
			if (array_key_exists("color", $args) instanceof Color)
				$this->_color = $args['color'];
			else
				$this->_color = new Color( array("red" => 255, "green" => 255, "blue" => 255));
			if (Vertex::$verbose == TRUE)
				print ($this . " constructed." . PHP_EOL);
			return ;
		}

		function __destruct()
		{
			if (Vertex::$verbose == TRUE)
				print ($this . " destructed." . PHP_EOL);
		}

		function invalid()
		{
			print("Invalid Args");
			exit(1);
		}

		function __toString()
		{
			if (Vertex::$verbose)
				return (sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f, %s )",
						$this->_x, $this->_y, $this->_z, $this->_w, $this->_color));
			else
				return (sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f )",
						$this->_x, $this->_y, $this->_z, $this->_w));
		}

		function get_x()
		{
			return $this->_x;
		}

		function get_y()
		{
			return $this->_y;
		}

		function get_z()
		{
			return $this->_z;
		}

		function get_w()
		{
			return $this->_w;
		}
		
		function get_color()
		{
			return $this->_color;
		}

		function set_x($v)
		{
			$this->_x = $v;
		}

		function set_y($v)
		{
			$this->_y = $v;
		}

		function set_z($v)
		{
			$this->_z = $v;
		}

		function set_w($v)
		{
			$this->_w = $v;
		}
		
		function set_color( Color $c )
		{
			$this->_color = $c;
		}

		public function add( Vertex $v ) {
			return new Vertex( array( "x" => $this->_x + $v->get_x(),
									"y" => $this->_y + $v->get_y(),
									"z" => $this->_z + $v->get_z(),
									"w" => $this->_w + $v->get_w()) );
		}
		public function sub( Vertex $v ) {
			return new Vertex( array( "x" => $this->_x - $v->get_x(),
									"y" => $this->_y - $v->get_y(),
									"z" => $this->_z - $v->get_z(),
									"w" => $this->_w - $v->get_w()) );
		}
		public function mult( $v ) {
			return new Vertex( array( "x" => $this->_x * $v,
									"y" => $this->_y * $v,
									"z" => $this->_z * $v,
									"w" => $this->_w * $v) );
		}
	}

?>