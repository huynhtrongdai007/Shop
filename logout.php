<?php include_once 'lib/session.php'; ?>
<?php include'classes/Cart.php';?>
<?php $ct = new Cart(); ?>
<?php session_start(); ?>
<?php 
	if (isset($_GET['customer_id'])){
		$deleteAllCart = $ct->dellAllCart();
		Session::destroy();		
	}

 ?>