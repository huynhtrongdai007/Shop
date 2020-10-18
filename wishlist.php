<?php include 'inc/header.php'; ?>
<?php

	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$deleteCompare = $pr->deleteWishlish($id);
	} 
 ?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Wish List</h2>		  
	
						<table class="tblone">
							<tr>
								<th width="10%">ID Customer</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							    $customer_id = Session::get('customer_id');
								$data = $pr->getAllWishListById($customer_id);
   								if (!empty($data)) {
   									
								 foreach($data as $items):
			
							?>
							<tr>
								<td><?php echo $items['customer_id']; ?></td>
								<td><?php echo $items['productName']; ?></td>
								<td>
									<img src="./admin/uploads/<?php echo $items['image'];?>" alt="<?php echo $items['image'];?>"/>	
								</td>

								<td><?php echo number_format($items['price'])." "."VND"; ?></td>
								<td>
								<a class="buysubmit" href="preview.php?id=<?php echo $items['productId']; ?>">Buy</a>	
								 ||
								 <a onclick="return confirm('are you sure want this delete ?');" href="?id=<?php echo $items['id']; ?>">Remove</a></td>
						    	</tr>
				
						         <?php  endforeach; ?>
						         <?php
   									}else {
   										echo "<td>Không có sản phẩm yêu thích</td>";
   									}	
						          ?>
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

