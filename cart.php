<?php include 'inc/header.php'; ?>
<?php

	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$delcart = $ct->deleteCart($id);
	} 
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
    	$cartid = $_POST['cardId'];
    	$quantity = $_POST['quantity'];
        $updateCart = $ct->updateCart($quantity,$cartid);
    }
    $data = $ct->getCart();
    $subtotal = 0;

 ?>
 <?php 

 
 	
  ?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php
			    	  $checkCart = $ct->checkCart();
			    	  if($checkCart){ 
			    	 ?>
			  
			    	<?php if(isset($updateCart )){echo $updateCart;} ?>

						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								
								foreach($data as $items):
								
							?>
							
							<tr>

								<td><?php echo $items['productname']; ?></td>
								<td><img src="./admin/uploads/<?php echo $items['image'];?>" alt="<?php echo $items['image'];?>"/></td>
								<td><?php echo number_format($items['price'])." "."VND"; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cardId" value="<?php echo $items['cartid'];?>">
										<input type="number" min="1" name="quantity" value="<?php echo $items['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<?php $total = $items['price'] * $items['quantity']; ?>
								<td><?php echo number_format($total);?></td>
								<td><a href="?id=<?php echo $items['cartid']; ?>">X</a></td>
							</tr>
							<?php $subtotal += $total;?>
						<?php  endforeach; ?>
						</table>
						<table style="float:right;text-align:left;" width="40%">
							
							<tr>
								<th>Sub Total : </th>
								<td>
									<?php 
									echo number_format($subtotal);
										
										Session::set('sum',$subtotal);
									
									?>
									
								</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php $vat = $subtotal * 0.1;
									$grandtotal = $subtotal + $vat;
								echo number_format($grandtotal);
									?>
									
								</td>
							</tr>
					   </table>
					<?php }else{echo "Gio Hang Trong";} ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>

