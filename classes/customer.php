<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/session.php');
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

?>

<?php

 class Customer 
 {
 	private $db;
 	private $fm;

 	function __construct()
 	{
 		$this->db = new Database();
 		$this->fm = new Format();
 	}

 
 	public function insertCustomer($data)
 	{
 		$name = mysqli_real_escape_string($this->db->link,$data['name']);
 		$city = mysqli_real_escape_string($this->db->link,$data['city']);
 		$zipcode = mysqli_real_escape_string($this->db->link,$data['zipcode']);
 		$email = mysqli_real_escape_string($this->db->link,$data['email']);
 		$address = mysqli_real_escape_string($this->db->link,$data['address']);
 		$country = mysqli_real_escape_string($this->db->link,$data['country']);
 		$phone = mysqli_real_escape_string($this->db->link,$data['phone']);
 		$password = mysqli_real_escape_string($this->db->link,md5($data['password']));

 		if (empty($name) || empty($city) || empty($zipcode) || empty($address) || empty($country) || empty($phone) || empty($password)) {
 			$alert="<span class='error'>Fiels must be not empty<span>";
 			return $alert;
 		} else {
 			$checkEmail = "SELECT email FROM tbl_customer WHERE email = '$email' LIMIT 1";	
 			$resultCheck = $this->db->select($checkEmail);
 			if($resultCheck == true) {
 				$alert="<span class='error'>Email Already Existed<span>";
 			return $alert;
 			} else {
 				$query = "INSERT INTO tbl_customer(name,city,zipcode,email,address,country,phone,password)
 						VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";
 				$result = $this->db->insert($query);
 				if($result == true) {
 					$alert="<span class='success'>Customer Created SuccessFully<span>";
 					return $alert;
 				} else {
 					$alert="<span class='error'>Customer Created Not Success<span>";
 					return $alert;
 				}		
 			}
 		}

 	}


 	public function updateCustomer($data,$id)
 	{
 		$name = mysqli_real_escape_string($this->db->link,$data['name']);
 		$zipcode = mysqli_real_escape_string($this->db->link,$data['zipcode']);
 		$email = mysqli_real_escape_string($this->db->link,$data['email']);
 		$address = mysqli_real_escape_string($this->db->link,$data['address']);
 		$phone = mysqli_real_escape_string($this->db->link,$data['phone']);

 		if (empty($name) || empty($zipcode) ||empty($email) || empty($address) || empty($phone)) {
 			$alert="<span class='error'>Fiels must be not empty<span>";
 			return $alert;
 		}
 		 else 
 		 {
 				$query = "UPDATE tbl_customer SET name='$name',zipcode='$zipcode',email='$email',address='$address',phone='$phone' WHERE id = '$id'";
 				$result = $this->db->update($query);
 				if($result == true) {
 					$alert="<span class='success'>Edit SuccessFully<span>";
 					return $alert;
 				} else {
 					$alert="<span class='error'>Edit  Not Success<span>";
 					return $alert;
 				}		
 			
 		}

 	}



 	public function loginCustomer($data)
 	{
 		$email = mysqli_real_escape_string($this->db->link,$data['email']);
 		$password = mysqli_real_escape_string($this->db->link,md5($data['password']));

 		if(empty($email) || empty($password))
 		{
 			$alert="<span class='error'>Fiels must be not empty<span>";
 			return $alert;
 		} 
 		else
 		{
 			$checkEmail = "SELECT id,email,password FROM tbl_customer WHERE email  = '$email' AND password = '$password' LIMIT 1";
 			$resultCheck = $this->db->select($checkEmail);
 			if($resultCheck == true)
 			{
 				$value = $resultCheck->fetch_assoc();
 				Session::set('customer_login',true);
 				Session::set('customer_id',$value['id']);
 				Session::set('customer_name',$value['name']);
 				header("Location:order.php");
 				exit();
 			} 
 			else
 			{
 				$alert="<span class='error'>Email And Password doesn't match<span>";
 				return $alert;
 			}
 		}
 	} 

 	public function showCustomer($id)
 	{
 		$query = "SELECT * FROM tbl_customer WHERE id = '$id'";
 		$result = $this->db->select($query);
 		return $result;
 	}

 	public function Comment($id,$data) {	
 		
 			$query = "INSERT INTO comments(customer_id,comment,created_at)VALUES($id,'$data',NOW())";
	 		$result = $this->db->insert($query);
	 		return $result;
 	}

 	public function coutComment() {
 		$query = "SELECT id FROM comments";
 		$result = $this->db->select($query);
 		return $result;
 	}

 	public function getComment() {
 		$query = "SELECT * FROM comments";
 		$result = $this->db->select($query);
 		return $result;
 	}

}