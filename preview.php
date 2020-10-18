<?php include 'inc/header.php'; ?>

<?php 
	if (!isset($_GET['id']) || $_GET['id']==NULL) {
		echo "<script>window.location = '404.php'</script>";
	} else {
		$id = $_GET['id'];
	}
		$dataPro = $pr->getDetails($id);
		$item = $dataPro->fetch_assoc();

 		$customer_id = Session::get('customer_id');
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['compare']))	
    {
    	$productid = $_POST['productid'];
        $insertCompare = $pr->insertCompare($productid,$customer_id);
    }

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['wishlist']))
    {
    	$productid = $_POST['productid'];
        $insertwishlist = $pr->insertWishlist($productid,$customer_id);
    }


 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
    	$quantity = $_POST['quantity'];	
        $insertCart = $ct->addToCart($quantity,$id);
    }
 ?>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="./admin/uploads/<?php echo $item['image'];?>" alt="image" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $item['productName'];?></h2>
					<p><?php echo $fm->textShorten($item['product_desc'],150); ?></p>					
					<div class="price">
						<p>Price: <span><?php echo number_format($item['price'])." "."VNĐ";?></span></p>
						<p>Category: <span><?php echo $item['productName']; ?></span></p>
						<p>Brand:<span><?php echo $item['brandName']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" min="1" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>

					</form>	
					<?php 
					if(isset($insertCart))
						{
							echo "<span style='color: red;font-size: 18px;'>Product Already Added</span>";
						} 
					?>	
								
				</div>
				<div class="product-desc">
					<form action="" method="POST">
						<?php if(Session::get('customer_id')){?>
							<input type="hidden" name="productid" value="<?php echo $item['productId']; ?>">
 					    	<input type="submit" class="buysubmit" name="compare" value="Compare Product">
 						<?php }else{echo"";} ?>
						
					</form>
 					<form action="" method="POST">
						<?php if(Session::get('customer_id')){?>
							<input type="hidden" name="productid" value="<?php echo $item['productId']; ?>">
 						  <input type="submit" class="buysubmit" name="wishlist" value="Save Wishlist Product">
 						<?php }else{echo"";} ?>
						
					</form>
					<div style="clear: both;"></div>
 					 <p>
 						<?php 
 						if (isset($insertwishlist)) {
 							echo $insertwishlist;
 						}

 						if (isset($insertCompare)) {
 							echo $insertCompare;
 						}
 					 ?>
 					</p>
				</div>
			</div>
			<div class="product-desc" >
			<h2>Product Details</h2>
			<p><?php echo  $item['product_desc']; ?></p>
	    </div>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php $categoryName= $cat->fetchAll(); ?>
						<?php foreach ($categoryName as $items): ?>
				          <li><a href="productbycat.php?id=<?php echo $items['cateId']; ?>"><?php echo $items['catName']; ?></a></li>
				        <?php endforeach; ?>
				      
    				</ul>
    	
 				</div>
 		</div>
 	</div>
 </div>
   <?php include 'inc/footer.php'; ?>