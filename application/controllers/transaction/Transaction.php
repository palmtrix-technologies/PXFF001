<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

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
        
        $this->load->model('masters/Shipper_model');
        $this->load->model('transaction/Transaction_model');
	}

	private $upload_path = UPLOAD_PATH;
	public function index()
	{
		 $user_id=	$this->session->userdata('user_id');
	
		$data['value'] = $this->Shipper_model->list();
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
		$data['code']=$this->Transaction_model->selectcode();
		$data['codes']=$this->Transaction_model->selectcode_estimate(); 
		
		$data['clientlist']=$this->Transaction_model->list_client();
		$data['desclist']=$this->Transaction_model->list_desc();
		$data['carrierlist']=$this->Transaction_model->list_carrier();
		$data['currencylist']=$this->Transaction_model->list_currency();
		$data['userlist']=$this->Transaction_model->list_user();
		$data['truck']=$this->Transaction_model->list_truck();
		
		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
				// $this->index($result);
		 $data['values'] = $this->Transaction_model->list();
		 $user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
		 $result['supcode']=$this->Transaction_model->selectcode_estexpns();
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/transaction',$data);
		$this->load->view('includes/footer');
	}

	public function estimation()
	{
		 $user_id=	$this->session->userdata('user_id');
	
		$data['value'] = $this->Shipper_model->list();
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
		$data['code']=$this->Transaction_model->selectcode();
		$data['codes']=$this->Transaction_model->selectcode_estimate();
		
		$data['clientlist']=$this->Transaction_model->list_client();
		$data['desclist']=$this->Transaction_model->list_desc();
		$data['carrierlist']=$this->Transaction_model->list_carrier();
		$data['currencylist']=$this->Transaction_model->list_currency();
		$data['userlist']=$this->Transaction_model->list_user();
		$data['truck']=$this->Transaction_model->list_truck();
		$result['supcode']=$this->Transaction_model->selectcode_estexpns();
		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		
		 $data['values'] = $this->Transaction_model->list();
		 $user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		 $data['values'] = $this->Transaction_model->listjobdetails();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/estimation',$data);
		$this->load->view('includes/footer');
	}
	
	public function edit_job($id)
	{
		
		 $user_id=	$this->session->userdata('user_id');
		 $docid = $this->uri->segment(4);
		
		$data['value'] = $this->Shipper_model->list();
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
		$data['code']=$this->Transaction_model->selectcode();
		$data['jobcode']=$this->Transaction_model->selectjobcode($id); 
		$data['codes']=$this->Transaction_model->selectcode_estimate();
		
		$data['clientlist']=$this->Transaction_model->list_client();
		$data['carrierlist']=$this->Transaction_model->list_carrier();
		$data['currencylist']=$this->Transaction_model->list_currency();
		$data['userlist']=$this->Transaction_model->list_user();
		$data['truck']=$this->Transaction_model->list_truck();
		$data['datadoc'] =$this->Transaction_model->job_updateForm($id);
		
		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$data['values'] = $this->Transaction_model->getjobById($id);
		$data['doc'] =$this->Transaction_model->get_all_job_doc_all($id);
		$data['jobno'] = $this->Transaction_model->getmaxjobno();

		$masterid=$this->Transaction_model->getestimatemaster_id($id);
		$clientid=$this->Transaction_model->getclient_id($id);

		$consignorid=$this->Transaction_model->getconsigor_id($id);

		$consigneeid=$this->Transaction_model->getconsignee_id($id);

		if($clientid!="0")
		{	$data['clientdata']=$this->Transaction_model->getclinetdetails($id);}
		else{
			$data['clientdata']="";
		}
		if($consignorid!="0")
		{
			$data['consignordata']=$this->Transaction_model->getconsignordetails($id);}
		else{
			$data['consignordata']="";
		}
		if($consigneeid!="0")
		{
			$data['consigneedata']=$this->Transaction_model->getconsigneeedetails($id);}
		else{
			$data['consigneedata']="";
		}
		if($masterid!="0"){
			$data['estimate']=$this->Transaction_model->job_estimate_details($masterid);
			$data['estimatedata']=$this->Transaction_model->editestimateedetails($id);
		

		}
		else{
			$data['estimate']=0;
			$data['estimatedata']=0;
			$estmasterid=$this->Transaction_model->selectmaxid_estimatemaster($id);
			$estmasterid=$estmasterid+1;
			$data['estmasterid']=$estmasterid;
		
		}
		
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
		$data['uploadedfile']=$this->Transaction_model->selectuploaded_file($id); 
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/edit_job',$data);
		$this->load->view('includes/footer');
	}
	
	public function edit_consignment($id)
	{
		
		 $user_id=	$this->session->userdata('user_id');
		 $docid = $this->uri->segment(4);
		
		$data['value'] = $this->Shipper_model->list();
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
		$data['code']=$this->Transaction_model->selectcode();
		$data['codes']=$this->Transaction_model->selectcode_estimate();
		
		$data['clientlist']=$this->Transaction_model->list_client();
		$data['carrierlist']=$this->Transaction_model->list_carrier();
		$data['currencylist']=$this->Transaction_model->list_currency();
		$data['userlist']=$this->Transaction_model->list_user();
		$data['truck']=$this->Transaction_model->list_truck();
		$data['datadoc'] =$this->Transaction_model->job_updateForm($id);
		
		$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$data['values'] = $this->Transaction_model->getjobById($id);
		$data['doc'] =$this->Transaction_model->get_all_job_doc_all($id);
		$data['jobno'] = $this->Transaction_model->getmaxjobno();

		$masterid=$this->Transaction_model->getestimatemaster_id($id);
		$clientid=$this->Transaction_model->getclient_id($id);

		$consignorid=$this->Transaction_model->getconsigor_id($id);

		$consigneeid=$this->Transaction_model->getconsignee_id($id);

		if($clientid!="0")
		{	$data['clientdata']=$this->Transaction_model->getclinetdetails($id);}
		else{
			$data['clientdata']="";
		}
		if($consignorid!="0")
		{
			$data['consignordata']=$this->Transaction_model->getconsignordetails($id);}
		else{
			$data['consignordata']="";
		}
		if($consigneeid!="0")
		{
			$data['consigneedata']=$this->Transaction_model->getconsigneeedetails($id);}
		else{
			$data['consigneedata']="";
		}
		if($masterid!="0"){ 
			//$data['estimate']=$this->Transaction_model->job_estimate_details($masterid);
			$data['estimate']=$this->Transaction_model->job_estimate_expdetails($masterid); 
			$data['estimatedata']=$this->Transaction_model->editestimateedetails1($masterid);
			$data['expensedata']=$this->Transaction_model->editestimate_expense_edetails($masterid);  
			

		}
		else{
			$data['estimate']=0;
			$data['estimatedata']=0;
			$data['expensedata']=0;  
			$estmasterid=$this->Transaction_model->selectmaxid_estimatemaster($id);
			$estmasterid=$estmasterid+1;
			$data['estmasterid']=$estmasterid;
		
		}
		//var_dump($data['estimate']);die();
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
		$data['uploadedfile']=$this->Transaction_model->selectuploaded_file($id);
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/edit_consignment',$data);
		$this->load->view('includes/footer');
	}
	


    public function store()
	{
		$postdata=$this->input->post('postData');
		$result= $this->Transaction_model->add($postdata);		
		echo json_encode($result);
		
    }
	public function update()
	{	
		$postdata=$this->input->post('postData');
		$data=$postdata["postData1"];
		$Shippername=$postdata["Shippername"];
		$consignorname=$postdata["consignorname"];	
		$dummyid=$postdata["old_id"];	
		if($data["consignee_id"]==0 &&$Shippername!=NULL){
	
			$shipperd_Id=$this->Transaction_model->add_derault_shipper($Shippername);	
			$data["consignee_id"]=$shipperd_Id;

		}
		if($data["consignor_id"]==0 && $consignorname!=NULL){
	
			$consignor_id=$this->Transaction_model->add_derault_shipper($consignorname);	
			$data["consignor_id"]=$consignor_id;

		}
		if($Shippername==NULL){
			$data["consignee_id"]=75;
		}
		if($consignorname==NULL){
			$data["consignor_id"]=75;
		}
		$id=$postdata["id"];

			$result= $this->Transaction_model->update($id,$data);
			$result= $this->Transaction_model->update_job_documentid($dummyid,$id);
			
			echo json_encode($result);
		
	}
   //autocomplete textbox
	public function getshipperdata(){
        
        $data = $this->Transaction_model->getshippers();
        echo json_encode($data);
      }
	  public function getconsigneedata(){
        
        $data = $this->Transaction_model->getshippers();
        echo json_encode($data);
      }
	  public function getdescription($value)
	  {
			$result= $this->Transaction_model->list_description($value);
			echo json_encode($result);

	  }
		public function jobdetails($value)
		{
		   
			  $result= $this->Transaction_model->job_desc($value); 
			  echo json_encode($result);
			  
		  }
		  public function store_estimate()
		  {
			  $postdata=$this->input->post('postData');
			  $estimate_data=$postdata["estimate_master_details"];
			  $result= $this->Transaction_model->add_estimate($postdata["estimate_master"]);		
			  $my_values = array();	$my_values = array();
			  $invoiceids = array();
		  $count=0;
			  if($result!=0)
		  {
			  
			  foreach($estimate_data as $row)
			  {
				  $row["estimate_masterid"]=$result;
				  $row["vat"]=floatval($row["vat"]);
				  $row["total"]=$row["total"];
				 $id= $this->Transaction_model->add_estimatedetails($row);
				  $invoiceids[$count]=$id;
				  $my_values[] = $row;
				  $count=$count+1; 
			  }
		  }


		  $jobdata=$postdata["ExpenseDetails"];
		  $jobdeta=$postdata["ExpenseData"]; 
		
		if(!empty($jobdeta))
		{
		  foreach($jobdeta as $row1)
		  {   
			  $postid=$row1['postid'];
			  $PostingDate=$row1['postingdate'];
			  $JobID=$row1['jobid'];
			  $SupplierID=$row1['supplierid'];
			  $row1['EstMasterId']=$result;   
  
			  if($SupplierID!='')   {
			  $data=$this->Transaction_model->viewestmaster_expense($postid,$SupplierID); 
			  if(empty($data))
			  { 
			  
			  $result1=$this->Transaction_model->addestmaster_expense($row1);  
			  $SubTotal=0;  $VatTotal=0;$GrandTotal=0;
			  foreach($jobdata as $row)
			  {
				  
				  if($row1["supplierid"]==$row["SupplierID"])
				  {
				  $r["EstimateExpId"]=$result1;
				  $r["description"]=$row["description"];
				  $r["amount"]=$row["amount"];
				  $r["convfactor"]=$row["convfactor"];
				  $r["vat"]=$row["vat"];
				  $r["Extotal"]=$row["Extotal"];
				  $r["currency"]=$row["currency"];
				  $r["code"]=$invoiceids[$row["code"]];   
				  $r["vatpersentage"]=$row["vatpersentage"];
				  $r["expensequantity"]=$row["expensequantity"];
				  $r["unitpricesupp"]=$row["unitpricesupp"];
				  $r['EstMasterid']=$result;                           
  
				  $d=$this->Transaction_model->addestimate_expense($r);
				  $my_values[] = $row;
				  $SubTotal=$SubTotal + $row["amount"];
				  $VatTotal=$VatTotal + $row["vat"];
				  $GrandTotal=$GrandTotal + $row["Extotal"];
				  }
				  $up=$this->Transaction_model->estimateupdate_expense($SubTotal,$VatTotal,$GrandTotal,$result1); 
			  } 
		  
			 }  
		  }	
		  }
		  } 


		  echo json_encode($result);
			  
		  }

		public function store_jobestimate()
		{
			$postdata=$this->input->post('postData');
			$estimate_data=$postdata["estimate_master_details"];
			$result= $this->Transaction_model->add_estimate($postdata["estimate_master"]);		
			$my_values = array();
			$invoiceids = array();
		$count=0;
			if($result!=0)
		{
			
			foreach($estimate_data as $row)
			{
				$row["estimate_masterid"]=$result;
				$row["vat"]=floatval($row["vat"]);
				$row["total"]=$row["total"];
				$id=$this->Transaction_model->add_estimatedetails($row);
				$invoiceids[$count]=$id;
				$my_values[] = $row;
				$count=$count+1; 
			}
		}

		$jobdata=$postdata["ExpenseDetails"];
		$jobdeta=$postdata["ExpenseData"]; 
      
      if(!empty($jobdeta))
      {
		foreach($jobdeta as $row1)
		{   
            $postid=$row1['postid'];
			$PostingDate=$row1['postingdate'];
			$JobID=$row1['jobid'];
			$SupplierID=$row1['supplierid'];
			$row1['EstMasterId']=$result;   

			if($SupplierID!='')   {
			$data=$this->Transaction_model->viewestmaster_expense($postid,$SupplierID); 
			if(empty($data))
			{ 
			
			$result1=$this->Transaction_model->addestmaster_expense($row1);  
			$SubTotal=0;  $VatTotal=0;$GrandTotal=0;
			foreach($jobdata as $row)
			{
				
				if($row1["supplierid"]==$row["SupplierID"])
				{
				$r["EstimateExpId"]=$result1;
				$r["description"]=$row["description"];
				$r["amount"]=$row["amount"];
				$r["convfactor"]=$row["convfactor"];
				$r["vat"]=$row["vat"];
				$r["Extotal"]=$row["Extotal"];
				$r["currency"]=$row["currency"];
				$r["code"]=$invoiceids[$row["code"]];   
				$r["vatpersentage"]=$row["vatpersentage"];
				$r["expensequantity"]=$row["expensequantity"];
				$r["unitpricesupp"]=$row["unitpricesupp"];
				$r['EstMasterid']=$result;                           

				$d=$this->Transaction_model->addestimate_expense($r);
				$my_values[] = $row;
				$SubTotal=$SubTotal + $row["amount"];
				$VatTotal=$VatTotal + $row["vat"];
				$GrandTotal=$GrandTotal + $row["Extotal"];
				}
				$up=$this->Transaction_model->estimateupdate_expense($SubTotal,$VatTotal,$GrandTotal,$result1); 
			} 
		
	       }  
		}	
		}
		} 

		echo json_encode($result);
			
		}
		
		//list job details
		public function job_transactionlist()
		{	
			
			  $user_id=	$this->session->userdata('user_id');
			$res = $this->Permission_model->userdetails($user_id);
			$user_image['values']=$res[0]->user_image;
			$result['roles']=$this->Login_model->userdetails($user_id);
			//to add menus
			$data['values'] = $this->Transaction_model->listjobdetails();
			$result['permission']=$this->Login_model->select_all_menu($user_id);
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

			$this->load->view('includes/header',$user_image);
			$this->load->view('includes/navigation',$result,$user_image);
			$this->load->view('transaction/list_jobtransaction',$data);
			$this->load->view('includes/footer');
	
		}
// List Consignment
		public function job_consignment()
		{	
			
			$user_id=	$this->session->userdata('user_id');
			$res = $this->Permission_model->userdetails($user_id);
			$user_image['values']=$res[0]->user_image;
			$result['roles']=$this->Login_model->userdetails($user_id);
			$data['jobid'] = $this->Transaction_model->listjobdetails(); 
			$data['values'] = $this->Transaction_model->listestimatedetails(); 
			$result['permission']=$this->Login_model->select_all_menu($user_id);
			$user_image['cmpnydata']=$this->Transaction_model->basic_company_details(); 

			$this->load->view('includes/header',$user_image);
			$this->load->view('includes/navigation',$result,$user_image);
			$this->load->view('transaction/list_consignment',$data);
			$this->load->view('includes/footer');
	
		}
		
public function jobclosed_status($id)
	{
        $result = $this->Transaction_model->jobclosed_status($id);
		redirect('list-job');
	}
	public function update_estimate()
	{
		 $data=$this->input->post('postData');
		
		$estimate=$data["estimate_master_details"];
		$id=$data["Id"];
		$deletedids=$data["deleted"];
		$dat=$data["Dat"];
		
		if($dat==0)
		{

		$id1=$this->Transaction_model->insert_estimatemaster($data["estimate_master"]);
		$invoiceids = array();
		$count=0;
		}
		else{
			$result=$this->Transaction_model->update_estimatemaster($id,$data["estimate_master"]);
			$id1=$id;
		}
		$my_values = array();
		
		if($estimate!="")
		{
		foreach($estimate as $row)
		{
				$row["estimate_masterid"]=$id1;
				$row["vat"]=floatval($row["vat"]);
				$row["total"]=floatval($row["total"]);
				$this->Transaction_model->insert_estimatedetails($row);
				$invoiceids[$count]=$id;
				$my_values[] = $row;
				$count=$count+1; 
		}
		}                                                
///////////////////////Edit Estimate expense $result
      
$jobdata=$data["ExpenseDetails"];  
		$jobdeta=$data["ExpenseData"];   
		if(!empty($jobdeta))
		{
		foreach($jobdeta as $row1)
		{   
            $postid=$row1['postid'];
			$PostingDate=$row1['postingdate'];
			$JobID=$row1['jobid'];
			$SupplierID=$row1['supplierid'];
			$row1['EstMasterId']=$id1; 
            if($SupplierID!='')   
			{
			$data=$this->Transaction_model->viewjobmaster_expense($postid,$SupplierID); 
			if(empty($data))
			{ 
			
			$result1=$this->Transaction_model->addjobmaster_expense($row1); 
			$SubTotal=0;  $VatTotal=0;$GrandTotal=0;
			foreach($jobdata as $row)
			{
				
				if($row1["supplierid"]==$row["SupplierID"])
				{
					$r["EstimateExpId"]=$result1;
					$r["description"]=$row["description"];
					$r["amount"]=$row["amount"];
					$r["convfactor"]=$row["convfactor"];
					$r["vat"]=$row["vat"];
					$r["Extotal"]=$row["Extotal"];
					$r["currency"]=$row["currency"];
					$r["code"]=$invoiceids[$row["code"]]; 
					$r["vatpersentage"]=$row["vatpersentage"];
					$r["expensequantity"]=$row["expensequantity"];
					$r["unitpricesupp"]=$row["unitpricesupp"];
					$r['EstMasterid']=$id1; 

				$this->Transaction_model->addjobinvoicedetailsinsert_expense($r);
				$my_values[] = $row;
				$SubTotal=$SubTotal + $row["amount"];
				$VatTotal=$VatTotal + $row["vat"];
				$GrandTotal=$GrandTotal + $row["Extotal"];
				}
				$up=$this->Transaction_model->expensemaster_expense($SubTotal,$VatTotal,$GrandTotal,$result1); 
			} 
		
	       }  


        else
		{
            $result1=$data[0]->EstimateExpId;
            $SubTotal=$data[0]->subtotal;  $VatTotal=$data[0]->vattotal; $GrandTotal=$data[0]->grandtotal;
			foreach($jobdata as $row)
			{
				
				if($row1["supplierid"]==$row["SupplierID"])
				{
					$r["EstimateExpId"]=$result1;
					$r["description"]=$row["description"];
					$r["amount"]=$row["amount"];
					$r["convfactor"]=$row["convfactor"];
					$r["vat"]=$row["vat"];
					$r["Extotal"]=$row["Extotal"];
					$r["currency"]=$row["currency"];
					$r["code"]=$row["code"];
					$r["vatpersentage"]=$row["vatpersentage"];
					$r["expensequantity"]=$row["expensequantity"];
					$r["unitpricesupp"]=$row["unitpricesupp"];
					$r['EstMasterid']=$id1; 

				$this->Transaction_model->addjobinvoicedetailsinsert_expense($r);
				$my_values[] = $row;
				$SubTotal=$SubTotal + $row["amount"];
				$VatTotal=$VatTotal + $row["vat"];
				$GrandTotal=$GrandTotal + $row["Extotal"];
				}
				$up=$this->Transaction_model->expensemaster_expense($SubTotal,$VatTotal,$GrandTotal,$result1); 
			} 

		}
	  }
			
		} 
	}




	

		if($deletedids!="")
		{
		foreach($deletedids as $row)
		{
				$id=$row['id'];;
				$result=$this->Transaction_model->delete_estimatedetails($id);

				$ids=$row['eid'];
				$data=$this->Transaction_model->viewjobdetails_expense($ids); 
				$mid=$data[0]->EstimateExpId;
				$Amount=$data[0]->amount;
				$Vat=$data[0]->vat;
				$Total=$data[0]->Extotal;
                  
				$master=$this->Transaction_model->viewmasterdata_expense($mid);  //print_r($mid);die();
                $SubTotal=$master[0]->subtotal;
				$VatTotal=$master[0]->vattotal;
				$GrandTotal=$master[0]->grandtotal;

				$sub=$SubTotal-$Amount;
				$VatT=$VatTotal-$Vat;
				$GrandT=$GrandTotal-$Total;
                $up=$this->Transaction_model->expensemaster_expense($sub,$VatT,$GrandT,$mid); 
				$masternull=$this->Transaction_model->viewmasterdata_expense($mid);
				if($masternull[0]->grandtotal ==0)
				{
					$results=$this->Transaction_model->deletexpensmaser($mid);
				}

				$result=$this->Transaction_model->deletexpenseedetailsinsert($ids);
			
		}
	}
	echo json_encode($id1);
	}
	
	//print estimate details
	public function estimate_print($estimateid)
		{
			$estimateid = $estimateid; 
			$result['estimatedata'] = $this->Transaction_model->estimatemaster_details($estimateid);
			$clientid=$this->Transaction_model->getclient_id_est($estimateid);

			$consignorid=$this->Transaction_model->getconsigor_id_est($estimateid);
	
			$consigneeid=$this->Transaction_model->getconsignee_id_est($estimateid);

			if($clientid!="0"){
			$result['client_data'] = $this->Transaction_model->client_details($estimateid);
	    	}
			else{
				$result['client_data']="0";
			}
			if($consignorid!="0")
			{
				$result['consignor_data'] = $this->Transaction_model->consignor_details($estimateid);}
				else{
				$result['consignor_data']="0";
			}
			if($consigneeid!="0")
			{
				$result['consignee_data'] = $this->Transaction_model->consignee_details($estimateid);}
				else{
				$result['consignee_data']="0";
			}
			
			$result['companyinfo']=$this->Transaction_model->basic_company_details();
			$result['estimate'] = $this->Transaction_model->estimate_details($estimateid);
			$result['invoiceinfo'] = $this->Transaction_model->basic_invoice_details();
if(($result['estimatedata'])=="NULL")
{
	$result['estimatedata']=0;
}

if(($result['estimate'])=="NULL")
{
	$result['estimate']=0;
}	
if(($result['invoiceinfo'])=="NULL")
{
	$result['invoiceinfo']=0;
}	
//var_dump($result['estimate']);die();
$this->load->view('transaction/jobestimate_print', $result);
	}
	
	//autocompleat description box
public function getdescriptiondata()
{
	$data = $this->Transaction_model->getdescriptiondata();
	echo json_encode($data);
  }
		  //to upload files
		  
	public function images_upload($id)
	{
	   
	//	$job_id=$this->Transaction_model->selectjobid();
$job_id=$id;
$doc_type = $this->input->post('doc_type');
		$file_name=$_FILES['file']['name'];
		$file_type=$_FILES['file']['type'];
		$extension = substr($file_name, strpos($file_name, ".") + 1);    
		do
		{
			$image_name=$this->randomkey();
			$image_name=$image_name.".".$extension;
			$result=$this->Transaction_model->check_filename($image_name);
		}while ($result!=0);
		if ( ! empty($_FILES)) 
		{
			$data_array=array('job_id'=>$job_id,'file_path'=>$image_name,'name'=>$file_name);
		}
			$config['upload_path'] = UPLOAD_PATH;
			$config["allowed_types"] = "gif|jpg|png|pdf";
			$config['max_size'] = '1024'; // max_size in kb
			$config['file_name']=$image_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file'))
			{
				$error = array('error' => $this->upload->display_errors());
			
			}
            else
            {
				$news_image_id=$this->Transaction_model->insert_image_data($data_array);

              $image_data = $this->upload->data();
            //  $data = $this->resize_news_image($image_data);
              echo $news_image_id;
            }
	}
	public function randomkey()
	{
	  $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	  for ($i = 0; $i < 25; $i++)
	  {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
	  }
	  $reference_code= implode($pass);
	  return $reference_code;
	}
	//to remove uploaded files
	public function images_remove()
	{
		echo $file = $this->input->post("file");
		$image_name=$this->Transaction_model->fetch_image_name($file);
		if ($file && file_exists($this->upload_path . "/" . $image_name)) {
			unlink($this->upload_path . "/" . $image_name);
			$this->Transaction_model->remove_image($image_name);
		}
	}

	//to remove file inside edit
	
	public function remove_uploadedfile($id)
	{
		$data['doc'] =$this->Transaction_model->get_all_job_doc_all($id);
		$result=$this->Transaction_model->deleteimages($id);

	}
	public function update_job_doc_ajax()
		 {
			$postData = [
				'job_id'           => $this->input->post('new_id',true)	
			];  
			$this->Transaction_model->update_job_documentid($this->input->post('old_id',true),$postData);
		}

	

		public function create_job_doc_ajax()
		{ 
			
						   $file_name = time().$_FILES["fileupld"]['name'];     
						// $config['upload_path']   = base_url('/assets/images/'); 
							$config['upload_path']   ='./assets/images/'; 
							$config['allowed_types'] = 'gif|jpg|png|pdf|csv|doc|docx'; 
							$config['file_name'] = $file_name; 
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('fileupld')) {

								
							   $error = array('error' => $this->upload->display_errors()); 
							
							}
						
		
	$filepath='assets/images/'.$file_name;  
			  $emp_documnts = [
					'job_id'    => $this->input->post('job_id'),
				
					'doc_type'     => $this->input->post('doc_type'),
					
					'file_path' 	      => $filepath
					// 'IsActive'   => 1,
					
				]; 
				$jobid=$this->input->post('job_id');

				$did=$this->Transaction_model->job_doc_create($emp_documnts);
				if ($did) { 
				 
			    $data['did']=$did;
				$data['file_name']=$file_name; 
				echo json_encode($data);

				} 
				else {
					echo "error";
				}
	
		    
		}

		public function delete_doc($id=null){
			
           
			$this->Transaction_model->document_delete($id);
			$url = redirect('edit-job',$id);
			echo $url;
			die();

		}
		public function delete_documents($id){
			
           
			$this->Transaction_model->document_delete($id);
		 echo $id;

		}

}
