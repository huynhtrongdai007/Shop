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


	public function fetchAll() {
		 $query = "SELECT * FROM tbl_admin order by adminId DESC";
		 $result = $this->db->select($query);
		 return $result;
	}

	public function fetchPassword($adminUser) {
		 $query = "SELECT adminPass FROM tbl_admin WHERE
		 adminUser = '$adminUser' ";
		 $result = $this->db->select($query);
		 return $result;
	}

	public function getById($id) {
		 $query = "SELECT * FROM tbl_admin WHERE adminId = '$id'";
		 $result = $this->db->select($query);
		 return $result;
	}

	public function insert($data) {
		$name = mysqli_real_escape_string($this->db->link,$data['adminName']);
 		$email = mysqli_real_escape_string($this->db->link,$data['adminEmail']);
 		$username = mysqli_real_escape_string($this->db->link,$data['adminUser']);
 		$password = mysqli_real_escape_string($this->db->link,$data['adminEmail']);
 		$level = mysqli_real_escape_string($this->db->link,$data['level']);
		
 		if (empty($name) || empty($username) || empty($email) || empty($password)) {
 			$alert="<span class='error'>Fiels must be not empty</span>";
 			return $alert;
 		}else {
 		  $query = "INSERT INTO tbl_admin VALUES('$name','$email','$username','$password','$level')";
 			$result = $this->db->insert($query);
 			if ($result) {
 				
		 			$alert="<span class='success'>Inserted User successfully</span>";
		 			return $alert;
 			}else{

		 			$alert="<span class='success'>Insert user not success</span>";
		 			return $alert;
 			}
 		}

	}


	public function updateData() {
		$name = mysqli_real_escape_string($this->db->link,$data['adminName']);
 		$email = mysqli_real_escape_string($this->db->link,$data['adminEmail']);
 		$username = mysqli_real_escape_string($this->db->link,$data['adminUser']);
 		$password = mysqli_real_escape_string($this->db->link,$data['adminEmail']);
 		$level = mysqli_real_escape_string($this->db->link,$data['level']);
		
 		if (empty($name) || empty($username) || empty($email) || empty($password)) {
 			$alert="<span class='error'>Fiels must be not empty</span>";
 			return $alert;
 		}else {
 		  $query = "UPDATE tbl_admin SET adminName = '$name',email = '$email',adminUser ='$username',adminPass = '$password', level = '$level')";
 			$result = $this->db->insert($query);
 			if ($result) {
 				
		 			$alert="<span class='success'>Updated User successfully</span>";
		 			return $alert;
 			}else{

		 			$alert="<span class='success'>Updated User not success</span>";
		 			return $alert;
 			}
 		}
	}

	public function Delete($id) {
		 $query = "DELETE FROM tbl_admin WHERE adminId = '$id'";
		 $result = $this->db->delete($query);
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
