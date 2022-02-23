<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {
	function __construct() 
	{
        parent::__construct();
		$this->load->model('usermanagement/Roles_model');
		$this->load->model('usermanagement/Login_model');
		$this->load->model('usermanagement/Permission_model');
		$this->load->library(array('form_validation'));
		$this->load->model('transaction/Transaction_model');

	}
	public function index()
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$data['value'] = $this->Roles_model->list();
		$result['roles']=$this->Login_model->userdetails($user_id);
		$user_id=	$this->session->userdata('user_id');
			$result['permission']=$this->Login_model->select_all_menu($user_id);
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('usermanagement/roles',$data);
		 $this->load->view('includes/footer');
	}
	public function create()
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
		$data['read'] = $this->Roles_model->list_permission("read");
		$data['create'] = $this->Roles_model->list_permission("create");
		$data['update'] = $this->Roles_model->list_permission("update");
		$user_id=	$this->session->userdata('user_id');
			$result['permission']=$this->Login_model->select_all_menu($user_id);
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('usermanagement/create_roles',$data);
	
		$this->load->view('includes/footer');
		
	}
	public function store()
	{
		$postdata=$this->input->post('postData');	
		
		$permission=$postdata['Permission'];
		$my_values = array();
		 $roledata=	$postdata['roledata'];
		$id= $this->Roles_model->add($roledata);
		
		foreach($permission as $row)
			{
				$row["role_id"]=$id;
				$row["permission_id"]=(int)$row["permission_id"];
				$this->Roles_model->adduserpermission($row);
			
			}

			echo json_encode($result);
		
	}	
	public function edit($id)
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$user_image['values']=$res[0]->user_image;
		$result['roles']=$this->Login_model->userdetails($user_id);
// 		$id=$_REQUEST['id'];
		$data['read'] = $this->Roles_model->list_permissionforEdit("read",$id);
		$data['create'] = $this->Roles_model->list_permissionforEdit("create",$id);
		$data['update'] = $this->Roles_model->list_permissionforEdit("update",$id);
	
		$data['value'] = $this->Roles_model->edit($id);
		$user_id=	$this->session->userdata('user_id');
			$result['permission']=$this->Login_model->select_all_menu($user_id);
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		
		$this->load->view('usermanagement/edit_roles',$data);
		$this->load->view('includes/footer');	
	}
	public function update()
	{	
		$postdata=$this->input->post('postData');	
		$id=$postdata["id"];
		$data=$postdata["postData1"];
		$my_values = array();
		$role=$postdata["role"];
        
		$result= $this->Roles_model->update($id,$role);
		$result= $this->Roles_model->deleterolepermission($id);
		foreach($data as $row)
			{
				$row["role_id"]=$id;
				$row["permission_id"]=(int)$row["permission_id"];
				$this->Roles_model->updaterolepermission($row);
			}
			echo json_encode($result);
	
	}
	
}
