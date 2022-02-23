<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trial_balance_model extends CI_Model {
public function find_Trialbalance($from)
{
   
   $sql="select al.Ledger_Name,
case when ((select  ifnull(sum(Amount),0) from accounts_accountmaster where CreditAccount=al.LedgerID and TransferDate<='".$from."')<(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=al.LedgerID and TransferDate<='".$from."')) then
(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=al.LedgerID and TransferDate<='".$from."')-(select  ifnull(sum(Amount),0) from accounts_accountmaster where CreditAccount=al.LedgerID and TransferDate<='".$from."') else 0 end as DebitAccount,
case when ((select  ifnull(sum(Amount),0) from accounts_accountmaster where CreditAccount=al.LedgerID and TransferDate<='".$from."')>(select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=al.LedgerID and TransferDate<='".$from."')) then
(select  ifnull(sum(Amount),0) from accounts_accountmaster where CreditAccount=al.LedgerID and TransferDate<='".$from."')- (select  ifnull(sum(Amount),0) from accounts_accountmaster where DebitAccount=al.LedgerID and TransferDate<='".$from."') else 0 end as Credit from accounts_ledger al";
  $query = $this->db->query($sql);

//$query = $this->db->get();
   $result = $query->result();
       return $result;
    
}
}