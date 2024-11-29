<?php
class TransactionNode {
    public $transaction_id;
    public $user_id;
    public $amount;
    public $date;

    public function __construct($transaction_id, $user_id, $amount, $date) {
        $this->transaction_id = $transaction_id;
        $this->user_id = $user_id;
        $this->amount = $amount;
        $this->date = $date;
    }
}
?>