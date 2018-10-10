<?php
	require_once("Vertex.class.php");
    class Triangle
    {
        static $verbose = false;
        private $_a;
        private $_b;
        private $_c;

        public function __construct($a, $b, $c)
        {
            if ($a instanceof Vertex && $b instanceof Vertex && $c instanceof Vertex) {
                $this->_a = $a;
                $this->_b = $b;
                $this->_c = $c;
            } else {
                $this->__destruct();
            }
        }
        
        function __destruct()
        {
            if (Triangle::$verbose)
      				print ($this . " destructed" . PHP_EOL);
        }
        function __toString()
        {
            if (Triangle::$verbose)
                return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) )", array($this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue)));
            return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
        }

        public static function doc()
    		{
    			return file_get_contents("./Vector.doc.txt");
    		}

        public function get_a()
        {
            return $this->_a;
        }

        public function get_b()
        {
            return $this->_b;
        }

        public function get_c()
        {
            return $this->_c;
        }
    }
