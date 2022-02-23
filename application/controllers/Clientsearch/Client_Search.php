<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_Search extends CI_Controller {

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
		 $this->load->model('clientsearch/Client_searchmodel');
		 $this->load->model('transaction/Transaction_model');
	}
	
	public function client_search()
	{	
       
      	$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('clientsearch/clientsearchview');
		$this->load->view('includes/footer');

    }
    public function getclientdata(){
        
        $data = $this->Client_searchmodel->getclient();
        echo json_encode($data);
	}
 public function get_clientsearchdetails()
 {
	$data=$this->input->post('postData');
	$value=$data["id"];
	$from=$data["from"];
	$to=$data["to"];
//
	$result['clientserchdata']= $this->Client_searchmodel->getclient_view($value,$from,$to);
	echo json_encode($result);
 }
}