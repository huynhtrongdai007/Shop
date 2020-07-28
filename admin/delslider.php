<?php include_once '../classes/Slider.php'; ?>
<?php 

 $sl = new Slider(); 
	 if(!isset($_GET['id']) || $_GET['id']==NULL)
	  {
 		echo "<script>window.location = 'sliderlist.php'</script>";
  	  } 
  	else
  	 { 
  		$id = $_GET['id'];
  		$sl->deleteSlider($id);
  		header("location:sliderlist.php");
  		exit();
 	 }

 ?>