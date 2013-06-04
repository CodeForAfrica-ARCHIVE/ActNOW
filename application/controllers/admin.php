<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	  public function __construct()
       {
            parent::__construct();
            // Your own constructor code
			if(($this->session->userdata('user_name')==""))
			{
				redirect(base_url().'index.php/user');
			}
       }
       
	public function index()
	{
			$data['page_title'] = 'Admin Dashboard';
				
			//get stats
			$this->load->model('admin_model');
			$data['stats'] = $this->admin_model->stats();
			
			$this->load->view('admin/header_admin',$data);
			$this->load->view('admin/admin', $data);
			$this->load->view('admin/footer', $data);
	}
	public function subscribers(){
		$this->load->model('admin_model');
		$data['page_title'] = "Subscribers";
		$data['subscribers'] = $this->admin_model->get_subscribers();
		
		$this->load->view('admin/header_admin', $data);
		$this->load->view('admin/subscribers', $data);
		$this->load->view('admin/footer', $data);
	} 
	public function petitions(){
	   	$data['page_title'] = 'Petitions';
		$this->load->model('admin_model');
		$data['petitions'] = $this->admin_model->get_petitions();
		
		$this->load->view('admin/header_admin', $data);
		$this->load->view('admin/petitions', $data);
		$this->load->view('admin/footer', $data);
		
	   }
	public function signatures(){
	   	$data['page_title'] = 'Signatures';
		$this->load->model('admin_model');
		$data['signatures'] = $this->admin_model->get_signatures();
		$this->load->view('admin/header_admin', $data);
		$this->load->view('admin/signatures', $data);
		$this->load->view('admin/footer', $data);
		
	   }
	public function new_petition(){
		$data['page_title'] = 'Add petition';
		$this->load->view('admin/header_admin', $data);
		$this->load->view('admin/add_petition', $data);
		$this->load->view('admin/footer', $data);
	}
public function send_update(){
		$data['page_title'] = 'Send Update';
		$this->load->model('admin_model');
		$data['petitions'] = $this->admin_model->get_petitions();
		if(isset($_POST)){
			$this->admin_model->process_updates($_POST['petition'], $_POST['message']);
		}
		$this->load->view('admin/header_admin', $data);
		$this->load->view('admin/send_update', $data);
		$this->load->view('admin/footer', $data);
	}

	public function add_petition(){
		$name = $_POST['name'];
		$description = $_POST['description'];
		
		$this->load->model('admin_model');
		$this->admin_model->add_petition($name, $description);
		redirect(base_url()."index.php/admin/petitions");
	}
		public function manage_users(){
	
		$data['page_title'] = 'Manage Users';
		$this->load->view('admin/header_admin', $data);
		$this->load->view('admin/users',$data);
		$this->load->view('admin/add_user', $data);
		$this->load->view('admin/footer', $data);
		
	}
}