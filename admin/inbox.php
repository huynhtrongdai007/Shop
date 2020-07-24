<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Order.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php 

	$od = new Order();
	if(isset($_GET['delid'])) {
		$id = $_GET['delid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$deleteshifted = $od->deleteShifted($id,$time,$price); 
	}
 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php 
                	if (isset($shifted)) {
                		echo $shifted;
                	}
                 ?>
                  <?php 
                	if (isset($deleteshifted)) {
                		echo $deleteshifted;
                	}
                 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							 $od = new Order();
							 $fm = new Format();
							 $orders = $od->getInbox(); 
						 ?>
						<?php 
						if($orders){
						while ($items =$orders->fetch_assoc()) {
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $items['id']; ?></td>
							<td><?php echo $fm->formatDate($items['created_at']); ?></td>
							<td><?php echo $items['product_name']; ?></td>
							<td><?php echo $items['quantity']; ?></td>
							<td><?php echo number_format($items['price']).' '.'VNĐ'; ?></td>
							<td><a href="customer.php?customerid=<?php echo $items['customer_id']; ?>">View Address</a></td>
							<td>
								<?php if($items['status']==0){
								?>
								<a href="update_status.php?shiftid=<?php echo $items['id'] ?>&time=<?php echo $items['created_at'] ?>&price=<?php echo $items['price'] ?>">Pending</a>
								<?php 
									}elseif($items['status']==1){
								 ?>
								 Shipping...
								 <?php 
								}else{
								  ?>
								  <a href="?delid=<?php echo $items['id'] ?>&time=<?php echo $items['created_at'] ?>&price=<?php echo $items['price'] ?>">Remove</a>
								  <?php 
								  	}
								   ?>
								
							</td>
						<?php 
							}
						}
						?>
				
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
