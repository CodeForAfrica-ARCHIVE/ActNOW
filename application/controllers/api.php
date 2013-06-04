<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index()
	{
		
	}
	public function get_petitions(){
		
		$this->load->model('api_m');
		
		if(isset($_GET['category'])){
			$type = $_GET['category'];
			$data['petitions'] = $this->api_m->get_petitions($type);
		}else{
			$data['petitions'] = $this->api_m->get_petitions('0');
		}
		
		$this->load->view('api/show_petitions', $data);
	}
}