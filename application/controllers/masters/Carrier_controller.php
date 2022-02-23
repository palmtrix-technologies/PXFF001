<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrier_controller extends CI_Controller {

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
		 $this->load->model('masters/Carrier_model');
		 $this->load->model('transaction/Transaction_model');

	}
	
	public function index()
	{	
        $data['carrier']=$this->Carrier_model->list();
      	$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$data['value'] = $this->User_model->list();
		$result['roles']=$this->Login_model->userdetails($user_id);
		//to add menus
		$user_id=	$this->session->userdata('user_id');
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('masters/carrier',$data,$result);
		$this->load->view('includes/footer');
    }
    public function add()
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		
		$user_id=	$this->session->userdata('user_id');
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$data['code']=$this->Carrier_model->selectcode();
	
		// var_dump($data);
		// die();
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('masters/create_carrier',$data);
			$this->load->view('includes/footer');
		
	}
	
    public function store()
	{
		$postdata=$this->input->post('postData');
		$result= $this->Carrier_model->add($postdata);
		// echo 'success';
		echo json_encode($result);
    }
    public function edit($id)
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
// 		$id=$_REQUEST['id'];
		$data['value'] = $this->Carrier_model->edit($id);
		$user_id=	$this->session->userdata('user_id');
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('masters/edit_carrier',$data);
		$this->load->view('includes/footer');	
    }
	public function update()
	{	
	
		$postdata=$this->input->post('postData');
		
		$data=$postdata["postData1"];
		$id=$postdata["id"];
		$result= $this->Carrier_model->update($id,$data);
		// echo 'success';
		echo json_encode($result);
	}
	//update status
	public function enable_status($id)
	
	{
		$result = $this->Carrier_model->enable_status($id);

		redirect('carrier');
	}
	public function disable_status($id)
	
	{
		$result = $this->Carrier_model->disable_status($id);
		redirect('carrier');
		
	}
	
}
 