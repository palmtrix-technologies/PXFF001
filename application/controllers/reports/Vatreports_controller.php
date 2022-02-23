<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vatreports_controller extends CI_Controller {

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
	
	public function vat_report_total()
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
		$this->load->view('reports/vat_report_total',$data);
		$this->load->view('includes/footer');

    }
    
    public function vat_report_total_data()
	{
		$data=$this->input->post('postData');
		$month=$data["month"];
	$year=$data["year"];
// if($month==1)
// {
    

//     $fromdate=$year."-"."01-01";
//     $todate=$year."-"."03-31";

// }
//  if($month==2)
// {
    

//     $fromdate=$year."-"."04-01";
//     $todate=$year."-"."06-30";

// }
//  if($month==3)
// {


//     $fromdate=$year."-"."07-01";
//     $todate=$year."-"."09-30";

// }
// if($month==4)
// {
    

    $fromdate=$month;
    $todate=$year;

// }
$result['period1']=$fromdate;
$result['period2']=$todate;

  $result['vatreporttotal']= $this->Vat_report_model->get_vat_total_report($fromdate,$todate);
  $result['expensedata']= $this->Vat_report_model->get_expensedata($fromdate,$todate);

  
		echo json_encode($result);	
	}
    
    	
	public function vat_in_report()
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
		$this->load->view('reports/vat_in_report',$data);
		$this->load->view('includes/footer');

    }
    public function vatin_report_data()
	{
		$data=$this->input->post('postData');
	
	$from=$data["fromdate"];
	$to=$data["todate"];
	$jobid =$data["jobid"]; 

 $result['vatinreportdata']= $this->Vat_report_model->get_vatin_reportdata($from,$to,$jobid);
	
		echo json_encode($result);	
    }
    	
	public function vat_out_report()
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
		$this->load->view('reports/vat_out_report',$data);
		$this->load->view('includes/footer');

    }
    public function vatout_report_data()
	{
		
		$data=$this->input->post('postData');
	
	$from=$data["fromdate"];
	$to=$data["todate"];
	$jobid =$data["jobid"]; 
    
 $result['vatoutreportdata']= $this->Vat_report_model->get_expense_reportdata($from,$to,$jobid);
	
		echo json_encode($result);	
	}
}
