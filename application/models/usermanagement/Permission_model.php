<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_model extends CI_Model {


public function add($data)
{
    $this->db->where('name', $data['name']);
    $this->db->where('display_name',$data['display_name']);
    $query = $this->db->get('mst_permission');
    $count_row = $query->num_rows();
    if ($count_row > 0) {
       return "data already exist";
    } else {
       
        $this->db->insert('mst_permission',$data);
        return "success";
    }
}
public function list()
{

$this->db->select('*');
$this->db->from('mst_permission');
$query = $this->db->get();
$result = $query->result();
return $result;

}
public function edit($id)
{
    $this->db->where('id', $id);
    $query = $this->db->get('mst_permission');
    $result = $query->result();
return $result;
}
public function update($id,$data)
{

    $this->db->where('id',$id);
        $this->db->update('mst_permission',$data);
        
        return "success";
    
} 
public function userdetails($id)
{
  
 
  $this->db->select('*');    
  $this->db->from('mst_users');

  $this->db->where('id', $id);
  $query = $this->db->get();
$result = $query->result();
return $result;
}

}