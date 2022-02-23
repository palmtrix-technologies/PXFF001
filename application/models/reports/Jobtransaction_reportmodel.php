<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobtransaction_reportmodel extends CI_Model {
    
    public function get_job_invoicedata($jobno)
{
    $invdata="SELECT convert(jm_invoicemaster.Date,date ) as Dates ,concat('Invoice -',Inv) As Patriculars,jm_invoicemaster.GrandTotal as Debit,0 as Credit,jm_invoicemaster.InvoiceType,mst_client.name,jm_invoicemaster.Inv
    FROM jm_invoicemaster
    INNER JOIN jm_job ON jm_invoicemaster.JobId = jm_job.JobId 
    inner join mst_client on mst_client.id=jm_job.client_id
    where jm_job.JobId=".$jobno."  ; ";
    
$query = $this->db->query($invdata);
$result = $query->result();
    return $result;
 
}
public function select_job_id($id)
{
$this->db->where('Number',$id);
$this->db->select('*');
$this->db->from('jm_job');
$query = $this->db->get();
$result = $query->result();
foreach($result as $row)
{
  $masterid=$row->JobId;
}
    return $masterid;
 

}
public function get_job_invoicedatawith_mawb($awb)
{
    $invdata="SELECT convert(jm_invoicemaster.Date,date ) as Dates ,concat('Invoice -',Inv) As Patriculars,jm_invoicemaster.GrandTotal as Debit,0 as Credit,jm_invoicemaster.InvoiceType,mst_client.name,jm_invoicemaster.Inv
    FROM jm_invoicemaster
    INNER JOIN jm_job ON jm_invoicemaster.JobId = jm_job.JobId 
    inner join mst_client on mst_client.id=jm_job.client_id
    where   jm_job.Mawb='".$awb."' ; ";
    
$query = $this->db->query($invdata);
$result = $query->result();
    return $result;
 
}
    
public function get_job_creditnotedata($jobno)
{
    $invdata="SELECT convert(jm_creditnote_master.Date,date)as Dates ,'Credit Note'+'-'+jm_creditnote_master.Code_Id+'-'+mst_client.name AS Descriptions,0 as Debit,jm_creditnote_master.GrandTotal as Credit,jm_creditnote_master.Code_Id,mst_client.name
    FROM jm_creditnote_master
    INNER JOIN jm_job ON jm_creditnote_master.JobId =jm_job.JobId
       INNER JOIN mst_client ON mst_client.id =jm_job.JobId
    where jm_job.JobId=".$jobno." ; ";
    
$query = $this->db->query($invdata);
$result = $query->result();
    return $result;
 
}
    
public function get_job_creditnotedata_withmawb($awb)
{
    $invdata="SELECT convert(jm_creditnote_master.Date,date)as Dates ,'Credit Note'+'-'+jm_creditnote_master.Code_Id+'-'+mst_client.name AS Descriptions,0 as Debit,jm_creditnote_master.GrandTotal as Credit,jm_creditnote_master.Code_Id,mst_client.name
    FROM jm_creditnote_master
    INNER JOIN jm_job ON jm_creditnote_master.JobId =jm_job.JobId
       INNER JOIN mst_client ON mst_client.id =jm_job.JobId
    where   jm_job.Mawb='".$awb."' ; ";
    
$query = $this->db->query($invdata);
$result = $query->result();
    return $result;
 
}
public function get_job_receiptdata($jobno)
{
    $invdata="SELECT DISTINCT convert(jm_receiptmaster.Date,date)as Dates ,jm_receiptmaster.ID,
    concat('Total of all invoices:',jm_invoicemaster.Inv) as Descriptions,0 as Debit,jm_receiptmaster.SubTotal as Credit,jm_invoicemaster.Inv,mst_client.name,jm_receiptmaster.Mode
    from jm_receiptmaster 
    inner join jm_receiptdetail on jm_receiptdetail.ReceiptMasterId=jm_receiptmaster.ReceiptMasterId
   inner join jm_invoicemaster on jm_invoicemaster.InvoiceMasterId=jm_receiptdetail.InvoiceMasterID
   inner join jm_job on jm_job.JobId=jm_receiptdetail.JobNo
   inner join mst_client on mst_client.id=jm_job.client_id
   
    where jm_job.JobId=".$jobno."  ; ";
    
$query = $this->db->query($invdata);
$result = $query->result();
    return $result;
 
}
public function get_job_receiptdata_withmawb($awb)
{
    $invdata="SELECT DISTINCT convert(jm_receiptmaster.Date,date)as Dates ,jm_receiptmaster.ID,
    concat('Total of all invoices:',jm_invoicemaster.Inv) as Descriptions,0 as Debit,jm_receiptmaster.SubTotal as Credit,jm_invoicemaster.Inv,mst_client.name,jm_receiptmaster.Mode
    from jm_receiptmaster 
    inner join jm_receiptdetail on jm_receiptdetail.ReceiptMasterId=jm_receiptmaster.ReceiptMasterId
   inner join jm_invoicemaster on jm_invoicemaster.InvoiceMasterId=jm_receiptdetail.InvoiceMasterID
   inner join jm_job on jm_job.JobId=jm_receiptdetail.JobNo
   inner join mst_client on mst_client.id=jm_job.client_id
   
    where  jm_job.Mawb='".$awb."' ; ";
    
$query = $this->db->query($invdata);
$result = $query->result();
    return $result;
 
}
public function get_job_expensedata($jobno)
{
    $expensedata="SELECT convert(jm_expensemaster.InvDate,date)as Dates ,'Expense' as Descriptions,0 as Debit,jm_expensemaster.GrandTotal as Credit,jm_expensemaster.PostId,jm_expensemaster.PostingDate,jm_expensemaster.InvDate,jm_expensemaster.OurInv,jm_expensemaster.Status,jm_expensemaster.Mode,mst_supplier.supplier_name,jm_expensemaster.Reference
    FROM jm_expensemaster
        INNER JOIN mst_supplier ON jm_expensemaster.SupplierID = mst_supplier.id
        inner join jm_job on jm_job.JobId=jm_expensemaster.JobID
   where jm_job.JobId=".$jobno."  ; ";
    
$query = $this->db->query($expensedata);
$result = $query->result();
    return $result;
 
}
public function get_job_expensedata_withmawb($awb)
{
    $expensedata="SELECT convert(jm_expensemaster.InvDate,date)as Dates ,'Expense' as Descriptions,0 as Debit,jm_expensemaster.GrandTotal as Credit,jm_expensemaster.PostId,jm_expensemaster.PostingDate,jm_expensemaster.InvDate,jm_expensemaster.OurInv,jm_expensemaster.Status,jm_expensemaster.Mode,mst_supplier.supplier_name,jm_expensemaster.Reference
    FROM jm_expensemaster
        INNER JOIN mst_supplier ON jm_expensemaster.SupplierID = mst_supplier.id
        inner join jm_job on jm_job.JobId=jm_expensemaster.JobID
    where  jm_job.Mawb='".$awb."' ; ";
    
$query = $this->db->query($expensedata);
$result = $query->result();
    return $result;
 
}
public function get_job_debitdata($jobno)
{
    $expensedata="SELECT DISTINCT convert(jm_debitnote_master.InvDate,date)as Dates ,concat('Debit Note','-',jm_debitnote_master.Code_Id,'-',mst_supplier.supplier_name)  as Descriptions,jm_debitnote_master.Mode,jm_debitnote_master.Reference,jm_debitnote_master.Status,
    jm_debitnote_master.PostingDate,jm_debitnote_master.Code_Id,jm_debitnote_master.InvDate,jm_debitnote_master.OurInv,jm_debitnote_master.GrandTotal as Debit, 0 as Credit,mst_supplier.supplier_name
    FROM jm_debitnote_master
    
        INNER JOIN mst_supplier ON jm_debitnote_master.SupplierID = mst_supplier.id
          inner join jm_job on jm_job.JobId=jm_debitnote_master.JobId
   where jm_job.JobId=".$jobno."  ; ";
    
$query = $this->db->query($expensedata);
$result = $query->result();
    return $result;
 
}
public function get_job_debitdata_withmawb($awb)
{
    $expensedata="SELECT DISTINCT convert(jm_debitnote_master.InvDate,date)as Dates ,concat('Debit Note','-',jm_debitnote_master.Code_Id,'-',mst_supplier.supplier_name)  as Descriptions,jm_debitnote_master.Mode,jm_debitnote_master.Reference,jm_debitnote_master.Status,
    jm_debitnote_master.PostingDate,jm_debitnote_master.Code_Id,jm_debitnote_master.InvDate,jm_debitnote_master.OurInv,jm_debitnote_master.GrandTotal as Debit, 0 as Credit,mst_supplier.supplier_name
    FROM jm_debitnote_master
    
        INNER JOIN mst_supplier ON jm_debitnote_master.SupplierID = mst_supplier.id
          inner join jm_job on jm_job.JobId=jm_debitnote_master.JobId
    where  jm_job.Mawb='".$awb."' ; ";
    
$query = $this->db->query($expensedata);
$result = $query->result();
    return $result;
 
}
//payment
public function get_job_payment($jobno)
{
    $expensedata="select distinct 'Payments'as types,convert(jm_supplierpaymentmaster.Date,date)as Dates ,'nodescription' as Descriptions, jm_supplierpaymentmaster.SubTotal as Debit, 0 as Credit,mst_supplier.supplier_name,jm_supplierpaymentmaster.Mode,jm_supplierpaymentmaster.ID,jm_supplierpaymentmaster.Date,jm_supplierpaymentmaster.Status,mst_client.name,jm_expensemaster.Reference,jm_expensemaster.OurInv
    from jm_supplierpaymentmaster
              inner join jm_supplierpaymentdetail on jm_supplierpaymentdetail.SupplierPaymentMasterId=jm_supplierpaymentmaster.SupplierPaymentMasterId
     inner join jm_job on jm_job.JobId=jm_supplierpaymentdetail.JobNo 
     inner join mst_supplier on mst_supplier.id=jm_supplierpaymentmaster.SuplierID
     inner join jm_expensemaster on jm_expensemaster.ExpenseMasterId=jm_supplierpaymentdetail.SupplierExpenseMasterID
     inner join mst_client on mst_client.id=jm_job.client_id
   where jm_job.JobId=".$jobno."  ; ";
    
$query = $this->db->query($expensedata);
$result = $query->result();
    return $result;
 
}
public function get_job_payment_withmawb($awb)
{
    $expensedata="select distinct 'Payments'as types,convert(jm_supplierpaymentmaster.Date,date)as Dates ,'nodescription' as Descriptions, jm_supplierpaymentmaster.SubTotal as Debit, 0 as Credit,mst_supplier.supplier_name,jm_supplierpaymentmaster.Mode,jm_supplierpaymentmaster.ID,jm_supplierpaymentmaster.Date,jm_supplierpaymentmaster.Status,mst_client.name,jm_expensemaster.Reference,jm_expensemaster.OurInv
    from jm_supplierpaymentmaster
              inner join jm_supplierpaymentdetail on jm_supplierpaymentdetail.SupplierPaymentMasterId=jm_supplierpaymentmaster.SupplierPaymentMasterId
     inner join jm_job on jm_job.JobId=jm_supplierpaymentdetail.JobNo 
     inner join mst_supplier on mst_supplier.id=jm_supplierpaymentmaster.SuplierID
     inner join jm_expensemaster on jm_expensemaster.ExpenseMasterId=jm_supplierpaymentdetail.SupplierExpenseMasterID
     inner join mst_client on mst_client.id=jm_job.client_id
    where  jm_job.Mawb='".$awb."' ; ";
    
$query = $this->db->query($expensedata);
$result = $query->result();
    return $result;
 
}
}

