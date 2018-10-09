<?php
	require_once("Vertex.class.php");
	class Vector
	{
		public static $verbose = FALSE;
		
		public static function doc()
		{
			return file_get_contents("./Vector.doc.txt");
		}

		private $_x;
		private $_y;
		private $_z;
		private $_w;

		function __construct($args)
		{
			if (isset($args['dest']) && $args['dest'] instanceof Vertex)
			{
				if (isset($args['orig']) && $args['orig'] instanceof Vertex)
					$ori = $args['orig'];
				else
					$ori = new Vertex(array("x" => 0, "y" => 0, "z" => 0, "w" => 1));
				$this->_x = $args['dest']->get_x() - $ori->get_x();
				$this->_y = $args['dest']->get_y() - $ori->get_y();
				$this->_z = $args['dest']->get_z() - $ori->get_z();
				$this->_w = 0;
			}
			if (Vector::$verbose == TRUE)
				print ($this . " constructed" . PHP_EOL);
		}

		function __destruct()
		{
			if (Vector::$verbose == TRUE)
				print ($this . " destructed" . PHP_EOL);
		}

		public function magnitude() : float
		{
			return sqrt(
					($this->get_x() * $this->get_x()) +
					($this->get_y() * $this->get_y()) +
					($this->get_z() * $this->get_z())
				);
		}

		public function normalize()
		{
			$val = $this->magnitude();
			if ($val == 0)
				return clone $this;
			return ($this->scalarProduct(1 / $val));
		}

		public function add( Vector $v )
		{
			return new Vector(
				array(
					"dest" => new Vertex ( array(
						"x" => $this->get_x() + $v->get_x(),
						"y" => $this->get_y() + $v->get_y(),
						"z" => $this->get_z() + $v->get_z()
					))));
		}

		public function sub( Vector $v )
		{
			return new Vector(
				array(
					"dest" =>  new Vertex (array(
						"x" => $this->get_x() - $v->get_x(),
						"y" => $this->get_y() - $v->get_y(),
						"z" => $this->get_z() - $v->get_z()
					))));
		}

		public function opposite()
		{
			return new Vector(
				array(
					"dest" => new Vertex (array(
						"x" => $this->get_x() * -1,
						"y" => $this->get_y() * -1,
						"z" => $this->get_z() * -1
					))));
		}

		public function scalarProduct($k)
		{
			return new Vector(
				array(
					"dest" => new Vertex (array(
						"x" => $this->get_x() * $k,
						"y" => $this->get_y() * $k,
						"z" => $this->get_z() * $k
					))));
		}

		public function dotProduct( Vector $v)
		{
			return (float)(($this->get_x() * $v->get_x()) +
							($this->get_y() * $v->get_y()) +
							($this->get_z() * $v->get_z()));
		}

		public function crossProduct(Vector $v)
        {
            return new Vector(array('dest' => new Vertex(array(
                'x' => ($this->_y * $v->get_z()) - ($this->_z * $v->get_y()),
                'y' => ($this->_z * $v->get_x()) - ($this->_x * $v->get_z()),
                'z' => ($this->_x * $v->get_y()) - ($this->_y * $v->get_x())
            ))));
		}
		
		public function cos(Vector $v)
        {
            return (Vector::dotProduct($v) / sqrt((($this->get_x() * $this->get_x()) + ($this->get_y() * $this->get_y()) + ($this->get_z() * $this->get_z())) * (($v->get_x() * $v->get_x()) + ($v->get_y() * $v->get_y()) + ($v->get_z() * $v->get_z()))));
        }

		function __toString()
		{
			return (
					sprintf("Vector( x: %.2f, y: %.2f, z: %.2f, w: %.2f )", 
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
	}

?>