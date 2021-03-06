<?php include_once 'lib/session.php'; ?>
<?php Session::init(); ?>
<?php include_once 'lib/database.php'; ?>
<?php include_once 'helpers/format.php'; ?>
<?php 
spl_autoload_register(function($ClsName){
	include_once "classes/".$ClsName.".php";
});

	$db = new Database();
	$fm = new Format();
	$ct = new Cart();
	$cat = new Category();
	$pr = new Product();
	$br = new Brand();
	$cus = new Customer();
	$od = new Order();
	$sl = new Slider();
	$contact = new Contact();
 ?>
 <?php 
 	if (!isset($_POST['btn_search'])) {
 		echo "<script>xin vio nhap tu khoa tim Kiếm</script>";
 	}
  ?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
	
				    <form action="search.php" method="GET">
				    	<input type="text" id="search"  placeholder="Tìm Kiếm..." name="search">
				    	<input type="submit" id="btn_search" onclick="return btnSearch();" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php 
									$checkCart = $ct->checkCart();
									if($checkCart==true){
										$sum = Session::get("sum");
										echo number_format($sum);
									} else{
										echo "Empty";
									}

										
									 ?>
								</span>
							</a>
						</div>
			      </div>
		   <div class="login">
		   	<?php $loginCheck = Session::get('customer_login');
			   		if($loginCheck==false){
			   			echo "<a href='login.php'>Login</a>";
			   		} else {
		   			echo '<a href="logout.php?customer_id='.Session::get('customer_id').'">Logout</a>';
		   		}
		   	 ?>
		   
		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="topbrands.php">Top Brands</a></li>
	  <?php 
		  $loginCheck = Session::get('customer_login');
	  	if($loginCheck==false)
	  	{
	  		echo "";
	  	}
	  	else
	  	{
	  		echo '<li><a href="profile.php">Profile</a></li>';
	  	}
	   ?>
	 <?php 
	  $customer_id = Session::get('customer_id');
	  $checkOrder = $od->checkOrder($customer_id);
	  	if($checkOrder==false)
	  	{
	  		echo "";
	  	}
	  	else
	  	{
	  		echo '<li><a href="orderdetail.php">Ordered</a></li>';
	  	}
	   ?>
	  <?php 
	  	$checkCart = $ct->checkCart();
	  	if ($checkCart==true) {
	  		echo '<li><a href="cart.php">Cart</a></li>';
	  	}
	  	else
	  	{
	  		echo "";
	  	}
	   ?>

	    <?php 
	  	  $compareCheck = Session::get('customer_id');
	  	if ($compareCheck==true) {
	  		echo '<li><a href="compare.php">Compare</a></li>';	
	  	}
	  	else
	  	{
	  		echo "";
	  	}
	   ?>
	    <?php 
	  	  $compareCheck = Session::get('customer_id');
	  	if ($compareCheck==true) {
	  		echo '<li><a href="wishlist.php">Wish List</a></li>';	
	  	}
	  	else
	  	{
	  		echo "";
	  	}
	   ?>
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>