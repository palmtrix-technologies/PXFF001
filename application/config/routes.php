<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/




$route['default_controller'] = 'Login_Control';
$route['Home'] = 'Login_Control/login';
$route['user-home'] = 'Login_Control/userhome';
$route['login'] = 'Login_Control/logout';
$route['forgot-password-page'] = 'Login_Control/viewforgotpassword';
$route['forgot-password'] = 'Login_Control/forgot_password';
$route['new-password'] = 'Login_Control/newpassword';
//$route['default_controller'] = 'usermanagement/Login/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// permission
$route['permission'] = 'Usermanagement/Permission/index';

$route['permission-create'] = 'Usermanagement/Permission/create';
$route['permission-edit/(:any)'] = 'Usermanagement/Permission/edit/$1';
//js permission
$route['permission-store'] = 'Usermanagement/Permission/store';
$route['permission-update'] = 'Usermanagement/Permission/update';
//roles
$route['roles'] = 'Usermanagement/Roles/index';
$route['roles-create'] = 'Usermanagement/Roles/create';
$route['roles-edit/(:any)'] = 'Usermanagement/Roles/edit/$1';

// js roles
$route['roles-store'] = 'Usermanagement/Roles/store';
$route['roles-update'] = 'Usermanagement/Roles/update';
 
//users
$route['users'] = 'Usermanagement/Users/index';
$route['users-create'] = 'Usermanagement/Users/add';
$route['users-store'] = 'Usermanagement/Users/store';

$route['users-edit/(:any)'] = 'Usermanagement/Users/edit/$1';
$route['users-enable-status/(:any)'] = 'Usermanagement/Users/enable_status/$1';
$route['users-disable-status/(:any)'] = 'Usermanagement/Users/disable_status/$1';
$route['checkMail'] = 'Usermanagement/Users/checkMail';



$route['users-update'] = 'Usermanagement/Users/update';

//login
$route['user-login']='Usermanagement/Login/index';
$route['user-logout']='Usermanagement/Login/logout';

//Master-Bank 
$route['bank']='masters/Bank_controller/index';
$route['create_bank']='masters/Bank_controller/add';
$route['bank-edit/(:any)'] = 'masters/Bank_controller/edit/$1';
$route['bank-enable-status/(:any)'] = 'masters/Bank_controller/enable_status/$1';
$route['bank-disable-status/(:any)'] = 'masters/Bank_controller/disable_status/$1';
$route['check-account'] = 'masters/Bank_controller/checkaccount';

// js carrier
$route['bank-store'] = 'masters/Bank_controller/store';
$route['bank-update'] = 'masters/Bank_controller/update';

//Master-carrier
$route['carrier']='masters/Carrier_controller/index';
$route['create_carrier']='masters/Carrier_controller/add';
$route['carrier-edit/(:any)'] = 'masters/Carrier_controller/edit/$1';
$route['carrier-enable-status/(:any)'] ='masters/Carrier_controller/enable_status/$1';
$route['carrier-disable-status/(:any)'] = 'masters/Carrier_controller/disable_status/$1';
// js carrier
$route['carrier-store'] = 'masters/Carrier_controller/store';
$route['carrier-update'] = 'masters/Carrier_controller/update';

//master description
$route['description'] = 'masters/Description/index';
$route['description-create'] = 'masters/Description/create';
$route['description-edit/(:any)'] = 'masters/Description/edit/$1';
$route['description-enable-status/(:any)'] ='masters/Description/enable_status/$1';
$route['description-disable-status/(:any)'] = 'masters/Description/disable_status/$1';
//js description
$route['description-store'] = 'masters/Description/store';
$route['description-update'] = 'masters/Description/update';
//master supplier

$route['supplier'] = 'masters/Supplier/index';
$route['supplier-create'] = 'masters/Supplier/create';
$route['supplier-edit/(:any)'] = 'masters/Supplier/edit/$1';
$route['supplier-enable-status/(:any)'] ='masters/Supplier/enable_status/$1';
$route['supplier-disable-status/(:any)'] = 'masters/Supplier/disable_status/$1';
//js supplier
$route['supplier-store'] = 'masters/Supplier/store';
$route['supplier-update'] = 'masters/Supplier/update';
//master client

$route['client'] = 'masters/Client/index';
$route['clientpaymentlist'] = 'masters/Client/payment';

$route['client-create'] = 'masters/Client/create';
$route['client-edit/(:any)'] = 'masters/Client/edit/$1';
$route['client-enable-status/(:any)'] ='masters/Client/enable_status/$1';
$route['client-disable-status/(:any)'] = 'masters/Client/disable_status/$1';
$route['check-client'] = 'masters/Client/checkclient';

//js supplier
$route['client-store'] = 'masters/Client/store';
$route['client-update'] = 'masters/Client/update';


//master shipper

$route['shipper'] = 'masters/Shipper/index';
$route['shipper-create'] = 'masters/Shipper/create';
$route['shipper-edit/(:any)'] = 'masters/Shipper/edit/$1';
$route['shipper-enable-status/(:any)'] ='masters/Shipper/enable_status/$1';
$route['shipper-disable-status/(:any)'] = 'masters/Shipper/disable_status/$1';
//js supplier
$route['shipper-store'] = 'masters/Shipper/store';
$route['shipper-update'] = 'masters/Shipper/update';

//master currency

$route['currency'] = 'masters/Currency/index';
$route['currency-create'] = 'masters/Currency/create';
$route['currency-edit/(:any)'] = 'masters/Currency/edit/$1';
$route['currency-enable-status/(:any)'] ='masters/Currency/enable_status/$1';
$route['currency-disable-status/(:any)'] ='masters/Currency/disable_status/$1';
//js supplier
$route['currency-store'] = 'masters/Currency/store';
$route['currency-update'] = 'masters/Currency/update';

//master truck

$route['truck'] = 'masters/Truck/index';
$route['truck-create'] = 'masters/Truck/create';
$route['truck-edit/(:any)'] = 'masters/Truck/edit/$1';
$route['truck-enable-status/(:any)'] ='masters/Truck/enable_status/$1';
$route['truck-disable-status/(:any)'] ='masters/Truck/disable_status/$1';
//js supplier
$route['truck-store'] = 'masters/Truck/store';
$route['truck-update'] = 'masters/Truck/update';

//Accounts

//create ledger
$route['create-ledger-group'] = 'accounts/Ledger_group/create_ledger_group';
$route['create-ledger'] = 'accounts/Ledger/create_ledger';
$route['accounts-entry'] = 'accounts/Accounts_entry/accounts_entry';
$route['day-book'] = 'accounts/Day_book/index';
$route['trial-balance'] = 'accounts/Trial_balance/index';
$route['balance-sheet'] = 'accounts/Balance_sheet/index';
$route['find-balance-sheet'] = 'accounts/Balance_sheet/find_balancesheet_data';
$route['ledger-view'] = 'accounts/Ledger_view/index';
$route['trial-balanceview'] = 'accounts/Trial_balance/gettrialbalance';
$route['find-ledger-view'] = 'accounts/Ledger_view/getledgerviewdata';


//js ledger group
$route['ledger-group'] = 'accounts/Ledger_group/store';
$route['list-ledger-group/(:any)'] = 'accounts/Ledger_group/getdata/$1';
//$route['list-group'] = 'accounts/ledger_group/list';

//js ledger 
$route['ledger'] = 'accounts/Ledger/store';
$route['ledger-edit'] = 'accounts/Ledger/editdata';
$route['list-ledger/(:any)'] = 'accounts/Ledger/getdata/$1';

//accounts entry 
$route['accounts-entry'] = 'accounts/Accounts_entry/accounts_entry';
$route['list-dropdown/(:any)'] = 'accounts/Accounts_entry/hidediv/$1';

//js accounts entry
$route['add-accounts-entry'] = 'accounts/Accounts_entry/store';

//js day book
$route['find-day-book'] = 'accounts/Day_book/finddata';


//transaction
//add job
$route['job'] = 'transaction/Transaction/index';
$route['edit-job/(:any)'] = 'transaction/Transaction/edit_job/$1';
$route['edit-consignment/(:any)'] = 'transaction/Transaction/edit_consignment/$1';
$route['estimation'] = 'transaction/Transaction/estimation';
$route['transportation-store'] = 'transaction/Transaction/store';
$route['transportation-update'] = 'transaction/Transaction/update';
$route['transportation-description/(:any)'] = 'transaction/Transaction/getdescription/$1';
$route['transportation-jobdetails/(:any)'] = 'transaction/Transaction/jobdetails/$1';
$route['transportation-estimate'] = 'transaction/Transaction/store_estimate';
$route['transportation-estimate-job'] = 'transaction/Transaction/store_jobestimate';
$route['transportation-carrier/(:any)'] = 'transaction/Transaction/getcarrier/$1';
$route['list-job'] = 'transaction/Transaction/job_transactionlist';
$route['list-consignment'] = 'transaction/Transaction/job_consignment';
$route['job-closed-status/(:any)'] ='transaction/Transaction/jobclosed_status/$1';
$route['update-estimate'] = 'transaction/Transaction/update_estimate';
$route['estimate-print/(:any)'] = 'transaction/Transaction/estimate_print/$1';
$route['images-upload/(:any)']='transaction/Transaction/images_upload/$1';
$route['create-job-doc-ajax']='transaction/Transaction/create_job_doc_ajax';
$route['images-remove']='transaction/Transaction/images_remove';
$route['delete-doc/(:any)']='transaction/Transaction/delete_doc/$1';
$route['delete_documents/(:any)']='transaction/Transaction/delete_documents/$1';
$route['update-job-doc-ajax']='transaction/Transaction/update_job_doc_ajax';
$route['images-list_files']='transaction/Transaction/images_list_files';
$route['remove_uploadedfile/(:any)']='transaction/Transaction/remove_uploadedfile/$1)';


$route['job-invoice/get_covfactor/(:any)'] = 'transaction/Job_invoice_controller/get_covfactor/$1';
$route['edit-job-invoice/get_covfactor/(:any)'] = 'transaction/Job_invoice_controller/get_covfactor/$1';
$route['get_covfactors/(:any)'] = 'transaction/Job_invoice_controller/get_covfactor/$1';
$route['edit-consignment/get_covfactor1/(:any)'] = 'transaction/Job_invoice_controller/get_covfactor/$1';
$route['payment-receipt/get_covfactor_receipt/(:any)'] = 'transaction/Job_invoice_controller/get_covfactor/$1';
$route['supplier-expense/get_covfactor_supplier/(:any)'] = 'transaction/Job_invoice_controller/get_covfactor/$1';
$route['delete_exp_documents/(:any)']='transaction/Supplierexpense_Controller/delete_exp_documents/$1';
//invoice
//job-invoice
$route['new_invoice'] = 'transaction/Job_invoice_controller/new_invoice';
$route['job-invoice/(:any)'] = 'transaction/Job_invoice_controller/job_invoice/$1';
$route['estimate-invoice/(:any)'] = 'transaction/Job_invoice_controller/estimate_invoice/$1';
$route['job-invoice/job-invoice-description/(:any)'] = 'transaction/Job_invoice_controller/getdata/$1';
$route['insert-job-details'] = 'transaction/Job_invoice_controller/insert_job_details';
$route['insert_expense_details'] = 'transaction/Job_invoice_controller/insert_expense_details';
//print invoice
$route['perfomainvoice-print/(:any)'] = 'transaction/Job_invoice_controller/perfomainvoice_print/$1';
$route['invoice-print/(:any)'] = 'transaction/Job_invoice_controller/invoice_print/$1';
// change-invoice-status
$route['change-invoice-status/(:any)/(:any)'] = 'transaction/Job_invoice_controller/change_invoice_status/$1/$2';
$route['job-invoice/supplier-expense-description/(:any)'] = 'transaction/Job_invoice_controller/getdatasupplierexpense/$1';

//edit job invoice
$route['edit-job-invoice/(:any)'] = 'transaction/Job_invoice_controller/edit_job_invoice/$1';
$route['update-job-details'] = 'transaction/Job_invoice_controller/update_jobInvoice_details';
//Job Supplier Payment
$route['job-supplier-payment/(:any)'] = 'transaction/Job_supplier_payment_controller/index/$1';
$route['job-supplier-payment-get-client-details/(:any)'] = 'transaction/Job_supplier_payment_controller/select_client_details/$1';
$route['insert-job-supplier-payment-details'] = 'transaction/Job_supplier_payment_controller/insert_supplier_payment';
$route['edit-job-supplier-payment/(:any)'] = 'transaction/Job_supplier_payment_controller/edit_job_supplier_payment/$1';
$route['update-supplier-payment'] = 'transaction/Job_supplier_payment_controller/update_supplier_payment';
$route['print-supplier-payment/(:any)'] = 'transaction/Job_supplier_payment_controller/print_supplier_payment/$1';
$route['list-supplier'] = 'transaction/Job_supplier_payment_controller/list_supplier';
$route['getsupplierpayment-detail'] = 'transaction/Job_supplier_payment_controller/getsupplierpayment_detail';


//edit_job_supplier_payment_receipt
$route['payment-receipt/(:any)'] = 'transaction/Payment_receipt_controller/receipt/$1';
$route['payment-receipt-get-client-details/(:any)'] = 'transaction/Payment_receipt_controller/payment_receipt_select_client_details/$1';
$route['insert-payment-receipt-details'] = 'transaction/Payment_receipt_controller/insert_payment_receipt';
$route['edit-payment-receipt-details/(:any)'] = 'transaction/Payment_receipt_controller/edit_job_payment_receipt/$1';
$route['update-payment-receipt-details'] = 'transaction/Payment_receipt_controller/update_payment_receipt_details';
$route['payment-receipt-print/(:any)'] = 'transaction/Payment_receipt_controller/payment_receipt_print/$1';
$route['getclientpayment-detail'] = 'transaction/Payment_receipt_controller/get_payment_receipt';
//supplier expense


$route['change-supplier-expense-status/(:any)/(:any)'] = 'transaction/Supplierexpense_Controller/change_supplier_expense_status/$1/$2';

$route['supplier-expense/(:any)'] = 'transaction/Supplierexpense_Controller/supplier_expense/$1';
$route['insert-expense-details'] = 'transaction/Supplierexpense_Controller/supplier_expense_details';
$route['supplier-expense-print/(:any)'] = 'transaction/Supplierexpense_Controller/supplier_expense_print/$1';
$route['edit-supplier-expense/(:any)'] = 'transaction/Supplierexpense_Controller/edit_supplier_expense/$1';
$route['update-supplier-expense'] = 'transaction/Supplierexpense_Controller/update_supplier_expense';
$route['view-supplierexpense'] = 'transaction/Supplierexpense_Controller/index';
$route['supplier-expense/create-exp-doc-ajax']='transaction/Transaction/create_exp_doc_ajax';

//debit note

$route['change-debit-note-status/(:any)/(:any)'] = 'transaction/Debitnote_Controller/change_debit_note_status/$1/$2';

$route['debit-note/(:any)'] = 'transaction/Debitnote_Controller/debit_note/$1';
$route['debit-note/debitnote-description/(:any)'] = 'transaction/Debitnote_Controller/getdata/$1';
$route['insert-debit-note'] = 'transaction/Debitnote_Controller/debit_note_details';
$route['debit-note-print/(:any)'] = 'transaction/Debitnote_Controller/debit_note_print/$1';
$route['edit-debitnote/(:any)'] = 'transaction/Debitnote_Controller/edit_debitnote/$1';
$route['update-debitnote'] = 'transaction/Debitnote_Controller/update_debitnote';

//credit note
$route['change-creditnote-status/(:any)/(:any)'] = 'transaction/Creditnote_Controller/change_credit_note_status/$1/$2';

$route['credit-note/(:any)'] = 'transaction/Creditnote_Controller/credit_note/$1';
$route['credit-note/creditnote-description/(:any)'] = 'transaction/Creditnote_Controller/getdata/$1';
$route['insert-credit-note'] = 'transaction/Creditnote_Controller/credit_note_details';
$route['credit-note-print/(:any)'] = 'transaction/Creditnote_Controller/credit_note_print/$1';
$route['edit-creditnote/(:any)'] = 'transaction/Creditnote_Controller/edit_creditnote/$1';
$route['update-creditnote'] = 'transaction/Creditnote_Controller/update_creditnote';
//reports
$route['job-reports'] = 'reports/Reports/job_reports';
$route['job-reports-modewise'] = 'reports/Reports/job_reports_modewise';

$route['job-transaction-reports'] = 'reports/Jobtransactionreport/job_transaction_reports';
$route['job-transaction-report-data'] = 'reports/Jobtransactionreport/job_transaction_report_data';


$route['job-report-data-modewise'] = 'reports/Reports/job_report_data_modewise';



$route['non-billed-jobs'] = 'reports/Reports/non_billed_jobs';
$route['sales-reports'] = 'reports/Reports/sales_report';
$route['sales-report-data'] = 'reports/Reports/sales_report_data';

$route['sales-reports-clientwise'] = 'reports/Reports/sales_report_clientwise';

$route['sales-report-data-clientwise'] = 'reports/Reports/sales_report_data_clientwise';

$route['closed-invoice-reports'] = 'reports/Reports/invoice_reports';
$route['invoice-report-data'] = 'reports/Reports/invoice_report_data';

$route['closed-invoice-reports-clientwise'] = 'reports/Reports/invoice_reports_clientwise';
$route['invoice-report-data-clientwise'] = 'reports/Reports/invoice_report_data_clientwise';
$route['pending-invoice'] = 'reports/Reports/pending_invoice_reports';
$route['pending-invoice-report-data'] = 'reports/Reports/pending_invoice_report_data';
$route['pending-invoice-clientwise'] = 'reports/Reports/pending_invoice_reports_clientwise';
$route['pending-invoice-report-data-clientwise'] = 'reports/Reports/pending_invoice_report_data_clientwise';

// $route['pending-invoice'] = 'reports/Reports/pending_invoice';
// $route['nonbilled-report-data'] = 'reports/Reports/nonbilled_report_report_data';

$route['bill-report'] = 'reports/Reports/bill_reports';
$route['bill-report-data'] = 'reports/Reports/bill_reports_getdata';

$route['bill-report-supplierwise'] = 'reports/Reports/bill_reports_supplierwise';
$route['bill-report-data-supplierwise'] = 'reports/Reports/bill_reports_getdata_supplierwise';
$route['pending-bills'] = 'reports/Reports/pending_bills';
$route['pending-bill-data'] = 'reports/Reports/pending_bill_data';
$route['pending-bills-supplierwise'] = 'reports/Reports/pending_bills_supplierwise';
$route['pending-bill-data-supplierwise'] = 'reports/Reports/pending_bill_data_supplierewise';
//receipt report
$route['receipt-report'] = 'reports/Reports/receipt_report';
$route['receipt-report-data'] = 'reports/Reports/receipt_data';

$route['receipt-report-paymodewise'] = 'reports/Reports/receipt_report_paymodewise';
$route['receipt-report-data-paymodewise'] = 'reports/Reports/receipt_data_paymodewise';
//payment report
$route['payment-report'] = 'reports/Reports/payment_report';
$route['paryment-report-data'] = 'reports/Reports/paryment_report_data';

$route['payment-report-cashwise'] = 'reports/Reports/payment_report_cashwise';
$route['paryment-report-data-cashwise'] = 'reports/Reports/paryment_report_data_cashwise';

$route['payment-report-bankwise'] = 'reports/Reports/receipt_report_bankwise';
$route['paryment-report-data-bankwise'] = 'reports/Reports/paryment_report_data_bankwise';
$route['profit-loss'] = 'reports/Reports/profit_loss';
$route['profit-loss-data'] = 'reports/Reports/profit_loss_data';


//vat report 

$route['vat-report-total'] = 'reports/Vatreports_controller/vat_report_total';
$route['getallvat'] = 'reports/Vatreports_controller/vat_report_total';

$route['vat-report-total-data'] = 'reports/Vatreports_controller/vat_report_total_data';
$route['vat-in-report'] = 'reports/Vatreports_controller/vat_in_report';
$route['vatin-report-data'] = 'reports/Vatreports_controller/vatin_report_data';
$route['vat-out-report'] = 'reports/Vatreports_controller/vat_out_report';
$route['vatout-report-data'] = 'reports/Vatreports_controller/vatout_report_data';


//job search
$route['job-search'] = 'Jobsearch/Job_Search/job_search';

$route['job-description/(:any)'] = 'Jobsearch/Job_Search/job_description/$1';
//supplier search
$route['supplier-search'] = 'Suppliersearch/Supplier_Search/supplier_search';
$route['supplier-data/(:any)'] = 'Suppliersearch/Supplier_Search/get_supplierdetails/$1';

//client search
$route['client-search'] = 'Clientsearch/Client_Search/client_search';
$route['client-data'] = 'Clientsearch/Client_Search/get_clientsearchdetails';

$route['getclientdata'] = 'Clientsearch/Client_Search/getclientdata';
//settings
$route['basic-settings'] = 'Settings/Settings_controller/basic_settings';
$route['update-basic-settings'] = 'Settings/Settings_controller/update_basic_settings';

//soa report

$route['soa-report'] = 'reports/Reports/soa_report_client';
$route['soa-report-data-clientwise'] = 'reports/Reports/soa_report_data_clientwise';



//genaral expense
$route['genaral-expense-new'] = 'genaral_expense/Genaral_expense_Controller/genaral_expense';
$route['insert-genaral-expense'] = 'genaral_expense/Genaral_expense_Controller/genaral_expense_details';
$route['genaralexpense-report-data'] = 'genaral_expense/Genaral_expense_Controller/genaralexpense_report_data';
$route['genaralexpense-report'] = 'genaral_expense/Genaral_expense_Controller/index';
$route['genaralexpense-report-data-detail'] = 'genaral_expense/Genaral_expense_Controller/genaralexpense_report_data_detail';
$route['genaralexpense-report-detailed'] = 'genaral_expense/Genaral_expense_Controller/detailedreport';
$route['invoice-draft'] = 'invoice/Job_invoice_controller/job_invoice_draft';
$route['expense-draft'] = 'invoice/Supplierexpense_Controller/supplier_expense_draft';


//vehicle management

$route['vehicle'] = 'vehicle/Vehicle/index';
$route['vehicle-create'] = 'vehicle/Vehicle/create';
$route['vehicle-store'] = 'vehicle/Vehicle/store';
$route['vehicle-update'] = 'vehicle/Vehicle/update';
$route['vehicle-edit/(:any)'] = 'vehicle/Vehicle/edit/$1';
$route['vehicle-enable-status/(:any)'] ='vehicle/Vehicle/enable_status/$1';
$route['vehicle-disable-status/(:any)'] = 'vehicle/Vehicle/disable_status/$1';
$route['vehicle-view/(:any)'] = 'vehicle/Vehicle/view/$1';


//Employee management

$route['employee'] = 'employee/Employee/index';
$route['employee-create'] = 'employee/Employee/create';
$route['employee-store'] = 'employee/Employee/store';
$route['employee-update'] = 'employee/Employee/update';
$route['employee-edit/(:any)'] = 'employee/Employee/edit/$1';
$route['employee-enable-status/(:any)'] ='employee/Employee/enable_status/$1';
$route['employee-disable-status/(:any)'] = 'employee/Employee/disable_status/$1';
$route['employee-view/(:any)'] = 'employee/Employee/view/$1';

