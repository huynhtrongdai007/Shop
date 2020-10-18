<?php 
 $filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../lib/session.php';
Session::checkLogin();
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
 class adminlogin
 {
 	private	$db;
 	private $fm;
 	function __construct()
 	{
 		$this->db = new Database();
 		$this->fm = new Format(); 
 	}

 	public function loginAdmin($adminUser,$adminPass)
 	{
 		$adminUser = $this->fm->validation($adminUser);
 		$adminPass  = $this->fm->validation($adminPass);

 		$adminUser = mysqli_real_escape_string($this->db->link,$adminUser);
 		$adminPass = mysqli_real_escape_string($this->db->link,$adminPass);

 		if(empty($adminUser) || empty($adminPass))
 		{
 			$alert('Username and Password must be not empty');
 			return $alert;
 		}
 		else
 		{
 			$query = "SELECT adminName,adminPass FROM tbl_admin WHERE adminName = '$adminUser' AND adminPass = '$adminPass'";
 			$result = $this->db->select($query);

 			if($result != false)
 			{
 				$value = $result->fetch_assoc();
 				Session::set('adminlogin',true);
 				Session::set('adminID',$value['adminId']);
 				Session::set('adminUser',$value['adminName']);
 				Session::set('adminPass',$value['adminPass']);
 				header("location:index.php");
 				exit();
 			}
 			else
 			{
 				$alert = "User and Password not match";
 				return $alert;
 			}
 		}
 	}

 }