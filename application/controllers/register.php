<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{
		$message = $_POST['message'];
		 $sender = $_POST['sender'];
		
		$message = explode('#', $message);
		
		$name = $message[0];
		$location = $message[0];
		
		$this->db->query("select * from subscribers where number='$sender'");
		$result = $this->db->get();
		
		if($result->num_rows()>0){
			return "user already registered";
		}else{
			$this->register_user($sender, $name, $location);
		}
	}
	
	public function register_user($sender, $name, $location){
		$this->db->query("insert into `subscribers`(`name`, `number`, `location`)values('$name', '$number', '$location')");
		return "registered";
	}
	
}