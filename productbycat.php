<?php include 'inc/header.php'; ?>
<?php 
	if (!isset($_GET['id']) || $_GET['id']==NULL) {
		echo "<script>window.location='404.php'</script>";
	} else {
		$id = $_GET['id'];
	}

	$productByCat = $cat->fetchProductByCat($id);
	$productName = $cat->fetchProductByCat($id);

 ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    			<?php foreach ($productName as $valName):?>
    		<h3><?php echo $valName['product_name']; ?></h3>
    	<?php endforeach; ?>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	      	<?php foreach ($productByCat as $items): ?>
<?php if(!isset($items)){echo "Not product";}else{ ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?id=<?php echo $items['product_id']; ?>"><img src="admin/uploads/<?php echo $items['image'] ?>" alt="" /></a>
					 <h2><?php echo $items['product_name']; ?></h2>
					 <p><?php echo $fm->textShorten($items['description'],50); ?></p>
					 <p><span class="price"><?php echo number_format($items['price']).' '.'VNĐ'; ?></span></p>
				     <div class="button"><span><a href="preview.php?id=<?php echo $items['product_id']; ?>" class="details">Details</a></span></div>
				</div>
			<?php } endforeach; ?>
				

			</div>

	
	
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>
