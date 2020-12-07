<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

class Category
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function insertCategory($cateName)
	{
		$cateName = $this->fm->validation($cateName);
		$cateName = mysqli_real_escape_string($this->db->link,$cateName);
		
		if(empty($cateName))
		{
			$alert="<span class='error'>name category be not empty</span>";
			return $alert;
		}

		else
		{
		    $query = "INSERT INTO tbl_category(catName)VALUES('$cateName')";
			$result = $this->db->insert($query);
			
			if($result)	
			{
				$alert = "<span class='success'>insert category Successfully</span>";
				return $alert;
			}
			else
			{
				$alert = "<span class='error'>insert category not Success</span>";
				return $alert;
			}
		}
	}

	public function updateCategory($cateName,$id)
	{
		$cateName = $this->fm->validation($cateName);
		$cateName = mysqli_real_escape_string($this->db->link,$cateName);
		$id =  mysqli_real_escape_string($this->db->link,$id);
		if(empty($cateName))
		{
			$alert="<span class='error'>name category be not empty</span>";
			return $alert;
		}

		else
		{
		    $query = "UPDATE tbl_category SET catName='$cateName' WHERE catid = '$id'";
			$result = $this->db->update($query);
			
			if($result)	
			{
				$alert = "<span class='success'>edit category Successfully</span>";
				return $alert;
			}
			else
			{
				$alert = "<span class='error'>edit category not Success</span>";
				return $alert;
			}
		}
	}


	public function fetchAll()
	{
		$query = "SELECT * FROM tbl_category ORDER BY catId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function fetchById($id)
	{
		$query = "SELECT * FROM tbl_category WHERE catId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function Delete($id)
	{
		$query = "DELETE FROM tbl_category WHERE catId = '$id'";
		$result = $this->db->delete($query);
		return $result;
	}

	// view

	public function fetchProductByCat($id)
	{
		$query = "SELECT *  FROM tbl_product as pro join tbl_category as cat 
		on pro.catId = cat.catID
		 WHERE cat.catId = '$id' ORDER BY cat.catId DESC";
		$result = $this->db->delete($query);
	
		return $result;
	}
}