<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	  public function __construct()
       {
            parent::__construct();
            // Your own constructor code
			if(($this->session->userdata('user_name')==""))
			{
				redirect('/user');
			}
       }
       
	public function index()
	{
			$data['page_title'] = 'Admin Dashboard';		
			$this->load->view('admin/header_admin',$data);
			$this->load->view('admin/admin', $data);
			$this->load->view('admin/footer', $data);
	}
	

}