<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_Search extends CI_Controller {

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
		//  $this->load->model('masters/Bank_model');
		//  $this->load->model('transaction/Transaction_model');
		 $this->load->model('supplier_search/Supplier_searchmodel');
		 $this->load->model('transaction/Transaction_model');

	}
	
	public function supplier_search()
	{	
        // $data['bank']=$this->Bank_model->list();
      	$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		// $data['value'] = $this->User_model->list();
		$result['roles']=$this->Login_model->userdetails($user_id);
		//to add menus
		// $data['values'] = $this->Report_model->listjobdata();
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('Suppliersearch/Supplier_search');
		$this->load->view('includes/footer');

	}
	public function getsupplierdata(){
        
        $data = $this->Supplier_searchmodel->getsupplierdata();
        echo json_encode($data);
	  }

	  public function get_supplierdetails($value)
	  {
	//    var_dump($value);
	//    die();

			$result['supplierdata']= $this->Supplier_searchmodel->list_supplier_data($value);
			$result['supplierpaymentdata']= $this->Supplier_searchmodel->supplier_payment_report($value);
			$result['viewledgerdata']= $this->Supplier_searchmodel->ledger_report($value);
			$result['postedexpense']= $this->Supplier_searchmodel->posted_expense($value);
			$result['debitnotedata']= $this->Supplier_searchmodel->debitnote_data($value);
			$result['supplierinvoicetotal']= $this->Supplier_searchmodel->supplier_invoice($value);
			$result['supplierpaidinvoice']= $this->Supplier_searchmodel->supplier_paid($value);
			
		
			echo json_encode($result);
			  
		}
	 
}