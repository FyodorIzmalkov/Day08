<?php

class Map{
	public $map = array();

	public function __construct(){
		for ($i = 0; $i < 150; $i++){
			for($j = 0; $j < 100; $j++)
				$this->map[$i][$j] = '.';
		}
	}

	public function printMap(){
		for ($i = 0; $i < 150; $i++){
			for($j = 0; $j < 100; $j++){
				echo $this->map[$i][$j];
			}
			echo "<br>";
		}
	}

	public function addShip(Frigate $ship)
	{
		if ($ship->player == 1)
		{
			$i = 0;
			while ($this->map[$i][0] != '.' && $i < 150)
				$i += 2;
			if ($i < 150)
			{
				$j = 0;
				while ($j < $ship->size[1])
				{
					$this->map[$i][$j] = '1';
					$j++;
				}
			}
		}
		else if ($ship->player == 2)
		{
			$i = 149;
			while ($this->map[$i][99] != '.' && $i >= 0)
				$i -= 2;
			if ($i >= 0)
			{
				$j = 99;
				while ($j > 99 - $ship->size[1])
				{
					$this->map[$i][$j] = '2';
					$j--;
				}
			}
		}
	}
}

class Frigate{
	private $hullPoints;
	public $size = array();
	private $PP;
	private $speed;
	private $handling;
	private $shield;
	private $weaponsName;
	public $player;

	public function __construct( $player_number ){
		$this->hullPoints = 5;
		$this->size[0] = 1;
		$this->size[1] = 4;
		$this->PP = 10;
		$this->speed = 15;
		$this->handling = 4;
		$this->shield = 0;
		$this->weaponsName = "Side laser batteries";
		$this->player = $player_number;
	}
}

class BattleField{

	public function addShip(Frigate $ship)
	{

	}
}

$map = new Map();
$frigate1 = new Frigate(1);
$frigate2 = new Frigate(2);
$frigate3 = new Frigate(1);
$frigate4 = new Frigate(2);
$map->addShip($frigate1);
$map->addShip($frigate2);
$map->addShip($frigate3);
$map->addShip($frigate2);
$map->printMap();