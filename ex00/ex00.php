<?php
	class Map
	{
		public $height;
		public $width;
		public $data;
		function __construct($w, $h)
		{
			$this->height = $h;
			$this->width = $w;
			$this->data = array_fill(0, $w * $h, '.');
		}
		public function print_map()
		{
			for($j = 0; $j < $this->height; $j++)
			{
				for($k = 0;$k < $this->width; $k++)
				{
					echo $this->data[$k + $j * $this->width]." ";
				}
				echo "\n";
			}
		}
		public function setOnMap($ships)
		{
			foreach($ships as $ship)
			{
				$this->data[$ship->position->x + $ship->position->y * $this->width] = $ship->_body;
			}
		}
	}
	class Point
	{
		public $x;
		public $y;

		function Point($x, $y)
		{
			$this->x = $x;
			$this->y = $y;
		}
	}
	class Ship
	{
		public $position;
		public $_body = 'x';
		function Ship(Point $point)
		{
			$this->position = $point;
		}
		public function moveby($x, $y)
		{
			$this->position->x += $x;
			$this->position->y += $y;
		}
	}

	$map = new Map(10, 10);
	//$map->print_map();
	
	$ships[] = new Ship(new Point(1, 1));
	$map->setOnMap($ships);
	//$map->print_map();
	if ($_POST["move_right"])
	{
		$ships[0]->moveby(2,2);
		$map->setOnMap($ships);
		header('Location: ./ex00.php');
	}
?>
<html>
	<body>
		<?php
			for($j = 0; $j < $map->height; $j++)
			{
				for($k = 0;$k < $map->width; $k++)
				{
		?>
				<div style="float:left; border:1px;">
					<?php echo $map->data[$k + $j * $map->width]." "; ?>
				</div>
			<?php		
				}
			?>
			</br>
			<?php
			}
			?>
			<form method="post">
				<input type="submit" name="move_right"  value="move_right" />
			</form>
	</body>
<html>