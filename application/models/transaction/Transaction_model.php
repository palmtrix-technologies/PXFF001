<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

public function list()
{
// $this->db->where('JobId',$id);
$this->db->select('*');
$this->db->from('jm_job');
$query = $this->db->get();
$result = $query->result();
return $result;

}

public function getjobById($id)
{
$this->db->where('JobId',$id);
$this->db->select('*');
$this->db->from('jm_job');
$query = $this->db->get();
$result = $query->result();
return $result;

}


// auto code 
public function selectcode()
{

$this->db->select_max('Number');
$this->db->from('jm_job');
$query = $this->db->get();
$result = $query->result();
if($result==NULL)
{
  $result=1;
}
return $result;

}
public function add($data)
{    
        $this->db->insert('jm_job',$data);
        $id = $this->db->insert_id();
           return $id;

     
}

public function list_client()
{

$this->db->select('*');
$this->db->from('mst_client');
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
public function list_truck()
{

$this->db->select('*');
$this->db->from('mst_truck');
$query = $this->db->get();
$result = $query->result();
return $result;

}
public function list_carrier()
{
  $this->db->select('*');
$this->db->from('mst_carrier');
$query = $this->db->get();
$result = $query->result();
return $result;
}

public function list_desc()
{
  $this->db->select('*');
$this->db->from('mst_description');
$query = $this->db->get();
$result = $query->result();
return $result;
} 
public function list_user()
{

  $this->db->select('*');
$this->db->from('mst_users');
$query = $this->db->get();
$result = $query->result();
return $result;
}
//autocomplete text
public function getshippers()
{
      
$this->db->select('id as value, name as label');
$this->db->from('mst_shipper');
$query = $this->db->get();
$result = $query->result();
return $result;

}
public function update($id,$data)
{

    $this->db->where('JobId',$id);
        $this->db->update('jm_job',$data);
        
        return "success";
    
} 

public function list_description($data)
{
    
 
    $this->db->where('code', $data);
$this->db->select('id,description');
$this->db->from('mst_description');
$query = $this->db->get();
$result = $query->result();
return $result;

}
//get job details
public function job_desc($data)
{
  $this->db->where('JobId',$data);
$this->db->select('*');
$this->db->from('jm_job');
$query = $this->db->get();
$result = $query->result();
return $result;
}

public function selectcode_estimate()
{

$this->db->select_max('estimate_no');
$this->db->from('jm_estimate_master');
$query = $this->db->get();
$result = $query->result();
if($result==NULL)
{
  $result=1;
}
return $result;

}
//add estimate details
public function add_estimate($data)
{
  $this->db->insert('jm_estimate_master',$data);
        $invoice_id = $this->db->insert_id();
        return $invoice_id;
}
public function add_estimatedetails($data)
{ 
    $this->db->insert('jm_estimate_master_details', $data);
    $invoice_details_id=$this->db->insert_id();
    return $invoice_details_id;

}

public function listjobdetails()
{
  $dataq="select * from  jm_job where Number!=0 order by Number DESC ;";

  $query = $this->db->query($dataq);
     $result = $query->result();
         return $result;
      

}

public function listestimatedetails()
{
     
   $this->db->select('*');
   $this->db->from('jm_estimate_master');
   $this->db->join('jm_estimate_master_details', 'jm_estimate_master_details.estimate_masterid = jm_estimate_master.estimate_masterid');
   $query = $this->db->get();
   return $query->result();

}


public function jobclosed_status($id)
{
     
  $this->db->where('JobId', $id);
  $this->db->set('Status','CLOSED');
  if($this->db->update('jm_job'))
  {
    return 1;
  }else{
    return 0;
  }
}
public function getestimatemaster_id($data)
{
  $data1="SELECT estimate_masterid FROM jm_estimate_master WHERE jm_estimate_master.job_id=".$data.";";
  $query = $this->db->query($data1);
    $result = $query->result();
   $count=$query->num_rows();
   //convert array to string
   if ($count > 0)
{
  foreach($result as $row)
  {
    $masterid=$row->estimate_masterid;
  }
  return $masterid;

} else {
return 0;
}
  
}
public function getclient_id($data)
{
  $data1="SELECT client_id FROM jm_job WHERE jm_job.JobId=".$data.";";
  $query = $this->db->query($data1);
    $result = $query->result();
   $count=$query->num_rows();
   //convert array to string
   if ($count > 0)
{
  foreach($result as $row)
  {
    $id=$row->client_id;
  }
  return $id;

} else {
return 0;
}
  
}
public function getconsigor_id($data)
{
  $data1="SELECT consignor_id FROM jm_job WHERE jm_job.JobId=".$data.";";
  $query = $this->db->query($data1);
    $result = $query->result();
   $count=$query->num_rows();
   //convert array to string
   if ($count > 0)
{
  foreach($result as $row)
  {
    $id=$row->consignor_id;
  }
  return $id;

} else {
return 0;
}
  
}
public function getconsignee_id($data)
{
  $data1="SELECT consignee_id FROM jm_job WHERE jm_job.JobId=".$data.";";
  $query = $this->db->query($data1);
    $result = $query->result();
   $count=$query->num_rows();
   //convert array to string
   if ($count > 0)
{
  foreach($result as $row)
  {
    $id=$row->consignee_id;
  }
  return $id;

} else {
return 0;
}
  
}
//for print estimate
public function getclient_id_est($data)
{
  $data1="SELECT client_id FROM jm_job
  inner join jm_estimate_master
  on jm_estimate_master.job_id=jm_job.JobId
  WHERE jm_estimate_master.estimate_masterid=".$data.";";
  $query = $this->db->query($data1);
    $result = $query->result();
   $count=$query->num_rows();
   //convert array to string
   if ($count > 0)
{
  foreach($result as $row)
  {
    $id=$row->client_id;
  }
  return $id;

} else {
return 0;
}
  
}
public function getconsigor_id_est($data)
{
  $data1="SELECT consignor_id FROM jm_job
  inner join jm_estimate_master
  on jm_estimate_master.job_id=jm_job.JobId
  WHERE jm_estimate_master.estimate_masterid=".$data.";";
  $query = $this->db->query($data1);
    $result = $query->result();
   $count=$query->num_rows();
   //convert array to string
   if ($count > 0)
{
  foreach($result as $row)
  {
    $id=$row->consignor_id;
  }
  return $id;

} else {
return 0;
}
  
}
public function getconsignee_id_est($data)
{
  $data1="SELECT consignee_id FROM jm_job
  inner join jm_estimate_master
  on jm_estimate_master.job_id=jm_job.JobId
  WHERE jm_estimate_master.estimate_masterid=".$data.";";
  $query = $this->db->query($data1);
    $result = $query->result();
   $count=$query->num_rows();
   //convert array to string
   if ($count > 0)
{
  foreach($result as $row)
  {
    $id=$row->consignee_id;
  }
  return $id;

} else {
return 0;
}
  
}
public function job_estimate_details($mid)
{
   $this->db->where('jm_estimate_master_details.estimate_masterid', $mid);
   $this->db->select('*');    
   $this->db->from('jm_estimate_master_details');
   $query = $this->db->get();
   $result = $query->result();
   return $result;
}


public function editestimateedetails($data)
{
  
$dataq="select ji.estimate_masterid,ji.estimate_no,ji.job_id,ji.e_date,ji.status,ji.total_amount,ji.tax_amount,ji.grand_total,concat(jj.Hawb,'-',jj.Mawb) as awb,jj.JobId,jj.Number,jj.ActualWeight,
jj.Etd,jj.Eta,jj.Type,jj.Mbl,jj.Carrier,jj.Pol,jj.Pod,jj.ShipmentTerms,jj.CargoDescription,jj.PoNo,
jj.Date,jj.Origin,jj.Type,jj.Mawb,jj.Hawb,jj.ContainerNo,jj.Etd,jj.Eta,jj.ShipmentTerms,jj.ChargeableWeight,jj.Description,jj.Destination,jj.BayanNo,jj.NoContainers,jj.TruckNo,jj.Nopcs,jj.BayanDate,jj.BayanNo,jj.Status
from jm_estimate_master ji
inner join jm_job jj on ji.job_id=jj.JobId

 where ji.job_id=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
}

public function estimateedetails($data)
{
  
$dataq="select ji.estimate_masterid,ji.estimate_no,ji.job_id,ji.e_date,ji.total_amount,ji.tax_amount,ji.grand_total,concat(jj.Hawb,'-',jj.Mawb) as awb,jj.JobId,jj.Number,jj.ActualWeight,
jj.Etd,jj.Eta,jj.Type,jj.Mbl,jj.Carrier,jj.Pol,jj.Pod,jj.ShipmentTerms,jj.CargoDescription,jj.PoNo,
jj.Date,jj.Origin,jj.Type,jj.Mawb,jj.Hawb,jj.ContainerNo,jj.Etd,jj.Eta,jj.ShipmentTerms,jj.ChargeableWeight,jj.Description,jj.Destination,jj.BayanNo,jj.NoContainers,jj.TruckNo,jj.Nopcs,jj.BayanDate,jj.BayanNo,jj.Status
from jm_estimate_master ji
inner join jm_job jj on ji.job_id=jj.JobId

 where ji.estimate_masterid=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
}
public function getclinetdetails($data)
{
  
$dataq="select concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientenglish 
from mst_client c
inner join jm_job jj on jj.client_id=c.id
 where jj.JobId=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
     
 

}
public function getconsignordetails($data)
{
  
$dataq="
select
concat(consignor.name,',',consignor.address,',',consignor.telephone,'-',consignor.mobile,'\n',consignor.email) as consignor,jm_job.JobId,jm_job.Number

from mst_shipper consignor
inner join jm_job on jm_job.consignor_id=consignor.id
where jm_job.JobId=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
     
 

}
public function getconsigneeedetails($data)
{
  
$dataq="
select
concat(consignee.name,',',consignee.address,',',consignee.telephone,'-',consignee.mobile,'\n',consignee.email) as consigni,jm_job.JobId,jm_job.Number

from mst_shipper consignee
inner join jm_job on jm_job.consignee_id=consignee.id
where jm_job.JobId=".$data.";";

 $query = $this->db->query($dataq);
    $result = $query->result();
        return $result;
     
 

}


public function update_estimatemaster($Id,$data_array)
{
   $this->db->where('jm_estimate_master.estimate_masterid', $Id);
   $this->db->update('jm_estimate_master', $data_array);
   
   return 1;

}
public function insert_estimatedetails($data_array)
{

   $this->db->insert('jm_estimate_master_details',$data_array);
   $invoice_id = $this->db->insert_id();
   return $invoice_id;

}
public function delete_estimatedetails($Id)
{
  
   $this->db->where('estimate_details_id',$Id);
   $this->db->delete('jm_estimate_master_details');
   return 1;

}
public function delete_estimatemaster($Id)
{
  
   $this->db->where('estimate_masterid',$Id);
   $this->db->delete('jm_estimate_master');
   return 1;

}

public function insert_estimatemaster($data_array)
{
     
  $this->db->insert('jm_estimate_master', $data_array);
  $id = $this->db->insert_id();
  return $id;
   
  
 
}
//to select basic_cvompany details from table

public function basic_company_details()
{
$this->db->select('*');
$this->db->from('cmpny_settings_basic_info');
$query = $this->db->get();

$result = $query->result();
return $result;

}
public function basic_invoice_details()
{
$this->db->select('*');
$this->db->from('cmpny_settings_inv_details');
$query = $this->db->get();
$result = $query->result();
return $result;

}
//print
public function estimatemaster_details($id)
{
  $data="select ji.estimate_masterid,ji.estimate_no,ji.e_date,ji.total_amount,ji.tax_amount,ji.grand_total,concat(jj.Hawb,'-',jj.Mawb) as awb,jj.JobId,jj.Number,jj.ActualWeight,
  jj.Etd,jj.Eta,jj.Type,jj.Mbl,jj.Carrier,jj.Pol,jj.Pod,jj.ShipmentTerms,jj.CargoDescription,jj.PoNo,
  jj.Date,jj.Origin,jj.Type,jj.Mawb,jj.Hawb,jj.ContainerNo,jj.Etd,jj.Eta,jj.ShipmentTerms,jj.ChargeableWeight,jj.Description,jj.Destination,jj.BayanNo,jj.NoContainers,jj.TruckNo,jj.Nopcs,jj.BayanDate,jj.BayanNo,jj.Status
  from jm_estimate_master ji
  inner join jm_job jj on ji.job_id=jj.JobId
     where ji.estimate_masterid=" . $id . ";";

   $query = $this->db->query($data);
   $result = $query->result();
   return $result;
} 
public function  client_details($id)
{
  $data="
  select concat(c.name,'|',c.address,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientenglish ,
  concat(c.name_arabic,'|',c.address_arabic,'|',c.telephone,'-',c.mobile,'\n',c.email) as clientarabic,c.vat_no
  from mst_client c
  inner join jm_job jj on jj.client_id=c.id
  inner join jm_estimate_master ji on ji.job_id=jj.JobId
  where ji.estimate_masterid=" . $id . ";";

   $query = $this->db->query($data);
   $result = $query->result();
   return $result;
} 
public function consignor_details($id)
{
  $data="select
  concat(consignor.name,',',consignor.address,',',consignor.telephone,'-',consignor.mobile,'\n',consignor.email) as consignor,jm_job.JobId,jm_job.Number
  
  from mst_shipper consignor
  inner join jm_job on jm_job.consignor_id=consignor.id
  inner join jm_estimate_master ji on ji.job_id=jm_job.JobId
  where ji.estimate_masterid=" . $id . ";";

   $query = $this->db->query($data);
   $result = $query->result();
   return $result;
} 
public function consignee_details($id)
{
  $data="select
  concat(consignee.name,',',consignee.address,',',consignee.telephone,'-',consignee.mobile,'\n',consignee.email) as consigni
  ,jm_job.JobId,jm_job.Number
  
  from mst_shipper consignee
  inner join jm_job on jm_job.consignee_id=consignee.id
  inner join jm_estimate_master ji on ji.job_id=jm_job.JobId
  where ji.estimate_masterid=" . $id . ";";

   $query = $this->db->query($data);
   $result = $query->result();
   return $result;
} 
public function estimate_details($data)
{
   $this->db->where('jm_estimate_master_details.estimate_masterid', $data);
   $this->db->select('*');
   $this->db->from('jm_estimate_master_details');
   $query = $this->db->get();
   $result = $query->result();
   return $result;
}
//autocomplete text for description
public function getdescriptiondata()
{
      
$this->db->select('id as value, description as label');
$this->db->from('mst_description');
$query = $this->db->get();
$result = $query->result();
return $result;

}
public function getjobdata()
{
      
$this->db->select('Number as value, Jobcode as label');
$this->db->from('jm_job');
$query = $this->db->get();
$result = $query->result();
return $result;

}
//to upload files

public function check_filename($image_name)
{
  $where='(file_path="'.$image_name.'")';
  $this->db->select('file_path')->from('jm_documents')->where($where);
  $query=$this->db->get();
  if($query->num_rows() > 0)
  {
    return 1;
  }else{
    return 0;
  }
}
public function insert_image_data($data_array)
{

  if($this->db->insert('jm_documents', $data_array))
    {
      $news_id = $this->db->insert_id();
      return $news_id;
    }else{
      $insert_status= "failed";
      return $insert_status;
    }
}
public function selectjobid()
   {

      $this->db->select_max('JobId');
      $this->db->from('jm_job');
      $query = $this->db->get();
      $result = $query->result();
      if ($result == NULL) {
         $result = 1;
      }
      $jobid=$result[0]->JobId;
      return $jobid;
   }

//to remove uploaded files
public function fetch_image_name($file)
{
  $where='(file_path LIKE "'.$file.'%" or `name` LIKE"'.$file.'%" )';
  $this->db->select('file_path')->from('jm_documents')->where($where);
  $query=$this->db->get();
  if($query->num_rows() > 0)
  {
    $result=$query->result();
    $image=$result[0]->file_path;
    return $image;
  }else{
    return 0;
  }
}

  public function remove_image($without_extension)
{
  $where='(file_path LIKE "'.$without_extension.'%" or `name` LIKE"'.$without_extension.'%")';
  $this->db->where($where);
  $this->db->delete("jm_documents");
  if ($this->db->affected_rows() > 0)
  {
    return 1;
  } 
  else
  {
    return 0;
  }
}
//to select uploaded files based onjobid

public function selectuploaded_file($jobid)
{
  $where='(job_id="'.$jobid.'")';
  $this->db->select('*')->from('jm_documents')->where($where);
  $query=$this->db->get();
  if($query->num_rows() > 0)
  {
    $result=$query->result();
    return $result;
  }else{
    return 0;
  }
}
public function deleteimages($id)
{
  $where='(id= "'.$id.'")';
  $this->db->where($where);
  $this->db->delete("jm_documents");
  if ($this->db->affected_rows() > 0)
  {
    return 1;
  } 
  else
  {
    return 0;
  }
}

public function selectmaxid_estimatemaster()
{
  $data1="SELECT  max(estimate_masterid) as id FROM jm_estimate_master ;";
  $query = $this->db->query($data1);
    $result = $query->result();
  
  foreach($result as $row)
  {
    $masterid=$row->id;
  }

  return $masterid;

  
}


public function getmaxjobno()
{
  $data1="SELECT  max(Number) as num FROM jm_job ;";
  $query = $this->db->query($data1);
    $result = $query->result();
  
  foreach($result as $row)
  {
    $num=$row->num;
  }

  return $num;

  
}

public function add_derault_shipper($Shippername)
{
  $data1="  INSERT INTO mst_shipper (name,IsActive,type) VALUES ('$Shippername','1','text') ;";
  $query = $this->db->query($data1);
     
  $id = $this->db->insert_id();
  return $id;
   
  
 
}
public function update_job_doc_ajax($id,$data = array())
{
  return $this->db->where('job_id',  $id)
    ->update("jm_documents", $data);
}
public function job_doc_create($data = array())
    {
        return $this->db->insert('jm_documents', $data);
    }

    public function get_all_job_doc_all($docid)
	{
		return $this->db->select('*')	
			->from('jm_documents')
			->where('job_id',$docid)
			->get()
			->result();
	}

  public function job_updateForm($id){
    $this->db->where('JobId',$id);
// $this->db->order_by('emp_his_id','desc');
    $query = $this->db->get('jm_job');
    return $query->row();
}

public function update_job_documentid($id,$new_id)
{
  

    $this->db->where('job_id', $id);
  $this->db->set('job_id',$new_id);
  if($this->db->update('jm_documents'))
  {
    return 1;
  }else{
    return 0;
  }
}
public function document_delete($id = null)
{
    $this->db->where('job_id',$id)
        ->delete('jm_documents');

    if ($this->db->affected_rows()) {
        return true;
    } else {
        return false;
    }
}

}