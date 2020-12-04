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
		$slidername = mysqli_real_escape_string($this->db->link,$data['sliderName']);
		$link = mysqli_real_escape_string($this->db->link,$data['link']);
		$type = mysqli_real_escape_string($this->db->link,$data['type']);
		// kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$premited = array('jpg','jpeg','png','gif');
		$file_name = $_FILES['slider_image']['name'];
		$file_size = $_FILES['slider_image']['size'];
		$file_temp = $_FILES['slider_image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "./sliders/".$unique_image;

		if (empty($slidername) || empty($link))
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
						$query = "INSERT INTO tbl_slider(sliderName,type,slider_image)VALUES('$slidername','$type','$unique_image')";
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



	public function updateSlider($data,$files,$id)
	{
		$slidername = mysqli_real_escape_string($this->db->link,$data['sliderName']);
		$link = mysqli_real_escape_string($this->db->link,$data['link']);
		// kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$premited = array('jpg','jpeg','png','gif');
		$file_name = $_FILES['slider_image']['name'];
		$file_size = $_FILES['slider_image']['size'];
		$file_temp = $_FILES['slider_image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
		$uploaded_image = "./sliders/".$unique_image;

		if (empty($slidername) || empty($link))
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
					$alert="<span class='error'>You can upload only:".implode(',', $premited)."</span>";
					return $alert;
				}
					move_uploaded_file($file_temp, $uploaded_image);
					$query = "UPDATE tbl_slider SET sliderName = '$slidername',link='$link',slider_image='$unique_image' WHERE sliderId = '$id'";
					
			}
			else
			{
				// nếu người dùng không chọn ảnh
				$query = "UPDATE tbl_slider SET sliderName = '$slidername',	link='$link' WHERE sliderId = '$id'";
					
			}
			
			$result = $this->db->update($query);
			if($result)
			{
				$alert="<span class='success'>Updated Slider SuccessFully</span>";
				return $alert;
			}
			else
			{
				$alert="<span class='error'>Update Slider Not Success</span>";
				return $alert;
			}
		}

	}


	public function getBYId($id)
	{
		$query = "SELECT * FROM tbl_slider WHERE sliderId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function getAllSlider()
	{
		$query = "SELECT * FROM tbl_slider ORDER BY sliderId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getBytype()
	{
		$query = "SELECT * FROM tbl_slider WHERE type = 1 ORDER BY sliderId DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function updatetype($id,$type){
		$type = mysqli_real_escape_string($this->db->link,$type);
		$query = "UPDATE tbl_slider SET type = '$type' WHERE sliderId = '$id'";
		$result = $this->db->update($query);
		return $result;
	}	

	public function deleteSlider($id)
	{
		$query = "DELETE FROM tbl_slider WHERE sliderId = '$id'";
		$result = $this->db->delete($query);
		return $result;
	}


}