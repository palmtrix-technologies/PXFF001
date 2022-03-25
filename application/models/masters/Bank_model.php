<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_model extends CI_Model {

    public function list()
{

$this->db->select('*');
$this->db->from('mst_bank');
$query = $this->db->get();
$result = $query->result();
return $result;

}
public function selectcode()
{

  $this->db->select_max('code');
$this->db->from('mst_bank');
$query = $this->db->get();
$result = $query->result();
if($result==NULL)
{
  $result=1;
}
return $result;

}
public function add($data,$bankledgerid)
{
    // var_dump($data);
    // die();
    $this->db->where('acc_number', $data['acc_number']);
   
    $query = $this->db->get('mst_bank');
    $count_row = $query->num_rows();
    if ($count_row > 0) {
       return "account already exist";
    } else {
       
        $this->db->insert('mst_bank',$data);
        $bankid = $this->db->insert_id();
        $this->db->query("UPDATE `mst_bank` SET `bankledgerid` = '".$bankledgerid."' WHERE `id` = $bankid");
        return "success";
    }
}


public function add_ledger($name)
{
  $query1="insert into accounts_ledger (LedgerID,LedgerGroupID,Ledger_Name) values('','1','".$name."')";
  $this->db->query($query1);

  $accountsid=   $this->db->insert_id();
  return $accountsid;
}
public function add_ledger_credit($name)
{
  $query1="insert into accounts_ledger (LedgerID,LedgerGroupID,Ledger_Name) values('','4','".$name."')";
  $this->db->query($query1);

  $accountsid=   $this->db->insert_id();
  return $accountsid;
}

public function edit($id)
{
    $this->db->where('id', $id);
    $query = $this->db->get('mst_bank');
    $result = $query->result();
return $result;
}
public function update($id,$data)
{

    $this->db->where('id',$id);
        $this->db->update('mst_bank',$data);
        
        return "success";
    
} 
	//change status
    public function enable_status($id)
    {
         
      
      $this->db->where('id', $id);
      $this->db->set('IsActive',1);
      if($this->db->update('mst_bank'))
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
      if($this->db->update('mst_bank'))
      {
        return 1;
      }else{
        return 0;
      }
    }
    public function checkaccount($accno)
{
  
   
    $query = $this->db->query("select acc_number from mst_bank where acc_number='".$accno."'");
    if($query->num_rows() > 0)
    {
     
      return 1;
    }else{
      return 0;
    }
}
}