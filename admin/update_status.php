<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Order.php');


	$od = new Order();
	if(isset($_GET['shiftid'])) {
		$id = $_GET['shiftid'];
		$proid = $_GET['proid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$qty = $_GET['qty'];
		$od->shifted($id,$proid,$qty,$time,$price);
		header("location:inbox.php");
	}

 ?>
