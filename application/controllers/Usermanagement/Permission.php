<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('usermanagement/Permission_model');
		$this->load->model('usermanagement/Login_model');
		$this->load->library(array('form_validation','session'));
		$this->load->model('transaction/Transaction_model');

	}

	
	public function index()
	{
		 $user_id=	$this->session->userdata('user_id');
	
		// var_dump($user_image);
		//  die();
		
		$data['value'] = $this->Permission_model->list();
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);

		$user_image['values']=$res[0]->user_image;
			// var_dump($res);
			// die();
			$user_id=	$this->session->userdata('user_id');
			$result['permission']=$this->Login_model->select_all_menu($user_id);
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('usermanagement/permission',$data);
		 $this->load->view('includes/footer');
	}
	public function create()
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		$user_id=	$this->session->userdata('user_id');
			$result['permission']=$this->Login_model->select_all_menu($user_id);
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('usermanagement/create_permission');
		$this->load->view('includes/footer');	
	}
	public function store()
	{
		$postdata=$this->input->post('postData');
		$result= $this->Permission_model->add($postdata);
		echo json_encode($result);
		
	}
	public function edit($id)
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
// 		$id=$_REQUEST['id'];
		$data['value'] = $this->Permission_model->edit($id);
		$user_id=	$this->session->userdata('user_id');
			$result['permission']=$this->Login_model->select_all_menu($user_id);
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('usermanagement/edit_permission',$data);
		$this->load->view('includes/footer');	
	}
	public function update()
	{	
	
		$postdata=$this->input->post('postData');
		
		$data=$postdata["postData1"];
		$id=$postdata["id"];
		$result= $this->Permission_model->update($id,$data);
		echo json_encode($result);
		
	}

}
