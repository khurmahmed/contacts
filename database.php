<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

require 'MysqliDatabase.php';

class Database {
	
public $server = 'localhost';
public $database = 'contacts_exercise';
public $username = 'root';
public $password = 'root';
public $db;
	
	//If DEV use original settings else use local variable settings
	function __construct($mode) {
		
		if($mode === 'DEV') {
			$connectionString  = "";
		} else {
			$connectionString  = "server=$this->server;database=$this->database;username=$this->username;password=$this->password";
		}
		//Connect to database.
		$this->db = new MysqliDatabase($connectionString);
	}
	
	//Get All contacts
	function getAll() {
		
		$query = 'SELECT CON_id, CON_first_name, CON_surname, CON_home_phone, CON_work_phone, CON_mobile_phone FROM con_contacts';
		return $this->db->query_all($query);
	}
	
	//Get contact by ID
	function getById($id) {
		
		$id = mysqli_real_escape_string($this->db, $id);
		$query = "SELECT * FROM con_contacts con INNER JOIN cou_countries cou ON con.CON_country_code = cou.COU_country_code WHERE con.CON_id=$id";
		return $this->db->query_one($query);
	}
	
	//Returns all countries
	function getCountries() {
		
		$query = "SELECT * FROM cou_countries";
		return $this->db->query_all($query);
	}
	
	//Inserts contact
	function insert($values) {
		
		$query = "INSERT INTO con_contacts (CON_first_name, CON_surname, CON_email, CON_home_phone, CON_mobile_phone, CON_work_phone, CON_address_1, CON_address_2, CON_address_3, CON_address_4, CON_postal_code, CON_country_code, notes) VALUES ($values)";
		return $this->db->query($query, false);
	}
	
	//Updates contact
	function update($id) {
		$firstname = $_POST['firstname'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$home = $_POST['home'];
		$mobile = $_POST['mobile'];
		$work = $_POST['work'];
		$address_1 = $_POST['address_1'];
		$address_2 = $_POST['address_2'];
		$address_3 = $_POST['address_3'];
		$address_4 = $_POST['address_4'];
		$postcode = $_POST['postcode'];
		$country = $_POST['country'];
		$notes = $_POST['notes'];
		$query = "UPDATE con_contacts SET CON_first_name='$firstname', CON_surname='$surname', CON_email='$email', CON_home_phone='$home', CON_mobile_phone='$mobile', CON_work_phone='$work', CON_address_1='$address_1', CON_address_2='$address_2', CON_address_3='$address_3', CON_address_4='$address_4', CON_postal_code='$postcode', CON_country_code='$country', notes='$notes' WHERE CON_id=$id";
		return $this->db->query($query, false);
	}
	
	//Deletes contact
	function delete($id) {
		
		$query = "DELETE FROM con_contacts WHERE CON_id = $id";
		return $this->db->query($query, false);
		
	}
}
	
	
	
?>