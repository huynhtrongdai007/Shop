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
					<h2>Profile Customer</h2>
				</div>
				<div class="clear"></div>
			</div>

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
</div>
<?php include 'inc/footer.php'; ?>