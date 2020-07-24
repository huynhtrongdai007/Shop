<?php include 'inc/header.php'; ?>
<?php
 $loginCheck = Session::get('customer_login');
 if($loginCheck==false)
 {
 	header("Location:login.php");
 	exit();
 }
 ?>
 <?php 
 $id =  Session::get('customer_id');
 	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['save'])) {
 		$updatecustomer = $cus->updateCustomer($_POST,$id);
 	}
  ?>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="content_top">
				<div class="heading">
					<h2>Profile Customer</h2>
				</div>
				<div class="clear"></div>
			</div>
			
			<form action="" method="POST">
			<table class="tblone">
				<tr>
					<?php if (isset($updatecustomer)) {
						echo "<td colspan='3'>".$updatecustomer."</td>";
					} ?>
				</tr>
				<tbody>

					<?php $id = Session::get('customer_id'); ?>
					<?php $getCustomer = $cus->showCustomer($id); ?>
					<?php foreach ($getCustomer as $item): ?>
					<tr>
						<td>Name</td>
						<td>:</td>

						<td><input type="text" name="name" value="<?php echo $item['name']; ?>"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td>:</td>
						<td><input type="text" name="address" value="<?php echo $item['address']; ?>"></td>
					</tr>
					<!-- <tr>
						<td>City</td>
						<td>:</td>
						<td><input type="text" name="city" value="<?php echo $item['city']; ?>"></td>
					</tr> -->
					<!-- <tr>
						<td>Country</td>
						<td>:</td>
						<td><input type="text" name="country" value="<?php echo $item['country']; ?>"></td>
					</tr> -->
					<tr>
						<td>Zip-Code</td>
						<td>:</td>
						<td><input type="text" name="zipcode" value="<?php echo $item['zipcode']; ?>"></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><input type="text" name="phone" value="<?php echo $item['phone']; ?>"></td>
					</tr>

					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="text" name="email" value="<?php echo $item['email']; ?>"></td>
					</tr>
					<tr>
						<td colspan="3"><input type="submit" name="save" value="Save"></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			</form>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>