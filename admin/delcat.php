<?php include_once '../classes/Category.php'; ?>
<?php 

 $cat = new Category(); 
	 if(!isset($_GET['id']) || $_GET['id']==NULL)
	  {
 		echo "<script>window.location = 'catlist.php'</script>";
  	  } 
  	else
  	 { 
  		$id = $_GET['id'];
  		$cat->Delete($id);
  		header("location:catlist.php");
  		exit();
 	 }

 ?>