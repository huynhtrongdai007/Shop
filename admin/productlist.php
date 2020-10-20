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
					<th>Code</th>
					<th>Tên Sản Phẩm</th>
					<th>Nhập Hàng</th>
					<th>Số Lượng Nhập</th>
					<th>Đã Bán</th>
					<th>Số Lượng Tồn</th>
					<th>Category</th>
					<th>Thương Hiệu</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data_pro as $items): ?>
				<tr class="odd gradeX">
					<td><?php echo $items['productId']; ?></td>
					<td><?php echo $items['product_code']; ?></td>
					<td><?php echo $items['productName'];?></td>
					<th><a href="productmorequantity.php?productid=<?php echo $items['productId'] ?>">Nhập Hàng</a></th>
					<td><?php echo $items['productQuantity'];?></td>
					<td><?php echo $items['product_soldout'];?></td>
					<td><?php echo $items['product_remain'];?></td>
					<td><?php echo $items['catName']; ?></td>
					<td><?php echo $items['brandName']; ?></td>
					<td class="center"><img src="./uploads/<?php echo $items['image'];?>" alt="image" height="80"/></td>
					<td><?php if($items['type']==1){echo"Featherad";}else{echo"Non-Featherad";} ?></td>
					<td><a href="editproduct.php?id=<?php echo $items['productId']; ?>">Edit</a> || <a href="delproduct.php?id=<?php echo $items['productId']; ?>" onclick="return acceptDelete('are you sure want category delete this')">Delete</a></td>
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
