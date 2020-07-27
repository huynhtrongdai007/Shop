<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
class Slider
{

	private $db;
	private $fm;

	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	} 

	public function insertSlider($data,$file)
	{
		$slidername = mysqli_real_escape_string($this->db->link,$data['title']);
		$status = mysqli_real_escape_string($this->db->link,$data['status']);
		// kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$premited = array('jpg','jpeg','png','gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "./sliders/".$unique_image;

		if (empty($slidername))
		{
			$alert="<span class='error'>Fiels must be not empty</span>";
			return $alert;
		} 
		else 
		{
			if(!empty($file_name))
			{
				if(in_array($file_ext, $premited)===false)
				{
					echo"<span class='error'>You can upload only:".implode(',', $premited)."</span>";
				}
				else
					{
					
					
						move_uploaded_file($file_temp, $uploaded_image);
						$query = "INSERT INTO tbl_slider(title,status,image)VALUES('$slidername','$status','$unique_image')";
						$result = $this->db->insert($query);
						if($result)
						{
							$alert="<span class='success'>Inserted Slider SuccessFully</span>";
							return $alert;
						}
						else
						{
							$alert="<span class='error'>Insert Slider Not Success</span>";
							return $alert;
						}
				   }
			}
			
		}
	}


	public function getAllSlider()
	{
		$query = "SELECT * FROM tbl_slider ORDER BY slider_id DESC";
		$result = $this->db->select($query);
		return $result;
	}

}