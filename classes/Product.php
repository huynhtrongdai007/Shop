<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php 

class Product
{
	
	private $db;
	private $fm;

	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function insertProduct($data,$files)
	{
		$productName = mysqli_real_escape_string($this->db->link,$data['name']);
		$brand = mysqli_real_escape_string($this->db->link,$data['brand']);
		$category = mysqli_real_escape_string($this->db->link,$data['category']);
		$desc = mysqli_real_escape_string($this->db->link,$data['desc']);
		$price = mysqli_real_escape_string($this->db->link,$data['price']);
		$type = mysqli_real_escape_string($this->db->link,$data['type']);

		// kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$premited = array('jpg','jpeg','png','gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "./uploads/".$unique_image;

		if ($productName=="" || $brand=="" || $category=="" || $desc=="" || $price=="" || $type=="")
		{
			$alert="<span class='error'>Fiels must be not empty</span>";
			return $alert;
		} 
		else 
		{
			if(!empty($file_name))
			{
				// nếu người dùng chọn ảnh
				// if($file_size > 2048)
				// {	
				// 	$alert = "<span class='error'>Image Size should be less then 2MB</span>";
				// 	return $alert;
				// }
				// else
				if(in_array($file_ext, $premited)===false)
				{
					echo"<span class='error'>You can upload only:".implode(',', $premited)."</span>";
				}
			}
			else
			{
				// nếu người dùng không chọn ảnh
			}
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO tbl_product(category_id,brand_id,product_name,description,price,type,image)VALUES('$category','$brand','$productName','$desc','$price','$type','$unique_image')";
			$result = $this->db->insert($query);
			if($result)
			{
				$alert="<span class='success'>Insert Product SuccessFully</span>";
				return $alert;
			}
			else
			{
				$alert="<span class='error'>Insert Product Not Success</span>";
				return $alert;
			}
		}

	}


	public function updateProduct($data,$files,$id)
	{
		$productName = mysqli_real_escape_string($this->db->link,$data['name']);
		$brand = mysqli_real_escape_string($this->db->link,$data['brand']);
		$category_id = mysqli_real_escape_string($this->db->link,$data['category']);
		$desc = mysqli_real_escape_string($this->db->link,$data['desc']);
		$price = mysqli_real_escape_string($this->db->link,$data['price']);
		$type = mysqli_real_escape_string($this->db->link,$data['type']);

		// kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$premited = array('jpg','jpeg','png','gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "./uploads/".$unique_image;

		if ($productName=="" || $brand=="" || $category_id=="" || $desc=="" || $price=="" || $type=="")
		{
			$alert="<span class='error'>Fiels must be not empty</span>";
			return $alert;
		} 
		else 
		{
			if(!empty($file_name))
			{
				// nếu người dùng chọn ảnh
				// if($file_size > 2.0480)
				// {	
				// 	$alert = "<span class='error'>Image Size should be less then 2MB</span>";
				// 	return $alert;
				// }
				if(in_array($file_ext, $premited)===false)
				{
					$alert="<span class='error'>You can upload only:".implode(',', $premited)."</span>";
					return $alert;
				}
					move_uploaded_file($file_temp, $uploaded_image);
					$query = "UPDATE tbl_product SET category_id = '$category_id',brand_id='$brand',product_name='$productName',description='$desc',price='$price',type='$type',image='$unique_image' WHERE product_id = '$id'";
					
			}
			else
			{
				// nếu người dùng không chọn ảnh
				$query = "UPDATE tbl_product SET category_id = '$category_id',brand_id='$brand',product_name='$productName',description='$desc',price='$price',type='$type' WHERE product_id = '$id'";
					
			}
			
			$result = $this->db->update($query);
			if($result)
			{
				$alert="<span class='success'>Update Product SuccessFully</span>";
				return $alert;
			}
			else
			{
				$alert="<span class='error'>Update Product Not Success</span>";
				return $alert;
			}
		}

	}


	public function fetchAll()
	{
		$query = "SELECT pro.*,cat.name,br.brand_name FROM tbl_product as pro
		JOIN tbl_category as cat on pro.category_id = cat.category_id
		JOIN tbl_brand as br on pro.brand_id  = br.brand_id 
		 ORDER BY product_id DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function fetchById($id)
	{
		$query = "SELECT * FROM tbl_product WHERE product_id = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function Delete($id)
	{
		$query = "DELETE FROM tbl_product WHERE product_id = '$id'";
		$result = $this->db->delete($query);
		return $result;
	}
// -------------------------------Front-end----------------------------------------

	public function getProductFeathered($trang)
	{
		$from = ($trang - 1) * 4;
		$query = "SELECT * FROM tbl_product LIMIT $from,4";
		$result = $this->db->select($query);
		
		return $result;
	}

	public function getProductNew()
	{
		$query = "SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}

	public function getDetails($id)
	{
		$query = "SELECT pro.*,cat.name,br.brand_name FROM tbl_product as pro
		JOIN tbl_category as cat on pro.category_id = cat.category_id
		JOIN tbl_brand as br on pro.brand_id  = br.brand_id 
		WHERE pro.product_id = '$id'
		 ORDER BY product_id DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function insertCompare($product_id,$customer_id)
	{
		$product_id = mysqli_real_escape_string($this->db->link,$product_id);
		$customer_id = mysqli_real_escape_string($this->db->link,$customer_id);
		$checkCompare = "SELECT * FROM tbl_compare WHERE product_id = '$product_id' AND customer_id ='$customer_id'";
		$resultCheck = $this->db->select($checkCompare);
		if($resultCheck)
		{
			$smg = "<span class='error'>Product Already Added to Compare</span>";
			return $smg;
		} else {

				$query = "SELECT * FROM tbl_product WHERE product_id = $product_id";
				$result = $this->db->select($query)->fetch_assoc();
				$productName = $result['product_name']; 
				$price = $result['price'];
				$image = $result['image'];

				$query_insert = "INSERT INTO tbl_compare(product_name,product_id,customer_id,price,image) 
								VALUES('$productName','$product_id','$customer_id','$price','$image')";
				$query_insert_compare = $this->db->insert($query_insert);
				if ($query_insert_compare) {
						$alert="<span class='success'>Added Compare SuccessFully</span>";
						return $alert;		
				} else {
						$alert="<span class='error'>Add Compare Not Success</span>";
						return $alert;
				}
			}	

	}

	public function getAllCompareById($customer_id)
	{
		$query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' ORDER BY id DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function deleteCompare($id)
	{
		$query = "DELETE FROM tbl_compare WHERE id = '$id'";
		$result = $this->db->delete($query);
		return $result;
	}


	public function insertWishlist($product_id,$customer_id)
	{
		$product_id = mysqli_real_escape_string($this->db->link,$product_id);
		$customer_id = mysqli_real_escape_string($this->db->link,$customer_id);

		$checkWlist = "SELECT * FROM tbl_wishlist WHERE product_id = '$product_id' AND customer_id ='$customer_id'";
		
		$resultCheck = $this->db->select($checkWlist);
		if($resultCheck)
		{
			$smg = "<span class='error'>Product Already Added to wishlist</span>";
			return $smg;
		} else {

				$query = "SELECT * FROM tbl_product WHERE product_id = $product_id";
				$result = $this->db->select($query)->fetch_assoc();
				$productName = $result['product_name']; 
				$price = $result['price'];
				$image = $result['image'];

				$query_insert = "INSERT INTO tbl_wishlist(product_name,product_id,customer_id,price,image) 
								VALUES('$productName','$product_id','$customer_id','$price','$image')";
				$query_insert_wlist = $this->db->insert($query_insert);
				if ($query_insert_wlist) {
						$alert="<span class='success'>Added to wishlist SuccessFully</span>";
						return $alert;		
				} else {
						$alert="<span class='error'>Add to wishlist Not Success</span>";
						return $alert;
				}
			}	

	}

	public function getAllWishListById($customer_id)
	{
		$query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' ORDER BY id DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function deleteWishlish($id) {
		$query = "DELETE FROM tbl_wishlist WHERE id = '$id'";
		$result = $this->db->delete($query);
		return $result;
	}

	public function searchProduct($keywords)
	{
		$keywords = mysqli_real_escape_string($this->db->link,$keywords);
		$keywords = $this->fm->validation($keywords);
		$query = "SELECT * FROM tbl_product WHERE product_name LIKE '%$keywords%'";
		$result = $this->db->select($query);
		if(empty($result)){
			$alert="khong co ket qua tim kiem";
			return $alert;
		}else {
			return $result;
		}
	}

	public function countPage()
	{

		$query = "SELECT product_id FROM tbl_product";
		$result = $this->db->select($query);
		$cout = mysqli_num_rows($result);
		$sotrang = ceil($cout/ 4);
		return $sotrang;
	}




}
