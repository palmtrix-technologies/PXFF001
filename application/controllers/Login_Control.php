<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Control extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('usermanagement/Login_model');
        $this->load->library(array('form_validation','session'));
		$this->load->helper(array('url','html','form'));
		$this->load->model('usermanagement/Permission_model');
		$this->load->model('transaction/Transaction_model');
		$this->load->model('dashboard/Dashboard_model');
		$this->load->model('Settings/Settings_model');
		

	}
	public function index()
	{
	  
       
        $iconimg['cmpnydata']=$this->Transaction_model->basic_company_details(); 
		$this->load->view('usermanagement/login',$iconimg);
		
		
	}

	public function userhome()
	{

		if($this->session->userdata('user_id'))
		{
		$user_id=	$this->session->userdata('user_id');
		$this->session->sess_expiration = 800; 
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
	//for dashboard
		$result['jobs']=$this->Dashboard_model->get_job_number();
		$result['pendingreceipt']=$this->Dashboard_model->pendingreceipt();
		
		$result['pendingpayment']=$this->Dashboard_model->pendingpayment();
		$result['pendingpayment1']=$this->Dashboard_model->pendingpayment1();
		
		$result['getcliennumber']=$this->Dashboard_model->get_client_number();
		$result['monthlyreport']=$this->Dashboard_model->monthlyreport();
		$result['totalexpense']=$this->Dashboard_model->totalexpense();
		$result['jobair']=$this->Dashboard_model->select_job_air();
		$result['jobsea']=$this->Dashboard_model->select_job_sea();
		$result['jobland']=$this->Dashboard_model->select_job_land();
		$result['jobother']=$this->Dashboard_model->select_job_other();
		
		$result['income']=$this->Dashboard_model->get_income();
		$result['purchase']=$this->Dashboard_model->get_purchase();
		$result['estimatetotaldata']=$this->Dashboard_model->estimate_total();
		
		$result['latestjobsdata']=$this->Dashboard_model->latestjobs();
//job destination report
$result['importdata']=$this->Dashboard_model->import_total_numbers();
$result['exportdata']=$this->Dashboard_model->export_total_numbers();

$result['othercount']=$this->Dashboard_model->other_total_numbers();
$result['jobairimport']=$this->Dashboard_model->select_job_air_import();
$result['jobseaimport']=$this->Dashboard_model->select_job_sea_import();
$result['joblandimport']=$this->Dashboard_model->select_job_land_import();

$result['jobairexport']=$this->Dashboard_model->select_job_air_export();
$result['jobseaexport']=$this->Dashboard_model->select_job_sea_export();
$result['joblandexport']=$this->Dashboard_model->select_job_land_export();
$result['creditdate'] = $this->Dashboard_model->getcredit_invoice();  // var_dump($result['creditdate']);die();
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
	
		$this->load->view('dashboard/dashboard2',$result);
		 $this->load->view('includes/footer');
		}
		else{
			redirect("login");
		}
	}
  
	public function login()
	{
	
	
		$Email=$this->input->post('Email');
		$Password=$this->input->post('Password');
		
	 	$res=$this->Login_model->login_check($Email,$Password);
	
		  if($res==0)
		 	{
		 		$message= array(
					'username' => $Email,
					'password' => $Password,
		 		'title' => 'invalid email or password',
		 		'heading' => 'My Heading',
				 'message' => 'My Message');
			
		 		$this->session->set_userdata('invalid_admin_login',$message);
				 echo "invalid Email or Password.....!";
				 $this->load->view('usermanagement/login');
		 	}
		 	else
		 	 {
			 $user_id=$res[0]->id;
			$user_name=$res[0]->user_name;
			$user_image['values']=$res[0]->user_image;
			$this->session->sess_expiration = 800; 
			$this->session->set_userdata('user_id',$user_id);
			$this->session->set_userdata('user_name',$user_name);
		    $this->session->set_userdata('user_image',$user_image);
		
			$_SESSION['user']=$_POST['Email'];
// 			$result['roles']=$this->Login_model->userdetails($user_id);
// 			$user_id=	$this->session->userdata('user_id');
// 			$result['permission']=$this->Login_model->select_all_menu($user_id);
// 			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
// 			$result['jobs']=$this->Dashboard_model->get_job_number();
// 			$result['pendingreceipt']=$this->Dashboard_model->pendingreceipt();
			
// 			$result['pendingpayment']=$this->Dashboard_model->pendingpayment();
// 			$result['pendingpayment1']=$this->Dashboard_model->pendingpayment1();
			
// 			$result['getcliennumber']=$this->Dashboard_model->get_client_number();
// 			$result['monthlyreport']=$this->Dashboard_model->monthlyreport();
// 			$result['totalexpense']=$this->Dashboard_model->totalexpense();
// 			$result['jobair']=$this->Dashboard_model->select_job_air();
// 			$result['jobsea']=$this->Dashboard_model->select_job_sea();
// 			$result['jobland']=$this->Dashboard_model->select_job_land();
// 			$result['jobother']=$this->Dashboard_model->select_job_other();

			
			
// var_dump($result['jobs']);
// 		die();
		// 	$this->load->view('includes/header',$user_image);
		// 	$this->load->view('includes/navigation',$result,$user_image);
			
		
		// $this->load->view('dashboard/dashboard2',$result);
		// 	$this->load->view('includes/footer');
	
		redirect('user-home');
	}
	}
	public function logout()
	{
		$this->session->unset_userdata('exampleInputEmail1');
		$this->session->sess_destroy();
		 $iconimg['cmpnydata']=$this->Transaction_model->basic_company_details();
		$this->load->view('usermanagement/login',$iconimg);
	}
	public function viewforgotpassword()
	{
		
		$this->load->view('usermanagement/forgotpassword');
	}

	public function forgot_password()
	{
		$email = $this->input->post('email');      
		$findemail = $this->Login_model->ForgotPassword($email);  
		if($findemail){
		 $this->Login_model->send_mail($findemail);  
		 $this->load->view('usermanagement/newpassword');      
		  }else{
		 $this->session->set_flashdata('msg',' Email not found!');
		 redirect(base_url().'login','refresh');
	 
	}    
	}
	public function newpassword()
	{
	
		$randomkey = $_POST['randomkey'];
		$newpassword = $_POST['newpassword'];
		$cpassword = $_POST['confirmpassword'];
		if($newpassword != $cpassword)
		{
			$this->load->view('usermanagement/newpassword'); 
		}  
		else{
			$this->load->model('Login_Model');
			$result= $this->Login_model->newpassword($randomkey);
			redirect('Home'); 
			     
		}
	}
}
