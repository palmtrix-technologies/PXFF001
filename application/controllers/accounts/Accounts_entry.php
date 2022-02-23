<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_entry extends CI_Controller {

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
		 $this->load->model('accounts/Accounts_entry_model');
		 $this->load->model('transaction/Transaction_model');

       
	}

	
    
	
    public function accounts_entry()
	{
		 $user_id=	$this->session->userdata('user_id');
	
		
		
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);

		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('accounts/accounts_entry');
		 $this->load->view('includes/footer');
	}

	public function hidediv($value)
	{
			 if($value=="payment")
		{  
 
        $result['credit']= $this->Accounts_entry_model->listcredit($value);
		$result['debit']= $this->Accounts_entry_model->listdebit($value);

		echo json_encode( $result );
		}
      
		else if($value=="receipt")
		{  
 
        $result['credit']= $this->Accounts_entry_model->listcredit_receipt($value);
		$result['debit']= $this->Accounts_entry_model->listdebit_receipt($value);

		echo json_encode( $result );
		}
		else if($value=="contra")
		{  
 
        $result['credit']= $this->Accounts_entry_model->listcredit_contra($value);
		$result['debit']= $this->Accounts_entry_model->listdebit_contra($value);

		echo json_encode( $result );
		}
		 if($value=="transfer")
		{  
 
        $result['credit']= $this->Accounts_entry_model->listcredit_transfer($value);
		$result['debit']= $this->Accounts_entry_model->listdebit_transfer($value);

		echo json_encode( $result );
		}

	}

	public function store()
	{
		$paymode=$_POST['paymode'];
		
		if($paymode=="cash")
		{
	
			$result['value']= $this->Accounts_entry_model->insert_accounts_entry();

		}
		else{
			$result['value']= $this->Accounts_entry_model->insert_accounts_entry_cheque();

		}
		redirect('accounts-entry');
	}


	
}
