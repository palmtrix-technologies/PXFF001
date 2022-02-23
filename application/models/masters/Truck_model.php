<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Truck_model extends CI_Model {


public function add($data)
{
        $this->db->insert('mst_truck',$data);
        return "success";
    
}
public function list()
{

$this->db->select('*');
$this->db->from('mst_truck');
$query = $this->db->get();
$result = $query->result();
return $result;

}
public function edit($id)
{
    $this->db->where('id', $id);
    $query = $this->db->get('mst_truck');
    $result = $query->result();
return $result;
}
public function update($id,$data)
{

    $this->db->where('id',$id);
        $this->db->update('mst_truck',$data);
        
        return "success";
    
} 
//change status
public function enable_status($id)
{
     
  
  $this->db->where('id', $id);
  $this->db->set('IsActive',1);
  if($this->db->update('mst_truck'))
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
  if($this->db->update('mst_truck'))
  {
    return 1;
  }else{
    return 0;
  }
}


}