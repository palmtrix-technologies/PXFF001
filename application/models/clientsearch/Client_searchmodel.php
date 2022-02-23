<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_searchmodel extends CI_Model {



    public function getclient()
    {
          
    $this->db->select('id as value, name as label');
    $this->db->from('mst_client');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }

 public function getclient_view($clientid,$from,$to)
 {
 //,$from,$to
//  WHERE Dates BETWEEN  CAST('".$from."' AS DATE) AND CAST('".$to."' AS DATE)

    $dataq="select * from(SELECT  concat('Invoice for the job no:',jm_invoicemaster.JobId) as particulars,'credit invoice' as vouchertypes,convert(jm_invoicemaster.Date,date ) as Dates ,'Invoice -'+Inv As Descriptions,jm_invoicemaster.GrandTotal as Debit,0 as Credit,jm_invoicemaster.Inv as invoice
    FROM jm_invoicemaster
    INNER JOIN jm_job ON jm_invoicemaster.JobId = jm_job.JobId
    INNER JOIN mst_client on mst_client.id=jm_job.client_id
    where mst_client.id=  ".$clientid."

union all

SELECT DISTINCT 'payment' as particulars, 'Reciept'as vouchertypes,convert(jm_receiptmaster.Date,date)as Dates ,'no description' as Descriptions, 0 as Debit,jm_receiptmaster.SubTotal as Credit ,0 as invoice from jm_receiptmaster 
   
      inner join mst_client on mst_client.id=jm_receiptmaster.ClientID
      where jm_receiptmaster.ClientID=  ".$clientid."
      union all
      SELECT DISTINCT concat('Credit note for the job no:',jm_job.JobId) as particulars, 'credit invoice'as vouchertypes,convert(jm_creditnote_master.Date,date)as Dates ,'Credit Note'+'-'+jm_creditnote_master.Code_Id+'-'+mst_client.name  as Descriptions,jm_creditnote_master.GrandTotal as Debit, 0 as Credit,0 as invoice FROM jm_creditnote_master 
      inner join jm_job on jm_job.JobId=jm_creditnote_master.JobId
    INNER JOIN mst_client ON jm_job.client_id = mst_client.id
    where jm_job.client_id=  ".$clientid."  
) as abc WHERE Dates BETWEEN '".$from."'  AND '".$to."' 
ORDER BY `abc`.`Dates`  ASC;";

     $query = $this->db->query($dataq);
        $result = $query->result();
            return $result;
 }

}