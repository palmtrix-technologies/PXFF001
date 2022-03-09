<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genaral_expense_model extends CI_Model {

    public function select_job_details($id)
    {
      $dataq="SELECT jm_sitedetails.*,mst_client.name as client_name FROM `jm_sitedetails` inner join mst_client on mst_client.id=jm_sitedetails.clientId where JobID='".$id."';";

      $query = $this->db->query($dataq);
    $result = $query->result();
    return $result;
    
    }
    
    public function genaralexpense_report_data($from,$to)
    {
        $data="select accounts_expence.*,accounts_ledger.Ledger_Name as expensehead,froms.Ledger_Name as paymentdecription from accounts_expence inner join accounts_ledger on accounts_ledger.LedgerID=accounts_expence.to_ledger inner join accounts_ledger froms on froms.LedgerID=accounts_expence.from_ledger_id  where  expense_date between  CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
           $query = $this->db->query($data);
           $result = $query->result();
           return $result;
    }
     public function genaralexpense_report_data_detail($from,$to)
    {
        $data="select accounts_expence.*,accounts_ledger.Ledger_Name as expensehead,froms.Ledger_Name as paymentdecription,
concat(ifnull(n_v_vehicledetails.Vehicle_number,''),ifnull(jm_sitedetails.site_name,'')) as entity,accounts_expense_details.subtotal as sub,accounts_expense_details.tax_amount as tax, accounts_expense_details.total_amount as total,accounts_expense_details.description as details

from accounts_expence inner join accounts_ledger on accounts_ledger.LedgerID=accounts_expence.to_ledger inner join accounts_ledger froms on froms.LedgerID=accounts_expence.from_ledger_id inner join accounts_expense_details on accounts_expense_details.acc_expense_id=accounts_expence.acc_expense_id left JOIN n_v_vehicledetails on n_v_vehicledetails.vehicleid=accounts_expense_details.vehicle_id LEFT join jm_sitedetails on jm_sitedetails.Site_ID=accounts_expense_details.site_id  where  expense_date between  CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
           $query = $this->db->query($data);
           $result = $query->result();
           return $result;
    }
    
    
    public function vehicle_list()
{
    
    $this->db->select('*');
    $this->db->from('n_v_vehicledetails');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }
    
    public function employee_list()
    {
    
    $this->db->select('*');
    $this->db->from('n_e_employee_details');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }
    
       public function select_cash_accounts()
    {
       $this->db->where('LedgerGroupID', 2);    
       $this->db->select('*');
       $this->db->from('accounts_ledger');
       
       $query = $this->db->get();
       $result = $query->result();
      
       return $result;
    }
    
    public function select_all_job()
    {
    $this->db->select('*');
    $this->db->from('jm_job');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }
    public function selectcode()
    {
    
      $this->db->select_max('PostId');
    $this->db->from('jm_expensemaster');
    $query = $this->db->get();
    $result = $query->result();
    if($result==NULL)
    {
      $result=1;
    }
    return $result;
    
    }

   

    public function get_all_expense_ledgers()
    {
      
    $this->db->where('LedgerGroupID', 9);
    $this->db->select('LedgerID,Ledger_Name');
    $this->db->from('accounts_ledger');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }

    public function select_all_bank()
    {
    $this->db->select('*');
    $this->db->from('mst_bank');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }
    public function list_description($data)
    {
      
    $this->db->where('code', $data);
    $this->db->select('description,id');
    $this->db->from('mst_description');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }
    //to insert into jobmaster tb
    public function addgenaralexpense($data_array)
       {
       
        
          $this->db->insert('accounts_expence', $data_array);
          $job_master_id=$this->db->insert_id();
          return $job_master_id;
       
          
    
       }
       public function addgenaralexpensedetails($data_array)
       {
       
          $this->db->insert('accounts_expense_details', $data_array);
          $job_invoice_details_id=$this->db->insert_id();
          return $job_invoice_details_id;
       
          
    
       }
      //print
      public function selectexpensedetails($data)
      {
         $dataq="select jm_sitedetails.*,sp.id,sp.supplier_name,concat( sp.`contact_person`,' ' ,sp.`address`,' ',sp.`vat_no`,' ', sp.`country`,' ', sp.`telephone`,' ',sp.`mobile`) as sp_address,ji.ExpenseMasterId,ji.PostId,ji.InvDate,ji.PostingDate,ji.SubTotal,ji.VatTotal,ji.Reference,ji.OurInv,ji.GrandTotal,jj.JobId,jj.Number,concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as client_name,c.vat_no,
         concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientearabic
        
         from jm_expensemaster ji
         inner join jm_job jj on ji.JobId=jj.JobId
         
       inner join jm_sitedetails on jj.JobId=jm_sitedetails.JobID
         inner join mst_client c on c.id=jj.client_id
         inner join mst_supplier sp on sp.id=ji.SupplierID
          where ji.ExpenseMasterId=".$data.";";
      
       $query = $this->db->query($dataq);
          $result = $query->result();

              return $result;
           
       
      
      }
      
      // to select_job_invoice details
      public function supplier_expense_details($data)
      {
         $this->db->where('jm_expensedetail.ExpenseMasterId', $data);
         $this->db->select('*');    
         $this->db->from('jm_expensedetail');
         $query = $this->db->get();
         $result = $query->result();
         return $result;
       
      
      }
       //edit
      public function editexpenseedetails($data)
      {
        
         $dataq="select jm_sitedetails.*,ji.Mode,sp.id,sp.supplier_name,ji.ExpenseMasterId,ji.PostId,ji.InvDate,ji.PostingDate,ji.SubTotal,ji.VatTotal,ji.Reference,ji.OurInv,ji.GrandTotal,jj.JobId,jj.Number,concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as client_name,c.vat_no,
         concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientearabic
        
         from jm_expensemaster ji
         inner join jm_job jj on ji.JobId=jj.JobId
         
       inner join jm_sitedetails on jj.JobId=jm_sitedetails.JobID
         inner join mst_client c on c.id=jj.client_id
         inner join mst_supplier sp on sp.id=ji.SupplierID
          where ji.ExpenseMasterId=".$data.";";
      
       $query = $this->db->query($dataq);
          $result = $query->result();
              return $result;
           
       
      
      }
      
      //update
      public function update_expenseemaster($Id,$data_array)
         {
            $this->db->where('jm_expensemaster.ExpenseMasterId', $Id);
            $this->db->update('jm_expensemaster', $data_array);
            
            return 1;
       
         }
         public function insert_expncdetails($data_array)
         {
         
            $this->db->insert('jm_expensedetail', $data_array);
            return 1;
         
         }
         public function delete_expncdetails($Id)
         {
           
            $this->db->where('ExpenseDetailId',$Id);
            $this->db->delete('jm_expensedetail');
            return 1;
         
            
      
         }
         //view supplier expense list
   public function select_expenselist()
    {
    $this->db->select('*');
    $this->db->from('jm_expensemaster');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }
    public function list_currency()
{

$this->db->select('*');
$this->db->from('mst_currency');
$query = $this->db->get();
$result = $query->result();
return $result;

}   
public function change_expense_status($masteid)
{
   $this->db->set('Status',"Posted" );
   $this->db->where('ExpenseMasterId', $masteid);
   $this->db->update('jm_expensemaster');
   return 1;
}
public function select_expense_data($data)
{
  
$dataq="select PostingDate,Mode,SubTotal,VatTotal ,PostId,JobID from jm_expensemaster
 where ExpenseMasterId=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
     
 

}



public function select_supplier_ledgerid($id)
{
  $this->db->where('SupplierID', $id);

$this->db->select('LedgerID');
$this->db->from('accounts_supplierledger');
$query = $this->db->get();
$result = $query->result();
foreach($result as $row)
{
  $id=$row->LedgerID;
}
return $id;

}

public function insert_into_accountmaster($supledgerid,$amount,$date,$narration,$type,$chequeid)
{
  
     $query2="insert into accounts_accountmaster values ('','".$supledgerid."','1','".$amount."','".$date."','".$narration."','".$type."','".$chequeid."')"; 
     $this->db->query($query2);
   
     $ledgerid=   $this->db->insert_id();
     return $ledgerid;
 
   

}
public function insert_into_accountmaster_vatentry($amount,$date,$narration,$type,$chequeid)
{
  
     $query2="insert into accounts_accountmaster values ('','13','1','".$amount."','".$date."','".$narration."','".$type."','".$chequeid."')"; 
     $this->db->query($query2);
   
     $ledgerid=   $this->db->insert_id();
     return $ledgerid;
 
   

}
}