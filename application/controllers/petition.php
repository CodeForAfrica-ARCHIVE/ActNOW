<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Petition extends CI_Controller {

	public function index()
	{
		
	}
	public function sign_petition(){
		$this->load->model('db_functions');
		
		$message = $_POST['message'];
		$sender = $_POST['sender'];
		
		$message = explode('#', $message);
		
		$custom_message = $message[1];
		$petition = $message[0];
		
		$petition_id = $this->db_functions->petition_id($petition);
		$user_id = $this->db_functions->user_id($sender);
		
		if(!$this->db_functions->user_signed_petition($petition_id, $user_id)){
			$this->db_functions->sign_petition($petition_id, $user_id);
			return "thank you for your signature";
		}else{
			return "user has already signed petition";
		}
	}
}
		