<?php include 'inc/header.php'; ?>
<?php

    if(isset($_GET['orderid']) && $_GET['orderid']=='order')
    {
    	$customer_id = Session::get('customer_id');
    	$insertOrder = $od->insertOrder($customer_id);
    	$delCart = $ct->dellAllCart();
    	header("location:success.php");
    	exit();
    }

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
    	$quantity = $_POST['quantity'];
        $addCart = $ct->addToCart($quantity,$id);
    }

 ?>
 <div class="main">
 	<form action="" method="POST">
    <div class="content">
    	<div class="section group">
			<div class="heading">
				<h2>Payment</h2>
			</div>
			<div class="clear"></div>
			<div class="box-left">
							<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php
			    	 $data = $ct->getCart();
    				 $subtotal = 0;
			    	  $checkCart = $ct->checkCart();
			    	  if($checkCart){ 
			    	 ?>
			  
			    	<?php if(isset($updateCart )){echo $updateCart;} ?>

						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
							</tr>
							<?php
								
								foreach($data as $items):
								
							?>
							
							<tr>

								<td><?php echo $items['productName']; ?></td>
								<td><?php echo number_format($items['price'])." "."VND"; ?></td>
								<td><?php echo $items['quantity']; ?></td>
								<?php $total = $items['price'] * $items['quantity']; ?>
								<td><?php echo number_format($total);?></td>
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
			</div>
			<div class="box-right">
				<div class="heading">
					<h2>Profile Customer</h2>
				</div>
				<div class="clear"></div>
				<table class="tblone">
				<tbody>
					<?php $id = Session::get('customer_id'); ?>
					<?php $getCustomer = $cus->showCustomer($id); ?>
					<?php foreach ($getCustomer as $item): ?>
					<tr>
						<td>Name</td>
						<td>:</td>
						<td><?php echo $item['name']; ?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td>:</td>
						<td><?php echo $item['address']; ?></td>
					</tr>
					<tr>
						<td>City</td>
						<td>:</td>
						<td><?php echo $item['city']; ?></td>
					</tr>
					<tr>
						<td>Country</td>
						<td>:</td>
						<td><?php echo $item['country']; ?></td>
					</tr>
					<tr>
						<td>Zip-Code</td>
						<td>:</td>
						<td><?php echo $item['zipcode']; ?></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><?php echo $item['phone']; ?></td>
					</tr>

					<tr>
						<td>Email</td>
						<td>:</td>
						<td><?php echo $item['email']; ?></td>
					</tr>
					<tr>
						<td colspan="3"><a href="editprofile.php">Update Profile</a></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			</div>
 		</div>
 		<a class="submit-order" href="?orderid=order">Order</a> 
 	</div>
 </form>
 </div>
   <?php include 'inc/footer.php'; ?>