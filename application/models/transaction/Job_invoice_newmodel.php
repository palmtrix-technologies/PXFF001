<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_invoice_newmodel extends CI_Model {

public function select_job_details($id)
{
   $dataq="SELECT jm_sitedetails.*,mst_client.name as client_name FROM `jm_sitedetails` inner join mst_client on mst_client.id=jm_sitedetails.clientId where JobID='".$id."';";

   $query = $this->db->query($dataq);
  
$result = $query->result();
return $result;

}

public function select_all_project_site()
{
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

  public function delete_invoicedetailsbyinvoice($Id)
         {
           
            $this->db->where('InvoiceMasterId',$Id);
            $this->db->delete('jm_invoicedetail');
            return 1;
         
            
      
         }
         
          public function delete_invoice($Id)
         {
           
            $this->db->where('InvoiceMasterId',$Id);
            $this->db->delete('jm_invoicemaster');
            return 1;
         
            
      
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
public function addjobmaster($data_array)
   {
   
    
      $this->db->insert('jm_invoicemaster', $data_array);
      $job_master_id=$this->db->insert_id();
      return $job_master_id;
   
      

   }
   public function addjobinvoicedetailsinsert($data_array)
   {
   
    //   var_dump( $data_array);
    //   die();
      $this->db->insert('jm_invoicedetail', $data_array);
      $job_invoice_details_id=$this->db->insert_id();
      return $job_invoice_details_id;
   
      

   }
   //to select invoicedetails
   
   public function selectinvoicedetails($data)
{
  
$dataq="select jm_sitedetails.*,jj.Shipper,jj.Consignee,ji.InvoiceMasterId,ji.Inv,ji.Date,ji.Total,ji.VatTotal,ji.GrandTotal,jj.Number,c.name as client_name,concat(c.address,'<br> ',c.telephone,' ',c.mobile,'\n',c.email) as clientenglish,c.vat_no
,concat(c.name_arabic,' ',c.address_arabic,' ',c.telephone,' ',c.mobile,'\n',c.email) as clientearabic,
concat(bn.bank_name,',<br>',bn.acc_number,',<br>',bn.other_info,',<br>',bn.iban) as bank
from jm_invoicemaster ji
inner join mst_bank bn  on bn.id=ji.Bank

inner join jm_job jj on ji.JobId=jj.JobId
inner join jm_sitedetails on jj.JobId=jm_sitedetails.JobID
inner join mst_client c on c.id=jj.client_id
 where ji.InvoiceMasterId=".$data." limit 1 ;";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
     
 

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

$dataq="select  jm_sitedetails.*,ji.InvoiceMasterId,ji.Inv,ji.Date,ji.Total,ji.VatTotal,ji.GrandTotal,ji.InvoiceType,ji.ReceiptNo,ji.ReceiptDescription,ji.Amount,bn.id,bn.bank_name,bn.id,concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientenglish,c.vat_no,
concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientearabic,
concat(bn.bank_name,',',bn.acc_number,',',bn.other_info,',',bn.iban) as bank
from jm_invoicemaster ji
inner join jm_job jj on ji.JobId=jj.JobId
inner join jm_sitedetails on jj.JobId=jm_sitedetails.JobID
inner join mst_client c on c.id=jj.client_id
inner join mst_bank bn  on bn.id=ji.Bank
 where ji.InvoiceMasterId=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
     
 

}


public function updateJobinvoicemaster($Id,$data_array)
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


public function job_invoice_draft()
{
  $dataq="SELECT jm_invoicemaster.*,jm_sitedetails.site_code,mst_client.id as clientid,mst_client.name FROM jm_invoicemaster 
inner join jm_job on jm_job.JobId=jm_invoicemaster.JobId 
inner join jm_sitedetails on jm_sitedetails.JobID=jm_job.JobId 
inner join mst_client on mst_client.id=jm_job.client_id  
WHERE jm_invoicemaster.Status='Posted';";

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
public function insert_into_accountmaster_vatentry($clientledgerid,$amount,$date,$narration,$type,$chequeid)
{
  
     $query2="insert into accounts_accountmaster values ('','1','".$clientledgerid."','".$amount."','".$date."','".$narration."','".$type."','".$chequeid."')"; 
     $this->db->query($query2);
   
     $ledgerid=   $this->db->insert_id();
     return $ledgerid;
 
   

}
}