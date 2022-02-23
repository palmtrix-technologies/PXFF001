<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    
    public function add($new_name)
    {
        date_default_timezone_set('Asia/Karachi'); # add your city to set local time zone
$now = date('Y-m-d H:i:s');
// echo $new_name;
// die();
      $data=array();
    
        if($new_name=='')
        {
          $data['user_image']='';
        }
        else{
          $data['user_image']=$new_name;
        }
        
            $data['user_name']=$_POST['name'];
            $data['email']=$_POST['email'];
            $data['password']=$_POST['password'];
             $data['enabled']=1;
             $data['created_at']=$now;
             $data['locale']=$_POST['locale'];
             $this->db->insert('mst_users', $data);
           
             //select last inserted id from mst_users tb
             $id = $this->db->insert_id();
            
           $dat['user_id']=$id;
          
            $dat['user_type']="user";
          
          $role=$_POST['roles'];
           
                foreach($role as $val)  
              {  $dat['role_id']=$val;
                
                $this->db->insert('mst_user_roles', $dat);
                   
              }
             
        return 1;
        
    }

public function list()
{
$this->db->select('*');    
$this->db->from('mst_users');
$this->db->join('mst_user_roles', 'mst_users.id = mst_user_roles.user_id');
$this->db->join('mst_roles', 'mst_user_roles.role_id = mst_roles.id');

$query = $this->db->get();
$result = $query->result();
return $result;

}

public function list_roles()
{

$this->db->select('*');
$this->db->from('mst_roles');
$query = $this->db->get();
$result = $query->result();
return $result;

}
public function edit($id)
{
    $this->db->where('id', $id);
    $query = $this->db->get('mst_users');
    $result = $query->result();
return $result;
}
public function editroles($id)
{
    $this->db->where('user_id',$id);
    $query = $this->db->get('mst_user_roles');
    $result = $query->result();
return $result;
}

public function update($new_name)
{
    date_default_timezone_set('Asia/Karachi'); # add your city to set local time zone
$now = date('Y-m-d H:i:s');
// echo $new_name;
// die();
  $data=array();

    if($new_name=='')
    {
      $data['user_image']=$_POST['imageval'];
    }
    else{
      $data['user_image']=$new_name;
    }
    
        $data['user_name']=$_POST['name'];
        $data['email']=$_POST['email'];
        $data['password']=$_POST['password'];
        
         $data['updated_at']=$now;
         $data['locale']=$_POST['locale'];
         $id=$_POST['id'];
         $this->db->where('id',$id);
        $this->db->update('mst_users',$data);
        $role=$_POST['roles']; 
      
        $this->db->where('user_id',$id);
        $this->db->delete('mst_user_roles');
        $dat['user_id']=$_POST['id'];
      
        $dat['user_type']="user";
        foreach($role as $val)  
              {  $dat['role_id']=$val;
           
              $this->db->insert('mst_user_roles', $dat);
                      
              }
    return 1;
}
//change status
public function enable_status($id)
{
 	
  
  $this->db->where('id', $id);
  $this->db->set('enabled',1);
  if($this->db->update('mst_users'))
  {
    return 1;
  }else{
    return 0;
  }
}
public function disable_status($id)
{
 	
  
  $this->db->where('id', $id);
  $this->db->set('enabled',0);
  if($this->db->update('mst_users'))
  {
    return 1;
  }else{
    return 0;
  }
}
public function checkmailmodel($emailID)
{
  
   
    $query = $this->db->query("select email from mst_users where email='".$emailID."'");
    if($query->num_rows() > 0)
    {
     
      return 1;
    }else{
      return 0;
    }
}
}