<?php include 'inc/header.php'; ?>
 <div class="main">
 	<form action="">
    <div class="content">
    	<div class="section group">
			<h2 class="success" style="text-align: center;">Success Order</h2>
			<?php 
				$customer_id = Session::get('customer_id');
				$get_amount = $od->getAmounPrice($customer_id);
				if ($get_amount) {
					$amout = 0;
					while ($result = $get_amount->fetch_assoc()) {
						$price = $result['price'];
						$amout+=$price;
					}
				}
			 ?>
			 <?php
			  $vat = $amout * 0.1;
			  $total = $vat + $amout;	
			  ?>
			<p class="success_note">Total Price you have bought from my Website :<?php echo number_format($total); ?>VNĐ</p>
			<p class="success_note">chúng tôi sẽ liên hệ với bạn sau. xin vui lòng xem chi tiết giỏ hàng tại đây <a href="orderdetail.php">Click Here</a></p>
 		</div>
 	</div>
 </form>
 </div>
   <?php include 'inc/footer.php'; ?>