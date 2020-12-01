<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');


class Contact
{
	private $db;
	private $fm;

	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function fetchAll() {
		$query = "SELECT * FROM tbl_contact ORDER BY id DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function addContact($data) {

		$name = mysqli_real_escape_string($this->db->link,$data['name']);
		$email = mysqli_real_escape_string($this->db->link,$data['email']);
		$phone = mysqli_real_escape_string($this->db->link,$data['phone']);
		$subject = mysqli_real_escape_string($this->db->link,$data['subject']);
		$date = date("d/m/Y");
		if (empty($name)  || empty($email) || empty($phone) || empty($subject)) {
			$alert = "<span class='error'>Fiels must be not empty</span>";	
			return $alert;
		} else {
			$query = "INSERT INTO tbl_contact (name,email,phone,subject,created_at)
			 VALUES('$name','email','$phone','$subject','$date')";
			$result = $this->db->insert($query);

			if ($result) {
				$alert = "<span class='success'>Cảm ơn bạn chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Thực hiện không thành công</span>";
				return $alert;
			}
		}
	}
}

