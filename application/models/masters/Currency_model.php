<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency_model extends CI_Model {


public function add($data)
{
        $this->db->insert('mst_currency',$data);
        return "success";
    
}
public function list()
{

$this->db->select('*');
$this->db->from('mst_currency');
$query = $this->db->get();
$result = $query->result();
return $result;

}
public function edit($id)
{
    $this->db->where('id', $id);
    $query = $this->db->get('mst_currency');
    $result = $query->result();
return $result;
}
public function update($id,$data)
{

    $this->db->where('id',$id);
        $this->db->update('mst_currency',$data);
        
        return "success";
    
} 
//change status
public function enable_status($id)
{
     
  
  $this->db->where('id', $id);
  $this->db->set('IsActive',1);
  if($this->db->update('mst_currency'))
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
  if($this->db->update('mst_currency'))
  {
    return 1;
  }else{
    return 0;
  }
}


}