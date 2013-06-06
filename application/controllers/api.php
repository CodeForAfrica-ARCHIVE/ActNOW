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
	public function show_petition(){
		$id = $_GET['id'];
		$this->load->model('api_m');
		$data['petitions'] = $this->api_m->show_petition($id);
		$this->load->view('api/show_petitions', $data);
	}
	public function sign_petition(){
		$petition = $_GET['pid'];
		$message = $_GET['description'];
		$this->load->model('api_m');
		$data['petitions'] = $this->api_m->sign_petition($petition, $message);
		$this->load->view('api/sign_petition');
	}
}