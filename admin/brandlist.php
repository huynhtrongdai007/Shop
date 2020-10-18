<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/Brand.php'; ?>
<?php
 $brand = new Brand(); 
  $show_brand = $brand->fetchAll();
 

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						
						<tr>
							<th>STT</th>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
				
					</thead>
					<tbody>
						<?php $stt=0; ?>
						<?php foreach ($show_brand as $items):?>
						<?php $stt++; ?>
						<tr class="odd gradeX">
							<td><?php echo $stt; ?></td>
							<td><?php echo $items['brandId']; ?></td>
							<td><?php echo $items['brandName']; ?></td>
							<td><a href="editbrand.php?id=<?php  echo $items['brandId']; ?>">Edit</a> || <a onclick="return acceptDelete('are you sure want category delete this')" href="delbrand.php?id=<?php echo $items['brandId'];?>">Delete</a></td>
						</tr>
						<?php endforeach; ?>
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

