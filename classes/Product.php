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
		$Productcode = mysqli_real_escape_string($this->db->link,$data['product_code']); 
		$Quantity = mysqli_real_escape_string($this->db->link,$data['productQuantity']); 
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

		if ($productName=="" || $brand=="" || $category=="" || $desc=="" || $price=="" || $type=="" || $Productcode=="" || $Quantity=="")
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
			$query = "INSERT INTO tbl_product(catId,brandId,productName,product_code,productQuantity,product_remain,product_desc,price,type,image)VALUES('$category','$brand','$productName','$Productcode','$Quantity','$Quantity','$desc','$price','$type','$unique_image')";
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
		$Productcode = mysqli_real_escape_string($this->db->link,$data['product_code']); 
		$Quantity = mysqli_real_escape_string($this->db->link,$data['productQuantity']);
		// kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$premited = array('jpg','jpeg','png','gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "./uploads/".$unique_image;

		if ($productName=="" || $brand=="" || $category_id=="" || $desc=="" || $price=="" || $type=="" || $Productcode=="" || $Quantity=="")
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
					$query = "UPDATE tbl_product SET catId = '$category_id',brandId='$brand',productName='$productName',product_code='$Productcode',productQuantity='$Quantity', product_desc='$desc',price='$price',type='$type',image='$unique_image' WHERE productId = '$id'";
					
			}
			else
			{
				// nếu người dùng không chọn ảnh
				$query = "UPDATE tbl_product SET catId = '$category_id',brandId='$brand',productName='$productName',product_desc='$desc',price='$price',type='$type' WHERE productId = '$id'";
					
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
		$query = "SELECT pro.*,cat.catName,br.brandName FROM tbl_product as pro
		JOIN tbl_category as cat on pro.catId = cat.catId
		JOIN tbl_brand as br on pro.brandId  = br.brandId 
		 ORDER BY productId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function fetchById($id)
	{
		$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function Delete($id)
	{
		$query = "DELETE FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->delete($query);
		return $result;
	}



public function show_product_warehouse(){
			$query = 
			"SELECT tbl_product.*, tbl_warehouse.*

			 FROM tbl_product INNER JOIN tbl_warehouse ON tbl_product.productId = tbl_warehouse.id_sanpham
								
			 order by tbl_warehouse.sl_ngaynhap desc ";

		
			$result = $this->db->select($query);
			return $result;
		}


public function update_quantity_product($data,$files,$id){
			$product_more_quantity = mysqli_real_escape_string($this->db->link, $data['product_more_quantity']);
			$product_remain = mysqli_real_escape_string($this->db->link, $data['product_remain']);
			
			if($product_more_quantity == ""){

				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert; 
			}else{
					$qty_total = $product_more_quantity + $product_remain;
				
					$query = "UPDATE tbl_product SET
					
					product_remain = '$qty_total'

					WHERE productId = '$id'";
					
					}
					$query_warehouse = "INSERT INTO tbl_warehouse(id_sanpham,sl_nhap) VALUES('$id','$product_more_quantity') ";
					$result_insert = $this->db->insert($query_warehouse);
					$result = $this->db->update($query);

					if($result){
						$alert = "<span class='success'>Thêm số lượng thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm số lượng không thành công</span>";
						return $alert;
					}
				
		}










// -------------------------------Front-end----------------------------------------

	public function getProductFeathered($trang)
	{
		$from = ($trang - 1) * 4;
		$query = "SELECT * FROM tbl_product order by product_soldout DESC LIMIT $from,4";
		$result = $this->db->select($query);
		
		return $result;
	}

	public function getProductNew()
	{
		$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}

	public function getDetails($id)
	{
		$query = "SELECT pro.*,cat.catName,br.brandName FROM tbl_product as pro
		JOIN tbl_category as cat on pro.catId = cat.catId
		JOIN tbl_brand as br on pro.brandId  = br.brandId 
		WHERE pro.productId = '$id'
		ORDER BY productId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function insertCompare($productId,$customer_id)
	{
		$productId = mysqli_real_escape_string($this->db->link,$productId);
		$customer_id = mysqli_real_escape_string($this->db->link,$customer_id);
		$checkCompare = "SELECT * FROM tbl_compare WHERE productId = '$productId' AND customer_id ='$customer_id'";
		$resultCheck = $this->db->select($checkCompare);
		if($resultCheck)
		{
			$smg = "<span class='error'>Product Already Added to Compare</span>";
			return $smg;
		} else {

				$query = "SELECT * FROM tbl_product WHERE productId = $productId";
				$result = $this->db->select($query)->fetch_assoc();
				$productName = $result['productName']; 
				$price = $result['price'];
				$image = $result['image'];

				$query_insert = "INSERT INTO tbl_compare(productName,productId,customer_id,price,image) 
								VALUES('$productName','$productId','$customer_id','$price','$image')";
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


	public function insertWishlist($productId,$customer_id)
	{
		$productId = mysqli_real_escape_string($this->db->link,$productId);
		$customer_id = mysqli_real_escape_string($this->db->link,$customer_id);

		$checkWlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productId' AND customer_id ='$customer_id'";
		
		$resultCheck = $this->db->select($checkWlist);
		if($resultCheck)
		{
			$smg = "<span class='error'>Product Already Added to wishlist</span>";
			return $smg;
		} else {

				$query = "SELECT * FROM tbl_product WHERE productId = $productId";
				$result = $this->db->select($query)->fetch_assoc();
				$productName = $result['productName']; 
				$price = $result['price'];
				$image = $result['image'];

				$query_insert = "INSERT INTO tbl_wishlist(productName,productId,customer_id,price,image) 
								VALUES('$productName','$productId','$customer_id','$price','$image')";
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

		$query = "SELECT productId FROM tbl_product";
		$result = $this->db->select($query);
		$cout = mysqli_num_rows($result);
		$sotrang = ceil($cout/ 4);
		return $sotrang;
	}


	// lấy sản phẩm mói nhất theo thương hiệu

	public function getProductTP_Link() {
		$query = "SELECT pr.productId,pr.productName,br.brandName,pr.image,pr.product_desc FROM tbl_product as pr join tbl_brand as br
		on pr.brandId = br.brandId	
		 where br.brandId = 14 order by pr.productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}

	public function getProduct_OEM() {
		$query = "SELECT pr.productId,pr.productName,br.brandName,pr.image,pr.product_desc FROM  tbl_product 
		as pr join tbl_brand as br
		on pr.brandId = br.brandId	
		where br.brandId = 13 order by pr.productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}

	public function getProduct_Viettel() {
		$query = "SELECT pr.productId,pr.productName,br.brandName,pr.image,pr.product_desc FROM  tbl_product 
		as pr join tbl_brand as br
		on pr.brandId = br.brandId	
		where br.brandId = 12 order by pr.productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}

	public function getProduct_Dell() {
		$query = "SELECT pr.productId,pr.productName,br.brandName,pr.image,pr.product_desc FROM tbl_product 
		as pr join tbl_brand as br
		on pr.brandId = br.brandId	
		 where br.brandId = 10 order by pr.productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}


}
