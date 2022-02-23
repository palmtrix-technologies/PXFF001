<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_entry_model extends CI_Model {

 

public function listcredit($data)
{
    
//     $this->db->select('Ledger_Name,LedgerID,GroupName');    
//     $this->db->from('Accounts_Ledger');
//     $this->db->join('Accounts_LedgerGroup', 'Accounts_Ledger.LedgerGroupID = Accounts_LedgerGroup.LedgerGroupID');
//    // $this->db->where('Ledger_Name not like '%cash%' and Accounts_LedgerGroup.GroupName not like '%bank%'');
//    $this->db->like('Accounts_Ledger.Ledger_Name', 'cash', 'both');
//    $this->db->like('Accounts_LedgerGroup.GroupName', 'bank', 'both');
$query = $this->db->query('select Ledger_Name,LedgerID,GroupName from accounts_ledger join accounts_ledgergroup on accounts_ledger.LedgerGroupID=accounts_ledgergroup.LedgerGroupID WHERE Ledger_Name LIKE "%cash%" OR accounts_ledgergroup.GroupName LIKE "%bank%"');
  
//$query = $this->db->get();
   $result = $query->result();
       return $result;
    
  
}

public function listdebit($data)
{
 
$query = $this->db->query('select Ledger_Name,LedgerID,GroupName from accounts_ledger join accounts_ledgergroup on accounts_ledger.LedgerGroupID=accounts_ledgergroup.LedgerGroupID WHERE Ledger_Name not LIKE "%cash%" AND accounts_ledgergroup.GroupName not LIKE "%bank%"');
 
   $result = $query->result();
       return $result;
    
  
}


public function listcredit_receipt($data)
{
    
//     $this->db->select('Ledger_Name,LedgerID,GroupName');    
//     $this->db->from('Accounts_Ledger');
//     $this->db->join('Accounts_LedgerGroup', 'Accounts_Ledger.LedgerGroupID = Accounts_LedgerGroup.LedgerGroupID');
//    // $this->db->where('Ledger_Name not like '%cash%' and Accounts_LedgerGroup.GroupName not like '%bank%'');
//    $this->db->like('Accounts_Ledger.Ledger_Name', 'cash', 'both');
//    $this->db->like('Accounts_LedgerGroup.GroupName', 'bank', 'both');
$query = $this->db->query('select Ledger_Name,LedgerID,GroupName from accounts_ledger join accounts_ledgergroup on accounts_ledger.LedgerGroupID=accounts_ledgergroup.LedgerGroupID WHERE Ledger_Name LIKE "%cash%" OR accounts_ledgergroup.GroupName LIKE "%bank%"');

//$query = $this->db->get();
   $result = $query->result();
       return $result;
    
  
}


public function listdebit_receipt($data)
{
  
$query = $this->db->query('select Ledger_Name,LedgerID,GroupName from accounts_ledger join accounts_ledgergroup on accounts_ledger.LedgerGroupID=accounts_ledgergroup.LedgerGroupID WHERE Ledger_Name LIKE "%cash%" OR accounts_ledgergroup.GroupName LIKE "%bank%"');

//$query = $this->db->get();
   $result = $query->result();
       return $result;
    
  
}

public function listcredit_contra($data)
{
  
$query = $this->db->query('select Ledger_Name,LedgerID,GroupName from accounts_ledger join accounts_ledgergroup on accounts_ledger.LedgerGroupID=accounts_ledgergroup.LedgerGroupID WHERE Ledger_Name LIKE "%cash%" OR accounts_ledgergroup.GroupName LIKE "%bank%"');

//$query = $this->db->get();
   $result = $query->result();
       return $result;
    
  
}

public function listdebit_contra($data)
{
  
$query = $this->db->query('select Ledger_Name,LedgerID,GroupName from accounts_ledger join accounts_ledgergroup on accounts_ledger.LedgerGroupID=accounts_ledgergroup.LedgerGroupID WHERE Ledger_Name LIKE "%cash%" OR accounts_ledgergroup.GroupName LIKE "%bank%"');

//$query = $this->db->get();
   $result = $query->result();
       return $result;
    
  
}

public function listdebit_transfer($data)
{
  
$query = $this->db->query('select Ledger_Name,LedgerID,GroupName from accounts_ledger join accounts_ledgergroup on accounts_ledger.LedgerGroupID=accounts_ledgergroup.LedgerGroupID WHERE Ledger_Name not LIKE "%cash%" AND accounts_ledgergroup.GroupName not LIKE "%bank%"');

//$query = $this->db->get();
   $result = $query->result();
       return $result;
    
  
}

public function listcredit_transfer($data)
{
  
    $query = $this->db->query('select Ledger_Name,LedgerID,GroupName from accounts_ledger join accounts_ledgergroup on accounts_ledger.LedgerGroupID=accounts_ledgergroup.LedgerGroupID WHERE Ledger_Name not LIKE "%cash%" AND accounts_ledgergroup.GroupName not LIKE "%bank%"');

//$query = $this->db->get();
   $result = $query->result();
       return $result;
    
  
}

public function insert_accounts_entry()
{

     $call_procedure ="call db_a11d4e_logiv1.sp_Accounts_TransactionEntry('".$_POST['creditaccount']."',' ".$_POST['debitaccount']."', '".$_POST['amount']."','".$_POST['date']."','". $_POST['narration']."', '".$_POST['pay_type']."', '0');";
     $this->db->query($call_procedure);

 //   $query = $this->db->query('call db_a11d4e_logiv1.sp_Accounts_TransactionEntry($_POST['creditaccount'],$_POST['debitaccount'],$_POST['account'],$_POST['date'],$_POST['narration'],$_POST['narration'],0)');

    
  
}

public function insert_accounts_entry_cheque()
{
//insert details to chequedetails table

//insert cheque details to cheque details table
$data=array();
$data['Chq_No']=$_POST['chequenumber'];
$data['Chq_Date']=$_POST['chequedate'];
$data['Chq_Bank']=$_POST['bank'];


$this->db->insert('accounts_cheque_details',$data);
$insert_id = $this->db->insert_id();
//call storedprocedure
     $call_procedure ="call db_a11d4e_logiv1.sp_Accounts_TransactionEntry('".$_POST['creditaccount']."',' ".$_POST['debitaccount']."', '".$_POST['amount']."','".$_POST['date']."','". $_POST['narration']."', '".$_POST['pay_type']."','".$insert_id."');";
     $this->db->query($call_procedure);



    
  
}
}