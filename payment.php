<?php include 'inc/header.php'; ?>
<?php
 $loginCheck = Session::get('customer_login');
 if($loginCheck==false)
 {
 	header("Location:login.php");
 	exit();
 }
 ?>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="content_top">
				<div class="heading">
					<h2>Payment</h2>
				</div>
				<div class="clear"></div>
			</div>
			<div class="wrapper-method">
				<h3 class="payment">Choose your method payment</h3>
				<p><a  href="offlinepayment.php">Offline Payment</a></p>
				<p><a  href="onlinepayment.php">Onlie Payemnt</a></p>	
				<div style="clear: both; margin-top: 20px;"></div>
				<a class="preview" href="cart.php?id=<?php  ?>">Preview</a>
			
			</div>
			
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>