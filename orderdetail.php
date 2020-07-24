<?php include 'inc/header.php'; ?>
<?php 
	$customer_id = Session::get('customer_id');
	if ($customer_id==false) {
		header('location:login.php');
		exit();
	}

 ?>
  <?php 
	$od = new Order();
	if(isset($_GET['confirmid'])) {
		$id = $_GET['confirmid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$od->shiptedConfirm($id,$time,$price); 
	}
 ?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2 style="width: 500px;">Chi tiết đơn hàng của bạn</h2>
			    
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="25%">Date Order</th>
								<th width="10">Status</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							$customer_id = Session::get('customer_id');
								$getOrdered = $od->getOrdered($customer_id );
								foreach($getOrdered as $items):	
							?>
							
							<tr>
								<td><?php echo $items['product_name']; ?></td>
								<td><img src="./admin/uploads/<?php echo $items['image'];?>" alt="<?php echo $items['image'];?>"/></td>
								<td><?php echo number_format($items['price'])." "."VND"; ?></td>
								<td><?php echo $items['quantity']; ?></td>
								<?php $total = $items['price'] * $items['quantity']; ?>
								<td><?php echo number_format($total);?></td>
								<td><?php echo $fm->formatDate($items['created_at']); ?></td>
								<td>
									<?php if($items['status']==0)
								{
									echo "chưa sử lý";
								}elseif($items['status']==1) {
							
								 ?>
								 	<a href="?confirmid=<?php echo $customer_id; ?>&time=<?php echo $items['created_at'] ?>&price=<?php echo $items['price'] ?>">Đã nhận hàng</a>
									<?php
									 }
									 else
									 {
									 	echo "Confirm";
									 } 
									 ?>
								</td>
								<?php if($items['status']==0){ ?>
									<td><a href="?id=<?php echo $items['cartid']; ?>">X</a></td>
								<?php 
									}else{
								 ?>

								<td><?php echo 'N/A'; ?></td>
							<?php } ?>
							</tr>
						
						<?php  endforeach; ?>
						</table>

			
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>

