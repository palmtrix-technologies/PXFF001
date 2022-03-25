<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_receipt_model extends CI_Model {
    public function select_all_bank()
{
$this->db->select('*');
$this->db->from('mst_bank');
$query = $this->db->get();
$result = $query->result();
return $result;

}
public function select_client_details($clientid)
{
   $dataq = "select * from mst_client  where id=" . $clientid . ";";

   $query = $this->db->query($dataq);
   $result = $query->result();
   return $result;
}
 //to select code
 public function selectcode()
 {

    $this->db->select_max('ID');
    $this->db->from('jm_receiptmaster');
    $query = $this->db->get();
    $result = $query->result();
    if ($result == NULL) {
       $result = 1;
    }
    return $result;
 }
  //to select invoice number with status notpaid
  public function select_invoice_number($clientid)
  {
     $dataq = "select * from jm_invoicemaster
     inner join  jm_job on jm_invoicemaster.JobId=jm_job.JobId
     where jm_invoicemaster.Status!='paid' and jm_job.client_id=" . $clientid . ";";

     $query = $this->db->query($dataq);
     $result = $query->result();
     return $result;
  }
  
  public function paymentreceipt_selectclientdetails($invmasterid)
  {
    
     $data = "select *, CASE WHEN jm_invoicemaster.Status='partialy Paid' THEN jm_invoicemaster.GrandTotal-(SELECT SUM(Amount) FROM `jm_receiptdetail` WHERE InvoiceMasterID=jm_invoicemaster.InvoiceMasterId) else jm_invoicemaster.GrandTotal END AS payable from jm_invoicemaster inner join jm_job on jm_invoicemaster.JobId=jm_job.JobId inner join mst_client on mst_client.id=jm_job.client_id where jm_invoicemaster.InvoiceMasterId=" . $invmasterid . ";";

     $query = $this->db->query($data);
     $result = $query->result();
     return $result;
  }

  public function paymentreceipt_selectdetails()
  {
    
     $data = "select *, CASE WHEN jm_invoicemaster.Status='partialy Paid' THEN jm_invoicemaster.GrandTotal-(SELECT SUM(Amount) FROM `jm_receiptdetail` WHERE InvoiceMasterID=jm_invoicemaster.InvoiceMasterId) else jm_invoicemaster.GrandTotal END AS payable from jm_invoicemaster inner join jm_job on jm_invoicemaster.JobId=jm_job.JobId inner join mst_client on mst_client.id=jm_job.client_id where jm_invoicemaster.Status='partialy Paid' OR jm_invoicemaster.Status='Posted' ";
   $query = $this->db->query($data);
     $result = $query->result();
     return $result;
  }
   //to insert into paymentreceiptmaster tb
   public function insert_receiptmaster($data_array)
   {


      $this->db->insert('jm_receiptmaster', $data_array);
      $payment_master_id = $this->db->insert_id();
    
   
      
      // $this->db->query("UPDATE `jm_receiptmaster` SET `TransactionID` = '".$transid."' WHERE `ReceiptMasterId` = $payment_master_id");
    
      $this->db->select_max('ReceiptMasterId');
      $this->db->from('jm_receiptmaster');
      $query = $this->db->get();
      $result = $query->result();
  

      foreach($result as $row)
{
  $id=$row->ReceiptMasterId;
}
return $id;
      // return $payment_master_id;insert_receiptdetails

   }
   public function insert_account_chequedetails($data_array)
   {


      $this->db->insert('accounts_cheque_details', $data_array);
      $chequedetailid = $this->db->insert_id();
      return $chequedetailid;
   }
  
   public function insert_receiptdetails_data($data_array)
   {   
     
      $this->db->insert('jm_receiptdetail', $data_array);
      return 1;
   }

   //to edit details and master table
   public function select_clinet_payment_receipt_detail($data)
   {
    
    $data = "select * from jm_receiptdetail
    inner join  jm_receiptmaster on jm_receiptmaster.ReceiptMasterId=jm_receiptdetail.ReceiptMasterId
    
    where jm_receiptmaster.ReceiptMasterId=" . $data . ";";

    $query = $this->db->query($data);
    $result = $query->result();
    return $result;
   }

   public function fetch_clinet_payment_receipt_master($data)
   {

   $dataq="select * from jm_receiptmaster
   inner join mst_client on jm_receiptmaster.ClientID=mst_client.id
   inner join mst_bank bn  on bn.id=jm_receiptmaster.BankID
   WHERE jm_receiptmaster.ReceiptMasterId=".$data.";";

    $query = $this->db->query($dataq);
       $result = $query->result();
           return $result;



   } 

   //update data

   public function updatepaymentreceiptmaster($Id,$data_array)
   {
   
      $this->db->where('jm_receiptmaster.ReceiptMasterId', $Id);
      $this->db->update('jm_receiptmaster', $data_array);
      
      return 1;
   
      

   }
   public function insertpaymentreceiptdetails($data_array)
   {
   
    
      $this->db->insert('jm_receiptdetail', $data_array);
      return 1;
   
   }
   public function deletepaymentreceiptdetails($Id)
   {

      $this->db->where('ReceiptDetailId',$Id);
      $this->db->delete('jm_receiptdetail');
      return 1;
   
      

   }

   //print receipt
   
   public function selectreceiptdetails($data)
   {
     
   $dataq="select ji.ID,ji.Date,ji.VatTotal,ji.SubTotal,Mode,ChequeNo,name,country,trn_no,concat(c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientenglish,c.vat_no,
   concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientearabic,
  
   concat(bn.bank_name,',',bn.acc_number,',',bn.other_info,',',bn.iban) as bank
   from jm_receiptmaster ji
     inner join mst_client c on c.id=ji.ClientID
     inner join mst_bank bn  on bn.id=ji.BankID
  
   
    where ji.ReceiptMasterId=".$data.";";
   
    $query = $this->db->query($dataq);
       $result = $query->result();
           return $result;
        
    
   
   }
   
   // to select_job_invoice details
   public function select_payment_receipt_details($data)
   {
      $this->db->where('jm_receiptdetail.ReceiptMasterId', $data);
      $this->db->select('*');    
      $this->db->from('jm_receiptdetail');
      $query = $this->db->get();
      $result = $query->result();
      return $result;
    
   
   }

   public function    changeinvoivemasterstatus($data_array,$status)
   {

      $this->db->set('Status',$status);
      $this->db->where('InvoiceMasterId', $data_array["InvoiceMasterId"]);
      $this->db->update('jm_invoicemaster');
   }
   public function select_currency()
   {
      $this->db->select('currency');
$this->db->from('mst_currency');
$query = $this->db->get();
$result = $query->result();
return $result;
   }



   
   public function select_client_ledgerid($id)
{
  $this->db->where('ClientID', $id);

$this->db->select('LedgerID');
$this->db->from('accounts_client_ledger');
$query = $this->db->get();
$result = $query->result();
foreach($result as $row)
{
  $id=$row->LedgerID;
}
return $id;

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
public function insert_into_accountmaster($clientledgerid,$amount,$date,$narration,$type,$chequeid)
{
  
     $query2="insert into accounts_accountmaster values ('','2','".$clientledgerid."','".$amount."','".$date."','".$narration."','".$type."','".$chequeid."')"; 
     $this->db->query($query2);
   
     $ledgerid=   $this->db->insert_id();
     return $ledgerid;
 
   

}
public function insert_into_accountmaster_bank($bankid,$clientledgerid,$amount,$date,$narration,$type,$chequeid)
{
  
     $query2="insert into accounts_accountmaster values ('','".$bankid."','".$clientledgerid."','".$amount."','".$date."','".$narration."','".$type."','".$chequeid."')"; 
     $this->db->query($query2);
   
     $ledgerid=   $this->db->insert_id();
     return $ledgerid;
 
   

}


public function select_receipt_data($data)
{
  
$dataq="select Date,SubTotal,Mode,BankID from jm_receiptmaster
 where ReceiptMasterId=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
     
 

}
}