<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php

class Order 
{
	private $db;
	private $fm;

	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function insertOrder($customer_id)
	{
		$sId = session_id();

		$query = "SELECT * FROM tbl_cart WHERE sessionid = '$sId'";
		$getProduct = $this->db->select($query);
		if ($getProduct) {
			while ($result = $getProduct->fetch_assoc()) {
				$productid = $result['productId'];
				$productname = $result['productName'];
				$quantity = $result['quantity'];
				$price = $result['price'] * $quantity;
				$image = $result['image'];
				$customerid = $customer_id;
				$queryInsert = "INSERT INTO tbl_order(productId,productName,customer_id,price,quantity,image)
						VALUES('$productid','$productname','$customerid','$price','$quantity','$image')";
				 $this->db->insert($queryInsert);	
			}
		}
	}

	public function getAmounPrice($customer_id)
	{
		$query = "SELECT price FROM  tbl_order WHERE customer_id = '$customer_id'";
		$result = $this->db->select($query);
		return $result;	
	}

	public function getOrdered($customer_id)
	{
		$query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
		$result = $this->db->select($query);
		return $result;	
	}

	public function checkOrder($customer_id)
	{
		$sId = session_id();
		$query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function getInbox()
	{
		$query = "SELECT * FROM tbl_order";
		$result = $this->db->select($query);
		return $result;
	}

	// khach hang huy đơn hàng
	public function deleteOrder($id) {
		$query = "DELETE FROM tbl_order WHERE id = '$id'";
		$result = $this->db->delete($query);
		return $result;
	}

		public function shifted($id,$proid,$qty,$time,$price)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$proid = mysqli_real_escape_string($this->db->link, $proid);
			$qty = mysqli_real_escape_string($this->db->link, $qty);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);

			$query_select = "SELECT * FROM tbl_product WHERE productId='$proid'";
			$get_select = $this->db->select($query_select);

			if($get_select){
				while($result = $get_select->fetch_assoc()){
					$soluong_new = $result['product_remain'] - $qty;
					$qty_soldout = $result['product_soldout'] + $qty;

					$query_soluong = "UPDATE tbl_product SET

					product_remain = '$soluong_new',product_soldout = '$qty_soldout' WHERE productId = '$proid'";
					 $this->db->update($query_soluong);
				}
			}

			$query = "UPDATE tbl_order SET

			status = '1'

			WHERE id = '$id' AND date_order = '$time' AND price = '$price' ";
		    $this->db->update($query);
			
		}

		
	// public function shifted($id,$time,$price)
	// {
	// 	$id = mysqli_real_escape_string($this->db->link,$id);
	// 	$time = mysqli_real_escape_string($this->db->link,$time);
	// 	$price = mysqli_real_escape_string($this->db->link,$price);

	// 	$query = "UPDATE tbl_order SET status = 1 WHERE id = '$id' AND date_order = '$time' AND price ='$price'";
	// 	$result = $this->db->update($query);
	// 	if($result)
	// 	{
	// 		$alert = "<span class='success'>Update Order SuccessFully</span>";
	// 		return $alert;
	// 	}
	// 	else
	// 	{
	// 		$alert = "<span class='error'>Update Order Not Success/span>";
	// 		return $alert;
	// 	}
	// }

	public function deleteShifted($id,$time,$price)
	{
		$id = mysqli_real_escape_string($this->db->link,$id);
		$time = mysqli_real_escape_string($this->db->link,$time);
		$price = mysqli_real_escape_string($this->db->link,$price);
		$query = "DELETE FROM tbl_order WHERE id = '$id' AND date_order = '$time' AND price ='$price'";
		$result = $this->db->delete($query);
		if($result)
		{
			$alert = "<span class='success'>Delete Order SuccessFully</span>";
			return $alert;
		}
		else
		{
			$alert = "<span class='error'>Delete Order Not Success/span>";
			return $alert;
		}
	}

	public function shiptedConfirm($id,$time,$price)
	{	
		$id = mysqli_real_escape_string($this->db->link,$id);
		$time = mysqli_real_escape_string($this->db->link,$time);
		$price = mysqli_real_escape_string($this->db->link,$price);

		$query = "UPDATE tbl_order SET status = 2 WHERE customer_id = '$id' AND date_order = '$time' AND price ='$price'";
		$result = $this->db->update($query);
		return $result;
	}

}