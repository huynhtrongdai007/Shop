<?php include_once '../classes/Product.php'; ?>
<?php 

 $pro = new Product(); 
	 if(!isset($_GET['id']) || $_GET['id']==NULL)
	  {
 		echo "<script>window.location = 'productlist.php'</script>";
  	  } 
  	else
  	 { 
  		$id = $_GET['id'];
  		$pro->Delete($id);
  		header("location:productlist.php");
  		exit();
 	 }

 ?>