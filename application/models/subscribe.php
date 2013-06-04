<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subscribe extends CI_Model {
 public function __construct()
 {
  parent::__construct();
 }
 public function sign($number, $message){
 	 	$message = explode(',', trim($message));
		$signature = trim($message[2]);
		$petition = trim($message[1]);
		
 		$this->db->select("*");
		$this->db->from("petitions");
		$this->db->where("name",$petition);
		
		$result = $this->db->get();
		
		if($result->num_rows()<1){
			return "no petition with that name";
		}else{
			$result = $result->result_array();
			$petition_id = $result[0]['id'];
			//get user id
			$this->db->select("*");
			$this->db->from("subscribers");
			$this->db->where("number",$number);
			$result = $this->db->get();
			
			if($result->num_rows<1){
				//return "you are not registered on the system";
				$this->db->query("insert into subscribers(number)VALUES('$number')");
				$user_id = $this->db->insert_id();
			}else{
				$result = $result->result_array();
				$user_id = $result[0]['id'];
			}	
		
			$this->db->query("insert into signatures(petition_id, user_id, message)VALUES('$petition_id', '$user_id', '$signature')");
			$this->db->query("update petitions set signatures=signatures=1 where id='$petition_id'");
			return "thanks for your signature";
		}
 }
 public function register($number, $message){
 		$message = explode(',', trim($message));
		$name = trim($message[1]);
		$location = trim($message[2]);
		//get user id
		$this->db->select("*");
		$this->db->from("subscribers");
		$this->db->where("number",$number);
		$result = $this->db->get();
		
		if($result->num_rows>0){
			return "you already exist in our system";
		}else{
		$this->db->query("insert into subscribers(number, name, location)VALUES('$number', '$name', '$location')");
		return "registered succsessfully";
		}
	}
 public function subscribe($number, $message){
 		$message = explode(',', trim($message));
		$message = trim($message[1]);
		
 		$this->db->select("*");
		$this->db->from("petitions");
		$this->db->where("name",$message);
		
		$result = $this->db->get();
		
		if($result->num_rows()<1){
			return "no petition with that name";
		}else{
		$result = $result->result_array();
		$petition_id = $result[0]['id'];
		
		//get user id
		$this->db->select("*");
		$this->db->from("subscribers");
		$this->db->where("number",$number);
		$result = $this->db->get();
		
		if($result->num_rows<1){
			//return "you are not registered on the system";
			$this->db->query("insert into subscribers(number)VALUES('$number')");
			$user_id = $this->db->insert_id();
		}else{
			$result = $result->result_array();
			$user_id = $result[0]['id'];
		}	
		
		//
		$this->db->select("*");
		$this->db->from("subscriptions");
		$this->db->where("user",$user_id);
		$this->db->where("petition",$petition_id);
		$result = $this->db->get();
		
		if($result->num_rows()>0){
			return "you are already subscribed to that petition";
		}else{
			
		$this->db->query("insert into subscriptions(user, petition)VALUES('$user_id','$petition_id')");	
		
		return "subscribed successfully";
		}
	}
 }
 public function unsubscribe($number, $message){
 		
 		$message = explode(',', trim($message));
		$message = trim($message[1]);
		
 		$this->db->select("*");
		$this->db->from("petitions");
		$this->db->where("name",$message);
		
		$result = $this->db->get();
		
		if($result->num_rows()<1){
			return "no petition with that name";
		}else{
		$result = $result->result_array();
		$petition_id = $result[0]['id'];
		
		//
		$this->db->select("*");
		$this->db->from("subscribers");
		$this->db->where("number",$number);
		$result = $this->db->get();
		
		if($result->num_rows<1){
			return "you are not registered on the system";
		}else{
		$result = $result->result_array();
		$user_id = $result[0]['id'];
		//
		$this->db->select("*");
		$this->db->from("subscriptions");
		$this->db->where("user",$user_id);
		$this->db->where("petition",$petition_id);
		$result = $this->db->get();
		
		if($result->num_rows()<1){
			return "you are not subscribed to that petition";
		}else{
		
		$this->db->query("delete from subscriptions where user='$user_id' and petition='$petition_id'");	
		
		return "unsubscribed successfully";
		}
	}
	}
 }
}