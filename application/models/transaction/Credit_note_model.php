<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Credit_note_model extends CI_Model
{

   public function select_job_details($id)
   {
      $this->db->where('JobId', $id);
      $this->db->select('*');
      $this->db->from('jm_job');
      $query = $this->db->get();
      $result = $query->result();
      return $result;
   }

   public function select_all_job()
   {
      $this->db->select('*');
      $this->db->from('jm_job');
      $query = $this->db->get();
      $result = $query->result();
      return $result;
   }
   public function selectcode()
   {

      $this->db->select_max('Code_Id');
      $this->db->from('jm_creditnote_master');
      $query = $this->db->get();
      $result = $query->result();
      if ($result == NULL) {
         $result = 1;
      }
      return $result;
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
   //to insert into creditnote tb
   public function addcreditmaster($data_array)
   {


      $this->db->insert('jm_creditnote_master', $data_array);
      $job_master_id = $this->db->insert_id();
      return $job_master_id;
   }
   public function add_creditnotedetails($data_array)
   {


      $this->db->insert('jm_creditnote_details', $data_array);
      $job_invoice_details_id = $this->db->insert_id();
      return $job_invoice_details_id;
   }
   //edit and update
   public function credit_note_details($data)
   {
      $this->db->where('jm_creditnote_details.Creditnote_master_id', $data);
      $this->db->select('*');
      $this->db->from('jm_creditnote_details');
      $query = $this->db->get();
      $result = $query->result();
      return $result;
   }
   //edit
   public function edit_creditnotedetails($data)
   {

      $dataq = "select ji.Creditnote_master_id,ji.Code_Id,ji.Date,ji.PostingDate,ji.Total,ji.Vat,ji.GrandTotal,concat(jj.Hawb,'-',jj.Mawb) as awb,jj.JobId,jj.Number,jj.ActualWeight,
       jj.Etd,jj.Eta,jj.Type,jj.Mbl,jj.Carrier,jj.Pol,jj.Pod,jj.PoNo,concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientenglish,c.vat_no,
       concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'|',c.email) as clientearabic,
       concat(consignor.name,',',consignor.address,',',consignor.telephone,'-',consignor.mobile,'\n',consignor.email) as consignor,
       concat(consignee.name,',',consignee.address,'\n',consignee.telephone,'-',consignee.mobile,'\n',consignee.email) as consignee
       from jm_creditnote_master ji
       inner join jm_job jj on ji.JobId=jj.JobId
       inner join mst_client c on c.id=jj.client_id
   
       inner join mst_shipper consignor on consignor.id=jj.consignor_id
       inner join mst_shipper consignee on consignee.id=jj.consignee_id
        where ji.Creditnote_master_id=" . $data . ";";

      $query = $this->db->query($dataq);
      $result = $query->result();
      return $result;
   }

   //update
   public function update_creditnotemaster($Id, $data_array)
   {

      $this->db->where('jm_creditnote_master.Creditnote_master_id', $Id);
      $this->db->update('jm_creditnote_master', $data_array);

      return 1;
   }
   public function insert_creditdetails($data_array)
   {


      $this->db->insert('jm_creditnote_details', $data_array);
      return 1;
   }
   public function delete_creditdetails($Id)
   {

      $this->db->where('creditnote_detals_id', $Id);
      $this->db->delete('jm_creditnote_details');
      return 1;
   }
   //print
   public function selectcredit_details($data)
   {
      $dataq = "select ji.Creditnote_master_id,ji.Code_Id,ji.Date,ji.PostingDate,ji.Total,ji.Vat,ji.GrandTotal,concat(jj.Hawb,'-',jj.Mawb) as awb,jj.JobId,jj.Number,jj.ActualWeight,
      jj.Etd,jj.Eta,jj.Type,jj.Mbl,jj.Carrier,jj.Pol,jj.Pod,jj.PoNo,concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientenglish,c.vat_no,
      concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientearabic,
      concat(consignor.name,',',consignor.address,',',consignor.telephone,'-',consignor.mobile,'\n',consignor.email) as consignor,
      concat(consignee.name,',',consignee.address,',',consignee.telephone,'-',consignee.mobile,'\n',consignee.email) as consignee
      from jm_creditnote_master ji
      inner join jm_job jj on ji.JobId=jj.JobId
      inner join mst_client c on c.id=jj.client_id
  
      inner join mst_shipper consignor on consignor.id=jj.consignor_id
      inner join mst_shipper consignee on consignee.id=jj.consignee_id
       where ji.Creditnote_master_id=" . $data . ";";


      $query = $this->db->query($dataq);
      $result = $query->result();
      return $result;
   }

   // to select_job_invoice details
   public function creditnote_details($data)
   {
      $this->db->where('jm_creditnote_details.Creditnote_master_id', $data);
      $this->db->select('*');
      $this->db->from('jm_creditnote_details');
      $query = $this->db->get();
      $result = $query->result();
      return $result;
   }
   public function list_currency()
   {
   
   $this->db->select('*');
   $this->db->from('mst_currency');
   $query = $this->db->get();
   $result = $query->result();
   return $result;
   
   }   
   
   public function change_creditnote_status($cnmasteid)
   {
      $this->db->set('Status',"Posted" );
      $this->db->where('Creditnote_master_id', $cnmasteid);
      $this->db->update('jm_creditnote_master');
      return 1;
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


public function select_cndata($data)
{
  
$dataq="select Date,Total,JobId,Code_Id from jm_creditnote_master
 where Creditnote_master_id=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
     
 

}
public function insert_into_accountmaster($clientledgerid,$amount,$date,$narration,$type,$chequeid)
{
  
     $query2="insert into accounts_accountmaster values ('','2','".$clientledgerid."','".$amount."','".$date."','".$narration."','".$type."','".$chequeid."')"; 
     $this->db->query($query2);
   
     $ledgerid=   $this->db->insert_id();
     return $ledgerid;
 
   

}
}
