<?php include 'inc/header.php'; ?>
<?php 
	$getProductTP_Link = $pr->getTopBrandProductTP_Link();
	$item1 =  $getProductTP_Link->fetch_assoc();
	
	$getProduct_SAMSUM = $pr->getTopBrandProduct_SAMSUM();
	$item2 =  $getProduct_SAMSUM->fetch_assoc();
	
	$getProduct_Apple = $pr->getTopBrandProduct_Apple();
	$item3 =  $getProduct_Apple->fetch_assoc();
 ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3><?php echo $item1['brandName']; ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php foreach ($getProductTP_Link as $value): ?>
	      		<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?id=<?php echo $value['productId'] ?>"><img src="admin/uploads/<?php echo $value['image'] ?>" alt="" /></a>
					 <h2>Lorem Ipsum is simply </h2>
					 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
					 <p><span class="price">$505.22</span></p>
				     <div class="button"><span><a href="preview.php?id=<?php echo $value['productId'] ?>" class="details">Details</a></span></div>
				</div>
	      	<?php endforeach ?>
				
				
			</div>
		<div class="content_bottom">
    		<div class="heading">
    		<h3><?php echo $item2['brandName']; ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">

				<?php foreach ($getProduct_SAMSUM as $value): ?>
	      		<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?id=<?php echo $value['productId'] ?>"><img src="admin/uploads/<?php echo $value['image'] ?>" alt="" /></a>
					 <h2>Lorem Ipsum is simply </h2>
					 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
					 <p><span class="price">$505.22</span></p>
				     <div class="button"><span><a href="preview.php?id=<?php echo $value['productId'] ?>" class="details">Details</a></span></div>
				</div>
	      	<?php endforeach ?>
				
			</div>
		<div class="content_bottom">
    		<div class="heading">
    		<h3><?php echo $item3['brandName']; ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php foreach ($getProduct_SAMSUM as $value): ?>
	      		<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?id=<?php echo $value['productId'] ?>"><img src="admin/uploads/<?php echo $value['image'] ?>" alt="" /></a>
					 <h2>Lorem Ipsum is simply </h2>
					 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
					 <p><span class="price">$505.22</span></p>
				     <div class="button"><span><a href="preview.php?id=<?php echo $value['productId'] ?>" class="details">Details</a></span></div>
				</div>
	      	<?php endforeach ?>
			
			</div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>

