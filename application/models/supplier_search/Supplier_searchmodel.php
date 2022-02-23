<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_searchmodel extends CI_Model {
//autocomplete
public function getsupplierdata()
    {
          
    $this->db->select('id as value, supplier_name as label');
    $this->db->from('mst_supplier');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }
    //view all supplierdata
    public function list_supplier_data($data)
    {
      
    $this->db->where('id', $data);
    $this->db->select('*');
    $this->db->from('mst_supplier');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }
    //fetch supplier expense report
    public function supplier_payment_report($data)
    {
        $dataq="select 'DE'+jm_supplierpaymentmaster.ID as doc, convert(jm_supplierpaymentmaster.Date,date)as Dates,jm_supplierpaymentmaster.SubTotal as amount,mst_supplier.supplier_name as suppliername from jm_supplierpaymentmaster
        inner join mst_supplier on mst_supplier.id=jm_supplierpaymentmaster.SuplierID
     
        where jm_supplierpaymentmaster.SuplierID=".$data.";";
        
         $query = $this->db->query($dataq);
            $result = $query->result();
                return $result;
    }
       //fetch supplier ledger report
    public function ledger_report($data)
    {
      $ledgerdata=" select * from(
            select 'Expense Voucher'as types,convert(jm_expensemaster.PostingDate,date)as Dates,'Expense for the job No'+' :'+jm_job.Number +', client: '+ mst_client.name as Descriptions,0 as Debit,jm_expensemaster.GrandTotal as Credit from jm_expensemaster
              inner join jm_job on jm_job.JobId=jm_expensemaster.JobID
              inner join mst_client on mst_client.id=jm_job.client_id
              where jm_expensemaster.SupplierID=".$data."
            
             union all
            SELECT 'Debit Note'as types,convert(jm_debitnote_master.InvDate,date)as Dates ,'Debit Note'+'-'+jm_debitnote_master.Code_Id+'-'+mst_supplier.supplier_name  as Descriptions,jm_debitnote_master.GrandTotal as Debit, 0 as Credit FROM 
             jm_debitnote_master
            
              INNER JOIN mst_supplier ON jm_debitnote_master.SupplierID = mst_supplier.id
            
              inner join jm_job on jm_job.JobId=jm_debitnote_master.JobId
            
               where mst_supplier.id=".$data."
             union all
            select 'Payments'as types,convert(Date,date)as Dates ,0 as Descriptions ,SubTotal as Debit, 0 as Credit  from jm_supplierpaymentmaster where SuplierID=".$data."
             )
            
               as abc order by Dates asc ;";
               $query = $this->db->query($ledgerdata);
               $result = $query->result();
                   return $result;

    }
    //post expense details
    public function posted_expense($data)
    {
        $postdata="select jm_expensemaster.ExpenseMasterId as id,jm_expensedetail.Description as particulars,'DE'+jm_expensemaster.PostId as doc,jm_expensemaster.Reference+'|'+jm_expensemaster.OurInv as refinv, convert(jm_expensemaster.PostingDate,date)as Dates,jm_expensedetail.Total as amount,mst_supplier.supplier_name as suppliername from jm_expensemaster
        inner join mst_supplier on mst_supplier.id=jm_expensemaster.SupplierID
         inner join jm_expensedetail on jm_expensedetail.ExpenseMasterId=jm_expensemaster.ExpenseMasterId
        where jm_expensemaster.SupplierID=".$data.";";
        $query = $this->db->query($postdata);
        $result = $query->result();
            return $result;

    }

//debit note details
public function debitnote_data($data)
{
    $postdata="select jm_debitnote_details.Description as particulars,'DE'+jm_debitnote_master.Code_Id as doc,jm_debitnote_master.Reference+'|'+jm_debitnote_master.OurInv as refinv, 
    convert(jm_debitnote_master.InvDate,date)as Dates,jm_debitnote_master.GrandTotal as amount,mst_supplier.supplier_name as suppliername from jm_debitnote_master
       inner join mst_supplier on mst_supplier.id=jm_debitnote_master.SupplierID
       inner join jm_debitnote_details on jm_debitnote_details.Debitnote_Master_id=jm_debitnote_master.Debitnote_Master_id
        where jm_debitnote_master.SupplierID=".$data.";";
    $query = $this->db->query($postdata);
    $result = $query->result();
        return $result;

}
//supplier invoice total
public function supplier_invoice($data)
{
$edata="select sum(GrandTotal) as sum from jm_expensemaster where jm_expensemaster.Status!='Paid' and jm_expensemaster.SupplierID=".$data.";";
$query = $this->db->query($edata);
$result = $query->result();
    return $result;
}
//supplier paid invoice
public function supplier_paid($data)
{
    $pdata="select sum(SubTotal) as sum from jm_supplierpaymentmaster where jm_supplierpaymentmaster.Status='Paid' and jm_supplierpaymentmaster.SuplierID=".$data.";";
     $query = $this->db->query($pdata);
$result = $query->result();
    return $result;
}
}