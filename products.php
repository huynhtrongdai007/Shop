<?php include 'inc/header.php'; ?>
<?php 
	$getProductByCategory = $pr->getProductByCategory();
	$nameproduct = $getProductByCategory->fetch_assoc();
	
 ?>
 <div class="main">

    <div class="content">
	     	<div class="section group">
	     		<?php foreach ($getProductByCategory as $key => $value): ?>

	     			<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?id=<?php echo $value['productId'] ?>"><img width="100" src="admin/uploads/<?php echo $value['image'] ?>" alt="" /></a>
					 <h2><?php echo $value['productName']; ?></h2>
					 <p><?php echo $fm->shorter($value['product_desc'],30); ?></p>
					 <p><span class="price"><?php echo number_format($value['price']).' '."VNĐ"; ?></span></p>
				     <div class="button"><span><a href="preview.php?id=<?php echo $value['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php endforeach ?>	
			</div>
    </div>
 </div>
</div>

<?php include 'inc/footer.php'; ?>