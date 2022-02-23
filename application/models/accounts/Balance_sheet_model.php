<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balance_sheet_model extends CI_Model {

    public function get_liability_details($from,$to)
    {
       

         
   $sql="select al.Ledger_Name,accounts_ledgergroup.GroupName,
   case when ((select  ifnull(sum(Amount),0)
               from accounts_accountmaster
               where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )<(select  ifnull(sum(Amount),0) 
               from accounts_accountmaster where DebitAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."' 
       ORDER BY TransferDate))
               then
   (select  ifnull(sum(Amount),0)
    from accounts_accountmaster where DebitAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )-(select  ifnull(sum(Amount),0) from accounts_accountmaster
     where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  ) 
     else 0 end as DebitAccount,
   case when ((select  ifnull(sum(Amount),0) 
               from accounts_accountmaster
               where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )>(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."' ))
               then
   (select  ifnull(sum(Amount),0) from accounts_accountmaster 
    where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )- (select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=al.LedgerID
     and  year(TransferDate) between '".$from."'   AND  '".$to."'  ) else 0 end as Credit from accounts_ledger al
     inner join accounts_ledgergroup on al.LedgerGroupID=accounts_ledgergroup.LedgerGroupID
     where accounts_ledgergroup.GroupName like '%Liability%'";
  $query = $this->db->query($sql);
   $result = $query->result();
       return $result;
    
    }
    public function get_asset_details($from,$to)
    {
       

         
   $sql="select al.Ledger_Name,accounts_ledgergroup.GroupName,
   case when ((select  ifnull(sum(Amount),0)
               from accounts_accountmaster
               where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )<(select  ifnull(sum(Amount),0) 
               from accounts_accountmaster where DebitAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."' 
       ORDER BY TransferDate))
               then
   (select  ifnull(sum(Amount),0)
    from accounts_accountmaster where DebitAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )-(select  ifnull(sum(Amount),0) from accounts_accountmaster
     where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  ) 
     else 0 end as DebitAccount,
   case when ((select  ifnull(sum(Amount),0) 
               from accounts_accountmaster
               where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )>(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."' ))
               then
   (select  ifnull(sum(Amount),0) from accounts_accountmaster 
    where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )- (select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=al.LedgerID
     and  year(TransferDate) between '".$from."'   AND  '".$to."'  ) else 0 end as Credit from accounts_ledger al
     inner join accounts_ledgergroup on al.LedgerGroupID=accounts_ledgergroup.LedgerGroupID
     where accounts_ledgergroup.GroupName like '%Asset%'";
  $query = $this->db->query($sql);
   $result = $query->result();
       return $result;
    
    }
    
    public function get_income_details($from,$to)
    {
       

         
   $sql="select al.Ledger_Name,accounts_ledgergroup.GroupName,
   case when ((select  ifnull(sum(Amount),0)
               from accounts_accountmaster
               where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )<(select  ifnull(sum(Amount),0) 
               from accounts_accountmaster where DebitAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."' 
       ORDER BY TransferDate))
               then
   (select  ifnull(sum(Amount),0)
    from accounts_accountmaster where DebitAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )-(select  ifnull(sum(Amount),0) from accounts_accountmaster
     where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  ) 
     else 0 end as DebitAccount,
   case when ((select  ifnull(sum(Amount),0) 
               from accounts_accountmaster
               where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )>(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."' ))
               then
   (select  ifnull(sum(Amount),0) from accounts_accountmaster 
    where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )- (select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=al.LedgerID
     and  year(TransferDate) between '".$from."'   AND  '".$to."'  ) else 0 end as Credit from accounts_ledger al
     inner join accounts_ledgergroup on al.LedgerGroupID=accounts_ledgergroup.LedgerGroupID
     where accounts_ledgergroup.GroupName like '%Income%'";
  $query = $this->db->query($sql);
   $result = $query->result();
       return $result;
    
    }
    
    public function get_expense_details($from,$to)
    {
       

         
   $sql="select al.Ledger_Name,accounts_ledgergroup.GroupName,
   case when ((select  ifnull(sum(Amount),0)
               from accounts_accountmaster
               where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )<(select  ifnull(sum(Amount),0) 
               from accounts_accountmaster where DebitAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."' 
       ORDER BY TransferDate))
               then
   (select  ifnull(sum(Amount),0)
    from accounts_accountmaster where DebitAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )-(select  ifnull(sum(Amount),0) from accounts_accountmaster
     where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  ) 
     else 0 end as DebitAccount,
   case when ((select  ifnull(sum(Amount),0) 
               from accounts_accountmaster
               where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )>(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."' ))
               then
   (select  ifnull(sum(Amount),0) from accounts_accountmaster 
    where CreditAccount=al.LedgerID and  year(TransferDate) between '".$from."'   AND  '".$to."'  )- (select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=al.LedgerID
     and  year(TransferDate) between '".$from."'   AND  '".$to."'  ) else 0 end as Credit from accounts_ledger al
     inner join accounts_ledgergroup on al.LedgerGroupID=accounts_ledgergroup.LedgerGroupID
     where accounts_ledgergroup.GroupName like '%Expense%'";
  $query = $this->db->query($sql);
   $result = $query->result();
       return $result;
    
    }
}