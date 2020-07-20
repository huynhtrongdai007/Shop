<?php 
$filepath = realpath(dirname(__FILE__));
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

 	public function loginCustomer($data)
 	{
 		$email = mysqli_real_escape_string($this->db->link,$data['email']);
 		$password = mysqli_real_escape_string($this->db->link,$data['password']);

 		if(empty($email) || empty($password))
 		{
 			$alert="<span class='error'>Fiels must be not empty<span>";
 			return $alert;
 		}
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
 		$password = mysqli_real_escape_string($this->db->link,$data['password']);

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
 				$query = "INSERT INTO tbl_customer(name,city,zipcode,email,address,cuontry,phone,password)
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
}