<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrier_model extends CI_Model {

    public function list()
{

$this->db->select('*');
$this->db->from('mst_carrier');
$query = $this->db->get();
$result = $query->result();
return $result;

}
public function selectcode()
{

  $this->db->select_max('code');
$this->db->from('mst_carrier');
$query = $this->db->get();
$result = $query->result();
if($result==NULL)
{
  $result=2;
}
return $result;

}
public function add($data)
{
    // var_dump($data);
    // die();
    // $this->db->where('email', $data['email']);
   
    // $query = $this->db->get('mst_carrier');
    // $count_row = $query->num_rows();
    // if ($count_row > 0) {
    //    return "account already exist";
    // } else {
       
        $this->db->insert('mst_carrier',$data);
        return "success";
    // }
}
public function edit($id)
{
    $this->db->where('id', $id);
    $query = $this->db->get('mst_carrier');
    $result = $query->result();
return $result;
}
public function update($id,$data)
{

    $this->db->where('id',$id);
        $this->db->update('mst_carrier',$data);
        
        return "success";
    
} 
//change status
public function enable_status($id)
{
 	
  
  $this->db->where('id', $id);
  $this->db->set('IsActive',1);
  if($this->db->update('mst_carrier'))
  {
    return 1;
  }else{
    return 0;
  }
}
public function disable_status($id)
{
 	
  
  $this->db->where('id', $id);
  $this->db->set('IsActive',0);
  if($this->db->update('mst_carrier'))
  {
    return 1;
  }else{
    return 0;
  }
}
}