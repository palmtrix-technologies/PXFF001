<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Job_supplier_payment_model extends CI_Model
{


   public function select_all_bank()
   {
      $this->db->select('*');
      $this->db->from('mst_bank');
      $query = $this->db->get();
      $result = $query->result();
      return $result;
   }
   public function select_supplier_details($supid)
   {
      $dataq = "select * from mst_supplier  where id=" . $supid . ";";

      $query = $this->db->query($dataq);
      $result = $query->result();
      return $result;
   }
   //to select invoice number with status notpaid
   public function select_invoice_number($supid)
   {
      $dataq = "select * from jm_expensemaster where Status!='Paid' and SupplierID=". $supid . ";";

      $query = $this->db->query($dataq);
      $result = $query->result();
      return $result;
   }
   public function selectinvoicenumber($id)
   {
      $dataq = "select * from jm_supplierpaymentmaster
     inner join  jm_expensemaster on jm_supplierpaymentmaster.SuplierID=jm_expensemaster.SupplierID
     where jm_expensemaster.Status!='Paid' and jm_supplierpaymentmaster.SupplierPaymentMasterId=" . $id . ";";

     $query = $this->db->query($dataq);
     $result = $query->result();
     return $result;
   }
   public function selectclientdetails($invid)
   {
      $data = "select * ,jm_expensemaster.GrandTotal-ifnull((select sum(Total) from jm_supplierpaymentdetail where jm_supplierpaymentdetail.SupplierExpenseMasterID=".$invid."),0) as balance from jm_expensemaster
      inner join  jm_job on jm_expensemaster.JobId=jm_job.JobId
       where jm_expensemaster.ExpenseMasterId=".$invid.";";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;
   }
   //to select code
   public function selectcode()
   {

      $this->db->select_max('ID');
      $this->db->from('jm_supplierpaymentmaster');
      $query = $this->db->get();
      $result = $query->result();
      if ($result == NULL) {
         $result = 1;
      }
      return $result;
   }
   //to insert into jobsupplierpaymentmaster tb
   public function addjobsupplierpaymentmaster($data_array)
   {


      $this->db->insert('jm_supplierpaymentmaster', $data_array);
      $job_supplier_payment_master_id = $this->db->insert_id();
      // return $job_supplier_payment_master_id;


      
      // $this->db->query("UPDATE `jm_supplierpaymentmaster` SET `TransactionId` = '".$transid."' WHERE `SupplierPaymentMasterId` = $job_supplier_payment_master_id");
    
      $this->db->select_max('SupplierPaymentMasterId');
      $this->db->from('jm_supplierpaymentmaster');
      $query = $this->db->get();
      $result = $query->result();
  

      foreach($result as $row)
{
  $id=$row->SupplierPaymentMasterId;
}
return $id;

   }
   public function addjobsupplierpaymentdetails($data_array)
   {

      // var_dump( $data_array);
      // die();
      $this->db->insert('jm_supplierpaymentdetail', $data_array);
      $job_supplier_payment_details_id = $this->db->insert_id();
      return $job_supplier_payment_details_id;
   }
   public function insert_account_chequedetails($data_array)
   {


      $this->db->insert('accounts_cheque_details', $data_array);
      $chequedetailid = $this->db->insert_id();
      return $chequedetailid;
   }
   public function changeexpensemasterstatus($data_array)
   {
// var_dump($data_array);
// die();
      $this->db->set('Status',"Paid" );
      $this->db->where('ExpenseMasterId', $data_array["ExpenseMasterId"]);
      $this->db->update('jm_expensemaster');
   }
   
   //update supplier payment
   public function select_job_supplier_payment($data)
   {
      $this->db->where('jm_supplierpaymentdetail.SupplierExpenseMasterID', $data);
      $this->db->select('*');
      $this->db->from('jm_supplierpaymentdetail');
      $query = $this->db->get();
      $result = $query->result();
      return $result;
   }

   public function fatchsupplierpaymentdetails($data)
   {

   $dataq="select * from jm_supplierpaymentmaster
   inner join mst_bank on mst_bank.id=jm_supplierpaymentmaster.BankId
  
     inner join mst_supplier on jm_supplierpaymentmaster.SuplierID=mst_supplier.id
    
     WHERE jm_supplierpaymentmaster.SupplierPaymentMasterId=".$data.";";

    $query = $this->db->query($dataq);
       $result = $query->result();
           return $result;



   }


  
   //update data

   public function updatesupplierpaymentemaster($Id,$data_array)
   {
   
      $this->db->where('jm_supplierpaymentmaster.SupplierPaymentMasterId', $Id);
      $this->db->update('jm_supplierpaymentmaster', $data_array);
      
      return 1;
   
      

   }
   public function insertsupplierpaymentdetails($data_array)
   {
   
    
      $this->db->insert('jm_supplierpaymentdetail', $data_array);
 
      return 1;
   
   }
   public function deletesupplierpayment($Id)
   {

      $this->db->where('SupplierPaymentDetailId',$Id);
      $this->db->delete('jm_supplierpaymentdetail');
      return 1;
   
      

   }
    //print supplier payment
   
    public function selectpaymentdetails($data)
    {
      
    $dataq="select ji.ID,ji.Date,ji.VatTotal,ji.SubTotal,concat(c.supplier_name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as supplierenglish,c.vat_no,
    concat(bn.bank_name,',',bn.acc_number,',',bn.other_info,',',bn.iban) as bank
    from jm_supplierpaymentmaster ji
      inner join mst_supplier c on c.id=ji.SuplierID
      inner join mst_bank bn  on bn.id=ji.BankID
   
    
     where ji.SupplierPaymentMasterId=".$data.";";
    
     $query = $this->db->query($dataq);
        $result = $query->result();
            return $result;
         
     
    
    }
    
    // to select_payment details
    public function select_payment_details($data)
    {
       $this->db->where('jm_supplierpaymentdetail.SupplierPaymentmasterId', $data);
       $this->db->select('*');    
       $this->db->from('jm_supplierpaymentdetail');
       $query = $this->db->get();
       $result = $query->result();
       return $result;
     
    
    }
    //to select all suppliers
    public function select_all_suppliers()
    {
 
       $this->db->select('*');
       $this->db->from('mst_supplier');
       $query = $this->db->get();
       $result = $query->result();
      
       return $result;
    }
    
   
   public function select_sup_ledgerid($id)
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
   
   public function insert_into_accountmaster($clientledgerid,$amount,$date,$narration,$type,$chequeid)
   {
     
        $query2="insert into accounts_accountmaster values ('','".$clientledgerid."','2','".$amount."','".$date."','".$narration."','".$type."','".$chequeid."')"; 
        $this->db->query($query2);
      
        $ledgerid=   $this->db->insert_id();
        return $ledgerid;
    
      
   
   }
   
   

public function select_payment_data($data)
{
  
$dataq="select Date,SubTotal,Mode,BankId from jm_supplierpaymentmaster
 where SupplierPaymentMasterId=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
     
 

}

public function select_bank_ledgerid($id)
{
  $this->db->where('id', $id);

$this->db->select('bankledgerid');
$this->db->from('mst_bank');
$query = $this->db->get();
$result = $query->result();
foreach($result as $row)
{
  $id=$row->bankledgerid;
}
return $id;

}
public function insert_into_accountmaster_bank($bankid,$clientledgerid,$amount,$date,$narration,$type,$chequeid)
{
  
     $query2="insert into accounts_accountmaster values ('','".$clientledgerid."','".$bankid."','".$amount."','".$date."','".$narration."','".$type."','".$chequeid."')"; 
     $this->db->query($query2);
   
     $ledgerid=   $this->db->insert_id();
     return $ledgerid;
 
   

}

}
