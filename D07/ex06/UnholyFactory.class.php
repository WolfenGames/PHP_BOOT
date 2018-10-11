<?php

	class UnholyFactory
	{
		private $minion = array();

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

		public function absorb($s)
		{
			if (get_parent_class($s)) {
				if (isset($this->minion[$s->getName()])) {
					print("(Factory already absorbed a fighter of type " . $s->getName() . ")" . PHP_EOL);
				} else {
					print("(Factory absorbed a fighter of type " . $s->getName() . ")" . PHP_EOL);
					$this->minion[$s->getName()] = $s;
				}
			} else {
				print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
			}
		}
		public function fabricate($s)
		{
			if (array_key_exists($s, $this->minion)) {
				print("(Factory fabricates a fighter of type " . $s . ")" . PHP_EOL);
				return (clone $this->minion[$s]);
			}
			print("(Factory hasn't absorbed any fighter of type " . $s . ")" . PHP_EOL);
			return null;
		}
	}
?>