<?php

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
?>
<script src="<?php echo base_url(); ?>/assets/user_scripts/accounts/accounts_entry.js"></script>

<section class="content-header">
  <h1>
    Accounts Entry
  </h1>

</section>
<section class="content">
  <div class="col-md-5">
    <div class="box box-success">
      <div class="box-body">
        <form method="post" action="<?php echo base_url(); ?>add-accounts-entry">
          <div class="box-body" style="min-height:300px;">
            <div class=" row">
              <div class="form-group col-md-12">
                <label for="paymode">Pay Type</label>
                <select class="form-control" name="pay_type" id="pay_type" value="" onchange="hidediv();">
                  <option value="select">--Select Type--</option>
                  <option value="payment">Payment</option>
                  <option value="receipt">Receipt</option>
                  <option value="contra">Contra</option>
                  <option value="transfer">Transfer/Journal</option>
                </select>
              </div>
            </div>
            <div class=" row">
              <div class="form-group col-md-12">
                <label for="creditacc">Credit Account</label>
                <select class="form-control" name="creditaccount" id="creditaccount" value="--Select Type--">
                  <option value="">--Select--</option>

                </select>
              </div>
            </div>
            <div class=" row">
              <div class="form-group col-md-12">
                <label for="debitacc">Debit Account</label>
                <select class="form-control" name="debitaccount" id="debitaccount" value="--Select Type--">
                  <option value="">--Select--</option>


                </select>
              </div>
            </div>
            <div class=" row">
              <div class="form-group col-md-12">
                <label for="account">Amount</label>
                <input type="text" class="form-control" required id="amount" name="amount" placeholder="Amount to transfer">
              </div>
            </div>
            <div class=" row">
              <div class="form-group col-md-12">
                <label for="date">Date</label>
                <input type="date" value="<?php echo $today; ?>" class="form-control" required id="date" name="date"></input>
              </div>
            </div>
          </div><!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-success">Transfer</button>
            <button type="reset" class="btn btn-success">Reset</button>

          </div>

      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="box box-success">


      <div class="box-body" style="min-height: 100px;">

        <div class=" row">
          <div class="form-group col-md-12">
            <label for="account">Account</label>
            <textarea class="form-control" rows="3" required id="narration" name="narration" placeholder="Enter narration if any.."></textarea>
          </div>
        </div>
        <div class=" row" id="pay">
          <div class="form-group col-md-12">
            <label for="paymode">Pay Mode</label><br>
            <label>
              <input type="radio" checked="checked" value="cash" name="paymode" id="paymode" onclick="hideradio();" /> Cash
            </label>&nbsp;

            <input type="radio" name="paymode" value="cheque" id="paymode" onclick="visible();" /> Cheque
            </label>

          </div>
        </div>
        <div id="chequefield">
          <div class=" row">
            <div class="form-group col-md-12">
              <label for="chequenumber">Cheque Number</label>
              <input type="text" class="form-control" id="chequenumber" name="chequenumber" placeholder="Cheque Number" />
            </div>
          </div>

          <div class=" row">
            <div class="form-group col-md-12">
              <label for="date">Date</label>
              <input type="date" value="<?php echo date('m/d/yy'); ?>" class="form-control" id="chequedate" name="chequedate" placeholder="Cheque Date" />
            </div>
          </div>
          <div class=" row">
            <div class="form-group col-md-12">
              <label for="bank">Bank</label>
              <input type="text" class="form-control" id="bank" name="bank" placeholder="Bank Details" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

