<?php include 'inc/header.php'; ?>

<?php 

    if(!isset($_GET['id']) || $_GET['id']==NULL)
    {
        echo "<script>window.location = '404.php'</script>";

    }else {
    	$id = $_GET['id'];
    }

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
    	$quantity = $_POST['quantity'];
        $addCart = $ct->addToCart($quantity,$id);
    }

$dataPro = $pr->getDetails($id);
$item = $dataPro->fetch_assoc();
 ?>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="./admin/uploads/<?php echo $item['image'];?>" alt="image" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $item['product_name'];?></h2>
					<p><?php echo $fm->textShorten($item['description'],150); ?></p>					
					<div class="price">
						<p>Price: <span><?php echo number_format($item['price'])." "."VNĐ";?></span></p>
						<p>Category: <span><?php echo $item['name']; ?></span></p>
						<p>Brand:<span><?php echo $item['brand_name']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" min="1" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>

					</form>	
					<?php 
					if(isset($addCart))
						{
							echo "<span style='color: red;font-size: 18px;'>Product Already Added</span>";
						} 
					?>	
								
				</div>
			</div>
			<div class="product-desc" >
			<h2>Product Details</h2>
			<p><?php echo  $item['description']; ?></p>
	    </div>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php $categoryName= $cat->fetchAll(); ?>
						<?php foreach ($categoryName as $items): ?>
				          <li><a href="productbycat.php?id=<?php echo $items['category_id']; ?>"><?php echo $items['name']; ?></a></li>
				        <?php endforeach; ?>
				      
    				</ul>
    	
 				</div>
 		</div>
 	</div>
 </div>
   <?php include 'inc/footer.php'; ?>