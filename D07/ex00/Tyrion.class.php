<?php

class Tyrion extends Lanister
{
	public function __constructor()
	{
		parent::__constructor();
		print("My name is Tyrion.". PHP_EOL);
	}

	public function getSize()
	{
		print("Short");
	}
}

?>