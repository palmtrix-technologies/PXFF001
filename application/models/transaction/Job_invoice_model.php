<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_invoice_model extends CI_Model {

public function select_job_details($id)
{
 $this->db->where('JobId',$id);
$this->db->select('*');
$this->db->from('jm_job');
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
public function selectcode()
{

  $this->db->select_max('Inv');
$this->db->from('jm_invoicemaster');
$query = $this->db->get();
$result = $query->result();
if($result==NULL)
{
  $result=1;
}
return $result;

}
public function selectcodeid()
{
$maxquery="(SELECT * FROM jm_invoicemaster ORDER BY InvoiceMasterId DESC LIMIT 0,1)";
$query = $this->db->query($maxquery);
$result = $query->result();
if($result==NULL)
{
  $result=1;
}
return $result;

}
public function list_description($data)
{
  
$this->db->where('code', $data);
$this->db->select('description,id');
$this->db->from('mst_description');
$result = $this->db->get()->result_array();

}

public function viewjobmaster_expense($postid,$SupplierID)
{
$dataq="select * from jm_expensemaster
 where PostId=".$postid." and SupplierID=".$SupplierID." ";
 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;

}
public function addjobmaster_expense($data_array)
       {
      
          $this->db->insert('jm_expensemaster', $data_array);
          $ExpenseMasterId=$this->db->insert_id();
          return $ExpenseMasterId;
       
       }
       public function addjobinvoicedetailsinsert_expense($data_array)
       {
      
          $this->db->insert('jm_expensedetail', $data_array);
          $ExpenseDetailId=$this->db->insert_id();
          return $ExpenseDetailId;
       
       }

//to insert into jobmaster tb
public function addjobmaster($data_array)
   {
   
    
      $this->db->insert('jm_invoicemaster', $data_array);
      $job_master_id=$this->db->insert_id();
      return $job_master_id;
   
   }
   public function addjobinvoicedetailsinsert($data_array)
   {
   
     
      $this->db->insert('jm_invoicedetail', $data_array);
      $job_invoice_details_id=$this->db->insert_id();
      return $job_invoice_details_id;
   
      

   }
   //to select invoicedetails
   
public function selectinvoicedetails($data)
{
 
$dataq="select ji.Inv,ji.Date,ji.Total,ji.VatTotal,ji.GrandTotal,concat(jj.Hawb,'-',jj.Mawb) as awb,concat(jj.Hbl,'-',jj.Mbl) as hblmbl,jj.Number,jj.ActualWeight,jj.PoNo, jj.Etd,jj.Eta,concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'<br>',c.email) as clientenglish,c.vat_no, concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'<br>',c.email) as clientearabic, jj.Shipper as consignor, jj.Consignee as consignee, concat(bn.bank_name,'<br>',bn.acc_number,'<br>',bn.other_info,'<br>',bn.iban) as bank from jm_invoicemaster ji inner join mst_bank bn on bn.id=ji.Bank inner join jm_job jj on ji.JobId=jj.JobId inner join mst_client c on c.id=jj.client_id inner join mst_shipper consignor on consignor.id=jj.consignor_id inner join mst_shipper consignee on consignee.id=jj.consignee_id where ji.InvoiceMasterId=".$data.";";

 $query = $this->db->query($dataq);
 return $query->result();
  
   
}



// to select_job_invoice details
public function select_job_invoice_details($data)
{
   $this->db->where('jm_invoicedetail.InvoiceMasterId', $data);
   $this->db->select('jm_invoicedetail.*,mst_description.description_arabic');    
   $this->db->from('jm_invoicedetail');
   $this->db->join('mst_description', 'mst_description.description = jm_invoicedetail.Description','left');
   $query = $this->db->get();
   $result = $query->result();
   return $result;

}
 
public function editinvoicedetails($data)
{
  
$dataq="select ji.InvoiceMasterId,ji.Inv,ji.Date,ji.Total,ji.VatTotal,ji.GrandTotal,ji.InvoiceType,ji.ReceiptNo,ji.ReceiptDescription,ji.Amount,concat(jj.Hawb,'-',jj.Mawb) as awb,jj.Number,jj.ActualWeight,
jj.Etd,jj.Eta,jj.Type,jj.Mbl,jj.Carrier,jj.Pol,jj.Pod,jj.PoNo,bn.id,bn.bank_name,bn.id,concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientenglish,c.vat_no,
concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientearabic,
concat(consignor.name,',',consignor.address,',',consignor.telephone,'-',consignor.mobile,'\n',consignor.email) as consignor,
concat(consignee.name,',',consignee.address,',',consignee.telephone,'-',consignee.mobile,'\n',consignee.email) as consignee,
concat(bn.bank_name,',',bn.acc_number,',',bn.other_info,',',bn.iban) as bank
from jm_invoicemaster ji
inner join jm_job jj on ji.JobId=jj.JobId
inner join mst_client c on c.id=jj.client_id
inner join mst_shipper consignor on consignor.id=jj.consignor_id
inner join mst_shipper consignee on consignee.id=jj.consignee_id
inner join mst_bank bn  on bn.id=ji.Bank
 where ji.InvoiceMasterId=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
     
 

}

public function updatejobmaster($Id)
   {
      
      $this->db->set('status',"Posted" );
      $this->db->where('estimate_masterid', $Id);
      $this->db->update('jm_estimate_master');
      return 1;
   }

   public function expensemaster_expense($SubTotal,$VatTotal,$GrandTotal,$result)
   {
      
      $this->db->set('SubTotal',$SubTotal );
      $this->db->set('VatTotal',$VatTotal );
      $this->db->set('GrandTotal',$GrandTotal );
      $this->db->where('ExpenseMasterId', $result);
      $this->db->update('jm_expensemaster');
      return 1;
   }

public function updateJobinvoicemaster($Id,$data_array)
   {
   
      $this->db->where('jm_invoicemaster.Inv', $Id);
      $this->db->update('jm_invoicemaster', $data_array);
      
      return 1;
   }
   
   public function updateJobinvoicemaster_InvoiceMasterId($Id,$data_array)
   {
   
      $this->db->where('jm_invoicemaster.InvoiceMasterId', $Id);
      $this->db->update('jm_invoicemaster', $data_array);
      
      return 1;
   
      

   }
   
   
   
   public function insertjobinvoicedetails($data_array)
   {
   
    
      $this->db->insert('jm_invoicedetail', $data_array);
      return 1;
   
   }
   public function deleteinvoicedetailsinsert($Id)
   {

      $this->db->where('InvoiceDetailId',$Id);
      $this->db->delete('jm_invoicedetail');
      return 1;
   
      

   }
   
   public function change_invoice_status($invoicemasteid)
   {
      $this->db->set('Status',"Posted" );
      $this->db->where('InvoiceMasterId', $invoicemasteid);
      $this->db->update('jm_invoicemaster');
      return 1;
   }
   public function select_currency()
   {
      $this->db->select('currency');
$this->db->from('mst_currency');
$query = $this->db->get();
$result = $query->result();
return $result;
   }
   

   public function select_invoice_data($data)
{
  
$dataq="select Date,InvoiceType,GrandTotal,Total,ReceiptDescription,VatTotal,Inv,JobId from jm_invoicemaster
 where InvoiceMasterId=".$data.";";

 $query = $this->db->query($dataq);
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

public function select_invoicedetails_data($data)
{
  
$dataq="SELECT `InvoiceDetailId`, `Description`, `UnitPrice`, `Currency`, `ConvFactor`, `Quantity`, `Vat`, `Total`, `InvoiceMasterId`, `VAT_percentage` FROM `jm_invoicedetail` 
WHERE InvoiceMasterId=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
     
 

}

public function insert_into_accountmaster($clientledgerid,$amount,$date,$narration,$type,$chequeid)
{
  
     $query2="insert into accounts_accountmaster values ('','1','".$clientledgerid."','".$amount."','".$date."','".$narration."','".$type."','".$chequeid."')"; 
     $this->db->query($query2);
   
     $ledgerid=   $this->db->insert_id();
     return $ledgerid;
 
   

}
public function insert_into_accountmaster_vatentry($amount,$date,$narration,$type,$chequeid,$vat)
{
    $id = $this->get_vatledger($vat);
     $query2="insert into accounts_accountmaster values ('','1','".$id."','".$amount."','".$date."','".$narration."','".$type."','".$chequeid."')"; 
     $this->db->query($query2);
   
     $ledgerid=   $this->db->insert_id();
     return $ledgerid;
 
   

}
public function get_vatledger($vat)
{
   $id=0;
   $this->db->where('Ledger_Name','vat@'.$vat);

   $this->db->select('LedgerID');
   $this->db->from('accounts_ledger');
   $query = $this->db->get();
   $result = $query->result();
   foreach($result as $row)
   {
     $id=$row->LedgerID;
   }
   if($id==0){
    
      $query2="INSERT INTO `accounts_ledger`(`LedgerGroupID`, `Ledger_Name`) values (4,concat('vat@',".$vat."))"; 
 
      $this->db->query($query2);
    
      $ledgerid=   $this->db->insert_id();
      $id=$ledgerid;
   
   }
   return $id;
   
}

}