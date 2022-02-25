<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Search extends CI_Controller {

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
		 $this->load->model('masters/Bank_model');
		 $this->load->model('Job_search/Job_searchmodel');
		 $this->load->model('transaction/Transaction_model');
	
	}
	
	public function job_search()
	{	
		
      	$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		// $data['value'] = $this->User_model->list();
		$result['roles']=$this->Login_model->userdetails($user_id);
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
	
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('jobsearch/Jobsearch');
		$this->load->view('includes/footer');

	}
	public function job_description($jobid)
	{	
	
		$result['jobdata']=$this->Job_searchmodel->select_job_decription($jobid);
		$masterid=$this->Job_searchmodel->select_job_id($jobid);

		$result['invoicetotal']=$this->Job_searchmodel->select_invoice_total($masterid);
		$result['expensetotal']=$this->Job_searchmodel->select_expense_total($masterid);
		
	 $result['invoicepaid']=$this->Job_searchmodel->select_inv_paid_total($masterid);
	 
	//  $result['amountdue']=$this->Job_searchmodel->select_amount_due($jobid);
	$result['jobdocument']  = $this->Job_searchmodel->get_all_job_doc($masterid);

		$result['invoicedata']=$this->Job_searchmodel->select_invoice_details($masterid);
		
		$result['creditnotedata']=$this->Job_searchmodel->select_creditnote_details($masterid);
		$result['receiptdata']=$this->Job_searchmodel->select_customer_payment_receipt_details($masterid);
		
		$result['expense']=$this->Job_searchmodel->select_expense_details($masterid);
		$result['debitnotedata']=$this->Job_searchmodel->select_debit_note_details($masterid);
		$result['supplierpayment']=$this->Job_searchmodel->select_payment_details($masterid);
		
		$result['jobledger']=$this->Job_searchmodel->select_job_ledger_details($masterid);
		
		echo json_encode($result);
	
	}
}