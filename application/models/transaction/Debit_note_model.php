<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debit_note_model extends CI_Model {

    public function select_job_details($id)
    {
     $this->db->where('JobId',$id);
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
    $this->db->from('jm_debitnote_master');
    $query = $this->db->get();
    $result = $query->result();
    if($result==NULL)
    {
      $result=1;
    }
    return $result;
    
    }

    public function getsupplier()
    {
          
    $this->db->select('id as value, supplier_name as label');
    $this->db->from('mst_supplier');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }

    public function list_description($data)
    {
      
    $this->db->where('code', $data);
    $this->db->select('description,id,code');
    $this->db->from('mst_description');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }
    //to insert into debitnote  master
    public function adddebitnote($data_array)
       {
       
        
          $this->db->insert('jm_debitnote_master', $data_array);
          $debit_master_id=$this->db->insert_id();
          return $debit_master_id;

       }
         //to insert into debitnote  details
       public function add_debitnotedetails($data_array)
       {
       
        
          $this->db->insert('jm_debitnote_details', $data_array);
          $debit_details_id=$this->db->insert_id();
        //   return $debit_details_id;
  
       }
      //edit and update
      public function debit_note_details($data)
      {
         $this->db->where('jm_debitnote_details.Debitnote_Master_id', $data);
         $this->db->select('*');    
         $this->db->from('jm_debitnote_details');
         $query = $this->db->get();
         $result = $query->result();
         return $result;
       
      
      }
       //edit
      public function edit_debitnotedetails($data)
      {
        
      $dataq="select sp.id,sp.supplier_name,ji.Debitnote_Master_id,ji.Code_Id,ji.InvDate,ji.PostingDate,ji.SubTotal,ji.Vat,ji.Reference,ji.OurInv,ji.GrandTotal,concat(jj.Hawb,'-',jj.Mawb) as awb,jj.JobId,jj.Number,jj.ActualWeight,
      jj.Etd,jj.Eta,jj.Type,jj.Mbl,jj.Carrier,jj.Pol,jj.Pod,jj.PoNo,concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientenglish,c.vat_no,
      concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'|',c.email) as clientearabic,
      concat(consignor.name,',',consignor.address,'\n',consignor.telephone,'-',consignor.mobile,'\n',consignor.email) as consignor,
      concat(consignee.name,',',consignee.address,'\n',consignee.telephone,'-',consignee.mobile,'\n',consignee.email) as consignee
      from jm_debitnote_master ji
      inner join jm_job jj on ji.JobId=jj.JobId
      inner join mst_client c on c.id=jj.client_id
      inner join mst_supplier sp on sp.id=ji.SupplierID
      inner join mst_shipper consignor on consignor.id=jj.consignor_id
      inner join mst_shipper consignee on consignee.id=jj.consignee_id
       where ji.Debitnote_Master_id=".$data.";";
      
       $query = $this->db->query($dataq);
          $result = $query->result();
              return $result;
           
       
      
      }
      
      //update
      public function update_debitnotemaster($Id,$data_array)
         {
         
            $this->db->where('jm_debitnote_master.Debitnote_Master_id', $Id);
            $this->db->update('jm_debitnote_master', $data_array);
            
            return 1;
         
            
      
         }
         public function insert_debitdetails($data_array)
         {
         
          
            $this->db->insert('jm_debitnote_details', $data_array);
            return 1;
         
         }
         public function delete_debitdetails($Id)
         {
      
            $this->db->where('Debit_note_id',$Id);
            $this->db->delete('jm_debitnote_details');
            return 1;
         
            
      
         }
       //print
       public function selectdebit_details($data)
       {
         $dataq="select sp.id,sp.supplier_name,ji.Debitnote_Master_id,ji.Code_Id,ji.InvDate,ji.PostingDate,ji.SubTotal,ji.Vat,ji.Reference,ji.OurInv,ji.GrandTotal,concat(jj.Hawb,'-',jj.Mawb) as awb,jj.JobId,jj.Number,jj.ActualWeight,
         jj.Etd,jj.Eta,jj.Type,jj.Mbl,jj.Carrier,jj.Pol,jj.Pod,jj.PoNo,concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientenglish,c.vat_no,
         concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientearabic,
         concat(consignor.name,',',consignor.address,',',consignor.telephone,'-',consignor.mobile,'\n',consignor.email) as consignor,
         concat(consignee.name,',',consignee.address,',',consignee.telephone,'-',consignee.mobile,'\n',consignee.email) as consignee
         from jm_debitnote_master ji
         inner join jm_job jj on ji.JobId=jj.JobId
         inner join mst_client c on c.id=jj.client_id
         inner join mst_supplier sp on sp.id=ji.SupplierID
         inner join mst_shipper consignor on consignor.id=jj.consignor_id
         inner join mst_shipper consignee on consignee.id=jj.consignee_id
          where ji.Debitnote_Master_id=".$data.";";
         
          $query = $this->db->query($dataq);
             $result = $query->result();
                 return $result;
        
       
       }
       
       // to select_job_invoice details
       public function debitnote_details($data)
       {
          $this->db->where('jm_debitnote_details.Debitnote_Master_id', $data);
          $this->db->select('*');    
          $this->db->from('jm_debitnote_details');
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
       public function change_debitnote_status($dnmasteid)
   {
      $this->db->set('Status',"Posted" );
      $this->db->where('Debitnote_Master_id', $dnmasteid);
      $this->db->update('jm_debitnote_master');
      return 1;
   }
   

   public function select_supplier_ledgerid($id)
{
  $this->db->where('SupplierID', $id);

$this->db->select('LedgerID');
$this->db->from('accounts_supplierledger');
$query = $this->db->get();
$result = $query->result();
foreach($result as $row)
{
  $id=$row->LedgerID;
}
return $id;

}


public function select_dndata($data)
{
  
$dataq="select PostingDate,SubTotal,Mode,JobId,Code_Id from jm_debitnote_master
 where Debitnote_Master_id=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
     
 

}
public function insert_into_accountmaster($supledgerid,$amount,$date,$narration,$type,$chequeid)
{
  
     $query2="insert into accounts_accountmaster values ('','".$supledgerid."','2','".$amount."','".$date."','".$narration."','".$type."','".$chequeid."')"; 
     $this->db->query($query2);
   
     $ledgerid=   $this->db->insert_id();
     return $ledgerid;
 
   

}
   
}