<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Db_functions extends CI_Model {
	 
	 public function __construct()
	 {
	  parent::__construct();
	 }
	public function petition_id($petition){
		$this->db->query("select * from petitions where name='$petition'");
		$result = $this->db->get();
		
		$result = $result->result_array();
		$petition_id = $result[0]['id'];
		
		return $petition_id;
	}
	public function user_signed_petition($user_id, $petition_id){
		$query = $this->db->query("select * from signatures where petition_id='$petition_id' and user_id='$user_id'");
		//$result = $result->result_array();
		
		if($query->num_rows()==0){
			return false;
		}else{
			return true;
		}
	}
	public function sign_petition($user_id, $petition_id){
		$this->db->query("insert into signatures(petition_id, user_id)values('$petition_id','$user_id')");
				
	}
	
}
