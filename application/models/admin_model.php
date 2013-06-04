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
 public function get_signatures(){
 	$this->db->select("signatures.*, subscribers.*");
	$this->db->from("signatures");
	$this->db->join("subscribers", "subscribers.id=signatures.user_id");
	$signatures = $this->db->get();
	$signatures = $signatures->result_array();
	return $signatures;
	
 }
 public function process_updates($petition, $message){
 	$sql = mysql_query("select subscriptions.*, subscribers.* from subscriptions left join subscribers on subscribers.id=subscriptions.subscriber where subscriptions.petition='$petition'");
 	while($row = mysql_fetch_array($sql)){
 		mail('actnowsms@gmail.com', $row['number'], $message);
 	}
 }
 public function add_petition($name, $description, $url){
 	$this->db->query("insert into petitions(name, description, image)values('$name', '$description', '$url')");
 }
 public function add_picture($image){
 	define ("MAX_SIZE","2000"); 
	//This function reads the extension of the file. It is used to determine if the
	// file  is an image by checking the extension.
	 function getExtension($str) {
	         $i = strrpos($str,".");
	         if (!$i) { return ""; }
	         $l = strlen($str) - $i;
	         $ext = substr($str,$i+1,$l);
	         return $ext;
	 }
	 
	//If the error occures the file will not be uploaded.
	 $errors=0;
	
	 	//reads the name of the file the user submitted for uploading
	 	
	 	//if it is not empty
	 	if ($image) 
	 	{
	 	//get the original name of the file from the clients machine
	 		$filename = stripslashes($_FILES['image']['name']);
	 	//get the extension of the file in a lower case format
	  		$extension = getExtension($filename);
	 		$extension = strtolower($extension);
	 	//if it is not a known extension, we will suppose it is an error and 
	        // will not  upload the file,  
		//otherwise we will do more tests
	 if (($extension != "jpg") && ($extension != "jpeg") && ($extension !=
	 "png") && ($extension != "gif")) 
	 		{
			//print error message
	 			$message = 'Unknown extension!';
	 			$errors=1;
	 		}
	 		else
	 		{
	//get the size of the image in bytes
	 //$_FILES['image']['tmp_name'] is the temporary filename of the file
	 //in which the uploaded file was stored on the server
	 $size=filesize($_FILES['image']['tmp_name']);
	
	//compare the size with the maxim size we defined and print error if bigger
	if ($size > MAX_SIZE*1024)
	{
		$message = 'You have exceeded the size limit!';
		$errors=1;
	}
	
	//we will give an unique name, for example the time in unix time format
	$image_name=time().'.'.$extension;
	//the new name will be containing the full path where will be stored (images 
	//folder)
	$newname="C:/xampp/htdocs/actNow/assets/uploads/".$image_name;
	
		  
		  
		  
	//we verify if the image has been uploaded, and print error instead
	$copied = copy($_FILES['image']['tmp_name'], $newname);
	if (!$copied) 
	{
		$message =  'Copy unsuccessfull!';
		$errors = 1;
	}}}
	
	//If no errors registred, print the success message
	 if(!$errors) 
	 {
		return array('errors'=>"0", 'image'=>$image_name);
		
	 }else{
	 	
	 	return array('errors'=>"1", 'message'=>$message);
	 }
	 
 }
}