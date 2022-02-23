<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balance_sheet extends CI_Controller {

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
		 $this->load->model('accounts/Balance_sheet_model');

		 
       
	}

	
    
	
    public function index()
	{
		 $user_id=	$this->session->userdata('user_id');
	
		 $result['data']="";
		
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);

		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('accounts/balance_sheet');
		 $this->load->view('includes/footer');
	}
	
	
    public function find_balancesheet_data()
	{
		 $user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$year  = $_POST['financial_year'];
		$year1=$year+1;
		$result['data']="1";

		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
	$result['liabilitydata']=$this->Balance_sheet_model->get_liability_details($year,$year1);
	$result['assetdata']=$this->Balance_sheet_model->get_asset_details($year,$year1);
	$result['incomedata']=$this->Balance_sheet_model->get_income_details($year,$year1);
	$result['expensedata']=$this->Balance_sheet_model->get_expense_details($year,$year1);



	$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('accounts/balance_sheet',$result);
		 $this->load->view('includes/footer');
	}

 
}
