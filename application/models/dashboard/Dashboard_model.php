<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
 {

    public function get_job_number()
    {
    
    $query = $this->db->query("SELECT count(JobId) as totaljobs  FROM jm_job");
    
    $result = $query->result();
    return $result;
    }
    public function pendingreceipt()
        {
            $data="  select sum(jm_invoicemaster.GrandTotal) as total
            from jm_invoicemaster
                  where jm_invoicemaster.Status!='Paid'";
          
            $query = $this->db->query($data);
      $result = $query->result();
      return $result;
        }
        public function pendingpayment()
        {
            $data="  select sum(jm_expensemaster.GrandTotal) as exptotal
            from jm_expensemaster  where jm_expensemaster.Status!='Paid'";
 
            $query = $this->db->query($data);
           
      $result = $query->result();
    
      return $result;
        }
        public function pendingpayment1()
        {
          
            $data2="  select sum(jm_supplierpaymentmaster.SubTotal) as paymenttotal
            from jm_supplierpaymentmaster";
            $query2 = $this->db->query($data2);
      $result2 = $query2->result();
      return $result2;
        }
        public function get_client_number()
        {
        
        $query = $this->db->query("SELECT count(id) as clients  FROM mst_client");
        
        $result = $query->result();
        return $result;
        }
      
        public function monthlyreport()
        {
        
$month = date('m');
$year = date('yy');

if(($month == 1)||($month == 2)||($month == 3)){
   

    $fromdate=$year."-"."01-01";
    $todate=$year."-"."03-31";

}
if($month == 4||$month == 5||$month == 6){
  
    

    $fromdate=$year."-"."04-01";
    $todate=$year."-"."06-30";

}
if($month == 7||$month == 8||$month == 9){
  
    

    $fromdate=$year."-"."07-01";
    $todate=$year."-"."09-30";

}
if($month == 10||$month == 11||$month == 12){
   
    

    $fromdate=$year."-"."10-01";
    $todate=$year."-"."12-31";

}
$data="SELECT 
SUM(Total) AS standardrate
FROM jm_invoicemaster

where Date BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)
";
  $query = $this->db->query($data);
  $result = $query->result();
  return $result;
}
public function totalexpense()
{

$month = date('m');
$year = date('yy');

if(($month == 1)||($month == 2)||($month == 3)){


$fromdate=$year."-"."01-01";
$todate=$year."-"."03-31";

}
if($month == 4||$month == 5||$month == 6){



$fromdate=$year."-"."04-01";
$todate=$year."-"."06-30";

}
if($month == 7||$month == 8||$month == 9){



$fromdate=$year."-"."07-01";
$todate=$year."-"."09-30";

}
if($month == 10||$month == 11||$month == 12){



$fromdate=$year."-"."10-01";
$todate=$year."-"."12-31";

}
$data="SELECT 
SUM(SubTotal) AS standardratedexpense
FROM jm_expensemaster

where PostingDate BETWEEN CAST('".$fromdate."' AS DATE) AND CAST('".$todate."' AS DATE)
";
$query = $this->db->query($data);
$result = $query->result();
return $result;
}
public function select_job_air()
{
    $query = $this->db->query("SELECT count(JobId) as aircount FROM jm_job where Type='airexport' or Type='airimport' ");
    
    $result = $query->result();
    return $result;
}
public function select_job_sea()
{
    $query = $this->db->query("SELECT count(JobId) as seacount FROM jm_job where Type='fclexport' or Type='fclimport' or Type='lclexport' or Type='lclimport' ");
    
    $result = $query->result();
    return $result;
}

public function select_job_land()
{
    $query = $this->db->query("SELECT count(JobId) as landcount FROM jm_job where Type='landexport' or Type='landimport'  ");
    
    $result = $query->result();
    return $result;
}

public function select_job_other()
{
    $query = $this->db->query("SELECT count(JobId) as othercount FROM jm_job where Type='transportation' ");
    
    $result = $query->result();
    return $result;
}
public function get_income()
{
    $data="  select sum(jm_invoicemaster.GrandTotal) as incometotal
    from jm_invoicemaster
          where jm_invoicemaster.Status='Paid'";
  
    $query = $this->db->query($data);
$result = $query->result();
return $result;
}
public function get_purchase()
{
    $data="  select sum(jm_expensemaster.GrandTotal) as totalexp
    from jm_expensemaster   where jm_expensemaster.Status='Paid'";
    $query = $this->db->query($data);
   
$result = $query->result();

return $result;
}
public function estimate_total()
{
    $data="  select sum(jm_estimate_master.grand_total) as totalestimate
    from jm_estimate_master   ";
    $query = $this->db->query($data);
   
$result = $query->result();

return $result;
}
public function latestjobs()
{
    $data=" select *
    from jm_job 
    ORDER BY JobId DESC limit 8";
    $query = $this->db->query($data);
   
$result = $query->result();

return $result;
}


public function import_total_numbers()
{
    $query = $this->db->query("SELECT count(JobId) as importcount FROM jm_job where shipment_type='Import' ");
    
    $result = $query->result();
    return $result;
}

public function export_total_numbers()
{
    $query = $this->db->query("SELECT count(JobId) as exportcount FROM jm_job where shipment_type='Export' ");
    
    $result = $query->result();
    return $result;
}

public function other_total_numbers()
{
    $query = $this->db->query("SELECT count(JobId) as othercount FROM jm_job where shipment_type='Transportation' ");
    
    $result = $query->result();
    return $result;
}
public function select_job_air_import()
{
    $query = $this->db->query("SELECT count(JobId) as aircountimp FROM jm_job where   Type='airimport' ");
    
    $result = $query->result();
    return $result;
}
public function select_job_sea_import()
{
    $query = $this->db->query("SELECT count(JobId) as seacountimp FROM jm_job where  Type='fclimport' or Type='lclimport' ");
    
    $result = $query->result();
    return $result;
}

public function select_job_land_import()
{
    $query = $this->db->query("SELECT count(JobId) as landcountimp FROM jm_job where Type='landimport'  ");
    
    $result = $query->result();
    return $result;
}
public function select_job_air_export()
{
    $query = $this->db->query("SELECT count(JobId) as aircountex FROM jm_job where   Type='airexport' ");
    
    $result = $query->result();
    return $result;
}
public function select_job_sea_export()
{
    $query = $this->db->query("SELECT count(JobId) as seacountex FROM jm_job where  Type='fclexport' or Type='lclexport' ");
    
    $result = $query->result();
    return $result;
}

public function select_job_land_export()
{
    $query = $this->db->query("SELECT count(JobId) as landcountex FROM jm_job where Type='landexport'  ");
    
    $result = $query->result();
    return $result;
}
 }