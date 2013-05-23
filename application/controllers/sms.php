<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms extends CI_Controller {
		
	public function index(){
		$number = $_GET['phone'];
		$text = $_GET['text'];
	
		$this->load->model('subscribe');
		
		if(strpos(strtolower($text), 'unsubscribe')!==false){
			$returned = $this->subscribe->unsubscribe($number, $text);
			
			mail('actnowsms@gmail.com', $number, $returned);
		}else if(strpos(strtolower($text), 'subscribe')!==false){
			$returned = $this->subscribe->subscribe($number, $text);
			
			mail('actnowsms@gmail.com', $number, $returned);
		}else if(strpos(strtolower($text), 'register')!==false){
			$returned = $this->subscribe->register($number, $text);
			
			mail('actnowsms@gmail.com', $number, $returned);
		}else if(strpos(strtolower($text), 'sign')!==false){
			$returned = $this->subscribe->sign($number, $text);
			
			mail('actnowsms@gmail.com', $number, $returned);
		}
	}
	
	
}

?>