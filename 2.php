<?php
session_start();
class Map{
	public $map = array();

	public function __construct(){
		for ($i = 0; $i < 24; $i++){
			for($j = 0; $j < 24; $j++)
				$this->map[$i][$j] = '.';
		}
	}

	public function printMap(){
		for ($i = 0; $i < 24; $i++){
			for($j = 0; $j < 24; $j++){
				echo $this->map[$i][$j];
			}
			echo "\n";
		}
	}

	public function addShip(Frigate $ship)
	{
		if ($ship->player == 1)
		{
			$i = 0;
			while ($this->map[$i][0] != '.' && $i < 24)
				$i++;
			if ($i < 24)
			{
				$this->map[$i][0] = '1';
				$ship->row = $i;
				$ship->col = 0;
			}
		}
		else if ($ship->player == 2)
		{
			$i = 23;
			while ($this->map[$i][23] != '.' && $i >= 0)
				$i--;
			if ($i >= 0)
			{
				$this->map[$i][23] = '2';
				$ship->row = $i;
				$ship->col = 23;
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
	public $row;
	public $col;

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
$_SESSION['map'] = $map;
$_SESSION['ship_1'] = $frigate1;
// $mysqli = new mysqli('localhost', 'root', '', 'day08');
// if ($mysqli->connect_errno) {
//     printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
// 	exit();
// }
// $create_table= "CREATE TABLE IF NOT EXISTS map (
// 	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
// 	cell INT UNSIGNED NOT NULL DEFAULT 0
// 	)";
// $mysqli->query($create_table);
// $fill_map = "INSERT INTO map (cell)
// VALUES (0)";

// $check_fullines = "SELECT MAX(id) FROM map";
// $result = $mysqli->query($check_fullines);
// $row = mysqli_fetch_row($result);
// $highest_id = $row[0];
// if ($highest_id === 0){
// 	$map_cells = 24 * 24;
// 	for ($i = 0; $i <= $map_cells; $i++)
// 		$mysqli->query($fill_map);
// }
?>
<!DOCTYPE html>
<html>
<head>
<style>
	.table{
		width: auto;
		height: auto;
		border: 1px solid black;
		border-collapse: collapse;
		display: inline-block;
}
	td{
		border: 1px solid black;
			table-layout:fixed;
		width:45px;
		height: 45px;
		overflow:hidden;
		word-wrap:break-word;
	}
	.cell{
	}

	.spaceship{
		width:45px;
		height: 45px;
		vertical-align: bottom;
	}

	#control{
		position: fixed;
		bottom: 1000px; /* Place the button at the bottom of the page */
  		right: 1000px;
		display: inline-block;
	}
	.button{
		width: 70px;
		height: 70px;
		border: solid black 1px;
	}

</style>
</head>
<body>
<table class="table" >
<?php
$map1 = (array)$_SESSION['map'];
for ($i = 0; $i < 24; $i++){
	echo "<tr>";
		for ($j = 0; $j < 24; $j++)
		{
			 if ($map1['map'][$i][$j] == 1 || $map1['map'][$i][$j] == 2)
			 	echo "<td class=\"cell\"><img class=\"spaceship\" src=\"/images/spaceship.jpg\"/></td>";
			 else
			 	echo "<td class=\"cell\"></td>";
		}
	echo "</tr>";
}?>
</table>

<form id="control" action="move.php" method="POST">
	<input class="button" type="submit" name="Up" value="up">
	<input class="button" type="submit" name="left" value="Rotate left">
	<input class="button" type="submit" name="right" value="Rotate right">
</form>

</body>
</html>