<?php

class Transaction
{
	private $db;

	function __construct()
	{
		$this->db = new Database;
	}

	function addTransaction($data)
	{
		//prepare query
		echo $this->db->query('INSERT INTO 
		appointments(
			patient_id,
			doctor_id, 
			comments, 
			patient_first_name, 
			patient_last_name, 
			patient_email, 
			patient_mobile, 
			patient_dob, 
			patient_gender,
			appointment_datetime,
			system_logs_id, 
			appointment_status) 
		VALUES (
			'.$_SESSION["user_id"].',
			'.$_SESSION[md5("selected_dr_id")].',
			"'.$_POST["message"].'",
			"'.$_POST["first_name"].'",
			"'.$_POST["last_name"].'",
			"'.$_POST["mobile"].'",
			"'.$_POST["email"].'",
			'.$_POST["dob"].',
			"'.$_POST["gender"].'",
			"'.$_SESSION["appointmentDatetime"].'",
			1,
			"confirmed")');
		//Execute
		if ($this->db->execute()) {
			$this->db->query('INSERT INTO payments(appointment_id, user_id, session_id, amount, transaction_id, status) VALUES (1,1,"' . session_id() . '",:amount,:id,:status)');
			//Bind Values
			$this->db->bind(':id', $data['id']);
			$this->db->bind(':amount', $data['amount']);
			$this->db->bind(':status', $data['status']);

			if ($this->db->execute()) {
				return true;
			}
		} else {
			return false;
		}
	}
}
