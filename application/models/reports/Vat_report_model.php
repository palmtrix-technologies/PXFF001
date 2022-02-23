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
public function get_vatin_reportdata($fromdate,$todate,$jobid)
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

