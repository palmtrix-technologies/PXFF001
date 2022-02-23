<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {


//list jobs
public function listjobdata()
{
// $this->db->select('*');
// $this->db->from('jm_job');
// $query = $this->db->get();
// $result = $query->result();
// return $result;
$dataq="select * from  jm_job where Number!=0 order by Number DESC ;";

$query = $this->db->query($dataq);
 $result = $query->result();
     return $result;

}
    
      public function get_job_reportdata_modewise($mode,$from,$to)
{
    $data="select *   from jm_job where jm_job.Type='".$mode."' and jm_job.Date between  CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
       $query = $this->db->query($data);
       $result = $query->result();
       return $result;
}
    //list non billed jobs
public function nonbilledjob()
{
    $data="select jm_job.JobId,jm_job.Number ,jm_job.Date,jm_job.Shipper,jm_job.Consignee , jm_job.client_name,jm_job.shipment_type,jm_job.ShipmentTerms,jm_job.Type from jm_job where jm_job.JobId not in (SELECT JobId FROM `jm_invoicemaster` );";
       $query = $this->db->query($data);
       $result = $query->result();
       return $result;
}
//sales report
public function get_sales_reportdata($fromdate,$todate)
{
    $data="select jm_invoicemaster.Inv,jm_invoicemaster.Date, jm_job.Number as  JobId,jm_invoicemaster.InvoiceType,jm_invoicemaster.Status,jm_invoicemaster.Total,jm_invoicemaster.VatTotal,jm_invoicemaster.GrandTotal,
    mst_client.name  from jm_invoicemaster inner join jm_job on jm_invoicemaster.JobId=jm_job.JobId 
            inner join mst_client on mst_client.id=jm_job.client_id  where  jm_invoicemaster.Date BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
public function get_sales_reportdata_withid($id,$fromdate,$todate)
{
    $data="select jm_invoicemaster.Inv,jm_invoicemaster.Date,jm_job.Number as  JobId,jm_invoicemaster.InvoiceType,jm_invoicemaster.Status,jm_invoicemaster.Total,jm_invoicemaster.VatTotal,jm_invoicemaster.GrandTotal,
    mst_client.name  from jm_invoicemaster inner join jm_job on jm_invoicemaster.JobId=jm_job.JobId 
            inner join mst_client on mst_client.id=jm_job.client_id  where   jm_job.client_id=".$id." and jm_invoicemaster.Date BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
//list invoice reports


public function get_invoice_reportdata($fromdate,$todate)
{
    $data="select jm_invoicemaster.Inv,jm_invoicemaster.Date,jjm_job.Number as  JobId,jm_invoicemaster.InvoiceType,jm_invoicemaster.Status,jm_invoicemaster.Total,jm_invoicemaster.VatTotal,jm_invoicemaster.GrandTotal,
    mst_client.name  from jm_invoicemaster inner join jm_job on jm_invoicemaster.JobId=jm_job.JobId 
            inner join mst_client on mst_client.id=jm_job.client_id  where jm_invoicemaster.Status='Paid' and jm_invoicemaster.Date BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
public function get_invoice_reportdata_withid($id,$fromdate,$todate)
{
    $data="select jm_invoicemaster.Inv,jm_invoicemaster.Date,jm_job.Number as  JobId,jm_invoicemaster.InvoiceType,jm_invoicemaster.Status,jm_invoicemaster.Total,jm_invoicemaster.VatTotal,jm_invoicemaster.GrandTotal,
    mst_client.name  from jm_invoicemaster inner join jm_job on jm_invoicemaster.JobId=jm_job.JobId 
            inner join mst_client on mst_client.id=jm_job.client_id  where jm_invoicemaster.Status='Paid' and  jm_job.client_id=".$id." and jm_invoicemaster.Date BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
public function pending_invoice_data($from,$to)
{
    $data="select jm_invoicemaster.Inv,jm_invoicemaster.Date,jm_job.Number as  JobId,jm_invoicemaster.InvoiceType,jm_invoicemaster.Status,jm_invoicemaster.Total,jm_invoicemaster.VatTotal,jm_invoicemaster.GrandTotal,
    mst_client.name  from jm_invoicemaster inner join jm_job on jm_invoicemaster.JobId=jm_job.JobId 
            inner join mst_client on mst_client.id=jm_job.client_id  where jm_invoicemaster.Status!='Paid' and jm_invoicemaster.Date BETWEEN CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
public function pending_invoice_data_withid($id,$from,$to)
{
    $data="select jm_invoicemaster.Inv,jm_invoicemaster.Date,jm_job.Number as  JobId,jm_invoicemaster.InvoiceType,jm_invoicemaster.Status,jm_invoicemaster.Total,jm_invoicemaster.VatTotal,jm_invoicemaster.GrandTotal,
    mst_client.name  from jm_invoicemaster inner join jm_job on jm_invoicemaster.JobId=jm_job.JobId 
            inner join mst_client on mst_client.id=jm_job.client_id  where jm_invoicemaster.Status!='Paid' and jm_job.client_id=".$id." and jm_invoicemaster.Date BETWEEN CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
public function select_suppliers()
{
    $this->db->select('*');
$this->db->from('mst_supplier');
$query = $this->db->get();
$result = $query->result();
return $result;
}
public function select_clients()
{
    $this->db->select('*');
$this->db->from('mst_client');
$query = $this->db->get();
$result = $query->result();
return $result;
}

public function get_billed_reportdata($from,$to)
{
    $data="select DISTINCT jm_expensedetail.Description,jm_expensedetail.Amount,jm_expensedetail.Currency,jm_expensemaster.PostId,jm_expensemaster.PostingDate,concat(jm_expensemaster.OurInv,'|',jm_expensemaster.Reference) as inv,jm_job.Number as  JobID,jm_expensemaster.SupplierID,mst_supplier.supplier_name,jm_expensemaster.Mode,jm_expensemaster.Status,jm_expensemaster.GrandTotal,jm_expensedetail.Vat,jm_expensedetail.Total
    from jm_expensemaster  inner join mst_supplier on mst_supplier.id=jm_expensemaster.SupplierID 
    inner join jm_expensedetail on jm_expensedetail.ExpenseMasterId=jm_expensemaster.ExpenseMasterId
      inner join jm_job on jm_job.JobId=jm_expensemaster.JobID
   where jm_expensemaster.PostingDate BETWEEN CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}

public function get_billed_reportdata_withid($id,$from,$to)
{
    $data="select DISTINCT jm_expensedetail.Description,jm_expensedetail.Amount,jm_expensedetail.Currency, jm_expensemaster.PostId,jm_expensemaster.PostingDate,concat(jm_expensemaster.OurInv,'|',jm_expensemaster.Reference) as inv,jm_job.Number as  JobID,jm_expensemaster.SupplierID,mst_supplier.supplier_name,jm_expensemaster.Mode,jm_expensemaster.Status,jm_expensemaster.GrandTotal,jm_expensedetail.Vat,jm_expensedetail.Total
    from jm_expensemaster
        inner join mst_supplier on mst_supplier.id=jm_expensemaster.SupplierID 
          inner join jm_expensedetail on jm_expensedetail.ExpenseMasterId=jm_expensemaster.ExpenseMasterId
          inner join jm_job on jm_job.JobId=jm_expensemaster.JobID
                where jm_expensemaster.SupplierID=".$id." and  jm_expensemaster.PostingDate BETWEEN CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
public function get_pendiding_bille_reportdata($from,$to)
{
    $data="select jm_expensemaster.PostId,jm_expensemaster.PostingDate,jm_expensemaster.Reference,concat(jm_expensemaster.Reference,'|',jm_expensemaster.OurInv) as INV,jm_job.Number as  JobID,
    jm_expensemaster.SupplierID,mst_supplier.supplier_name,jm_expensemaster.Mode,jm_expensemaster.Status,jm_expensemaster.GrandTotal,jm_expensemaster.VatTotal as Vat,jm_expensemaster.SubTotal as Total
    from jm_expensemaster  inner join mst_supplier on mst_supplier.id=jm_expensemaster.SupplierID 
      inner join jm_job on jm_job.JobId=jm_expensemaster.JobID
   where jm_expensemaster.Status!='Paid' and jm_expensemaster.PostingDate BETWEEN  CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";

      $query = $this->db->query($data);
      $result = $query->result();
      return $result;
}
public function get_pending_bille_reportdata_withid($id,$from,$to)
{
    $data="select jm_expensemaster.PostId,jm_expensemaster.PostingDate,jm_expensemaster.Reference,concat(jm_expensemaster.Reference,'|',jm_expensemaster.OurInv) as INV,jm_job.Number as  JobID,jm_expensemaster.SupplierID,mst_supplier.supplier_name,
    jm_expensemaster.Mode,jm_expensemaster.Status,jm_expensemaster.GrandTotal,jm_expensemaster.VatTotal as Vat,jm_expensemaster.SubTotal as Total
    from jm_expensemaster  inner join mst_supplier on mst_supplier.id=jm_expensemaster.SupplierID 
      inner join jm_job on jm_job.JobId=jm_expensemaster.JobID
   where jm_expensemaster.Status!='Paid'and  jm_expensemaster.SupplierID=".$id." and  jm_expensemaster.PostingDate BETWEEN CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
public function get_receiptreport($from,$to)
{
    $data="select jm_receiptmaster.ID,jm_receiptmaster.Date,jm_receiptmaster.Status,jm_receiptmaster.SubTotal,jm_receiptmaster.Mode,mst_client.name  from jm_receiptmaster inner join mst_client on jm_receiptmaster.ClientID=mst_client.id 
    where jm_receiptmaster.Date BETWEEN  CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
public function get_receiptreport_paymodewise($paymode,$from,$to)
{
    $data="select jm_receiptmaster.ID,jm_receiptmaster.Date,jm_receiptmaster.Status,jm_receiptmaster.SubTotal,jm_receiptmaster.Mode,mst_client.name 
     from jm_receiptmaster inner join mst_client on jm_receiptmaster.ClientID=mst_client.id 
    where   jm_receiptmaster.Mode='".$paymode."' and jm_receiptmaster.Date BETWEEN  CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
// get_paymentreport
public function get_paymentreport($from,$to)
{
    $data="select    jm_supplierpaymentmaster.ID,jm_supplierpaymentmaster.Date,jm_supplierpaymentmaster.Status,jm_supplierpaymentmaster.SubTotal,jm_supplierpaymentmaster.Mode,mst_supplier.supplier_name
    from jm_supplierpaymentmaster
    inner join mst_supplier
    on jm_supplierpaymentmaster.SuplierID=mst_supplier.id
    where jm_supplierpaymentmaster.Date between CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
     $query = $this->db->query($data);
     $result = $query->result();
     return $result;
}
public function get_paymentreport_cashwise($from,$to)
{
    $data="select    jm_supplierpaymentmaster.ID,jm_supplierpaymentmaster.Date,jm_supplierpaymentmaster.Status,jm_supplierpaymentmaster.SubTotal,jm_supplierpaymentmaster.Mode,mst_supplier.supplier_name
    from jm_supplierpaymentmaster
    inner join mst_supplier
    on jm_supplierpaymentmaster.SuplierID=mst_supplier.id
    where jm_supplierpaymentmaster.Mode='cash' and jm_supplierpaymentmaster.Date between CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
     $query = $this->db->query($data);
     $result = $query->result();
     return $result;
}
public function get_paymentreport_bankwise($from,$to)
{
    $data="select    jm_supplierpaymentmaster.ID,jm_supplierpaymentmaster.Date,jm_supplierpaymentmaster.Status,jm_supplierpaymentmaster.SubTotal,jm_supplierpaymentmaster.Mode,mst_supplier.supplier_name
    from jm_supplierpaymentmaster
    inner join mst_supplier
    on jm_supplierpaymentmaster.SuplierID=mst_supplier.id
    where jm_supplierpaymentmaster.Mode='cheque' or jm_supplierpaymentmaster.Mode='electronic' and jm_supplierpaymentmaster.Date between CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
     $query = $this->db->query($data);
     $result = $query->result();
     return $result;
}

public function soa_report_data_clientwise($id)
{
    $data="select jm_invoicemaster.Inv,jm_invoicemaster.Date,jm_invoicemaster.JobId,jm_invoicemaster.InvoiceType,jm_invoicemaster.Status,jm_invoicemaster.Total,jm_invoicemaster.VatTotal,jm_invoicemaster.GrandTotal,
    mst_client.name  from jm_invoicemaster inner join jm_job on jm_invoicemaster.JobId=jm_job.JobId 
            inner join mst_client on mst_client.id=jm_job.client_id  where   jm_job.client_id=".$id." and jm_invoicemaster.Status!='Paid' ";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}

public function soa_reports($clientid)
{
      
      
      $datas="select LedgerID from accounts_client_ledger
        where ClientID=".$clientid.";";
         $querys = $this->db->query($datas);
            $results = $querys->result();

 $dataq="select * from(
           select 'Invoice' as types, DATE_FORMAT(jm_invoicemaster.Date, '%Y-%m-%d')as Dates,
Concat('Invoice-',jm_invoicemaster.Inv , ' | job No -', jm_job.Number) as Descriptions,
jm_invoicemaster.GrandTotal as Debit,0 as Credit,  DATEDIFF( now() , jm_invoicemaster.Date) as age
from jm_invoicemaster
inner join jm_job on jm_job.JobId=jm_invoicemaster.JobId
inner join mst_client on mst_client.id=jm_job.client_id
where jm_job.client_id=".$clientid." and jm_invoicemaster.Status !='paid'

union all        
SELECT 'Credit Note'as types,DATE_FORMAT(jm_creditnote_master.Date, '%Y-%m-%d') as Dates ,
Concat(' CN-',jm_creditnote_master.Code_Id, '| Job No-',jm_job.Number)  as Descriptions,0 as Debit, jm_creditnote_master.GrandTotal as Credit ,'' as age
FROM jm_creditnote_master
inner join jm_job on jm_job.JobId=jm_creditnote_master.JobId
where jm_job.client_id=".$clientid." 
    
    

           
           union ALL
    
                SELECT `VoucherType` as types,DATE_FORMAT(`TransferDate`, '%Y-%m-%d') as Dates, `Narration` as Descriptions,
            case when  `DebitAccount`=".$results[0]->LedgerID." then Amount else 0 end as Debit,
            case when  CreditAccount=".$results[0]->LedgerID." then Amount else 0 end as Credit ,'' as age
            FROM `accounts_accountmaster`
            where (`CreditAccount`=".$results[0]->LedgerID." or `DebitAccount`=".$results[0]->LedgerID.") and (BINARY `VoucherType`) in ('payment','receipt','contra','transfer')) as abc 
 ORDER BY `abc`.`age`  ASC;";
           
           
         $datac="select jm_invoicemaster.Inv as ReferenceNo,concat(REPLACE(REPLACE(jm_job.Type,'import',' import'),'export',' export'), ' | ',ifnull(jm_job.PoNo,''),' - ',ifnull(jm_job.Mbl,'')) as ClientReference,jm_job.Number as Jobno, DATE_FORMAT(jm_invoicemaster.Date, '%Y-%m-%d')as Dates,

jm_invoicemaster.GrandTotal as Amount,  DATEDIFF( now() , jm_invoicemaster.Date) as age
from jm_invoicemaster
inner join jm_job on jm_job.JobId=jm_invoicemaster.JobId
inner join mst_client on mst_client.id=jm_job.client_id
where jm_job.client_id=".$clientid."  and jm_invoicemaster.Status !='Paid' ORDER BY DATEDIFF( now() , jm_invoicemaster.Date) ASC";
    
     $query = $this->db->query($datac);
        $result = $query->result();
        
            return $result;
      
            
}

public function clientdetails($id)
{
    $data="select id,concat('<p>',`name`,' | ',`name_arabic`,'</p>','<p>',`address`,'</p>') as client from mst_client where mst_client.id=".$id;
    $query = $this->db->query($data);
        $result = $query->row();
        
            return $result;
}

}


