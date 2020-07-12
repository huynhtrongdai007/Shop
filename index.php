<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php $getProductFeathered = $pr->getProductFeathered();?>
	      	<?php foreach ($getProductFeathered as $items):?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php"><img src="./admin/uploads/<?php echo $items['image']; ?>" alt="image" /></a>
					 <h2><?php echo $items['product_name']; ?></h2>
					 <p><?php echo $fm->textShorten($items['description'],30); ?></p>
					 <p><span class="price"><?php echo number_format($items['price'])."VNĐ"; ?></span></p>
				     <div class="button"><span><a href="preview.php?id=<?php echo $items['product_id']; ?>" class="details">Details</a></span></div>
				</div>
			<?php endforeach; ?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php $getProductNew = $pr->getProductNew(); ?>
				<?php foreach ($getProductNew as $items):?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.html"><img src="./admin/uploads/<?php echo $items['image'];?>" alt="" /></a>
					 <h2><?php echo $items['product_name']; ?></h2>
					 <p><span class="price"><?php echo number_format($items['price']); ?></span></p>
				     <div class="button"><span><a href="preview.php?id=<?php echo $items['product_id'];?>" class="details">Details</a></span></div>
				</div>
			<?php endforeach; ?>
			</div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>