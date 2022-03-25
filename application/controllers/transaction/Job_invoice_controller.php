<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_invoice_controller extends CI_Controller {

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
     $this->load->model('transaction/Job_invoice_model');
	 $this->load->model('transaction/Transaction_model');
	 $this->load->model('transaction/Supplier_expensemodel');

	}

	
	public function job_invoice($id)
	{
		 $user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
       	$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
        $result['bank']=$this->Job_invoice_model->select_all_bank();
        $result['jobdata']=$this->Job_invoice_model->select_job_details($id);
		$result['supcode']=$this->Supplier_expensemodel->selectcode();
        $result['currency']=$this->Job_invoice_model->select_currency();
		//$result['Inv']=$this->Job_invoice_model->selectcode();
		$Inv=$this->Job_invoice_model->selectcodeid();
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
        $result['code']=$this->Supplier_expensemodel->selectcode();
		$result['job']=$this->Supplier_expensemodel->select_all_job();
		if(($Inv)=='1'){$result['Inv']=1;}
		else{$result['Inv']=$Inv[0]->Inv; } 
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/job_invoice',$result);
		$this->load->view('includes/footer');
    }

	public function new_invoice()
	{
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
       	$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
        $result['bank']=$this->Job_invoice_model->select_all_bank();
		$result['supcode']=$this->Supplier_expensemodel->selectcode();
        $result['currency']=$this->Job_invoice_model->select_currency();
		$Inv=$this->Job_invoice_model->selectcodeid();
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
        $result['code']=$this->Supplier_expensemodel->selectcode();
		$result['job']=$this->Supplier_expensemodel->select_all_job();
		if(($Inv)=='1'){$result['Inv']=1;}
		else{$result['Inv']=$Inv[0]->Inv; } 
		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/new_invoice',$result);
		$this->load->view('includes/footer');
    }

    public function estimate_invoice($masterid)
	{
		
		$estimate=$this->Transaction_model->job_estimate_details($masterid); //jm_estimate_master_details
		$estimatemaster=$this->Transaction_model->estimateedetails($masterid);
		$Inv=$this->Job_invoice_model->selectcodeid(); 
		$month = date('m');
   $day = date('d');
   $year = date('Y');
		if(($Inv)=='1'){$iv=1;}
		else{$Invv=$Inv[0]->Inv; } 
		 $pieces = str_split($Invv, 12);
        $iv=$pieces[1]+1;    $inv1= "INV/".$year."/".$month."/".$iv;
		// foreach($Inv as $r)
		// 	{$inv=$r->Inv;  $inv1=$inv+1;}
        $today =date('Y-m-d'); 
		foreach($estimatemaster as $row)
			{
				$data=array(
				"Inv"=>$inv1,
				"Date"=>$today,
				"JobId"=>$row->job_id,
				"Total"=>$row->total_amount,
				"VatTotal"=>$row->tax_amount,
				"Bank"=>1,
				"Status"=>'Drafted',
				"Active"=>'active',
				"InvoiceType"=>'credit',
				"GrandTotal"=>$row->grand_total,);
				$master=	$this->Job_invoice_model->addjobmaster($data); 
				$ids=$row->estimate_masterid;
				$db=	$this->Job_invoice_model->updatejobmaster($ids); 

			}

			foreach($estimate as $rowa)
			{
				$data1=array(
				"Description"=>$rowa->description,
				"UnitPrice"=>$rowa->unitprice,
				"Currency"=>$rowa->unit_type,
				"ConvFactor"=>$rowa->conv_factor,
				"Quantity"=>$rowa->quantity,
				"Vat"=>$rowa->vat,
				"Total"=>$rowa->subtotal,
				"InvoiceMasterId"=>$master, );
				$this->Job_invoice_model->addjobinvoicedetailsinsert($data1);
				
			}

			$invid=$master; 
		

		redirect(base_url()."invoice-print/".$invid);
	
	}


    public function getdata($value)
    {
	
          $result= $this->Job_invoice_model->list_description($value);
          echo json_encode($result);
            
	  }

	  public function get_covfactor($value)
	  {
		
			$result= $this->Job_invoice_model->get_covnfactor($value); 
			echo json_encode($result);
			  
	}

public function insert_job_details()
	{

		 $data=$this->input->post('postData');
	
		$jobdata=$data["JobDetails"]; 
		$result=$this->Job_invoice_model->addjobmaster($data["JobData"]);
		$my_values = array();
		$invoiceids = array();
		$count=0;
		if($result!=0)
		{
			
			foreach($jobdata as $row)
			{
				$row["InvoiceMasterId"]=$result;
				$row["Vat"]=floatval($row["Vat"]);
				$row["Total"]=floatval($row["Total"]);
				$id=$this->Job_invoice_model->addjobinvoicedetailsinsert($row);
				$invoiceids[$count]=$id;
				$my_values[] = $row;
				$count=$count+1;
			}
		} ///expense details


        $jobdata=$data["ExpenseDetails"]; 
		$jobdeta=$data["ExpenseData"]; 
      
      if(!empty($jobdeta))
      {
		foreach($jobdeta as $row1)
		{   
            $postid=$row1['PostId'];
			$PostingDate=$row1['PostingDate'];
			$JobID=$row1['JobID'];
			$SupplierID=$row1['SupplierID'];
			$row1['InvMasterId']=$result;   

			if($SupplierID!='')   {
			$data=$this->Job_invoice_model->viewjobmaster_expense($postid,$SupplierID); 
			//if($data[0]=='' or $data[0]->PostId != $postid or $data[0]->PostId=='') 
			if(empty($data))
			{ 
		
			$result1=$this->Job_invoice_model->addjobmaster_expense($row1);   	
			$SubTotal=0;  $VatTotal=0;$GrandTotal=0;
			foreach($jobdata as $row)
			{
				
				if($row1["SupplierID"]==$row["SupplierID"])
				{
				$r["ExpenseMasterId"]=$result1;
				$r["Description"]=$row["Description"];
				$r["Amount"]=$row["Amount"];
				$r["ConvFactor"]=$row["ConvFactor"];
				$r["Vat"]=$row["Vat"];
				$r["Total"]=$row["Total"];
				$r["Currency"]=$row["Currency"];
				$r["Code"]= $invoiceids[$row["Code"]];
				$r["vat_persentage"]=$row["vat_persentage"];
				$r["expense_quantity"]=$row["expense_quantity"];
				$r["unitprice_supp"]=$row["unitprice_supp"];
				$r['InvMasterid']=$result; 

				$this->Job_invoice_model->addjobinvoicedetailsinsert_expense($r);
				$my_values[] = $row;
				$SubTotal=$SubTotal + $row["Amount"];
				$VatTotal=$VatTotal + $row["Vat"];
				$GrandTotal=$GrandTotal + $row["Total"];
				}
				$up=$this->Job_invoice_model->expensemaster_expense($SubTotal,$VatTotal,$GrandTotal,$result1); 
			} 
		
	       }  
		}	
		}
		} 
		//  $my_values = array();
		// if($result1!=0)
		// {
			
		// 	foreach($jobdata as $row)
		// 	{
		// 		$row["ExpenseMasterId"]=$result1;
		// 		$this->Job_invoice_model->addjobinvoicedetailsinsert_expense($row);
		// 		$my_values[] = $row;
		// 	}
		// }  
 
	echo json_encode($result);	
		
		
	}


	public function insert_expense_details()
	{

		$data=$this->input->post('postData');
		$jobdata=$data["ExpenseDetails"];
		$jobdeta=$data["ExpenseData"];

		foreach($jobdeta as $row1)
		{   
            $postid=$row1['PostId'];
			$PostingDate=$row1['PostingDate'];
			$JobID=$row1['JobID'];
			$SupplierID=$row1['SupplierID'];
			$data=$this->Job_invoice_model->viewjobmaster_expense($postid,$SupplierID); 
			if($data[0]->PostId != $postid or $data[0]->PostId=='') {
			
			$result1=$this->Job_invoice_model->addjobmaster_expense($row1); 
			$SubTotal=0;  $VatTotal=0;$GrandTotal=0;
			foreach($jobdata as $row)
			{
				

				if($row1["SupplierID"]==$row["SupplierID"])
				{
				$r["ExpenseMasterId"]=$result1;
				$r["Description"]=$row["Description"];
				$r["Amount"]=$row["Amount"];
				$r["ConvFactor"]=$row["ConvFactor"];
				$r["Vat"]=$row["Vat"];
				$r["Total"]=$row["Total"];
				$r["Currency"]=$row["Currency"];
				$r["Code"]=$row["Code"];
				$r["vat_persentage"]=$row["vat_persentage"];
				$r["expense_quantity"]=$row["expense_quantity"];

				$this->Job_invoice_model->addjobinvoicedetailsinsert_expense($r);
				$my_values[] = $row;
				$SubTotal=$SubTotal + $row["Amount"];
				$VatTotal=$VatTotal + $row["Vat"];
				$GrandTotal=$GrandTotal + $row["Total"];
				}
				$up=$this->Job_invoice_model->expensemaster_expense($SubTotal,$VatTotal,$GrandTotal,$result1); 
			}
		
	       }
			
		}
		 $my_values = array();
		if($result1!=0)
		{
			
			foreach($jobdata as $row)
			{
				$row["ExpenseMasterId"]=$result1;
				$this->Job_invoice_model->addjobinvoicedetailsinsert_expense($row);
				$my_values[] = $row;
			}
		}
		
		echo json_encode($result1);
		
	}	

	
	public function perfomainvoice_print($invid)
	{
		$invid=$invid;
		$result['invoicedata']=$this->Job_invoice_model->selectinvoicedetails($invid); 
		 $result['invoice']=$this->Job_invoice_model->select_job_invoice_details($invid);
		 $result['companyinfo']=$this->Transaction_model->basic_company_details();
		 $result['invoiceinfo']=$this->Transaction_model->basic_invoice_details();
		 
	//	var_dump($result);die();
		$this->load->view('transaction/perfoma-invoice',$result);
	
	}

	public function invoice_print($invid)
	{
		$invid=$invid;
		$result['invoicedata']=$this->Job_invoice_model->selectinvoicedetails($invid);
		 $result['invoice']=$this->Job_invoice_model->select_job_invoice_details($invid);
		 $result['companyinfo']=$this->Transaction_model->basic_company_details();
		 $result['invoiceinfo']=$this->Transaction_model->basic_invoice_details();
		
		$this->load->view('transaction/invoice',$result); 
	
	}
	//Edit job-invoice
		
	public function edit_job_invoice($id)
	{
		$invid=$id;
		$user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
       	$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$data['bank']=$this->Job_invoice_model->select_all_bank();
		$data['currency']=$this->Job_invoice_model->select_currency();

		$invoicedata=$this->Job_invoice_model->editinvoicedetails($invid);
		$data['invoicedata']=$invoicedata;
		$data['expensedata']=$this->Job_invoice_model->editexpensedetails($invid);
		$data['invoice']=$this->Job_invoice_model->select_job_invoice_details_all($invid); //var_dump($data['invoice']);die();
		$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/edit_job_invoice',$data);
		$this->load->view('includes/footer');
	}
	

	public function update_jobInvoice_details()
	{

		$data=$this->input->post('postData');
	
		$jobdata=$data["JobDetails"];
		$id=$data["Id"];
		$deletedids=$data["deleted"];
	
		$result=$this->Job_invoice_model->updateJobinvoicemaster_InvoiceMasterId($id,$data["JobData"]);
		$my_values = array();
		if($jobdata!="")
		{
		foreach($jobdata as $row)
		{
				$row["InvoiceMasterId"]=$id;
				$row["Vat"]=floatval($row["Vat"]);
				$row["Total"]=floatval($row["Total"]);
				$this->Job_invoice_model->insertjobinvoicedetails($row);
				$my_values[] = $row;
		}
		}
		/////expense edit
        
		
		$jobdata=$data["ExpenseDetails"];
		$jobdeta=$data["ExpenseData"]; 
		if(!empty($jobdeta))
		{
		foreach($jobdeta as $row1)
		{   
            $postid=$row1['PostId'];
			$PostingDate=$row1['PostingDate'];
			$JobID=$row1['JobId'];
			$SupplierID=$row1['SupplierID'];
			$row1['InvMasterId']=$result; 
            if($SupplierID!='')   
			{
			$data=$this->Job_invoice_model->viewjobmaster_expense($postid,$SupplierID); 
			if(empty($data))
			{ 
			
			$result1=$this->Job_invoice_model->addjobmaster_expense($row1); 
			$SubTotal=0;  $VatTotal=0;$GrandTotal=0;
			foreach($jobdata as $row)
			{
				
				if($row1["SupplierID"]==$row["SupplierID"])
				{
				$r["ExpenseMasterId"]=$result1;
				$r["Description"]=$row["Description"];
				$r["Amount"]=$row["Amount"];
				$r["ConvFactor"]=$row["ConvFactor"];
				$r["Vat"]=$row["Vat"];
				$r["Total"]=$row["Total"];
				$r["Currency"]=$row["Currency"];
				$r["Code"]=$row["Code"];
				$r["vat_persentage"]=$row["vat_persentage"];
				$r["expense_quantity"]=$row["expense_quantity"];
				$r["unitprice_supp"]=$row["unitprice_supp"];
				$r['InvMasterid']=$result; 

				$this->Job_invoice_model->addjobinvoicedetailsinsert_expense($r);
				$my_values[] = $row;
				$SubTotal=$SubTotal + $row["Amount"];
				$VatTotal=$VatTotal + $row["Vat"];
				$GrandTotal=$GrandTotal + $row["Total"];
				}
				$up=$this->Job_invoice_model->expensemaster_expense($SubTotal,$VatTotal,$GrandTotal,$result1); 
			} 
		
	       }  


        else
		{
            $result1=$data[0]->ExpenseMasterId;
            $SubTotal=$data[0]->SubTotal;  $VatTotal=$data[0]->VatTotal; $GrandTotal=$data[0]->GrandTotal;
			foreach($jobdata as $row)
			{
				
				if($row1["SupplierID"]==$row["SupplierID"])
				{
				$r["ExpenseMasterId"]=$result1;
				$r["Description"]=$row["Description"];
				$r["Amount"]=$row["Amount"];
				$r["ConvFactor"]=$row["ConvFactor"];
				$r["Vat"]=$row["Vat"];
				$r["Total"]=$row["Total"];
				$r["Currency"]=$row["Currency"];
				$r["Code"]=$row["Code"];
				$r["vat_persentage"]=$row["vat_persentage"];
				$r["expense_quantity"]=$row["expense_quantity"];
				$r["unitprice_supp"]=$row["unitprice_supp"];
				$r['InvMasterid']=$result; 

				$this->Job_invoice_model->addjobinvoicedetailsinsert_expense($r);
				$my_values[] = $row;
				$SubTotal=$SubTotal + $row["Amount"];
				$VatTotal=$VatTotal + $row["Vat"];
				$GrandTotal=$GrandTotal + $row["Total"];
				}
				$up=$this->Job_invoice_model->expensemaster_expense($SubTotal,$VatTotal,$GrandTotal,$result1); 
			} 

		}
	  }
			
		} 
	}


		if($deletedids!="")
		{
		foreach($deletedids as $row)
		{
				$id=$row['id'];
				$result=$this->Job_invoice_model->deleteinvoicedetailsinsert($id);
                  
				$ids=$row['eid'];
                
				$data=$this->Job_invoice_model->viewjobdetails_expense($ids);
				$mid=$data[0]->ExpenseMasterId;
				$Amount=$data[0]->Amount;
				$Vat=$data[0]->Vat;
				$Total=$data[0]->Total;
                  
				$master=$this->Job_invoice_model->viewmasterdata_expense($mid);
                $SubTotal=$master[0]->SubTotal;
				$VatTotal=$master[0]->VatTotal;
				$GrandTotal=$master[0]->GrandTotal;

				$sub=$SubTotal-$Amount;
				$VatT=$VatTotal-$Vat;
				$GrandT=$GrandTotal-$Total;
                $up=$this->Job_invoice_model->expensemaster_expense($sub,$VatT,$GrandT,$mid); 
				$masternull=$this->Job_invoice_model->viewmasterdata_expense($mid);
				if($masternull[0]->GrandTotal ==0)
				{
					$results=$this->Job_invoice_model->deletexpensmaser($mid);
				}

				$result=$this->Job_invoice_model->deletexpenseedetailsinsert($ids);
			
		}
	    }
echo $result;
	}


	public function change_invoice_status($invmasterid,$clientid)
	{
	

		$result=$this->Job_invoice_model->change_invoice_status($invmasterid);
		$data=$this->Job_invoice_model->select_invoice_data($invmasterid);
		$datadetails=$this->Job_invoice_model->select_invoicedetails_data($invmasterid);
		


		foreach($data as $row)
		{
		  $amount=$row->GrandTotal;
		  $vatamnt=$row->VatTotal;
		  $date=$row->Date;
		
		  $jobid=$row->JobId;
		  $inv=$row->Inv;

		  $narration="Invoice .$inv. created for JobNo:.$jobid. ,debited Amount:.$amount.";
		  $type="Invoice";
		  $narrationvat="Invoice .$inv. created for JobNo:.$jobid. ,VAT Amount:.$amount.";
		  $typevat="VAT";
		  $chequeid=0;
		}

		$clientledgerid=$this->Job_invoice_model->select_client_ledgerid($clientid);
		$result1=$this->Job_invoice_model->insert_into_accountmaster($clientledgerid,$amount,$date,$narration,$type,$chequeid);
		foreach($datadetails as $row)
		{
		  $vatamnt=$row->Vat;
		  $vatper=$row->VAT_percentage;
		  $narrationvat="Invoice .$inv. created for JobNo:.$jobid. ,VAT Amount:.$vatamnt.";
		  $typevat="VAT";
		  $chequeid=0;
		  if($vatamnt !=0){
		  $result2=$this->Job_invoice_model->insert_into_accountmaster_vatentry($vatamnt,$date,$narrationvat,$typevat,$chequeid,$vatper);
		  }
		}
	

//redirect(base_url()."invoice-print/".$invmasterid);
redirect(base_url()."perfomainvoice-print/".$invmasterid);
	}
	public function getsupplierdata(){
        
        $data = $this->Supplier_expensemodel->getsupplier();
        echo json_encode($data);
	}
	
	public function getdatasupplierexpense($value)
    {
	
          $result= $this->Supplier_expensemodel->list_description($value);
          echo json_encode($result);
            
	  }
	  
}