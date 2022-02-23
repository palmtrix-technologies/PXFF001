<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledger_model extends CI_Model {

 
public function add($data)
{
   
   
    $this->db->insert('accounts_ledger',$data);
        return "success";
  
}

public function listdata()
{
    
    $this->db->select('*');
    $this->db->from('accounts_ledgergroup');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
}

public function list($data)
{
    
    $this->db->where('LedgerGroupID', $data);
    $query = $this->db->get('accounts_ledger');
    $result = $query->result();
    return $result;
  
}

public function editmodel($id,$data)
{

    $this->db->where('LedgerID',$id);
        $this->db->update('accounts_ledger',$data);
                return "success";
    
} 
}