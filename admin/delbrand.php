<?php include_once '../classes/Brand.php'; ?>
<?php 

 $cat = new Brand(); 
	 if(!isset($_GET['id']) || $_GET['id']==NULL)
	  {
 		echo "<script>window.location = 'brandlist.php'</script>";
  	  } 
  	else
  	 { 
  		$id = $_GET['id'];
  		$cat->Delete($id);

  		header("location:brandlist.php");
  		exit();
 	 }

 ?>