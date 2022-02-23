<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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
		 $this->load->model('reports/Report_model');
		 $this->load->model('reports/Vat_report_model');
	}
	
	public function job_reports()
	{	
      
      	$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
	
		$result['roles']=$this->Login_model->userdetails($user_id);
		//to add menus
		$data['values'] = $this->Report_model->listjobdata();
		$result['permission']=$this->Login_model->select_all_menu($user_id);
	
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('reports/job_report',$data);
		$this->load->view('includes/footer');

	}
	public function job_reports_modewise()
	{	
      
      	$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
	
		$result['roles']=$this->Login_model->userdetails($user_id);
		//to add menus
		$data['values'] = $this->Report_model->listjobdata();
		$result['permission']=$this->Login_model->select_all_menu($user_id);
	
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('reports/job_report_modewise',$data);
		$this->load->view('includes/footer');

	}
	public function job_report_data_modewise()
	{
		$data=$this->input->post('postData');
		$mode=$data["mode"];
	$from=$data["fromdate"];
	$to=$data["todate"];

 $result['jobrepoprtmodewise']= $this->Report_model->get_job_reportdata_modewise($mode,$from,$to);
	
		echo json_encode($result);	
	}
	
	
    public function non_billed_jobs()
	{	
        // $data['bank']=$this->Bank_model->list();
      	$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		// $data['value'] = $this->User_model->list();
		$result['roles']=$this->Login_model->userdetails($user_id);
	
		$data['values'] = $this->Report_model->nonbilledjob();
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();


		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('reports/no_billed_jobs',$data);
		$this->load->view('includes/footer');

	}
	//sales report
	public function sales_report()
	{	
      	$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		//to add menus
	
		$result['permission']=$this->Login_model->select_all_menu($user_id);
	 $result['client']= $this->Report_model->select_clients();
	 $user_image['cmpnydata']=$this->Transaction_model->basic_company_details();


		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('reports/sales_report',$result);
		$this->load->view('includes/footer');

	}
	public function sales_report_data()
	{
		$data=$this->input->post('postData');
		// $id=$data["id"];
	$from=$data["fromdate"];
	$to=$data["todate"];

 $result['salesreportdata']= $this->Report_model->get_sales_reportdata($from,$to);
	
		echo json_encode($result);	
	}
		//sales report client wise
		public function sales_report_clientwise()
		{	
			  $user_id=	$this->session->userdata('user_id');
			$res = $this->Permission_model->userdetails($user_id);
			$user_image['values']=$res[0]->user_image;
			$result['roles']=$this->Login_model->userdetails($user_id);
			//to add menus
		
			$result['permission']=$this->Login_model->select_all_menu($user_id);
		 $result['client']= $this->Report_model->select_clients();
		 $user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
	
	
			$this->load->view('includes/header',$user_image);
			$this->load->view('includes/navigation',$result,$user_image);
			$this->load->view('reports/sales_report_clientwise',$result);
			$this->load->view('includes/footer');
	
		}
		public function sales_report_data_clientwise()
		{
			$data=$this->input->post('postData');
			$id=$data["id"];
		$from=$data["fromdate"];
		$to=$data["todate"];
	
	 $result['salesreportdataclientwise']= $this->Report_model->get_sales_reportdata_withid($id,$from,$to);
		
			echo json_encode($result);	
		}
		


    public function invoice_reports()
	{	
      	$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		//to add menus
	
		$result['permission']=$this->Login_model->select_all_menu($user_id);
	 $result['client']= $this->Report_model->select_clients();
	 $user_image['cmpnydata']=$this->Transaction_model->basic_company_details();


		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('reports/invoice_report',$result);
		$this->load->view('includes/footer');

	}
	public function invoice_report_data()
	{
		$data=$this->input->post('postData');
		// $id=$data["id"];
	$from=$data["fromdate"];
	$to=$data["todate"];

 $result['invoicereportdata']= $this->Report_model->get_invoice_reportdata($from,$to);
	
		echo json_encode($result);	
	}



//inv report client wise
public function invoice_reports_clientwise()
{	
	  $user_id=	$this->session->userdata('user_id');
	$res = $this->Permission_model->userdetails($user_id);
	$user_image['values']=$res[0]->user_image;
	$result['roles']=$this->Login_model->userdetails($user_id);
	//to add menus

	$result['permission']=$this->Login_model->select_all_menu($user_id);
 $result['client']= $this->Report_model->select_clients();
 $user_image['cmpnydata']=$this->Transaction_model->basic_company_details();


	$this->load->view('includes/header',$user_image);
	$this->load->view('includes/navigation',$result,$user_image);
	$this->load->view('reports/invoice_report_clientwise',$result);
	$this->load->view('includes/footer');

}
public function invoice_report_data_clientwise()
	{
		$data=$this->input->post('postData');
		$id=$data["id"];
	$from=$data["fromdate"];
	$to=$data["todate"];

	
			$result['invoicereportdata']= $this->Report_model->get_invoice_reportdata_withid($id,$from,$to);

	
		echo json_encode($result);	
	}
	public function pending_invoice_reports()
	{	
      	$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		//to add menus
	
		$result['permission']=$this->Login_model->select_all_menu($user_id);
	 $result['client']= $this->Report_model->select_clients();
	
	 $user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('reports/pending_invoice',$result);
		$this->load->view('includes/footer');

	}
	public function pending_invoice_report_data()
	{
		$data=$this->input->post('postData');
		// $id=$data["id"];
	$from=$data["fromdate"];
	$to=$data["todate"];

 $result['pendinginvoicereportdata']= $this->Report_model->pending_invoice_data($from,$to);
	
	
		echo json_encode($result);	
	}
	public function 	pending_invoice_reports_clientwise()
	{	
      	$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		//to add menus
	
		$result['permission']=$this->Login_model->select_all_menu($user_id);
	 $result['client']= $this->Report_model->select_clients();
	
	 $user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('reports/pending_invoice_clientwise',$result);
		$this->load->view('includes/footer');

	}
	public function pending_invoice_report_data_clientwise()
	{
		$data=$this->input->post('postData');
		$id=$data["id"];
	$from=$data["fromdate"];
	$to=$data["todate"];

	
			$result['pendinginvoicereportdata']= $this->Report_model->pending_invoice_data_withid($id,$from,$to);

	
		echo json_encode($result);	
	}
    public function bill_reports()
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
		$this->load->view('reports/bill_reports',$result);
		$this->load->view('includes/footer');

    }
	public function bill_reports_getdata()
	{
		$data=$this->input->post('postData');
	// $id=$data["id"];
	$from=$data["from"];
	$to=$data["to"];


	$result['billreportdata']= $this->Report_model->get_billed_reportdata($from,$to);


	echo json_encode($result);	
	}
//bill report supplierwise
public function bill_reports_supplierwise()
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
	$this->load->view('reports/bill_reports_supplierwise',$result);
	$this->load->view('includes/footer');

}
public function bill_reports_getdata_supplierwise()
{
	$data=$this->input->post('postData');
$id=$data["id"];
$from=$data["from"];
$to=$data["to"];


$result['billreportdata']= $this->Report_model->get_billed_reportdata_withid($id,$from,$to);

echo json_encode($result);	
}
    public function pending_bills()
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
		$this->load->view('reports/pending_bills',$result);
		$this->load->view('includes/footer');

    }

	public function pending_bill_data()
	{
		$data=$this->input->post('postData');
	// $id=$data["id"];
	$from=$data["from"];
	$to=$data["to"];
	$result['pendingbillreportdata']= $this->Report_model->get_pendiding_bille_reportdata($from,$to);


	echo json_encode($result);	
	}
	public function pending_bills_supplierwise()
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
		$this->load->view('reports/pending_bills_supplierwise',$result);
		$this->load->view('includes/footer');

    }

	public function pending_bill_data_supplierewise()
	{
		$data=$this->input->post('postData');
	$id=$data["id"];
	$from=$data["from"];
	$to=$data["to"];


	$result['pendingbillreportdata']= $this->Report_model->get_pending_bille_reportdata_withid($id,$from,$to);
	echo json_encode($result);	
	}
	//receipt report
	public function receipt_report()
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
		$this->load->view('reports/receipt_report',$result);
		$this->load->view('includes/footer');

	}
	public function receipt_data()
	{
		$data=$this->input->post('postData');

	$from=$data["fromdate"];
	$to=$data["todate"];


	$result['receiptdata']= $this->Report_model->get_receiptreport($from,$to);
	echo json_encode($result);	
	}
	// receipt_report_paymodewise
	public function receipt_report_paymodewise()
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
		$this->load->view('reports/receipt_report_paymodewise',$result);
		$this->load->view('includes/footer');

	}
	
	public function receipt_data_paymodewise()
	{
		$data=$this->input->post('postData');
$paymode=$data["paymode"];
	$from=$data["fromdate"];
	$to=$data["todate"];


	$result['receiptdata_paymodewise']= $this->Report_model->get_receiptreport_paymodewise($paymode,$from,$to);
	echo json_encode($result);	
	}
	//payment report
	
	public function payment_report()
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
		$this->load->view('reports/payment_report',$result);
		$this->load->view('includes/footer');

	}
	
	public function paryment_report_data()
	{
		$data=$this->input->post('postData');

	$from=$data["fromdate"];
	$to=$data["todate"];


	$result['paymentreportdata']= $this->Report_model->get_paymentreport($from,$to);
	echo json_encode($result);	
	}
	public function payment_report_cashwise()
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
		$this->load->view('reports/payment_report_cashwise',$result);
		$this->load->view('includes/footer');

	}
	
	public function paryment_report_data_cashwise()
	{
		$data=$this->input->post('postData');

	$from=$data["fromdate"];
	$to=$data["todate"];


	$result['paymentreportdatacashwise']= $this->Report_model->get_paymentreport_cashwise($from,$to);
	echo json_encode($result);	
	}
	public function receipt_report_bankwise()
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
		$this->load->view('reports/payment_report_bankwise',$result);
		$this->load->view('includes/footer');

	}
	
	public function paryment_report_data_bankwise()
	{
		$data=$this->input->post('postData');
// $paymode=$data["paymode"];
	$from=$data["fromdate"];
	$to=$data["todate"];


	$result['paymentreportdatabankwise']= $this->Report_model->get_paymentreport_bankwise($from,$to);
	echo json_encode($result);	
	}
	//PROFIT AND LOSS
	
	public function profit_loss()
	{	
      
      	$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
	
		$result['roles']=$this->Login_model->userdetails($user_id);
		//to add menus
		$data['values'] = $this->Report_model->listjobdata();
		$result['permission']=$this->Login_model->select_all_menu($user_id);
	
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('reports/profit_loss',$data);
		$this->load->view('includes/footer');

	}
public function profit_loss_data()
{
	$data=$this->input->post('postData');
	
	$from=$data["fromdate"];
	$to=$data["todate"];
	$result['vatinreportdata']= $this->Vat_report_model->get_vatin_reportdata($from,$to);

 $result['vatoutreportdata']= $this->Vat_report_model->get_expense_reportdata($from,$to);
	
		echo json_encode($result);	
}
	
public function soa_report_client()
{	
  
	  $user_id=	$this->session->userdata('user_id');
	$res = $this->Permission_model->userdetails($user_id);
	$user_image['values']=$res[0]->user_image;

	$result['roles']=$this->Login_model->userdetails($user_id);
	//to add menus
	// $data['values'] = $this->Report_model->listjobdata();
	$result['client']= $this->Report_model->select_clients();

	$result['permission']=$this->Login_model->select_all_menu($user_id);

	$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

	$this->load->view('includes/header',$user_image);
	$this->load->view('includes/navigation',$result,$user_image);
	$this->load->view('reports/soa_report_client');
	$this->load->view('includes/footer');

}
public function soa_report_data_clientwise()
{
	$data=$this->input->post('postData');
			$id=$data["id"];
		// $from=$data["fromdate"];
		// $to=$data["todate"];
	
	 $result['soareportdataclientwise']= $this->Report_model->soa_reports($id);
	  $result['clientdetails']=$this->Report_model->clientdetails($id);
			echo json_encode($result);	
}
}


