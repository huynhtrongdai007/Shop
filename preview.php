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

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['addComment']))
    {
    	 $comment = $_POST['comment'];
    	 $customer_id = session::get('customer_id');

    	if (empty($comment)) {
    		echo"";
    	} else {
	       $cus->Comment($customer_id,$comment);
    	}
    }
	
	// diem so luong binh luan  
	$sqlNumComments = $cus->coutComment();
	$numComments  = $sqlNumComments->num_rows;

	// lay binh luan
	$datacomment = $cus->getComment()


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
	 
	<?php 
		if(!empty(session::get('customer_id'))){
	?>
		<div id="form-comment">

		 <form action="" method="POST">
			<textarea  name="comment" cols="100" style="height: 100px;" placeholder="Enter Comment"></textarea>
			<input type="hidden" id="customer_id_comment" value="<?php echo Session::get('customer_id');?>">
			<div style="clear: both;"></div>	
			 <input type="submit" style="float: right;" class="submit-comment" name="addComment" value="submit" >
			</form>
		</div>
		<h2><b><?php echo $numComments;?> comments</b></h2>
			<div class="userComments">
				<div class="comment">
					<?php 
						while ($comment = $datacomment->fetch_assoc()) {
					 ?>
					<div class="user"><?php echo $comment['comment'];?><span class="time"><?php echo $comment['created_at']; ?></span></div>
					<?php 
						}
					 ?>
				</div>
			</div>
	<?php 
		}
	 ?>
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php $categoryName= $cat->fetchAll(); ?>
						<?php foreach ($categoryName as $items): ?>
				          <li><a href="productbycat.php?id=<?php echo $items['catId']; ?>"><?php echo $items['catName']; ?></a></li>
				        <?php endforeach; ?>
				      
    				</ul>
    	
 				</div>
 		</div>
 	</div>
 </div>
   <?php include 'inc/footer.php'; ?>

