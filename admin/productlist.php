<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/Product.php';?>
<?php
$fm = new Format(); 
	$pro = new Product();
	$data_pro = $pro->fetchAll();

 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Post Title</th>
					<th>Description</th>
					<th>Category</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data_pro as $items): ?>
				<tr class="odd gradeX">
					<td><?php echo $items['product_id']; ?></td>
					<td><?php echo $items['product_name'];?></td>
					<td><?php echo $fm->textShorten($items['description'],30);?></td>
					<td><?php echo $items['name']; ?></td>
					<td class="center"><img src="./uploads/<?php echo $items['image'];?>" alt="image" height="80"/></td>
					<td><?php if($items['type']==1){echo"Featherad";}else{echo"Non-Featherad";} ?></td>
					<td><a href="editproduct.php?id=<?php echo $items['product_id']; ?>">Edit</a> || <a href="delproduct.php?id=<?php echo $items['product_id']; ?>" onclick="return acceptDelete('are you sure want category delete this')">Delete</a></td>
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
