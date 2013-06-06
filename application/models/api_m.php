<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_m extends CI_Model {
	public function get_petitions($type){
		
		if($type!='0'){
			$this->db->select("petitions.*, categories.*");
			$this->db->from("petitions");
			$this->db->join("categories", "petitions.category=categories.cat_id");
			$this->db->where("petitions.category", $type);
		}else{
			$this->db->select("petitions.*, categories.*");
			$this->db->from("petitions");
			$this->db->join("categories", "petitions.category=categories.cat_id");
		}
		
		$result = $this->db->get();
		$petitions = $result->result_array();
		return $petitions;
	}
	public function show_petition($id){
		$this->db->select("petitions.*, categories.*");
		$this->db->from("petitions");
		$this->db->join("categories", "petitions.category=categories.cat_id");
		$this->db->where("petitions.id", $id);
		
		$result = $this->db->get();
		$petition = $result->result_array();
		return $petition;
	}
	public function sign_petition($petition, $message){
		$this->db->query("insert into signatures(`user_id`, `petition_id`, `message`)values('0', '$petition', '$message')");
	}
}
?>