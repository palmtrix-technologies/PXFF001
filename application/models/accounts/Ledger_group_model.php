<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledger_group_model extends CI_Model {

 
public function add($data)
{
    $this->db->insert('Accounts_LedgerGroup',$data);
        return "success";
  
}

public function list($data)
{
    
    $this->db->where('Type', $data);
    $query = $this->db->get('accounts_ledgergroup');
    $result = $query->result();
    return $result;
  
}

}