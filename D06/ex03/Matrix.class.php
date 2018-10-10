<?php
	require_once("Vertex.class.php");
	require_once("Vector.class.php");
	class Matrix
	{
		const IDENTITY = "IDENTITY";
		const SCALE = "SCALE";
		const RX = "Ox ROTATION";
		const RY = "Oy ROTATION";
		const RZ = "Oz ROTATION";
		const TRANSLATION = "TRANSLATION";
		const PROJECTION = "PROJECTION";

		protected $mat = array();
		private $_preset;
		private $_scale;
		private $_angle;
		private $_vtc;
		private $_fov;
		private $_ratio;
		private $_near;
		private $_far;
		static $verbose = false;

		public static function doc()
		{
			return file_get_contents("./Matrix.doc.txt");
		}

		public function __construct($array = null)
		{
			if (isset($array)) {
				if (isset($array['preset']))
					$this->_preset = $array['preset'];
				if (isset($array['scale']))
					$this->_scale = $array['scale'];
				if (isset($array['angle']))
					$this->_angle = $array['angle'];
				if (isset($array['vtc']))
					$this->_vtc = $array['vtc'];
				if (isset($array['fov']))
					$this->_fov = $array['fov'];
				if (isset($array['ratio']))
					$this->_ratio = $array['ratio'];
				if (isset($array['near']))
					$this->_near = $array['near'];
				if (isset($array['far']))
					$this->_far = $array['far'];
				$this->check();
				$this->createMatrix();
				if (Matrix::$verbose) {
					if ($this->_preset == Matrix::IDENTITY)
						echo "Matrix " . $this->_preset . " instance constructed\n";
					else
						echo "Matrix " . $this->_preset . " preset instance constructed\n";
				}
				$this->do_da_thing();
			}
		}

		private function do_da_thing()
		{
			switch ($this->_preset) {
				case (Matrix::IDENTITY) :
					$this->identity(1);
					break;
				case (Matrix::TRANSLATION) :
					$this->translation();
					break;
				case (Matrix::SCALE) :
					$this->identity($this->_scale);
					break;
				case (Matrix::RX) :
					$this->rotation_x();
					break;
				case (Matrix::RY) :
					$this->rotation_y();
					break;
				case (Matrix::RZ) :
					$this->rotation_z();
					break;
				case (Matrix::PROJECTION) :
					$this->projection();
					break;
			}
		}

		private function createMatrix()
		{
			for ($i = 0; $i < 16; $i++) {
				$this->mat[$i] = 0;
			}
		}

		private function identity($scale)
		{
			$this->mat[0] = $scale;
			$this->mat[5] = $scale;
			$this->mat[10] = $scale;
			$this->mat[15] = 1;
		}

		private function translation()
		{
			$this->identity(1);
			$this->mat[3] = $this->_vtc->get_x();
			$this->mat[7] = $this->_vtc->get_y();
			$this->mat[11] = $this->_vtc->get_z();
		}

		private function rotation_x()
		{
			$this->identity(1);
			$this->mat[0] = 1;
			$this->mat[5] = cos($this->_angle);
			$this->mat[6] = -sin($this->_angle);
			$this->mat[9] = sin($this->_angle);
			$this->mat[10] = cos($this->_angle);
		}

		private function rotation_y()
		{
			$this->identity(1);
			$this->mat[0] = cos($this->_angle);
			$this->mat[2] = sin($this->_angle);
			$this->mat[5] = 1;
			$this->mat[8] = -sin($this->_angle);
			$this->mat[10] = cos($this->_angle);
		}

		private function rotation_z()
		{
			$this->identity(1);
			$this->mat[0] = cos($this->_angle);
			$this->mat[1] = -sin($this->_angle);
			$this->mat[4] = sin($this->_angle);
			$this->mat[5] = cos($this->_angle);
			$this->mat[10] = 1;
		}

		private function projection()
		{
			$this->identity(1);
			$this->mat[5] = 1 / tan(0.5 * deg2rad($this->_fov));
			$this->mat[0] = $this->mat[5] / $this->_ratio;
			$this->mat[10] = -1 * (-$this->_near - $this->_far) / ($this->_near - $this->_far);
			$this->mat[14] = -1;
			$this->mat[11] = (2 * $this->_near * $this->_far) / ($this->_near - $this->_far);
			$this->mat[15] = 0;
		}

		private function check()
		{
			if (empty($this->_preset))
				return "error";
			if ($this->_preset == Matrix::SCALE && empty($this->_scale))
				return "error";
			if (($this->_preset == Matrix::RX || $this->_preset == Matrix::RY || $this->_preset == Matrix::RZ) && empty($this->_angle))
				return "error";
			if ($this->_preset == Matrix::TRANSLATION && empty($this->_vtc))
				return "error";
			if ($this->_preset == Matrix::PROJECTION && (empty($this->_fov) || empty($this->_radio) || empty($this->_near) || empty($this->_far)))
				return "error";
		}

		public function mult(Matrix $v)
		{
			$tmp = array();
			for ($i = 0; $i < 16; $i += 4) {
				for ($j = 0; $j < 4; $j++) {
					$tmp[$i + $j] = 0;
					$tmp[$i + $j] += $this->mat[$i + 0] * $v->mat[$j + 0];
					$tmp[$i + $j] += $this->mat[$i + 1] * $v->mat[$j + 4];
					$tmp[$i + $j] += $this->mat[$i + 2] * $v->mat[$j + 8];
					$tmp[$i + $j] += $this->mat[$i + 3] * $v->mat[$j + 12];
				}
			}
			$matrice = new Matrix();
			$matrice->mat = $tmp;
			return $matrice;
		}

		public function transformVertex(Vertex $vtx)
		{
			$tmp = array();
			$tmp['x'] = ($vtx->get_x() * $this->mat[0]) + ($vtx->get_y() * $this->mat[1]) + ($vtx->get_z() * $this->mat[2]) + ($vtx->get_w() * $this->mat[3]);
			$tmp['y'] = ($vtx->get_x() * $this->mat[4]) + ($vtx->get_y() * $this->mat[5]) + ($vtx->get_z() * $this->mat[6]) + ($vtx->get_w() * $this->mat[7]);
			$tmp['z'] = ($vtx->get_x() * $this->mat[8]) + ($vtx->get_y() * $this->mat[9]) + ($vtx->get_z() * $this->mat[10]) + ($vtx->get_w() * $this->mat[11]);
			$tmp['w'] = ($vtx->get_x() * $this->mat[11]) + ($vtx->get_y() * $this->mat[13]) + ($vtx->get_z() * $this->mat[14]) + ($vtx->get_w() * $this->mat[15]);
			$tmp['color'] = $vtx->get_color();
			$vertex = new Vertex($tmp);
			return $vertex;
		}

		function __destruct()
		{
			if (Matrix::$verbose)
					print ("Matrix instance destructed" . PHP_EOL);
		}

		function __toString()
		{
			$tmp = "M | vtcX | vtcY | vtcZ | vtxO\n";
			$tmp .= "-----------------------------\n";
			$tmp .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
			$tmp .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
			$tmp .= "z | %0.2f | %0.2f | %0.2f | %0.2f\n";
			$tmp .= "w | %0.2f | %0.2f | %0.2f | %0.2f";
			return (vsprintf($tmp, array($this->mat[0], $this->mat[1], $this->mat[2], $this->mat[3],
								$this->mat[4], $this->mat[5], $this->mat[6], $this->mat[7],
								$this->mat[8],$this->mat[9], $this->mat[10], $this->mat[11],
								$this->mat[12], $this->mat[13], $this->mat[14], $this->mat[15])));
		}
	}
?>
