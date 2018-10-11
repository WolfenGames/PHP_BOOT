<?php
	class NightsWatch implements IFighter
	{
		private $soldier = array();
		public static $verbose = false;

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

		public function recruit($s)
		{
			$this->soldier[] = $s;
		}

		function fight()
		{
			foreach($this->soldier as $minion)
			{
				if (method_exists($minion, "fight"))
					$minion->fight();
			}
		}
	}
?>