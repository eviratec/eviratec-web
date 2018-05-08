<?php

  if ('create-transaction' === $_REQUEST['form-id']) {
    MoneyCmd::createTransaction(
      $_REQUEST['TransactionWalletID'],
      $_REQUEST['TransactionDescription'],
      $_REQUEST['TransactionAmt']
    );
  }

?>
<div id="CreateTransactionForm"
  class="eviratec-web eviratec-form">
  <div class="form-field">
    <label for="TransactionDescription">
      Description
    </label>

    <span class="spacer"></span>

    <input id="TransactionDescription"
      name="TransactionDescription"
      placeholder="E.g. Car Service"
      value=""
      required>
  </div>

  <div class="form-field">
    <label for="TransactionAmt">
      Amount
    </label>

    <span class="spacer"></span>

    <input id="TransactionAmt"
      name="TransactionAmt"
      placeholder="E.g. 10.00"
      value=""
      required>
  </div>

  <button id="CreateTransaction">
    Create Transaction
  </button>
  <input name="form-id"
    type="hidden"
    value="create-transaction">
</div>
