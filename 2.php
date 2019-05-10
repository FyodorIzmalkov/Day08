<!DOCTYPE html>
<html>
<head>
<style>
	.table{
		width: auto;
		height: auto;
		border: 1px solid black;
		border-collapse: collapse;
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

</style>
</head>
<body>
<!-- <img src="https://i.ibb.co/rt4ZqSn/spaceship.jpg" alt="spaceship"> -->
<table class="table" >
<?php for ($i = 0; $i < 24; $i++){
	echo "<tr>";
		for ($j = 0; $j < 24; $j++)
		{
			if ($i == 5 && $j == 5)
				echo "<td class=\"cell\"><img class=\"spaceship\" src=\"https://i.ibb.co/rt4ZqSn/spaceship.jpg\"/></td>";
			else
				echo "<td class=\"cell\"></td>";
		}
	echo "</tr>";
}?>
</table>

</body>
</html>
