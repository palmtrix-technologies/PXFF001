<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_invoice_controller extends CI_Controller {

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
      $this->load->model('masters/Shipper_model');
     $this->load->model('transaction/Job_invoice_model');
	 $this->load->model('transaction/Transaction_model');
	 $this->load->model('transaction/Supplier_expensemodel');

	}

	
	public function job_invoice($id)
	{
		 $user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
       	$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
        $result['bank']=$this->Job_invoice_model->select_all_bank();
        $result['jobdata']=$this->Job_invoice_model->select_job_details($id);
      $result['currency']=$this->Job_invoice_model->select_currency();
		$result['Inv']=$this->Job_invoice_model->selectcode();
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
        $result['code']=$this->Supplier_expensemodel->selectcode();
		$result['job']=$this->Supplier_expensemodel->select_all_job();
	
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/job_invoice',$result);
		$this->load->view('includes/footer');
    }
    public function getdata($value)
    {
	
          $result= $this->Job_invoice_model->list_description($value);
          echo json_encode($result);
            
	  }
public function insert_job_details()
	{

		 $data=$this->input->post('postData');
	
		$jobdata=$data["JobDetails"];
		$result=$this->Job_invoice_model->addjobmaster($data["JobData"]);
		$my_values = array();
		if($result!=0)
		{
			
			foreach($jobdata as $row)
			{
				$row["InvoiceMasterId"]=$result;
				$row["Vat"]=floatval($row["Vat"]);
				$row["Total"]=floatval($row["Total"]);
				$this->Job_invoice_model->addjobinvoicedetailsinsert($row);
				$my_values[] = $row;
			}
		}
		
		echo json_encode($result);
		
	}
	
	public function perfomainvoice_print($invid)
	{
		$invid=$invid;
		$result['invoicedata']=$this->Job_invoice_model->selectinvoicedetails($invid);
		 $result['invoice']=$this->Job_invoice_model->select_job_invoice_details($invid);
		 $result['companyinfo']=$this->Transaction_model->basic_company_details();
		 $result['invoiceinfo']=$this->Transaction_model->basic_invoice_details();
		 
		
		$this->load->view('transaction/perfoma-invoice',$result);
	
	}

	public function invoice_print($invid)
	{
		$invid=$invid;
		$result['invoicedata']=$this->Job_invoice_model->selectinvoicedetails($invid);
		 $result['invoice']=$this->Job_invoice_model->select_job_invoice_details($invid);
		 $result['companyinfo']=$this->Transaction_model->basic_company_details();
		 $result['invoiceinfo']=$this->Transaction_model->basic_invoice_details();
		 
		
		$this->load->view('transaction/invoice',$result);
	
	}
	//Edit job-invoice
		
	public function edit_job_invoice($id)
	{
		$invid=$id;
		 $user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
       	$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$data['bank']=$this->Job_invoice_model->select_all_bank();
		$data['currency']=$this->Job_invoice_model->select_currency();

		$data['invoicedata']=$this->Job_invoice_model->editinvoicedetails($invid);
		$data['invoice']=$this->Job_invoice_model->select_job_invoice_details($invid);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/edit_job_invoice',$data);
		$this->load->view('includes/footer');
	}
	

	public function update_jobInvoice_details()
	{

		 $data=$this->input->post('postData');
	
		$jobdata=$data["JobDetails"];
		$id=$data["Id"];
		$deletedids=$data["deleted"];
	
		$result=$this->Job_invoice_model->updateJobinvoicemaster_InvoiceMasterId($id,$data["JobData"]);
		$my_values = array();
		if($jobdata!="")
		{
		foreach($jobdata as $row)
		{
				$row["InvoiceMasterId"]=$id;
				$row["Vat"]=floatval($row["Vat"]);
				$row["Total"]=floatval($row["Total"]);
				$this->Job_invoice_model->insertjobinvoicedetails($row);
				$my_values[] = $row;
		}
		}
		if($deletedids!="")
		{
		foreach($deletedids as $row)
		{
				$id=$row;
				$result=$this->Job_invoice_model->deleteinvoicedetailsinsert($id);
			
		}
	}
echo $result;
	}
	public function change_invoice_status($invmasterid,$clientid)
	{
	

		$result=$this->Job_invoice_model->change_invoice_status($invmasterid);
		$data=$this->Job_invoice_model->select_invoice_data($invmasterid);
		$datadetails=$this->Job_invoice_model->select_invoicedetails_data($invmasterid);
		


		foreach($data as $row)
		{
		  $amount=$row->GrandTotal;
		  $vatamnt=$row->VatTotal;
		  $date=$row->Date;
		
		  $jobid=$row->JobId;
		  $inv=$row->Inv;

		  $narration="Invoice .$inv. created for JobNo:.$jobid. ,debited Amount:.$amount.";
		  $type="Invoice";
		  $narrationvat="Invoice .$inv. created for JobNo:.$jobid. ,VAT Amount:.$amount.";
		  $typevat="VAT";
		  $chequeid=0;
		}

		$clientledgerid=$this->Job_invoice_model->select_client_ledgerid($clientid);
		$result1=$this->Job_invoice_model->insert_into_accountmaster($clientledgerid,$amount,$date,$narration,$type,$chequeid);
		foreach($datadetails as $row)
		{
		  $vatamnt=$row->Vat;
		  $vatper=$row->VAT_percentage;
		  $narrationvat="Invoice .$inv. created for JobNo:.$jobid. ,VAT Amount:.$vatamnt.";
		  $typevat="VAT";
		  $chequeid=0;
		  if($vatamnt !=0){
		  $result2=$this->Job_invoice_model->insert_into_accountmaster_vatentry($vatamnt,$date,$narrationvat,$typevat,$chequeid,$vatper);
		  }
		}
	

//redirect(base_url()."invoice-print/".$invmasterid);
redirect(base_url()."perfomainvoice-print/".$invmasterid);
	}
	public function getsupplierdata(){
        
        $data = $this->Supplier_expensemodel->getsupplier();
        echo json_encode($data);
	}
	
	public function getdatasupplierexpense($value)
    {
	
          $result= $this->Supplier_expensemodel->list_description($value);
          echo json_encode($result);
            
	  }
	  
}