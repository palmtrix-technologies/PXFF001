<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {


public function add($data)
{
    $this->db->where('name', $data['name']);
    $query = $this->db->get('n_e_employee_details');
    $count_row = $query->num_rows();
    if ($count_row > 0) {
       return "data already exist";
    } else {
       
        $this->db->insert('n_e_employee_details',$data);
        $id=   $this->db->insert_id();
        return $id;
    }
}
public function list()
{

$this->db->select('*');
$this->db->from('n_e_employee_details');
$query = $this->db->get();
$result = $query->result();
return $result;

}

public function gettype()
    {
          
    $this->db->select("code as value, 	CONCAT(site_name,' - ',site_code) as label");
    $this->db->from('jm_sitedetails');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    
    }
public function selectcode()
{

  $this->db->select_max('employee_code');
$this->db->from('n_e_employee_details');
$query = $this->db->get();
$result = $query->result();
if($result==NULL)
{
  $result=1;
}
return $result;

}
public function edit($id)
{
    $this->db->where('employeeid', $id);
    $query = $this->db->get('n_e_employee_details');
    $result = $query->result();
return $result;
}

public function view($id)
{
    $this->db->where('employeeid', $id);
    $query = $this->db->get('n_e_employee_details');
    $result = $query->row();
return $result;
}

 public function getall_vehicleexpense($id)
   {
      $dataq = "select accounts_expence.expense_date,accounts_expence.expense_category,accounts_expense_details.description,accounts_expense_details.subtotal,accounts_expense_details.tax_amount,accounts_expense_details.total_amount from accounts_expense_details inner join accounts_expence on accounts_expence.acc_expense_id=accounts_expense_details.acc_expense_id where accounts_expense_details.vehicle_id=". $id . ";";

      $query = $this->db->query($dataq);
      $result = $query->result();
      return $result;
   }
   public function getall_Fuelexpense($id)
   {
      $dataq = "select accounts_expence.expense_date,accounts_expence.expense_category,accounts_expense_details.description,accounts_expense_details.subtotal,accounts_expense_details.tax_amount,accounts_expense_details.total_amount from accounts_expense_details inner join accounts_expence on accounts_expence.acc_expense_id=accounts_expense_details.acc_expense_id where  expense_category='Fuel Expense' and accounts_expense_details.vehicle_id=". $id . ";";

      $query = $this->db->query($dataq);
      $result = $query->result();
      return $result;
   }
   public function getall_maintenenceExpense($id)
   {
      $dataq = "select accounts_expence.expense_date,accounts_expence.expense_category,accounts_expense_details.description,accounts_expense_details.subtotal,accounts_expense_details.tax_amount,accounts_expense_details.total_amount from accounts_expense_details inner join accounts_expence on accounts_expence.acc_expense_id=accounts_expense_details.acc_expense_id where  expense_category='Vehicle maintenance' and accounts_expense_details.vehicle_id=". $id . ";";

      $query = $this->db->query($dataq);
      $result = $query->result();
      return $result;
   }
   
   public function vehicle_dash($id)
   {
      $dataq = "select (select sum(accounts_expense_details.total_amount) from accounts_expense_details 
inner join accounts_expence on accounts_expence.acc_expense_id=accounts_expense_details.acc_expense_id
where accounts_expense_details.vehicle_id=".$id." and EXTRACT( YEAR_MONTH FROM accounts_expence.expense_date )=EXTRACT( YEAR_MONTH FROM CURDATE() )) as month_total,(select sum(accounts_expense_details.total_amount) from accounts_expense_details 
inner join accounts_expence on accounts_expence.acc_expense_id=accounts_expense_details.acc_expense_id
where accounts_expense_details.vehicle_id=".$id." and accounts_expence.expense_category='Fuel Expense' and EXTRACT( YEAR_MONTH FROM accounts_expence.expense_date )=EXTRACT( YEAR_MONTH FROM CURDATE() )) as month_fuel,
(select sum(accounts_expense_details.total_amount) from accounts_expense_details 
inner join accounts_expence on accounts_expence.acc_expense_id=accounts_expense_details.acc_expense_id
where accounts_expense_details.vehicle_id=".$id." and accounts_expence.expense_category='Vehicle maintenance' and EXTRACT( YEAR_MONTH FROM accounts_expence.expense_date )=EXTRACT( YEAR_MONTH FROM CURDATE() )) as month_main,
(select sum(accounts_expense_details.total_amount) from accounts_expense_details 
inner join accounts_expence on accounts_expence.acc_expense_id=accounts_expense_details.acc_expense_id
where accounts_expense_details.vehicle_id=".$id.") as total,(select sum(accounts_expense_details.total_amount) from accounts_expense_details 
inner join accounts_expence on accounts_expence.acc_expense_id=accounts_expense_details.acc_expense_id
where accounts_expense_details.vehicle_id=".$id." and accounts_expence.expense_category='Fuel Expense') as fuel,
(select sum(accounts_expense_details.total_amount) from accounts_expense_details 
inner join accounts_expence on accounts_expence.acc_expense_id=accounts_expense_details.acc_expense_id
where accounts_expense_details.vehicle_id=".$id." and accounts_expence.expense_category='Vehicle maintenance') as main;";

      $query = $this->db->query($dataq);
      $result = $query->row();
      return $result;
   }



public function update($id,$data)
{

    $this->db->where('employeeid',$id);
        $this->db->update('n_e_employee_details',$data);
        
        return "success";
    
} 
//change status
public function enable_status($id)
{
     
  
  $this->db->where('employeeid', $id);
  $this->db->set('is_active',1);
  if($this->db->update('n_e_employee_details'))
  {
    return 1;
  }else{
    return 0;
  }
}
public function disable_status($id)
{
     
  
  $this->db->where('employeeid', $id);
  $this->db->set('is_active',0);
  if($this->db->update('n_e_employee_details'))
  {
    return 1;
  }else{
    return 0;
  }
}

}