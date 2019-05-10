<?php
require_once("2.php");
$map = (array)$_SESSION['map'];
$ship = $_SESSION['ship_1'];
if (isset($_POST['Up']))
{
	$x = $ship->col;
	$y = $ship->row;
	$map['map'][$y][$x] = '.';
	$map['map'][$y + 1][$x] = '1';
	$_SESSION['map'] = $map;
	$ship->row++;
	$_SESSION['ship_1'] = $ship;
	header("Location: http://localhost:8100/2.php");
	exit();
}
else if (isset($_POST['left']))
{

}
else if (isset($_POST['right']))
{

}