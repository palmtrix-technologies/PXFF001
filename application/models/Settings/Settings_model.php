<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

 

public function list_company_data()
{
    
    $query = $this->db->query('SELECT * FROM cmpny_settings_basic_info');
 
   $result = $query->result();
       return $result;
}

public function list_invoice_data()
{
    $query = $this->db->query('SELECT * FROM cmpny_settings_inv_details');
 
    $result = $query->result();
        return $result;
}
public function updatedata($new_name1,$new_name2,$new_name3)
{
 
    date_default_timezone_set('Asia/Karachi'); # add your city to set local time zone
$now = date('Y-m-d H:i:s');
// echo $new_name;
// die();
  $data=array();
  $data1=array();
    if($new_name1=='')
    {
      $data['Icon_image']=$_POST['imageval'];
    }
    else{
      $data['Icon_image']=$new_name1;
    }
    if($new_name2=='')
    {
      $data1['Invheaderimage']=$_POST['headerimg'];
    }
    else{
      $data1['Invheaderimage']=$new_name2;
    }
    
    if($new_name3=='')
    {
      $data1['InvfooterImage']=$_POST['footerimg'];
    }
    else{
      $data1['InvfooterImage']=$new_name3;
    }
    
    
        $data['Cmpny_name']=$_POST['name'];
        $data['Address']=$_POST['address'];
        $data['Phone']=$_POST['phno'];
        $data['FAX']=$_POST['fax'];
        $data['VAT']=$_POST['vat'];
        $data['CR']=$_POST['cr'];
        $data['Email']=$_POST['email'];
        $data['Web']=$_POST['web'];

         $id=$_POST['id'];
         $this->db->where('id',$id);
        $this->db->update('cmpny_settings_basic_info',$data);
      $data1['Invseries']=$_POST['invseries'];
      $invid=$_POST['invid'];
      $this->db->where('id',$invid);
      $this->db->update('cmpny_settings_inv_details',$data1);
       
    return 1;

}
}