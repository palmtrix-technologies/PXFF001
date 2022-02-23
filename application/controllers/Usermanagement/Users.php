<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		 $this->load->model('usermanagement/Login_model');
		 $this->load->model('transaction/Transaction_model');

	}
	private $upload_path = UPLOAD_PATH;
	
	public function index()
	{	
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$data['value'] = $this->User_model->list();
		$result['roles']=$this->Login_model->userdetails($user_id);
		//to add menus
		$user_id=	$this->session->userdata('user_id');
			$result['permission']=$this->Login_model->select_all_menu($user_id);
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

			$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('usermanagement/users',$data,$result);
		$this->load->view('includes/footer');
	}
	public function add()
	 {
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		$data['msg']="";
		$data['roles'] = $this->User_model->list_roles();
		$user_id=	$this->session->userdata('user_id');
			$result['permission']=$this->Login_model->select_all_menu($user_id);
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

			$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('usermanagement/create_users',$data);
		$this->load->view('includes/footer');
	}
	public function store()
	{
		
	
				$data['msg']="";
				$new_name ='';
	  			 if (!empty($_FILES['image']['name'])) {
		  
	 			 $new_name = time().'user-image.png';
	  			 $config['file_name'] = $new_name;
				 $config['upload_path'] = UPLOAD_PATH;
				 $config['allowed_types'] = 'gif|jpg|png';
				
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('image'))
				{
					$error = array('error' => $this->upload->display_errors());
				
				} else {

					$result= $this->User_model->add($new_name);
			
				}
				}
				
			
	 			 redirect('users');	
			}
						
		
	
	public function edit($id)
	
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
// 		$id=$_REQUEST['id'];
		$data['roles'] = $this->User_model->list_roles();
		$data['values'] = $this->User_model->edit($id);
		$data['selected'] = $this->User_model->editroles($id);
// 		var_dump($data['values']);
// 		die();
		$user_id=	$this->session->userdata('user_id');
			$result['permission']=$this->Login_model->select_all_menu($user_id);
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

			$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('usermanagement/edit_users',$data);
		$this->load->view('includes/footer');
	}
	//update status
	public function enable_status($id)
	
	{
		$result = $this->User_model->enable_status($id);

		redirect('users');
	}
	public function disable_status($id)
	
	{
		$result = $this->User_model->disable_status($id);
		redirect('users');
		
	}
	public function update()
	{
		
		
	
		
		 $new_name ='';
		 if (!empty($_FILES['image']['name']))
		  {
	       $new_name = time().'user-image.png';
	       $config['file_name'] = $new_name;
	       $config['upload_path'] = UPLOAD_PATH;
	       $config['allowed_types'] = 'gif|jpg|png';
	       $this->upload->initialize($config);
	      if (!$this->upload->do_upload('image'))
	       {
		     $error = array('error' => $this->upload->display_errors());
		 
		   } 
		  else
		   {
	       }
	     }
	
	    $result= $this->User_model->update($new_name);
	  	
		if($result)
		 {
			
					
	
//    echo '<script>alert("updated successfully!"); window.location.href = \'users\';</script>';

     
		 }
	    else{

			}

	redirect('users');
	
	
	}
	public function checkMail()
	
	{
		$email = $_POST['email'];
		$result=$this->User_model->checkmailmodel($email);
		echo $result;	
	}
	

}
 