<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trial_balance extends CI_Controller {

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
		 $this->load->model('accounts/Trial_balance_model');
	   $this->load->helper('date');
	   $this->load->model('transaction/Transaction_model');

	}

	
    
	
    public function index()
	{
		 $user_id=	$this->session->userdata('user_id');
	
		
		$format = "%Y-%m-%d";
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);

		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$data['Trialbalance']=$this->Trial_balance_model->find_Trialbalance(mdate($format));
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('accounts/trial_balance',$data);
		 $this->load->view('includes/footer');
	}

	public function gettrialbalance()
	{
		 $user_id=	$this->session->userdata('user_id');
		$postdata=$this->input->post('from');
		$format = "%Y-%m-%d";
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$data['Trialbalance']=$this->Trial_balance_model->find_Trialbalance($postdata);
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('accounts/trial_balance',$data);
		 $this->load->view('includes/footer');
	}


 
}
