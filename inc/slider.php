<?php 
	$getProductTP_Link = $pr->getProductTP_Link();
	$item1 =  $getProductTP_Link->fetch_assoc();
	
	$getProduct_OEM = $pr->getProduct_OEM();
	$item2 =  $getProduct_OEM->fetch_assoc();
	
	$getProduct_Viettel = $pr->getProduct_Viettel();
	$item3 =  $getProduct_Viettel->fetch_assoc();

	$getProduct_Dell = $pr->getProduct_Dell();
	$item4 =  $getProduct_Dell->fetch_assoc();
 ?>
<div class="header_bottom">
		<div class="header_bottom_left">
		
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.html"> <img src="admin/uploads/<?php echo $item1['image'] ?> " alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo  $item1['brandName']; ?> </h2>
						<p><?php echo $item1['product_desc']; ?></p>
						<div class="button"><span><a href="preview.php?id=<?php echo $item1['productId'] ?>">Add to cart</a></span></div>
				   </div>

			   </div>			
					<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.html"> <img src="admin/uploads/<?php echo $item2['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $item2['brandName']; ?></h2>
						<p><?php echo $fm->shorter($item2['product_desc'],50); ?></p>
						<div class="button"><span><a href="preview.php?id=<?php echo $item2['productId'] ?>">Add to cart</a></span></div>
				   </div>		

			   </div>			
			</div>

			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.html"> <img src="admin/uploads/<?php echo $item3['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $item3['brandName']; ?></h2>
						<p><?php echo $fm->shorter($item3['product_desc'],100); ?></p>
						<div class="button"><span><a href="preview.php?id=<?php echo $item3['productId'] ?>">Add to cart</a></span></div>
				   </div>

			   </div>	
			   <div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.html"> <img src="admin/uploads/<?php echo $item4['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $item4['brandName']; ?></h2>
						<p><?php echo $fm->shorter($item4['product_desc'],40); ?></p>
						<div class="button"><span><a href="preview.php?id=<?php echo $item4['productId'] ?>">Add to cart</a></span></div>
				   </div>

			   </div>					
				
			</div>		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
				  
					<ul class="slides">
							<?php
				  	$get_slier = $sl->getBytype();

				  	 ?>
				  		<?php 

				  		foreach ($get_slier as $items) { 
				  				$slider_info = array(
				  				'slider_image' => $items['slider_image']
					  		);

				  		 ?>

						<li>
							<a href="<?php echo $items['link'] ?>">
								<img src="./admin/sliders/<?php echo $slider_info['slider_image'];?>" alt=""/>
							</a>
						</li>
						<?php
						 	}
						 ?>
				    </ul>
				  
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>