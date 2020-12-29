<?php include 'inc/header.php'; ?>
<?php 
	if ($_SERVER['REQUEST_METHOD']=='GET') {
		$keywords = $_GET['search'];
		$result_search = $pr->searchProduct($keywords);
		
	}  
	if($_GET['search']==NULL){
		header("location:index.php");
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
	  		<?php 
	  			if (is_array($result_search) || is_object($result_search)) {
	  		 ?>
	      	<?php foreach ($result_search as $items): ?>
			
			      <div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?id=<?php echo $items['productId']; ?>"><img src="admin/uploads/<?php echo $items['image'] ?>" alt="" /></a>
					 <h2><?php echo $items['productName']; ?></h2>
					 <p><?php echo $fm->shorter($items['product_desc'],50); ?></p>
					 <p><span class="price"><?php echo number_format($items['price']).' '.'VNĐ'; ?></span></p>
				     <div class="button"><span><a href="preview.php?id=<?php echo $items['productId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php  endforeach; }else{echo "khong co ket qua tim kiem";} ?>

			</div>

	
	
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>
