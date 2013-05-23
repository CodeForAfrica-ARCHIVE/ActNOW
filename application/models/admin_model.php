<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model {
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
 public function get_subscribers(){
 	
	$this->db->select("*");
	$this->db->from("subscribers");
	$subscribers = $this->db->get();
	$subscribers = $subscribers->result_array();
	
	return $subscribers;
 }
 public function get_petitions(){
 	$this->db->select("*");
	$this->db->from("petitions");
	$petitions = $this->db->get();
	$petitions = $petitions->result_array();
	return $petitions;
	
 }
 public function process_updates($petition, $message){
 	$sql = mysql_query("select subscriptions.*, subscribers.* from subscriptions left join subscribers on subscribers.id=subscriptions.subscriber where subscriptions.petition='$petition'");
 	while($row = mysql_fetch_array($sql)){
 		mail('actnowsms@gmail.com', $row['number'], $message);
 	}
 }
 public function add_petition($name, $description){
 	$this->db->query("insert into petitions(name, description)values('$name', '$description')");
 }
}