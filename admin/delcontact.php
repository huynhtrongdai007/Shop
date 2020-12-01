<?php include_once '../classes/Contact.php'; ?>
<?php 

 $contact = new Contact(); 
	 if(!isset($_GET['id']) || $_GET['id']==NULL)
	  {
 		echo "<script>window.location = 'contact.php'</script>";
  	  } 
  	else
  	 { 
  		$id = $_GET['id'];
  		$contact->Delete($id);
  		header("location:contact.php");
  		exit();
 	 }

 ?>