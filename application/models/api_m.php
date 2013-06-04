<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_m extends CI_Model {
	public function get_petitions($type){
		
		if($type!=''){
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
}
?>