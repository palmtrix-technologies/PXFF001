<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplierexpense_Controller extends CI_Controller {

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
     $this->load->model('transaction/Supplier_expensemodel');
     $this->load->model('transaction/Transaction_model');
	}

	public function index()
	{
		$user_id=	$this->session->userdata('user_id');
		$data['value'] = $this->Supplier_expensemodel->select_expenselist();
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;			
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/view_supplierexpense',$data);
		 $this->load->view('includes/footer');
	}
	public function supplier_expense($id)
	{
		 $user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
       	$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
        $result['job']=$this->Supplier_expensemodel->select_all_job();
        $result['jobdata']=$this->Supplier_expensemodel->select_job_details($id);
		$result['currency']=$this->Supplier_expensemodel->list_currency();
        $result['code']=$this->Supplier_expensemodel->selectcode();
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/supplier_expnc',$result);
		$this->load->view('includes/footer');
    }
    public function getdata($value)
    {
	
          $result= $this->Supplier_expensemodel->list_description($value);
          echo json_encode($result);
            
	  }
public function supplier_expense_details()
	{

		 $data=$this->input->post('postData');
	
		$jobdata=$data["ExpenseDetails"];
		$result=$this->Supplier_expensemodel->addjobmaster($data["ExpenseData"]);
		$my_values = array();
		if($result!=0)
		{
			
			foreach($jobdata as $row)
			{
				$row["ExpenseMasterId"]=$result;
				$row["Vat"]=floatval($row["Vat"]);
				$row["Total"]=floatval($row["Total"]);
				$this->Supplier_expensemodel->addjobinvoicedetailsinsert($row);
				$my_values[] = $row;
			}
		}
		
		echo json_encode($result);
		
	}
	
	public function getsupplierdata(){
        
        $data = $this->Supplier_expensemodel->getsupplier();
        echo json_encode($data);
	}
//print expense details
	public function supplier_expense_print($expid)
	{
		$expid=$expid;

		$result['expdata']=$this->Supplier_expensemodel->selectexpensedetails($expid);
		 $result['expense']=$this->Supplier_expensemodel->supplier_expense_details($expid);
		 $result['companyinfo']=$this->Transaction_model->basic_company_details();
		 $result['invoiceinfo']=$this->Transaction_model->basic_invoice_details();
		$this->load->view('transaction/supplier_expenseprint',$result);
	
	}
	//Edit supplier expense
		
	public function edit_supplier_expense($id)
	{
		$invid=$id;
		$user_id=$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
       	$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		// $data['bank']=$this->Supplier_expensemodel->select_all_bank();
		$data['currencylist']=$this->Supplier_expensemodel->list_currency();
		$data['expensedata']=$this->Supplier_expensemodel->editexpenseedetails($invid);
		// var_dump($data['expensedata']);
		// die();
		$data['expnc']=$this->Supplier_expensemodel->supplier_expense_details($invid);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/edit_supplier_expnc',$data);
		$this->load->view('includes/footer');
	}
	

	public function update_supplier_expense()
	{

		 $data=$this->input->post('postData');
		
		$expnc=$data["ExpenseDetails"];
		$id=$data["Id"];
		$deletedids=$data["deleted"];
		// echo $id;
		// die();
		$result=$this->Supplier_expensemodel->update_expenseemaster($id,$data["ExpenseData"]);
		$my_values = array();
		if($expnc!="")
		{
		foreach($expnc as $row)
		{
				$row["ExpenseMasterId"]=$id;
				$row["Vat"]=floatval($row["Vat"]);
				$row["Total"]=floatval($row["Total"]);
				$this->Supplier_expensemodel->insert_expncdetails($row);
				$my_values[] = $row;
		}
		}
		if($deletedids!="")
		{
		foreach($deletedids as $row)
		{
				$id=$row;
				$result=$this->Supplier_expensemodel->delete_expncdetails($id);
			
		}
	}
	echo json_encode($result);
// echo $result;
	}

	public function change_supplier_expense_status($masterid,$supid)
	{
	

		$result=$this->Supplier_expensemodel->change_expense_status($masterid);
		$data=$this->Supplier_expensemodel->select_expense_data($masterid);
		$datadetails=$this->Supplier_expensemodel->select_expensedetails_data($masterid);

		foreach($data as $row)
		{
		  $amount=$row->SubTotal; 
		
$expid=$row->PostId; 
$jobid=$row->JobID; 
		  $vatamnt=$row->VatTotal;
		  $date=$row->PostingDate;
		  $narration="Expense .$expid. created for JobNo:.$jobid.,Amount:.$amount.";
		  $type="Supplier Expense";
		  $narrationvat="Expense .$expid. created for JobNo:.$jobid.,VAT Amount:.$amount.";
		  $typevat="VAT";
		  $chequeid=0;

		}
		$supplierledgerid=$this->Supplier_expensemodel->select_supplier_ledgerid($supid);
		$result1=$this->Supplier_expensemodel->insert_into_accountmaster($supplierledgerid,$amount,$date,$narration,$type,$chequeid);
		foreach($datadetails as $row)
		{
		  $vatamnt=$row->Vat;
		  $vatper=$row->vat_persentage;
		  
		 
		  $narrationvat="Expense .$expid. created for JobNo:.$jobid.,VAT Amount:.$vatamnt.";
		  $typevat="VAT";
		  $chequeid=0;
		  if($vatamnt !=0){
		  $result2=$this->Supplier_expensemodel->insert_into_accountmaster_vatentry($vatamnt,$date,$narrationvat,$typevat,$chequeid,$vatper);
		  }
		}
	

		
// redirect(base_url()."supplier-expense-print/".$masterid);
 redirect(base_url()."job-search");

	}
	}