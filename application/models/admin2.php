<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin2 extends CI_Model {
	public function index(){
 	
 }
 public function stats(){
 	$query = $this->db->query("select * from subscribers");
	$subscribers = $query->num_rows();
	
	$query = $this->db->query("select * from petitions");
	$petitions = $query->num_rows();
	
	$query = $this->db->query("select * from signatures");
	$signatures = $query->num_rows();
	
	$stats = array('subscribers'=>$subscribers, 'petitions'=>$petitions, 'signatures'=>$signatures);
	return $stats;
	
 }
}