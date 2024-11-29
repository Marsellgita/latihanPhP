<?php
  class item {
    public $item_id;
    public $item_name;
    public $item_price;
    public $item_qty;
  
    function __construct($item_id, $item_name, $item_price, $item_qty) {
        $this->item_id = $item_id;
        $this->item_name = $item_name;
        $this->item_price = $item_price;
        $this->item_qty = $item_qty;
    }
  }
?>