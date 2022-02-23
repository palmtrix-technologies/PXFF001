<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

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

        $this->load->model('masters/Supplier_model');
	}

	
	public function index()
	{
		 $user_id=	$this->session->userdata('user_id');
	
		// var_dump($user_image);
		//  die();
		
		$data['value'] = $this->Supplier_model->list();
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);

		$user_image['values']=$res[0]->user_image;
			// var_dump($res);
			// die();
			$result['permission']=$this->Login_model->select_all_menu($user_id);	
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

			$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('masters/supplier',$data,$result);
		 $this->load->view('includes/footer');
	}
	public function create()
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$data['code']=$this->Supplier_model->selectcode();
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('masters/create_supplier',$data);
		$this->load->view('includes/footer');	
	}
	public function store()
	{
		$postdata=$this->input->post('postData');
		$data=$postdata["postData1"];
		$name=$postdata["name"];

		$supid= $this->Supplier_model->add($data);
		$accountsid = $this->Supplier_model->addsupplier_to_accountsledger($name);
		$supplierledgerid = $this->Supplier_model->addto_supplierledger($supid,$accountsid);

		$result="success";
		echo json_encode($result);
		
	}
	public function edit($id)
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
// 		$id=$_REQUEST['id'];
		$data['value'] = $this->Supplier_model->edit($id);
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('masters/edit_supplier',$data);
		$this->load->view('includes/footer');	
	}
	public function update()
	{	
	
		$postdata=$this->input->post('postData');
		
		$data=$postdata["postData1"];
		$id=$postdata["id"];
		$name=$postdata["name"];

		$result= $this->Supplier_model->update($id,$data);
		$ledgerid= $this->Supplier_model->select_ledgerid($id);
		$this->Supplier_model->update_accoutns_ledger($ledgerid,$name);


		echo json_encode($result);
	}
	//update status
	public function enable_status($id)
	
	{
		$result = $this->Supplier_model->enable_status($id);

		redirect('supplier');
	}
	public function disable_status($id)
	
	{
		$result = $this->Supplier_model->disable_status($id);
		redirect('supplier');
		
	}

}
