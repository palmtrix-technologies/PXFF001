<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_searchmodel extends CI_Model {

    
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
    public function listjobdata()
    {
    // $this->db->where('JobId',$id);
    $this->db->select('*');
    $this->db->from('jm_job');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }
    public function select_job_decription($jobid)
    {
       
       
        
$dataq="select jj.client_id,jj.Jobcode,jj.ShipmentTerms,jj.JobId,jj.CargoDescription,jj.Description,concat(c.name,'|',c.telephone,'-',c.mobile,'|',c.email) as clientenglish,c.vat_no,jj.Number,
concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'|',c.email) as clientearabic,
concat(consignor.name,',',consignor.telephone,'-',consignor.mobile,',',consignor.email) as consignor,
concat(consignee.name,',',consignee.telephone,'-',consignee.mobile,',',consignee.email) as consignee
from jm_job jj

inner join mst_client c on c.id=jj.client_id
left join mst_shipper consignor on consignor.id=jj.consignor_id
left join mst_shipper consignee on consignee.id=jj.consignee_id

 where jj.Number=".$jobid.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
        
    }
    public function select_invoice_total($jobid)
    {
               
$data="SELECT sum(GrandTotal)as sumvalue  FROM `jm_invoicemaster` WHERE jm_invoicemaster.Status!='paid' and JobId=".$jobid.";";

 $query = $this->db->query($data);
    $result = $query->result();
        return $result;
        
    }
      public function select_expense_total($jobid)
    {
               
$data="SELECT sum(GrandTotal)as sumvalue  FROM `jm_expensemaster` WHERE  JobId=".$jobid.";";

 $query = $this->db->query($data);
    $result = $query->result();
        return $result;
        
    }
    
    public function select_inv_paid_total($jobid)
    {
               
$data="SELECT sum(jm_receiptdetail.`Amount`)as sumvalue FROM `jm_receiptdetail` inner join jm_receiptmaster on jm_receiptmaster.ReceiptMasterId=jm_receiptdetail.ReceiptMasterId 
join jm_invoicemaster on jm_invoicemaster.InvoiceMasterId=jm_receiptdetail.InvoiceMasterID where JobNo=(select jm_job.Number from jm_job where jm_job.JobId=".$jobid.");";

 $query = $this->db->query($data);
    $result = $query->result();
        return $result;
        
    }

  
    public function select_invoice_details($jobid)
    {
               
$dataq="select jm_invoicemaster.InvoiceMasterId,jm_invoicemaster.Status,jm_invoicemaster.Inv,jm_invoicemaster.Date,jm_invoicemaster.JobId,jm_invoicemaster.InvoiceType,jm_invoicemaster.VatTotal,jm_invoicemaster.GrandTotal,jm_invoicedetail.Total,jm_invoicedetail.Vat
from jm_invoicemaster 
inner join jm_invoicedetail on jm_invoicemaster.InvoiceMasterId=jm_invoicedetail.InvoiceMasterId
where jm_invoicemaster.JobId=".$jobid.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
        
    }
    public function select_creditnote_details($jobid)
    {
               
$dataq="select cm.Code_Id,cm.Date,jj.client_name,jj.client_id,jj.Type,c.name,cm.GrandTotal,cm.Creditnote_master_id,jm_creditnote_details.Total
from jm_creditnote_master cm
inner join jm_job jj on jj.JobId=cm.JobId
inner join jm_creditnote_details on jm_creditnote_details.Creditnote_master_id=cm.Creditnote_master_id 
inner join mst_client c on c.id=jj.client_id
 where cm.JobId=".$jobid.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
        
    }
    public function select_customer_payment_receipt_details($jobid)
    {
            
              $datareceipt="SELECT jm_receiptmaster.Date,jm_receiptdetail.`Amount` as SubTotal,jm_receiptdetail.ReceiptMasterId as ID,concat('Total of all invoices',':',jm_invoicemaster.Inv) as particulars,jm_invoicemaster.Inv FROM `jm_receiptdetail` inner join jm_receiptmaster on jm_receiptmaster.ReceiptMasterId=jm_receiptdetail.ReceiptMasterId inner join jm_invoicemaster on jm_invoicemaster.InvoiceMasterId=jm_receiptdetail.InvoiceMasterID where JobNo=(select jm_job.Number from jm_job where jm_job.JobId=".$jobid.");";


 $query = $this->db->query($datareceipt);
    $result = $query->result();
        return $result;
     
   
      
    }
    public function select_expense_details($jobid)
    {
        $dataexpense="select im.InvDate,ss.supplier_name,im.SupplierID,im.GrandTotal,im.ExpenseMasterId,im.PostId,im.Status,jm_expensedetail.Description,im.Reference as invoice,jm_expensedetail.Total
        from jm_expensemaster im
        
         INNER JOIN jm_expensedetail  on jm_expensedetail.ExpenseMasterId=im.ExpenseMasterId
                INNER JOIN mst_supplier ss on ss.id=im.SupplierID
                where im.JobID=".$jobid.";";

 $query = $this->db->query($dataexpense);
    $result = $query->result();
        return $result;
     
   
      
    }
    public function select_debit_note_details($jobid)
    {
        $dataexpense="select  im.InvDate,im.SupplierID,im.OurInv,ss.supplier_name,im.GrandTotal,im.Code_Id,jm_debitnote_details.Description,concat(im.OurInv,'|',im.Reference) as Inv,im.Debitnote_Master_id,jm_debitnote_details.Amount
        from jm_debitnote_master im
         inner join jm_debitnote_details on im.Debitnote_Master_id=jm_debitnote_details.Debitnote_Master_id
        INNER JOIN mst_supplier ss on ss.id=im.SupplierID
       
        where im.JobId=".$jobid.";";

 $query = $this->db->query($dataexpense);
    $result = $query->result();
        return $result;
     
   
      
    }
    public function select_payment_details($jobid)
    {
        $datapayment=" SELECT  jm_supplierpaymentmaster.SupplierPaymentMasterId,jm_supplierpaymentmaster.Date,jm_supplierpaymentmaster.SubTotal,mst_supplier.supplier_name,jm_supplierpaymentmaster.ID, jm_supplierpaymentdetail.Total
        FROM `jm_supplierpaymentdetail`
                INNER join jm_supplierpaymentmaster on jm_supplierpaymentmaster.SupplierPaymentMasterId=jm_supplierpaymentdetail.SupplierPaymentMasterId
                INNER join mst_supplier on jm_supplierpaymentmaster.SuplierID=mst_supplier.id
                WHERE jm_supplierpaymentdetail.JobNo=".$jobid.";";

 $query = $this->db->query($datapayment);
    $result = $query->result();
        return $result;
     
   
      
}
public function select_job_ledger_details($jobid)
    {
        $datajobledger=" select * from(
            SELECT 'Invoice'as types,convert(jm_invoicemaster.Date,date ) as Dates ,concat('Invoice -',Inv) As Descriptions,jm_invoicemaster.GrandTotal as Debit,0 as Credit
        FROM jm_invoicemaster
        INNER JOIN jm_job ON jm_invoicemaster.JobId = jm_job.JobId 
        where jm_job.JobId=".$jobid."
        
               union all
               SELECT  'Reciept'as types,convert(jm_receiptmaster.Date,date)as Dates ,concat('Total of all invoices:',jm_invoicemaster.Inv) as Descriptions,0 as Debit,jm_receiptdetail.Total as Credit  from jm_receiptmaster 
               inner join jm_receiptdetail on jm_receiptdetail.ReceiptMasterId=jm_receiptmaster.ReceiptMasterId
               inner join jm_invoicemaster on jm_invoicemaster.InvoiceMasterId=jm_receiptdetail.InvoiceMasterID
               where jm_receiptdetail.JobNo=".$jobid."
                  union all
            
            SELECT DISTINCT 'Credit Note'as types,convert(jm_creditnote_master.Date,date)as Dates ,'Credit Note'+'-'+jm_creditnote_master.Code_Id+'-'+mst_client.name AS Descriptions,0 as Debit,jm_creditnote_master.GrandTotal as Credit FROM jm_creditnote_master INNER JOIN jm_job ON jm_creditnote_master.JobId = jm_job.JobId
        
        INNER JOIN mst_client ON mst_client.id =mst_client.id
        where jm_job.JobId=".$jobid."
                  union all
            SELECT 'Expense Voucher'as types,convert(jm_expensemaster.InvDate,date)as Dates ,'Expense' as Descriptions,0 as Debit,jm_expensemaster.GrandTotal as Credit  FROM jm_expensemaster
         INNER JOIN mst_supplier ON jm_expensemaster.SupplierID = mst_supplier.id
         inner join jm_job on jm_job.JobId=jm_expensemaster.JobID
          where jm_job.JobId=".$jobid."
            union ALL
            SELECT DISTINCT 'Debit Note'as types,convert(jm_debitnote_master.InvDate,date)as Dates ,'Debit Note'+'-'+jm_debitnote_master.Code_Id+'-'+mst_supplier.supplier_name  as Descriptions,jm_debitnote_master.GrandTotal as Debit, 0 as Credit FROM jm_debitnote_master 
          INNER JOIN mst_supplier ON jm_debitnote_master.SupplierID = mst_supplier.id
          inner join jm_job on jm_job.JobId=jm_debitnote_master.JobId
           where jm_job.JobId=".$jobid."
            union all
            select 'Payments'as types,convert(jm_supplierpaymentmaster.Date,date)as Dates ,'nodescription' as Descriptions, jm_supplierpaymentmaster.SubTotal as Debit, 0 as Credit  from jm_supplierpaymentmaster
           inner join jm_supplierpaymentdetail on jm_supplierpaymentdetail.SupplierPaymentMasterId=jm_supplierpaymentmaster.SupplierPaymentMasterId
           where jm_supplierpaymentdetail.JobNo=".$jobid."
            ) as abc order by Dates asc ; ";

 $query = $this->db->query($datajobledger);
    $result = $query->result();
        return $result;
     
   
      
    }
  
    public function get_all_job_doc($id)
	{
		return $this->db->select('*')	
			->from('jm_documents')
			->where('job_id',$id)
			->get()
			->result();
	}
    
}