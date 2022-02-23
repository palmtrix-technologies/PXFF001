<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
 {


 function __construct(){
    parent::__construct();
    $this->load->database();
  }
  public function login_check($Email,$Password)
  {
    $where='(email="'.$Email.'" and password="'.$Password.'" and enabled="1")';
    $this->db->select('*')->from('mst_users')->where($where)->limit(1);
    $query=$this->db->get();
    if($query->num_rows() > 0)
    {
      $result=$query->result();
      return $result;
    }else{
      return 0;
    }
  }
  public function userdetails($id)
  {
    
   
    $this->db->select('*');    
    $this->db->from('mst_user_roles');
    $this->db->join('mst_roles', 'mst_user_roles.role_id = mst_roles.id');
    $this->db->where('mst_user_roles.user_id', $id);
    $query = $this->db->get();
$result = $query->result();
return $result;
  }
  public function ForgotPassword($email)
  {
         $this->db->select('email');
         $this->db->from('mst_users'); 
         $this->db->where('email', $email); 
         $query=$this->db->get();
         return $query->row_array();
  }
 
  public function send_mail($data)
 {
         $email = $data['email'];
         $query1=$this->db->query("SELECT *  from mst_users where email = '".$email."' ");
         $row=$query1->result_array();
         if ($query1->num_rows()>0)
       
 {
         $passwordplain = "";
         $passwordplain  = rand(999999999,9999999999);
         $newpass['remember_token'] = $passwordplain;
         $this->db->where('email', $email);
         $this->db->update('mst_users', $newpass); 
         $mail_message='Dear '.$row[0]['user_name'].','. "\r\n";
         $mail_message.='Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>'.$passwordplain.'</b>'."\r\n";
         $mail_message.='<br>Please Update your password.';
         $mail_message.='<br>Thanks & Regards';
         $mail_message.='<br>Palmtrix';        
         date_default_timezone_set('Etc/UTC');
         require FCPATH.'assets/PHPMailer/PHPMailerAutoload.php';
         $mail = new PHPMailer;
         $mail->isSMTP();
         $mail->SMTPSecure = "tls"; 
         $mail->Debugoutput = 'html';
         $mail->Host = "yooursmtp";
         $mail->Port = 587;
         $mail->SMTPAuth = true;   
         $mail->Username = "salu.santhosh.p@email.com";    
         $mail->Password = ".$newpass.";
         $mail->setFrom('salu.santhosh.p@gmail.com', 'admin');
         $mail->IsHTML(true);
         $mail->addAddress($email);
         $mail->Subject = 'OTP from company';
         $mail->Body    = $mail_message;
         $mail->AltBody = $mail_message;
 if (!$mail->send()) {
      $this->session->set_flashdata('msg','Failed to send password, please try again!');
 } else {
    $this->session->set_flashdata('msg','Password sent to your email!');
 }
   redirect(base_url().'login','refresh');        
 }
 else
 {  
  $this->session->set_flashdata('msg','Email not found try again!');
  redirect(base_url().'forgot-password-page','refresh');
 }
 }

  public function newpassword($random)
  {
   
    $data=array();
    $data['password']=$_POST['newpassword'];
    $this->db->where('remember_token', $random);
    $this->db->update('mst_users', $data);
  }
   //select all menus on navigation bar
   public function select_all_menu($id)
   {
     $this->db->select('mst_permission.name');    
     $this->db->from('mst_permission');
     $this->db->join('mst_role_permissions', 'mst_permission.id = mst_role_permissions.permission_id');
     $this->db->join('mst_roles', 'mst_roles.id = mst_role_permissions.role_id');
     $this->db->join('mst_user_roles', 'mst_user_roles.role_id = mst_role_permissions.role_id');
     $this->db->join('mst_users', 'mst_users.id = mst_user_roles.user_id');
     $this->db->where('mst_users.id', $id);
     $query = $this->db->get();
 $result = $query->result_array();
 // var_dump($result);
 // die();
 $user_permission = array();
 foreach ($result as $val) {
     $user_permission[] = $val['name'];
 }
 return $user_permission;
 //return $result;
   }
//   public function view_permission()
//   {
//     $this->db->select('*');    
//     $this->db->from('mst_permission');
//     $query = $this->db->get();
// $result = $query->result();
// return $result;
//   }
}