<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
class Cart
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function addToCart($quantity,$id)
	{
		$quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link,$quantity);
		$id = mysqli_real_escape_string($this->db->link,$id);
		$sId = session_id();

		$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->select($query)->fetch_assoc();
		
		$image = $result['image'];
		$price = $result['price'];
		$productname = $result['productName'];

		$check_cart = "SELECT * FROM tbl_cart WHERE productid = '$id' AND sessionid = '$sId'";
		$check_result = $this->db->select($check_cart);
		if($check_result)
		{
			$msg="Product Already Added";
			return $msg;
		}
		else
		{
			$queryInsert = "INSERT INTO tbl_cart(productid,sessionid,productname,price,quantity,image)
						VALUES('$id','$sId','$productname','$price','$quantity','$image')";
			$insertCart = $this->db->insert($queryInsert);
			if($result)
			{
				header("location:cart.php");
				exit();
			}
			else
			{
				header("location:404.php");
				exit();
			}	
		}				
	}

	public function getCart()
	{
		$session_id = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sessionid = '$session_id' ORDER BY cartId desc";
		$result = $this->db->select($query);
		return $result;
		
		
		
	}

	public function updateCart($qty,$id)
	{
		$query = "UPDATE tbl_cart SET quantity = '$qty' WHERE cartId = '$id'";
		$result = $this->db->update($query);
		if($result)
		{
			header("location:cart.php");
		}
		else
		{
			$msg = "<span class='error'>Product Quantity Not Updated Seccess</span>";
			return $msg;
		}
	}

	public function deleteCart($id)
	{
		$query = "DELETE FROM tbl_cart WHERE cartId = '$id'";
		$result = $this->db->delete($query);
		if($result)
		{
			header("location:cart.php");
		}
			
	}

	public function checkCart()
	{
		$sId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sessionid = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function dellAllCart()
	{
		$sId = session_id();
		$query = "DELETE FROM tbl_cart WHERE sessionid = '$sId'";
		$result = $this->db->delete($query);
		return $result;
	}

	
}