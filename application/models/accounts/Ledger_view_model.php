<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledger_view_model extends CI_Model {


public function find_LedgerSummery($from,$to,$id)
{
    $sql="select 
case when ((select  ifnull(sum(Amount),0) from accounts_accountmaster where CreditAccount=".$id." and TransferDate<='".$from."')<(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=".$id." and TransferDate<='".$from."')) then
(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=".$id." and TransferDate<='".$from."')-(select  ifnull(sum(Amount),0) from accounts_accountmaster where CreditAccount=".$id." and TransferDate<='".$from."') else 0 end as opDebitAccount,
case when ((select  ifnull(sum(Amount),0) from accounts_accountmaster where CreditAccount=".$id." and TransferDate<='".$from."')>(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=".$id." and TransferDate<='".$from."')) then
(select  ifnull(sum(Amount),0) from accounts_accountmaster where CreditAccount=".$id." and TransferDate<='".$from."')- (select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=".$id." and TransferDate<='".$from."') else 0 end as opCreditAccount,
case when ((select  ifnull(sum(Amount),0) from accounts_accountmaster where CreditAccount=".$id." and TransferDate<='".$to."')<(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=".$id." and TransferDate<='".$to."')) then
(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=".$id." and TransferDate<='".$to."')-(select  ifnull(sum(Amount),0) from accounts_accountmaster where CreditAccount=".$id." and TransferDate<='".$to."') else 0 end as cbDebitAccount,
case when ((select  ifnull(sum(Amount),0) from accounts_accountmaster where CreditAccount=".$id." and TransferDate<='".$to."')>(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=".$id." and TransferDate<='".$to."')) then
(select  ifnull(sum(Amount),0) from accounts_accountmaster where CreditAccount=".$id." and TransferDate<='".$to."')- (select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=".$id." and TransferDate<='".$to."') else 0 end as cbCreditAccount
";
 $query = $this->db->query($sql);

//$query = $this->db->get();
   $result = $query->result();
       return $result;
}
public function find_Ledgerview($from,$to,$id)
{
   
   $sql="select * from(select TransferDate as TransDate,concat('To ',accounts_ledger.Ledger_Name) as Purticular,accounts_accountmaster.VoucherType,0 as Credit, Amount as Debit
from accounts_accountmaster 
inner join accounts_ledger on accounts_ledger.LedgerID= accounts_accountmaster.DebitAccount
where CreditAccount=".$id." and (TransferDate between '".$from."' and '".$to."')
union all
select TransferDate as TransDate,concat('To ',accounts_ledger.Ledger_Name) as Purticular,accounts_accountmaster.VoucherType,Amount as Credit,0  as Debit
from accounts_accountmaster 
inner join accounts_ledger on accounts_ledger.LedgerID= accounts_accountmaster.DebitAccount
where DebitAccount=".$id." and (TransferDate between '".$from."' and '".$to."')) aa order by TransDate asc;";
  $query = $this->db->query($sql);

//$query = $this->db->get();
   $result = $query->result();
       return $result;
    
}

public function get_ledgers()
{
  
  $sql="  SELECT Ledger_Name,LedgerID FROM `accounts_ledger`;";
    $query = $this->db->query($sql);
 
     $result = $query->result();
         return $result;
}
}