<?php
	class NightWatch implements IFighter
	{
		private $soldier = array();

		public function recruit($s)
		{
			$this->soldier[] = $s;
		}

		function fight()
		{
			foreach($soldier as $minion)
			{
				if (method_exists($minion, "fight"))
					$minion->fight();
			}
		}
	}
?>