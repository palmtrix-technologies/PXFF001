<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_receipt_controller extends CI_Controller {

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
         $this->load->model('transaction/Payment_receipt_model');
         $this->load->model('transaction/job_invoice_model');
         $this->load->model('transaction/Transaction_model');

     	}

         public function receipt($id)
         {
              $user_id=	$this->session->userdata('user_id');
             $res = $this->Permission_model->userdetails($user_id);
             $result['roles']=$this->Login_model->userdetails($user_id);
                $user_image['values']=$res[0]->user_image;
             $result['permission']=$this->Login_model->select_all_menu($user_id);
             $result['bank']=$this->Payment_receipt_model->select_all_bank();
             $result['client']=$this->Payment_receipt_model->select_client_details($id);
             $result['receiptcode']=$this->Payment_receipt_model->selectcode();
             $result['invno']=$this->Payment_receipt_model->select_invoice_number($id);
             $user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
      $result['currency']=$this->Payment_receipt_model->select_currency();

             $this->load->view('includes/header',$user_image);
             $this->load->view('includes/navigation',$result,$user_image);
             $this->load->view('transaction/payment_receipt',$result);
             $this->load->view('includes/footer');
       
         }
         public function payment_receipt_select_client_details($value)
         {
         
             
                   $result= $this->Payment_receipt_model->paymentreceipt_selectclientdetails($value);
                 //   var_dump($result);
                 //   die();
                   echo json_encode($result);
                     
               }
               //to insert data into tables
                 
                      
          public function insert_payment_receipt()
          {
      
               $data=$this->input->post('postData');
          $clientid=$data["Clientid"];
          $mode=$data["Mode"];

              $receiptdata=$data["PaymentReceiptDetails"];
              if($mode!="cash")
              {
              $result2=$this->Payment_receipt_model->insert_account_chequedetails($data["Chequedata"]);
              }
           
              $result=$this->Payment_receipt_model->insert_receiptmaster($data["PaymentReceiptData"]);
              $my_values = array();
              if($result!=0)
              {
                  
                  foreach($receiptdata as $row)
                  {
                    
                      $row["ReceiptMasterId"]=$result;
                   
                      $row["Total"]=floatval($row["Total"]);
                    $data["InvoiceMasterId"]=$row["InvoiceMasterID"];
                 
                      $this->Payment_receipt_model->insert_receiptdetails($row);
                      
                      $this->Payment_receipt_model->changeinvoivemasterstatus($data,$row["status"]);

                      $my_values[] = $row;
                  }
              }
              $data=$this->Payment_receipt_model->select_receipt_data($result);

              foreach($data as $row)
              {
                $amount=$row->SubTotal;
                $date=$row->Date;
                $narration="Payment from client, Amount:.$amount.";
                $type="Receipt";
                $bankid=$row->BankID;
              }

              $clientledgerid=$this->Payment_receipt_model->select_client_ledgerid($clientid);
              if($mode=="cash")
            {
                $result2="";
              $result1=$this->Payment_receipt_model->insert_into_accountmaster($clientledgerid,$amount,$date,$narration,$type,$result2);
            }
            else{
                $bid=$this->Payment_receipt_model->select_bank_ledgerid($bankid);
                $result1=$this->Payment_receipt_model->insert_into_accountmaster_bank($bid,$clientledgerid,$amount,$date,$narration,$type,$result2);

            }
              echo json_encode($result);
 
          }  


          //To edit payment receipt
          public function edit_job_payment_receipt($id)
	{
       
		$id=$id;
		 $user_id=	$this->session->userdata('user_id');
		$res = $this->Permission_model->userdetails($user_id);
		$result['roles']=$this->Login_model->userdetails($user_id);
       	$user_image['values']=$res[0]->user_image;
		$result['permission']=$this->Login_model->select_all_menu($user_id);
		$data['bank']=$this->job_invoice_model->select_all_bank();
		$data['detaildata']=$this->Payment_receipt_model->select_clinet_payment_receipt_detail($id);
		$data['receiptmasterdata']=$this->Payment_receipt_model->fetch_clinet_payment_receipt_master($id);
        $data['invno']=$this->Payment_receipt_model->select_invoice_number($id);
// var_dump($data['receiptmasterdata']);
// die();
$user_image['cmpnydata']=$this->Transaction_model->basic_company_details();
$data['currency']=$this->Payment_receipt_model->select_currency();

		$this->load->view('includes/header',$user_image);
		$this->load->view('includes/navigation',$result,$user_image);
		$this->load->view('transaction/edit_payment_receipt',$data);
		$this->load->view('includes/footer');
	}
	
//update job-invoice


public function update_payment_receipt_details()
{

     $data=$this->input->post('postData');
    
    $receiptdata=$data["ReceiptDetails"];
    $id=$data["Id"];
    $deletedids=$data["deleted"];
    $result=$this->Payment_receipt_model->updatepaymentreceiptmaster($id,$data["ReceiptData"]);
    $my_values = array();
    if($receiptdata!="")
    {
    foreach($receiptdata as $row)
    {
            $row["ReceiptMasterId"]=$id;
            // $row["Vat"]=floatval($row["Vat"]);
            $row["Total"]=floatval($row["Total"]);
            $this->Payment_receipt_model->insertpaymentreceiptdetails($row);
            $my_values[] = $row;
    }
    }
    if($deletedids!="")
    {
    foreach($deletedids as $row)
    {
            $id=$row;
            $result=$this->Payment_receipt_model->deletepaymentreceiptdetails($id);
        
    }
}
echo $result;
}
//print payment receipt
public function payment_receipt_print($id)
{
    $ID=$id;

    $result['receiptdata']=$this->Payment_receipt_model->selectreceiptdetails($ID);
     $result['receiptdetails']=$this->Payment_receipt_model->select_payment_receipt_details($ID);
     $result['companyinfo']=$this->Transaction_model->basic_company_details();
	 $result['invoiceinfo']=$this->Transaction_model->basic_invoice_details();
   $this->load->view('transaction/payment_receipt_print',$result);

}
}