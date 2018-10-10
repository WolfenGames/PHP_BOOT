<?php
	require_once("Vertex.class.php");
    class Render
    {
        const VERTEX = 'vertex';
        const EDGE = 'edge';
        const RASTERIZE = 'rasterize';
        static $verbose = false;
        private $_width;
        private $_height;
        private $_filename;
        private $_image;
        public function __construct($width, $height, $filename)
        {
            $this->_height = $height;
            $this->_width = $width;
            $this->_filename = $filename;
            $this->_image = imagecreate((integer)$this->_width, (integer)$this->_height);
            imagecolorallocate($this->_image, 0, 0, 0);
            if (Render::$verbose)
      				print ($this . " constructed" . PHP_EOL);
        }
        public function renderVertex(Vertex $screenVertex)
        {
            $color = imagecolorallocate($this->_image, $screenVertex->get_color()()->red, $screenVertex->get_color()->green, $screenVertex->get_color()->blue);
            imagesetpixel($this->_image, $screenVertex->get_x() + $this->_width / 2, $screenVertex->get_y() + $this->_height / 2, $color);
        }
        public function renderEdge(Vertex $a, Vertex $b)
        {
            $color1 = imagecolorallocate($this->_image, $a->get_color()->red, $b->get_color()->green, $b->get_color()->blue);
            $color2 = imagecolorallocate($this->_image, $b->get_color()->red, $b->get_color()->green, $b->get_color()->blue);
            imagesetstyle($this->_image, array($color1, $color2));
            imageline($this->_image, $a->get_x() + $this->_width / 2, $a->get_y() + $this->_height / 2, $b->get_x() + $this->_width / 2, $b->get_y() + $this->_height / 2, IMG_COLOR_STYLED);
        }
        public function renderTriangle(Triangle $triangle, $mode)
        {
            $this->renderVertex($triangle->get_a()->opposite());
            $this->renderVertex($triangle->get_b()->opposite());
            $this->renderVertex($triangle->get_c()->opposite());
        }
        public function renderMesh($mesh, $mode)
        {
            if ($mode == Render::EDGE) {
                foreach ($mesh as $k => $triangle) {
                    $this->renderEdge($triangle[0], $triangle[1]);
                    $this->renderEdge($triangle[1], $triangle[2]);
                    $this->renderEdge($triangle[2], $triangle[0]);
                }
            } else {
                foreach ($mesh as $k => $triangle) {
                    $this->renderVertex($triangle[0]);
                    $this->renderVertex($triangle[1]);
                    $this->renderVertex($triangle[2]);
                }
            }
        }
        public function develop()
        {
            imagepng($this->_image, $this->_filename);
            imagedestroy($this->_image);
        }
        function __destruct()
        {
            if (Render::$verbose)
      				print ($this . " destructed" . PHP_EOL);
        }
        function __toString()
        {
            return ("I am the one and only render\n");
        }
        public static function doc()
        {
            return file_get_contents("./Render.doc.txt");
        }
    }
