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

</style>
</head>
<body>

<table class="table" >
<?php for ($i = 0; $i < 25; $i++){
	echo "<tr>";
		for ($j = 0; $j < 25; $j++)
		{
			echo "<td class=\"cell\"></td>";
		}
	echo "</tr>";
}?>
</table>

</body>
</html>
