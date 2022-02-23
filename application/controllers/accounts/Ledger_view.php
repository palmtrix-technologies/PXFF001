<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledger_view extends CI_Controller {

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
		$this->load->model('accounts/Ledger_view_model');
		$this->load->model('transaction/Transaction_model');


       
	}

	
    
	
    public function index()
	{
		 $user_id=	$this->session->userdata('user_id');
			$data['data']="";
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
		$data['ledgers']=$this->Ledger_view_model->get_ledgers();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('accounts/ledger_view',$data);
		$this->load->view('includes/footer');
	}

	public function getledgerviewdata()
	{
		$from=$_POST['from'];
		$to=$_POST['to'];
		$id=$_POST['ledger'];
				 
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);

		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
	$data['data']="1";
		$data['summery']=$this->Ledger_view_model->find_LedgerSummery($from,$to,$id);
		$data['ledgerview']=$this->Ledger_view_model->find_Ledgerview($from,$to,$id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
$data['ledgers']=$this->Ledger_view_model->get_ledgers();
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('accounts/ledger_view',$data);
		 $this->load->view('includes/footer');
		
	}


 
}
