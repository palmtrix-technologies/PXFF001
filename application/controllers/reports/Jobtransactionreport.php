<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobtransactionreport extends CI_Controller {

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
		 $this->load->model('transaction/Transaction_model');
         $this->load->model('reports/Jobtransaction_reportmodel');
         $this->load->model('reports/Report_model');

	}
//job transaction report

public function job_transaction_reports()
{	
	  $user_id=	$this->session->userdata('user_id');
	$res = $this->Permission_model->userdetails($user_id);
	$user_image['values']=$res[0]->user_image;
	$result['roles']=$this->Login_model->userdetails($user_id);
	//to add menus

	$result['permission']=$this->Login_model->select_all_menu($user_id);
	
	$result['suppliers']= $this->Report_model->select_suppliers();
	$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();


	$this->load->view('includes/header',$user_image);
	$this->load->view('includes/navigation',$result,$user_image);
	$this->load->view('reports/job_transaction_reports',$result);
	$this->load->view('includes/footer');

}


public function job_transaction_report_data()
{
	$data=$this->input->post('postData');
$jobno=$data["jobno"];
$awb=$data["awb"];

if($jobno!="")
{
	$masterid=$this->Jobtransaction_reportmodel->select_job_id($jobno);
    $result['jobinoicedata']= $this->Jobtransaction_reportmodel->get_job_invoicedata($masterid);
    $result['jobcreditnotedata']= $this->Jobtransaction_reportmodel->get_job_creditnotedata($masterid);
    $result['jobreceiptdata']= $this->Jobtransaction_reportmodel->get_job_receiptdata($masterid);
    $result['jobexpensedata']= $this->Jobtransaction_reportmodel->get_job_expensedata($masterid);


    $result['jobdebitdata']= $this->Jobtransaction_reportmodel->get_job_debitdata($masterid);
    $result['paymentdata']= $this->Jobtransaction_reportmodel->get_job_payment($masterid);

}
else{
    $result['jobinoicedata']= $this->Jobtransaction_reportmodel->get_job_invoicedatawith_mawb($awb);

    $result['jobcreditnotedata']= $this->Jobtransaction_reportmodel->get_job_creditnotedata_withmawb($awb);

    $result['jobreceiptdata']= $this->Jobtransaction_reportmodel->get_job_receiptdata_withmawb($awb);
    $result['jobexpensedata']= $this->Jobtransaction_reportmodel->get_job_expensedata_withmawb($awb);
    
    $result['jobdebitdata']= $this->Jobtransaction_reportmodel->get_job_debitdata_withmawb($awb);
    $result['paymentdata']= $this->Jobtransaction_reportmodel->get_job_payment_withmawb($awb);

}


 echo json_encode($result);	
}
}