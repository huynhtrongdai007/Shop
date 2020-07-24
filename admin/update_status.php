<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Order.php');


	$od = new Order();
	if(isset($_GET['shiftid'])) {
		$id = $_GET['shiftid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted = $od->shifted($id,$time,$price); 
		header("location:inbox.php");
	}

 ?>
