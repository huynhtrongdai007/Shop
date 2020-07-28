<?php include 'inc/header.php'; ?>
<?php 
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$keywords = $_POST['search'];
		$result_search = $pr->searchProduct($keywords);
	}

	
 ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    			<h3>Từ khóa tìm kiếm là: <?php echo $keywords; ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	      	<?php foreach ($result_search as $items): ?>
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
