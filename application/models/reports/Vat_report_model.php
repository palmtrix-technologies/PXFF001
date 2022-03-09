<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vat_report_model extends CI_Model {
    

      public function get_vat_total_report($fromdate,$todate)
      {
          $data="SELECT 
          MONTH(Date) as month,
        SUM(Total) AS standardrated,
         SUM(VatTotal) AS vattotal
      FROM jm_invoicemaster
      
      where Date BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)
      ";
            $query = $this->db->query($data);
            $result = $query->result();
            return $result;
      
      }

public function get_vat_intotal_report($fromdate,$todate)
{
    
$data="select ji.*,concat(jj.Hawb,'-',jj.Mawb) as awb,jj.Number,jj.ActualWeight,
jj.Etd,jj.Eta,jj.Type,jj.Mbl,jj.Carrier,jj.Pol,jj.Pod,jj.PoNo,bn.id,bn.bank_name,bn.id,concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientenglish,c.vat_no,c.trn_no,c.name,c.address,
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
 where ji.Date BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)";
 $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}

public function get_expensedata_report($fromdate,$todate)
      {
        
      $dataq="select sp.id,sp.supplier_name,ji.ExpenseMasterId,ji.PostId,ji.InvDate,ji.PostingDate,ji.SubTotal,ji.VatTotal,ji.Reference,ji.OurInv,ji.Mode,ji.GrandTotal,concat(jj.Hawb,'-',jj.Mawb) as awb,jj.JobId,jj.Number,jj.ActualWeight,
      jj.Etd,jj.Eta,jj.Type,jj.Mbl,jj.Carrier,jj.Pol,jj.Jobcode,jj.Pod,jj.PoNo,concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientenglish,c.vat_no,c.trn_no,c.name,c.address,
      concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientearabic,
      concat(consignor.name,',',consignor.address,',',consignor.telephone,'-',consignor.mobile,'\n',consignor.email) as consignor,
      concat(consignee.name,',',consignee.address,',',consignee.telephone,'-',consignee.mobile,'\n',consignee.email) as consignee
      from jm_expensemaster ji
      inner join jm_job jj on ji.JobId=jj.JobId
      inner join mst_client c on c.id=jj.client_id
      inner join mst_supplier sp on sp.id=ji.SupplierID
      inner join mst_shipper consignor on consignor.id=jj.consignor_id
      inner join mst_shipper consignee on consignee.id=jj.consignee_id
       where ji.PostingDate BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)";
      
       $query = $this->db->query($dataq);
          $result = $query->result();
              return $result;
      
      }

public function get_expensedata($fromdate,$todate)
{
    $data="SELECT 
    MONTH(PostingDate) as expensemonth,
  SUM(SubTotal) AS standardratedexpense,
   SUM(VatTotal) AS inputvat
FROM jm_expensemaster

where PostingDate BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)
";
      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
//sales report
public function get_vatin_reportdata11($fromdate,$todate,$jobid)
{
      $jobcondition = "";
      if($jobid!=0){
            $jobcondition = "jm_job.Number ='".$jobid."' AND ";
      }
    $data="select jm_invoicemaster.Inv,jm_invoicemaster.Date,jm_job.Number AS JobId,jm_invoicemaster.InvoiceType,jm_invoicemaster.Status,jm_invoicemaster.Total,jm_invoicemaster.VatTotal,jm_invoicemaster.GrandTotal,
    mst_client.name, (SELECT max(VAT_percentage) FROM jm_invoicedetail WHERE jm_invoicedetail.InvoiceMasterId = jm_invoicemaster.InvoiceMasterId) AS per   from jm_invoicemaster inner join jm_job on jm_invoicemaster.JobId=jm_job.JobId 
            inner join mst_client on mst_client.id=jm_job.client_id  where ".$jobcondition." jm_invoicemaster.VatTotal!=0 and  jm_invoicemaster.Date BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)";
    
            $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
public function get_vatin_reportdata($fromdate,$todate,$jobid)
{  
$data="select jm_invoicemaster.Inv,jm_invoicemaster.Date,jm_job.Number AS JobId,jm_invoicemaster.InvoiceType,jm_invoicemaster.Status,jm_invoicemaster.Total,jm_invoicemaster.VatTotal,jm_invoicemaster.GrandTotal,
    mst_client.name, (SELECT max(VAT_percentage) FROM jm_invoicedetail WHERE jm_invoicedetail.InvoiceMasterId = jm_invoicemaster.InvoiceMasterId) AS per   from jm_invoicemaster inner join jm_job on jm_invoicemaster.JobId=jm_job.JobId 
            inner join mst_client on mst_client.id=jm_job.client_id  where  jm_invoicemaster.VatTotal!=0 and  jm_invoicemaster.Date BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)";
    
            $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}
public function get_expense_reportdata($from,$to,$jobid)
{
//     $data="select DISTINCT jm_expensedetail.Description,jm_expensedetail.Amount,jm_expensedetail.Currency,jm_expensemaster.PostId,jm_expensemaster.PostingDate,concat(jm_expensemaster.OurInv,'|',jm_expensemaster.Reference) as inv,jm_expensemaster.JobID,jm_expensemaster.SupplierID,mst_supplier.supplier_name,jm_expensemaster.Mode,jm_expensemaster.Status,jm_expensemaster.GrandTotal,jm_expensemaster.VatTotal,
//     jm_expensedetail.vat_persentage
//     from jm_expensemaster  inner join mst_supplier on mst_supplier.id=jm_expensemaster.SupplierID 
//     inner join jm_expensedetail on jm_expensedetail.ExpenseMasterId=jm_expensemaster.ExpenseMasterId
//   where jm_expensemaster.VatTotal!=0 and jm_expensedetail.vat_persentage !=0 and jm_expensemaster.PostingDate BETWEEN CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";
$jobcondition = "";
if($jobid!=0){
      $jobcondition = "jm_job.Number ='".$jobid."' AND ";
}
   $data="select jm_expensemaster.*,mst_supplier.*,jm_job.Number,(SELECT max(vat_persentage)FROM jm_expensedetail WHERE jm_expensedetail.ExpenseMasterId=jm_expensemaster.ExpenseMasterId) AS percentage
 from jm_expensemaster  inner join mst_supplier on mst_supplier.id=jm_expensemaster.SupplierID 
 INNER JOIN jm_job ON jm_job.JobId = jm_expensemaster.JobID where ".$jobcondition." jm_expensemaster.VatTotal!=0 and  jm_expensemaster.PostingDate BETWEEN CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)";

      $query = $this->db->query($data);
      $result = $query->result();
      return $result;

}

}

