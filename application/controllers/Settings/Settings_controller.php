<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_controller extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('usermanagement/User_model');
		$this->load->model('usermanagement/Login_model');
        $this->load->model('usermanagement/Permission_model');
        $this->load->model('Settings/Settings_model');
        $this->load->model('transaction/Transaction_model');

		$this->load->library(array('form_validation','session','upload'));
		$this->load->helper(array('url','html','form'));
		$this->load->library('pagination');
         $this->load->database(); 
		 $this->load->library('session');
		 $this->load->helper('url');
	 
	}

	
    
	
    public function basic_settings()
	{
        $user_id=	$this->session->userdata('user_id');
	
		
		
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);

		$user_image['values']=$res[0]->user_image;
        $result['permission']=$this->Login_model->select_all_menu($user_id);
        $data['basicinfo']=$this->Settings_model->list_company_data();
        $data['invinfo']=$this->Settings_model->list_invoice_data();
        $user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('Settings/basic_settings',$data,$result);
		 $this->load->view('includes/footer');
    }
    public function   update_basic_settings()
	{
		
		
	
		
         $new_name1 ='';
         $new_name2 ='';
         $new_name3='';

         
		 if (!empty($_FILES['iconimage']['name']))
		  {
	       $new_name1 = time().'iconimage.png';
	       $config['file_name'] = $new_name1;
	       $config['upload_path'] = UPLOAD_PATH;
	       $config['allowed_types'] = 'gif|jpg|png';
	       $this->upload->initialize($config);
	      if (!$this->upload->do_upload('iconimage'))
	       {
		     $error = array('error' => $this->upload->display_errors());
		 
		   } 
		  else
		   {
	       }
         }
         if (!empty($_FILES['headerimage']['name']))
         {
          $new_name2 = time().'headerimage.png';
          $config['file_name'] = $new_name2;
          $config['upload_path'] = UPLOAD_PATH;
          $config['allowed_types'] = 'gif|jpg|png';
          $this->upload->initialize($config);
         if (!$this->upload->do_upload('headerimage'))
          {
            $error = array('error' => $this->upload->display_errors());
        
          } 
         else
          {
          }
        }
        if (!empty($_FILES['footerimage']['name']))
        {
         $new_name3 = time().'footerimage.png';
         $config['file_name'] = $new_name3;
         $config['upload_path'] = UPLOAD_PATH;
         $config['allowed_types'] = 'gif|jpg|png';
         $this->upload->initialize($config);
        if (!$this->upload->do_upload('footerimage'))
         {
           $error = array('error' => $this->upload->display_errors());
       
         } 
        else
         {
         }
       }
	
	    $result= $this->Settings_model->updatedata($new_name1,$new_name2,$new_name3);
        //   var_dump($new_name1);
        //   die();
		if($result)
		 {
			
					
	
//    echo '<script>alert("updated successfully!"); window.location.href = \'users\';</script>';

     
		 }
	    else{

			}
// var_dump($result);
// die();
 redirect('basic-settings');
	
	
	}
}