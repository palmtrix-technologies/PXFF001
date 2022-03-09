<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genaral_expense_Controller extends CI_Controller {

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
     $this->load->model('genaral_expense/Genaral_expense_model');
	 $this->load->model('transaction/Transaction_model');
	 
     $this->load->model('transaction/Job_invoice_newmodel');
	}

	public function index()
	{
		$user_id=	$this->session->userdata('user_id');
	
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;			
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('genaral_expense/genaral_expense_report_total');
		 $this->load->view('includes/footer');
	}
	public function detailedreport()
	{
		$user_id=	$this->session->userdata('user_id');
	
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;			
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('genaral_expense/genaral_expense_report_detailed');
		 $this->load->view('includes/footer');
	}
	public function genaral_expense()
	{
		
		 $user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
       	$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$result['currency']=$this->Genaral_expense_model->list_currency();
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
		$result['project_site']=$this->Job_invoice_newmodel->select_all_project_site();
		$result['expenses']=$this->Genaral_expense_model->get_all_expense_ledgers();
		$result['bank']=$this->Genaral_expense_model->select_all_bank();
		$result['vehicle']=$this->Genaral_expense_model->vehicle_list();
			$result['employee']=$this->Genaral_expense_model->employee_list();
		
		
		$result['cash_acc']=$this->Genaral_expense_model->select_cash_accounts();
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('genaral_expense/genaral_expense',$result);
		$this->load->view('includes/footer');
    }
    public function getdata($value)
    {
	
          $result= $this->Supplier_expensemodel->list_description($value);
          echo json_encode($result);
            
	  }
public function genaral_expense_details()
	{

		 $data=$this->input->post('postData');
	
		$jobdata=$data["ExpenseDetails"];
		$result=$this->Genaral_expense_model->addgenaralexpense($data["ExpenseData"]);
		$my_values = array();
		if($result!=0)
		{
			
			foreach($jobdata as $row)
			{
				$row["acc_expense_id"]=$result;
				// $row["Vat"]=floatval($row["Vat"]);
				// $row["Total"]=floatval($row["Total"]);
				$this->Genaral_expense_model->addgenaralexpensedetails($row);
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
	    if($vatamnt>0)
	    {
		$result2=$this->Supplier_expensemodel->insert_into_accountmaster_vatentry($vatamnt,$date,$narrationvat,$typevat,$chequeid);
	    }

		
redirect(base_url()."supplier-expense-print/".$masterid);
	}
	
	public function genaralexpense_report_data(){
        
       	$data=$this->input->post('postData');
	$from=$data["from"];
	$to=$data["to"];

    $result['genaral_expense']= $this->Genaral_expense_model->genaralexpense_report_data($from,$to);
	
		echo json_encode($result);	
	}
	
	public function genaralexpense_report_data_detail(){
        
       	$data=$this->input->post('postData');
	$from=$data["from"];
	$to=$data["to"];

    $result['genaral_expense']= $this->Genaral_expense_model->genaralexpense_report_data_detail($from,$to);
	
		echo json_encode($result);	
	}
	
	}