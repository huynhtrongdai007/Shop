<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

class User 
{
		
	private $db;
	private $fm;

	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	} 



	public function fetchPassword($adminUser) {
		 $query = "SELECT adminPass FROM tbl_admin WHERE
		 adminUser = '$adminUser' ";
		 $result = $this->db->select($query);
		 return $result;
	}

	public function changePassword($oldPass,$newPass) {

 		$oldPass = mysqli_real_escape_string($this->db->link,$oldPass);
 		$newPass = mysqli_real_escape_string($this->db->link,md5($newPass));

 		 $adminUser = Session::get('adminUser');
 		if (empty($oldPass) || empty($newPass) ) {
 			$alert="<span class='error'>Fiels must be not empty</span>";
 			return $alert;
 		} else {
 			$result = $this->fetchPassword($adminUser);
 			 $adminPass = $result->fetch_assoc();
 			 
 			if (md5($oldPass) == $adminPass['adminPass']) {
 				
 				$query = "UPDATE tbl_admin SET adminPass = '$newPass' WHERE adminUser = '$adminUser'";
 				$this->db->update($query);
 				$alert="<span class='success'>Change Password SuccessFully</span>";
				return $alert;
 			} else{
 				$alert="<span class='error'>Passwor Cu khong dung</span>";
				return $alert;
 			}
 			
 		}
		 
 	}


}
