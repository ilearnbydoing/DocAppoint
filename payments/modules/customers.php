<?php 
session_start();
class Customer
{
	private $db;

	function __construct()
	{
		$this->db = new Database;
	}

	function addCustomer($data){
	
    return true;
	}

	public function getCustomers()
	{
		$this->db->query('SELECT * FROM tbl_customers ORDER BY creat_date DESC');

		$result = $this->db->resultset();
		return $result;
	}
}