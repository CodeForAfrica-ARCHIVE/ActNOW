<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribe extends CI_Controller {

	public function index()
	{
		$message = $_GET['message'];
		$number = $_GET['number'];
		
		$message = str_replace('subscribe', '', $message);
		$message = trim($message);
		
		$this->db->query("select subscriptions.*, subscribers.*, petitions.* from subscriptions left join subscribers on subscribers.id=subscriptions.user left join petitions on subcriptions.petition=petition.id where petition.name='$message' and subscriber.number='$number'");
		$result = $this->db->get();
		
		if($result->num_rows()>0){
			return "already subscribed";
		}else{
			$this->subsciber_user($message, $number);
		}
	}
	
	public function subscribe_user($message, $number){
		$this->db->query("select * from subscribers where number='$number'");
		$result = $this->db->get();
		
		$result = $result->result_array();
		$user_id = $result[0]['id'];
		
		$this->db->query("select * from petitions where name='$message'");
		$result = $this->db->get();
		
		$result = $result->result_array();
		$petition_id = $result[0]['id'];
		
		$this->db->query("insert into subscriptions(user, petition)values('$user_id', '$petition_id')");	
		
		return "user subscribed";
	}
	public function email_petitions(){
		$email = $_GET['email'];
		$this->db->query("insert into subscribers(email)values('$email')");
		$user_id = $this->db->insert_id();
		$this->db->query("insert into subscriptions(user, petition)values('$user_id', '4')");
		echo "Thank you for your subscription";
	}
	public function sign_petitions(){
		$email = $_GET['email'];
		$message = $_GET['message'];
		$this->db->query("insert into subscribers(email)values('$email')");
		$user_id = $this->db->insert_id();
		
		$this->db->query("insert into signatures(petition_id, user_id, message)values('4', '$user_id', '$message')");
		echo "Thank you for your signature";
	}
	public function unsubscribe(){
		$result = $this->db->query("select * from petitions where name='$message'");
		//$result = $this->db->get();
		
		//$result = $result->result_array();
		$petition_id = $result[0]['id'];
		
		$number = $_GET['number'];
		$result = $this->db->query("select * from subscribers where number='$number'");
		//$result = $this->db->get();
		//
		//$result = $result->result_array();
		$user_id = $result[0]['id'];
		
		$this->db->query("delete from subscriptions where user='$user_id' and petition='$petition_id'");	
		
		return "unsubscribed successfully";
	}
	
}