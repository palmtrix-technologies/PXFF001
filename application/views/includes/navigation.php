p
      <!-- =============================================== -->
      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: 100%;">
          <!-- Sidebar user panel -->
          <!-- <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo IMAGE_PATH.$cmpnydata[0]->Icon_image; ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $cmpnydata[0]->Cmpny_name; ?></p>
            </div>
          </div> -->
          <div class="user-panel" style="padding: 0;
    background: white;
    text-align: center;">
              <img src="assets/images/backgrounds/freighbrid-logo.png" style="background: white;
    width: 9rem;
    height: 3rem;" >
            </div>
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li class="treeview">
              <a href="<?php echo base_url(); ?>user-home">
                <i class=" fa fa-dashboard"></i> <span>Dashboard </span> <i class=" pull-right"></i>
              </a>
          
            </li>
           
            <li class="treeview">
              <a href="">
                <i class=" fa fa-dashboard"></i> <span>User Management </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <?php 
              // foreach($permission as $key=>$val){
                if (in_array("read user", $permission))
                {  ?>
               <li><a href="<?php echo base_url(); ?>users"><i class="fa fa-circle-o"></i>List User</a></li>
            
              <?php
              }
                ?>
                  <?php 
          
                if (in_array("read permission",$permission))
                { 
                   ?>
               <li><a href="<?php echo base_url(); ?>permission"><i class="fa fa-circle-o"></i>Lsit Permission</a></li>
               
              <?php
              }
              ?>
                  <?php 
          
          if (in_array("read role",$permission))
          { 
             ?>
         <li><a href="<?php echo base_url(); ?>roles"><i class="fa fa-circle-o"></i> List Roles</a></li>
         
        <?php
        }
        ?>
              </ul>
            </li>
            <?php 
          
          if(in_array("read bank",$permission)||in_array("read carrier",$permission)||in_array("read client",$permission)||in_array("read supplier",$permission)||in_array("read descriptionmaster",$permission)||in_array("read shipper",$permission)||in_array("read currency",$permission)||in_array("read truck",$permission))
          { 
             ?>
            <li class="treeview">
           
              <a href="">
                <i class=" fa fa-home"></i> <span>Master </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
            
              <ul class="treeview-menu">
              <?php 
          if (in_array("read bank",$permission))
          { 
             ?>
               <li><a href="<?php echo base_url(); ?>bank"><i class="fa fa-circle-o"></i>Manage Bank</a></li>
               <?php
        }
        ?>
            <?php 
          
          if (in_array("read  carrier",$permission))
          { 
             ?>
               <li><a href="<?php echo base_url(); ?>carrier"><i class="fa fa-circle-o"></i>Manage Carrier</a></li>
               <?php
        }
        ?>
         <?php 
          
          if (in_array("read client",$permission))
          { 
             ?>
               <li><a href="<?php echo base_url(); ?>client"><i class="fa fa-circle-o"></i> Manage Client</a></li>
               <?php
        }
        ?>
         <?php 
          
          if (in_array("read supplier",$permission))
          { 
             ?>
                <li><a href="<?php echo base_url(); ?>supplier"><i class="fa fa-circle-o"></i> Manage Supplier</a></li>
                <?php
        }
        ?>
         <?php 
          
          if (in_array("read descriptionmaster",$permission))
          { 
             ?>
                <li><a href="<?php echo base_url(); ?>description"><i class="fa fa-circle-o"></i> Manage Description Master</a></li>
                <?php
        }
        ?>
         <?php 
          
          if (in_array("read shipper",$permission))
          { 
             ?>
                <li><a href="<?php echo base_url(); ?>shipper"><i class="fa fa-circle-o"></i> Manage Shipper</a></li>
                <?php
        }
        ?>
         <?php 
          
          if (in_array("read currency",$permission))
          { 
             ?>
                <li><a href="<?php echo base_url(); ?>currency"><i class="fa fa-circle-o"></i> Manage Currency</a></li>
                <?php
        }
        ?>
         <?php 
          
          if (in_array("read truck",$permission))
          { 
             ?>
                <li><a href="<?php echo base_url(); ?>truck"><i class="fa fa-circle-o"></i> Manage Truck</a></li>
                <?php
        }
        ?>
              </ul>
           
            </li>
            <?php
        }
        ?>
       <?php 
          
          if (in_array("read transaction ",$permission))
          { 
             ?>
            <li class="treeview">
              <a href="">
                <i class=" fa fa-exchange"></i> <span>Transaction </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <!-- <li><a href="<?php echo base_url(); ?>job"><i class="fa fa-circle-o"></i>Job </a></li> -->
              <li><a href="<?php echo base_url(); ?>list-job"><i class="fa fa-circle-o"></i>List Job  </a></li>

              <li><a href="<?php echo base_url(); ?>list-consignment"><i class="fa fa-circle-o"></i>Estimation  </a></li>
        
              </ul>
            </li>
            <?php
        }
        ?>
          <?php 
          
          if (in_array("read job view",$permission))
          { 
             ?>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>job-search">
                <i class=" fa fa-search"></i> <span>Job View </span> <i class=" pull-right"></i>
              </a>
          
            </li>
            <?php
        }
        ?>
        <?php 
          
          if (in_array("read supplier search",$permission))
          { 
             ?>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>supplier-search">
                <i class="fa fa-search"></i> <span>Supplier View </span> <i class=""></i>
              </a>
           
            </li>
            <?php
        }
        ?>
          <?php 
          
          if (in_array("read client search",$permission))
          { 
             ?>
            <li class="treeview ">
              <a href="<?php echo base_url(); ?>client-search">
                <i class="fa  fa-user"></i> <span>Client View </span> <i class=""></i>
              </a>
             
            </li>
            <?php
        }
        ?>
         <?php 
          
          if (in_array("read supplier payment",$permission))
          { 
             ?>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>list-supplier">
                <i class="fa  fa-credit-card"></i> <span> Supplier Payment</span> <i class=" pull-right"></i>
              </a></li>
              <?php
        }
        ?>
            <?php 
          
          if (in_array("read clientreceipt",$permission))
          { 
             ?>
              <li class="treeview">
              <a href="<?php echo base_url(); ?>clientpaymentlist">
                <i class="fa fa-list"></i> <span> client reciept</span> <i class=" pull-right"></i>
              </a>
             
            </li>
            <?php
        }
        ?>
        

        <li class="treeview">
           
           <a href="<?php echo base_url(); ?>vehicle">
             <i class=" fa fa-truck"></i> <span>Vehicles </span> </a>
         
        
         </li>
         
          <li class="treeview">
        
           <a href="<?php echo base_url(); ?>employee">
             <i class=" fa fa-user"></i> <span>Employees </span> </a>
         
        
         </li>

         <li class="treeview"> 
         
         <a href="">
                   <i class="fa fa-exchange"></i> <span>General Expense </span> <i class="fa fa-angle-left pull-right"></i>
                 </a>
               
                 <ul class="treeview-menu" style="display: none;">
                                <li><a href="<?php echo base_url(); ?>genaral-expense-new"><i class="fa fa-circle-o"></i>Add Expense</a></li>
                                <li><a href=" <?php echo base_url(); ?>genaralexpense-report"><i class="fa fa-circle-o"></i> Genaral Expense Report</a></li>
                               
                              
                           <li><a href="<?php echo base_url(); ?>genaralexpense-report-detailed"><i class="fa fa-circle-o"></i> Genaral Expense Detailed</a></li>
                           
                           
                           
                           
                                 </ul>
              
               </li>
             
     
         <?php 
          
          if (in_array("read jobreports",$permission)||in_array("read nonbilledreports",$permission)||in_array("read invoicereports",$permission)||in_array("read pendinginvoice",$permission)||in_array("read billreport",$permission)||in_array("read pendingbills",$permission))
          { 
             ?>
            <li class="treeview">
              <a href="">
                <i class=" fa fa-files-o"></i> <span>Reports </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li class="treeview">
              <a href="">
                <i class=" fa fa-files-o"></i> <span>Job Reports </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <?php 
          
          if (in_array("read jobreports",$permission))
          { 
             ?>
              <li><a href="<?php echo base_url(); ?>job-reports"><i class="fa fa-circle-o"></i>Job Reports</a></li>
              <?php } ?>
              <li><a href="<?php echo base_url(); ?>job-reports-modewise"><i class="fa fa-circle-o"></i>Job Report Modewise</a></li>
              <li><a href="<?php echo base_url(); ?>job-transaction-reports"><i class="fa fa-circle-o"></i>Job Transaction Report</a></li>

          <?php 
          
          if (in_array("read nonbilledreports",$permission))
          { 
             ?>
               <li><a href="<?php echo base_url(); ?>non-billed-jobs"><i class="fa fa-circle-o"></i>Non Billed Jobs </a></li>
               <?php } ?>
              </ul></li>
              <li class="treeview">
              <a href="">
                <i class=" fa fa-files-o"></i> <span>Invoice Reports </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>sales-reports"><i class="fa fa-circle-o"></i>Sales Report </a></li>
              <li><a href="<?php echo base_url(); ?>sales-reports-clientwise"><i class="fa fa-circle-o"></i>Sales Report Clientwise</a></li>

         <?php 
          
          if (in_array("read invoicereports",$permission))
          { 
             ?>
               <li><a href="<?php echo base_url(); ?>closed-invoice-reports"><i class="fa fa-circle-o"></i>ClosedInvoiceReport</a></li>
               <?php } ?>
             <!-- closed in report clientwise -->
               <li><a href="<?php echo base_url(); ?>closed-invoice-reports-clientwise"><i class="fa fa-circle-o"></i>ClosedInvoices Clientwise </a></li>
          <?php 
          
          if (in_array("read pendinginvoice",$permission))
          { 
             ?> 
               <li><a href="<?php echo base_url(); ?>pending-invoice"><i class="fa fa-circle-o"></i>Pending Invoice </a></li>
               <?php 
              } 
              ?>
              <li><a href="<?php echo base_url(); ?>pending-invoice-clientwise"><i class="fa fa-circle-o"></i>PendingInvoiceClientWise</a></li>
              </ul></li>
              <li class="treeview">
              <a href="">
                <i class=" fa fa-files-o"></i> <span>Expense Reports </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
         <?php 
          
          if (in_array("read billreport",$permission))
          { 
             ?> 
               <li><a href="<?php echo base_url(); ?>bill-report"><i class="fa fa-circle-o"></i>Bill Report </a></li>
               <?php 
              }
               ?>
               <li><a href="<?php echo base_url(); ?>bill-report-supplierwise"><i class="fa fa-circle-o"></i>Bill Report Supplier Wise </a></li>

          <?php 
          
          if (in_array("read pendingbills",$permission))
          { 
             ?>
               <li><a href="<?php echo base_url(); ?>pending-bills"><i class="fa fa-circle-o"></i>Pending Bills</a></li>
               <?php 
              } 
              ?>  
 <li><a href="<?php echo base_url(); ?>pending-bills-supplierwise"><i class="fa fa-circle-o"></i>Pendingbills Supplierwise</a></li>
              </ul></li>
              <?php 
          
          if (in_array("read receipt reports",$permission))
          { 
             ?>
              <li class="treeview">
              <a href="">
                <i class=" fa fa-files-o"></i> <span>Receipt Reports </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>receipt-report"><i class="fa fa-circle-o"></i>Receipt Report</a></li>
              <li><a href="<?php echo base_url(); ?>receipt-report-paymodewise"><i class="fa fa-circle-o"></i>Receiptreport Paymentwise </a></li>
              </ul>
              </li>
              <?php } ?>
              <?php 
          
          if (in_array("read payment receipt reports",$permission))
          { 
             ?>
              <li class="treeview">
              <a href="">
                <i class=" fa fa-files-o"></i> <span>Payment Reports </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>payment-report"><i class="fa fa-circle-o"></i>Payment Report</a></li>
              <li><a href="<?php echo base_url(); ?>payment-report-cashwise"><i class="fa fa-circle-o"></i>Payment Report Cashwise</a></li>
              <li><a href="<?php echo base_url(); ?>payment-report-bankwise"><i class="fa fa-circle-o"></i>Payment Report Bankwise</a></li>

              </ul></li>
       
              <?php } ?>   
          <?php 
          
          if (in_array("read vatreports",$permission))
          { 
             ?>
             <!-- vat report -->
             <li class="treeview">
              <a href="#">
                <i class=" fa fa-files-o"></i> <span>VAT Reports </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
             <li><a href="<?php echo base_url(); ?>vat-report-total"><i class="fa fa-circle-o"></i> VAT Report Total</a></li>
             <li><a href="<?php echo base_url(); ?>vat-in-report"><i class="fa fa-circle-o"></i> VAT In Report </a></li>
             <li><a href="<?php echo base_url(); ?>vat-out-report"><i class="fa fa-circle-o"></i> VAT Out Report </a></li>
   
             </ul>
            </li>
          <?php } ?>
          <?php 
          
          if (in_array("read profit and loss",$permission))
          { 
             ?>
            <li><a href="<?php echo base_url(); ?>profit-loss"><i class="fa fa-circle-o"></i>Profit And Loss</a></li>
            <?php } ?>
              <?php 
          
          if (in_array("read soa report",$permission))
          { 
             ?>
             <!-- vat report -->
          
             <li><a href="<?php echo base_url(); ?>soa-report"><i class="fa fa-circle-o"></i>SOA Report </a></li>
          
            
          <?php } ?>
            </ul>
            </li>
            <?php
        }
        ?>
       
          <?php 
          
          if (in_array("create ledgergroup",$permission)||in_array("create ledger",$permission)||in_array("create accountsentry",$permission)||in_array("read daybook",$permission)||in_array("read trialbalance",$permission)||in_array("read balancesheet",$permission)||in_array("read ledgerview",$permission))
          { 
             ?>
            <li class="treeview ">
              <a href="#">
                <i class=" fa fa-credit-card"></i> <span>Accounts </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <?php 
          
          if (in_array("create ledgergroup",$permission))
          { 
             ?>
              <li><a href="<?php echo base_url(); ?>create-ledger-group"><i class="fa fa-circle-o"></i>Create Ledger Group</a></li>
              <?php
        }
        ?>
          <?php 
          
          if (in_array("create ledger",$permission))
          { 
             ?>
              <li><a href="<?php echo base_url(); ?>create-ledger"><i class="fa fa-circle-o"></i>Create Ledger</a></li>
              <?php
          }
        ?>
          <?php 
          
          if (in_array("create accountsentry",$permission))
          { 
             ?>
              <li><a href="<?php echo base_url(); ?>accounts-entry"><i class="fa fa-circle-o"></i>Accounts Entry</a></li>
              <?php
          }
        ?>
          <?php 
          
          if (in_array("read daybook",$permission))
          { 
             ?>
              <li><a href="<?php echo base_url(); ?>day-book"><i class="fa fa-circle-o"></i>Day Book</a></li>
              <?php
          }
        ?>
          <?php 
          
          if (in_array("read trialbalance",$permission))
          { 
             ?>
              <li><a href="<?php echo base_url(); ?>trial-balance"><i class="fa fa-circle-o"></i>Trial Balance</a></li>
              <?php
          }
        ?>
          <?php 
          
          if (in_array("read balancesheet",$permission))
          { 
             ?>
              <li><a href="<?php echo base_url(); ?>balance-sheet"><i class="fa fa-circle-o"></i>Balance Sheet</a></li>
              <?php
          }
        ?>
          <?php 
          
          if (in_array("read ledgerview",$permission))
          { 
             ?>
              <li><a href="<?php echo base_url(); ?>ledger-view"><i class="fa fa-circle-o"></i>Ledger View</a></li>
              <?php
          }
        ?>
            </ul>
            </li>
            <?php } ?>
            <?php 
          
          if (in_array("read basic settings",$permission))
          { 
             ?>
            <li class="treeview">
              <a href="#">
                <i class=" fa fa-wrench"></i> <span>Settings </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>basic-settings"><i class="fa fa-circle-o"></i>Basic Settings </a></li>
               <!-- <li><a href="#"><i class="fa fa-circle-o"></i>Invoice Settings </a></li> -->
              
              </ul>
            </li>
            <?php } ?>
         
          </ul>
        </section>
        
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      
      <div class="content-wrapper">

      
      