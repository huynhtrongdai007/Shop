<?php include 'inc/header.php'; ?>
<?php 
	if (!isset($_GET['id']) || $_GET['id']==NULL) {
		echo "<script>window.location='404.php'</script>";
	} else {
		$id = $_GET['id'];
	}

	$productByCat = $cat->fetchProductByCat($id);	
	$nameCat = $productByCat->fetch_assoc();
 ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    			<?php if (isset($nameCat)): ?>
    				<h3><?php echo $nameCat['catName']; ?> </h3>
    				<?php else: echo "khong co san pham"; ?>
    			<?php endif ?>
    			
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	      	<?php foreach ($productByCat as $items):?>
	      	
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?id=<?php echo $items['productId']; ?>"><img src="admin/uploads/<?php echo $items['image'] ?>" alt="" /></a>
					 <h2><?php echo $items['productName']; ?></h2>
					 <p><?php echo $fm->shorter($items['product_desc'],50); ?></p>
					 <p><span class="price"><?php echo number_format($items['price']).' '.'VNĐ'; ?></span></p>
				     <div class="button"><span><a href="preview.php?id=<?php echo $items['productId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php  endforeach; ?>
				

			</div>
		
	
	
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>
