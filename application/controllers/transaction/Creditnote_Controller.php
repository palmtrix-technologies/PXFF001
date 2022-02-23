<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creditnote_Controller extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('usermanagement/User_model');
		$this->load->model('usermanagement/Login_model');
		$this->load->model('usermanagement/Permission_model');
		$this->load->library(array('form_validation','session','upload'));
		$this->load->helper(array('url','html','form'));
		$this->load->library('pagination');
        $this->load->database(); 
		$this->load->library('session');
		$this->load->helper('url');
        $this->load->model('transaction/Credit_note_model');
		$this->load->model('transaction/Transaction_model');

	}

	
	public function credit_note($id)
	{
		 $user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
       	$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
        $result['jobdata']=$this->Credit_note_model->select_job_details($id);
		$result['code']=$this->Credit_note_model->selectcode();
		$result['job']=$this->Credit_note_model->select_all_job();
		$result['currencylist']=$this->Credit_note_model->list_currency();
		// $data['cmpnydata']=$this->Transaction_model->basic_company_details();
// var_dump($data);
$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

// die();
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/creditnote',$result);
		$this->load->view('includes/footer');
    }
    public function getdata($value)
    {
	
          $result= $this->Credit_note_model->list_description($value);
          echo json_encode($result);
            
	  }
public function credit_note_details()
	{

		 $data=$this->input->post('postData');
	
		$jobdata=$data["CreditnoteDetails"];
		$result=$this->Credit_note_model->addcreditmaster($data["CreditnoteData"]);
		$my_values = array();
		if($result!=0)
		{
			
			foreach($jobdata as $row)
			{
				$row["Creditnote_master_id"]=$result;
				$row["Total"]=floatval($row["Total"]);
				$this->Credit_note_model->add_creditnotedetails($row);
				$my_values[] = $row;
			}
		}
		
		echo json_encode( $result );
		
	}
	
	public function getsupplierdata()
	{
        
        $data = $this->Credit_note_model->getsupplier();
        echo json_encode($data);
	  
	}
	  
		//editand update
		public function edit_creditnote($id)
		{
			$creditid=$id;
			$user_id=$this->session->userdata('user_id');
			$res = $this->Permission_model->userdetails($user_id);
			$result['roles']=$this->Login_model->userdetails($user_id);
			   $user_image['values']=$res[0]->user_image;
			$result['permission']=$this->Login_model->select_all_menu($user_id);
			// $data['bank']=$this->Credit_note_model->select_all_bank();
			$data['currencylist']=$this->Credit_note_model->list_currency();
			$data['creditdata']=$this->Credit_note_model->edit_creditnotedetails($creditid);
			// var_dump($data['expensedata']);
			// die();
			$data['cdata']=$this->Credit_note_model->credit_note_details($creditid);
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

			$this->load->view('includes/header',$user_image);
			$this->load->view('includes/navigation',$result,$user_image);
			$this->load->view('transaction/edit_creditnote',$data);
			$this->load->view('includes/footer');
		}
		
	
		public function update_creditnote()
		{
	
			 $data=$this->input->post('postData');
			
			$creditdata=$data["CreditnoteDetails"];
			$id=$data["Id"];
			$deletedids=$data["deleted"];
		  //   echo $id;
		  //   die();
			$result=$this->Credit_note_model->update_creditnotemaster($id,$data["CreditnoteData"]);
			$my_values = array();
			if($creditdata!="")
			{
			foreach($creditdata as $row)
			{
					$row["Creditnote_master_id"]=$id;
				  //   $row["Vat"]=floatval($row["Vat"]);
					$row["Total"]=floatval($row["Total"]);
					$this->Credit_note_model->insert_creditdetails($row);
					$my_values[] = $row;
			}
			}
			if($deletedids!="")
			{
			foreach($deletedids as $row)
			{
					$id=$row;
					$result=$this->Credit_note_model->delete_creditdetails($id);
				
			}
		}
	echo $result;
		}

//print creditnote details
public function credit_note_print($creditid)
{
	$creditid=$creditid;

	$result['creditdata']=$this->Credit_note_model->selectcredit_details($creditid);
	 $result['credit']=$this->Credit_note_model->creditnote_details($creditid);
	 $result['companyinfo']=$this->Transaction_model->basic_company_details();
	 $result['invoiceinfo']=$this->Transaction_model->basic_invoice_details();

	$this->load->view('transaction/creditnote_print',$result);

}


public function change_credit_note_status($masterid,$clientid)
{


	$result=$this->Credit_note_model->change_creditnote_status($masterid);
	$data=$this->Credit_note_model->select_cndata($masterid);

	foreach($data as $row)
	{
	  $amount=$row->Total;
	  $cid=$row->Code_Id;

	  
	  $date=$row->Date;
	  $JobId=$row->JobId;

	  
	  $narration="Invoice .$cid. generated for Job No:.$JobId.,deited amount:$amount.";
	  $type="Credit Invoice";
	  $chequeid=0;
	}
	$clientledgerid=$this->Credit_note_model->select_client_ledgerid($clientid);
	$result1=$this->Credit_note_model->insert_into_accountmaster($clientledgerid,$amount,$date,$narration,$type,$chequeid);


	
redirect(base_url()."credit-note-print/".$masterid);
}
}
