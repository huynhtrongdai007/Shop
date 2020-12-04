<?php include_once '../classes/User.php'; ?>
<?php 

 $user = new User(); 
	 if(!isset($_GET['id']) || $_GET['id']==NULL)
	  {
 		echo "<script>window.location = 'userlist.php'</script>";
  	  } 
  	else
  	 { 
  		$id = $_GET['id'];
  		$user->Delete($id);
  		header("location:userlist.php");
  		exit();
 	 }

 ?>