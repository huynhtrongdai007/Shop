<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php

 class Brand 
 {
 	private $db;
 	private $fm;

 	function __construct()
 	{
 		$this->db = new Database();
 		$this->fm = new Format();
 	}

 	

 	public function insertBrand($brandName)
 	{
 		$brandName = $this->fm->validation($brandName);
 		$brandName = mysqli_real_escape_string($this->db->link,$brandName);

 		if(empty($brandName))
 		{
 			$alert="<span class='error'>name brand be not empty</span>";
 			return $alert;
 		} 
 		elseif(strlen($brandName) > 10)
 		{
		$alert="<span class='error'>name brand khong vuot qua 10 ky tu</span>";
 			return $alert;
 		}

 		else
 		{
 			if($this->checkName($brandName))
 			{
	 			$alert="<span class='error'>Name brand was has please choose other name</span>";
	 			return $alert;
 			}
 			else
 			{
 				$query = "INSERT INTO tbl_brand(brand_name) VALUES('$brandName')";
 				$result = $this->db->insert($query);

	 			if($result)
	 			{

		 			$alert="<span class='success'>Insert brand name successfully</span>";
		 			return $alert;
	 			}
	 			else
	 			{
	 				$alert="<span class='error'>Insert brand name not success</span>";
		 			return $alert;
	 			}
 			}
 			
 		}

 	}

 	public function updateBrand($id,$brandName)
 	{
 		$brandName = $this->fm->validation($brandName);
 		$brandName = mysqli_real_escape_string($this->db->link,$brandName);

 		if(empty($brandName))
 		{
 			$alert="<span class='error'>name brand be not empty</span>";
 			return $alert;
 		}
 		elseif(strlen($brandName) > 10)
 		{
			$alert="<span class='error'>name brand khong vuot qua 5 ky tu</span>";
 			return $alert;
 		}
 		else
 		{
 			$query = "UPDATE tbl_brand SET brand_name = '$brandName' WHERE brand_id = '$id'";
 			$result = $this->db->update($query);

 			if($result)
 			{

	 			$alert="<span class='success'>Update brand name successfully</span>";
	 			return $alert;
 			}
 			else
 			{
 				$alert="<span class='error'>Update brand name not success</span>";
	 			return $alert;
 			}
 		}
 	}


 	public function fetchAll()
 	{
 		$query = "SELECT * FROM tbl_brand ORDER BY brand_id DESC";
 		$result = $this->db->select($query);
 		return $result;
 	}

 	public function fetchById($id)
 	{
 		$query = "SELECT * FROM tbl_brand WHERE brand_id = '$id'";
 		$result = $this->db->select($query);
 		return $result;
 	}

 	public function Delete($id)
 	{
 		$query = "DELETE FROM tbl_brand WHERE brand_id = '$id'";
 		$result = $this->db->delete($query);
 		return $result;
 	}
	// kiem tra ten co trong db chua
 	public function checkName($name)
 	{
 		$query = "SELECT brand_name FROM tbl_brand WHERE brand_name = '$name'";
 		$result = $this->db->select($query);
 		return $result;
 	}
 
 } 



