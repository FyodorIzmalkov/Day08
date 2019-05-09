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
	}

	$map = new Map(10, 10);
	$map->print_map();