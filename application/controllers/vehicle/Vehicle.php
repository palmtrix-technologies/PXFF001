<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('usermanagement/User_model');
		$this->load->model('usermanagement/Login_model');
		$this->load->model('usermanagement/Permission_model');
		$this->load->library(array('form_validation','session','upload'));
		$this->load->helper(array('url','html','form'));
		$this->load->library('pagination');
         $this->load->database(); 
		 $this->load->library('session');
		 $this->load->helper('url');

		 $this->load->model('transaction/Transaction_model');
        $this->load->model('vehicle/Vehicle_model');
	}

	
	public function index()
	{
		 $user_id=	$this->session->userdata('user_id');
		$data['value'] = $this->Vehicle_model->list();
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);

		$user_image['values']=$res[0]->user_image;
			// var_dump($res);
			// die();
			$result['permission']=$this->Login_model->select_all_menu($user_id);	
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

			$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('vehicle/vehicle',$data,$result);
		 $this->load->view('includes/footer');
	}
	public function create()
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$data['code']=$this->Vehicle_model->selectcode();
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('vehicle/create_vehicle',$data);
		$this->load->view('includes/footer');	
	}
	public function store()
	{
		$postdata=$this->input->post('postData');
		$data=$postdata["postData1"];
		$supid= $this->Vehicle_model->add($data);

		$result="success";
		echo json_encode($result);
		
	}
	public function edit($id)
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		$data['value'] = $this->Vehicle_model->edit($id);
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('vehicle/edit_vehicle',$data);
		$this->load->view('includes/footer');	
	}
	public function update()
	{	
	
		$postdata=$this->input->post('postData');
		
		$data=$postdata["postData1"];
		$id=$postdata["id"];

		$result= $this->Vehicle_model->update($id,$data);


		echo json_encode($result);
	}
	//update status
	public function enable_status($id)
	
	{
		$result = $this->Vehicle_model->enable_status($id);

		redirect('vehicle');
	}
	public function disable_status($id)
	
	{
		$result = $this->Vehicle_model->disable_status($id);
		redirect('vehicle');
		
	}
	
	
	public function view($id)
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		$data['value'] = $this->Vehicle_model->view($id);
		$data['overview'] = $this->Vehicle_model->vehicle_dash($id);
		$data['allexpense'] = $this->Vehicle_model->getall_vehicleexpense($id);
		$data['fuelexpense'] = $this->Vehicle_model->getall_Fuelexpense($id);
		$data['maintenence'] = $this->Vehicle_model->getall_maintenenceExpense($id);
		
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('vehicle/vehicle_view',$data);
		$this->load->view('includes/footer');	
	}


	//vehicle documents start 

	public function vehicle_documents()
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
		$data['vehicles'] = $this->Vehicle_model->list();
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('vehicle/vehicle_documents',$data);
		$this->load->view('includes/footer');	
	}


	public function add_vehicle_documents()
	{
		if(!empty($_FILES['file']['name'])){ 
			// Set preference 
			$config['upload_path'] = 'uploads/'; 
			$config['allowed_types'] = 'jpg|jpeg|png|gif'; 
			$config['max_size'] = '100'; // max_size in kb 
			$config['file_name'] = $_FILES['file']['name']; 
   
			// Load upload library 
			$this->load->library('upload',$config); 
	  
			// File upload
			if($this->upload->do_upload('file')){ 
			   // Get data about the file
			   $uploadData = $this->upload->data(); 
			   $filename = $uploadData['file_name']; 
			   $data['response'] = 'successfully uploaded '.$filename; 
			}else{ 
			   $data['response'] = 'failed'; 
			} 

		}
	}

}
