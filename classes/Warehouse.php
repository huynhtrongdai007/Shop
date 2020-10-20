<?php 


/**
 * 
 */
class Warehouse
{
	
	private $db;
	private $fm;

	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}



}

