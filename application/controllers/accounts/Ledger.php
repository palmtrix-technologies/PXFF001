<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledger extends CI_Controller {

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
         $this->load->model('accounts/Ledger_model');
		 $this->load->model('transaction/Transaction_model');

	}

	
	public function create_ledger()
	{
		 $user_id=	$this->session->userdata('user_id');
	
		
		
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);

		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$data['ledger']=$this->Ledger_model->listdata();
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('accounts/create_ledger',$data);
		 $this->load->view('includes/footer');
    }
	public function store()
	{
       
        $postdata=$this->input->post('postData');
      
		// var_dump($postdata);
		// die();
		$result= $this->Ledger_model->add($postdata);
		echo json_encode( $result );
      
		
	}
	public function getdata($value)
	{
    
        $result= $this->Ledger_model->list($value);
       
        echo json_encode( $result );

	}
	public function editdata()
	{

        $postdata=$this->input->post('postData');
		$data=$postdata["postData1"];
		$id=$postdata["LedgerID"];
		// var_dump($postdata);
		// die();
		$result= $this->Ledger_model->editmodel($id,$data);
		//echo 'success';
		echo json_encode('success' );
		
	}
}
