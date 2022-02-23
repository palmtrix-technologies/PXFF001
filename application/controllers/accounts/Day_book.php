<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Day_book extends CI_Controller {

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
		 $this->load->model('accounts/Day_book_model');
		 $this->load->model('transaction/Transaction_model');

	}

	
    
	
    public function index()
	{
		 $user_id=	$this->session->userdata('user_id');
	
		
		
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);

		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$from=date('yy-m-d',strtotime("-1 days"));
		$to=date('yy-m-d',strtotime("0 days"));
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$result['details']=$this->Day_book_model->find_day_book($from,$to);
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('accounts/day_book',$result);
		 $this->load->view('includes/footer');
	}


    public function finddata()
	{
		 $user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$from  = $_POST['from'];
		$to=$_POST['to'];
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();


		$result['details']=$this->Day_book_model->find_day_book($from,$to);
		// var_dump($result['details']);
		// die();
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('accounts/day_book',$result);
		 $this->load->view('includes/footer');
	}
 
}
