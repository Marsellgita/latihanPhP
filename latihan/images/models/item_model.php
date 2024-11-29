<?php 
require_once 'domain_object/node_item.php';
class modelItem
{
    private $items = [];
    private $nextId = 1;
    public function __construct() {
        if (isset($_SESSION['items'])) {
            $this->items = unserialize($_SESSION['items']);
            $this->nextId = count($this->items) + 1;
        } else {
            $this->initializeDefaultItem();
        }
    }
    public function initializeDefaultItem() {
        $this->addItem("VARIO 160 ABS", "Rp30.300.000", 5);
        $this->addItem("VARIO 160 CBS", "Rp27.300.000", 10);
        $this->addItem("BEAT STREET", "Rp20.300.000", 5);
    }
    public function addItem($item_id,$item_price, $item_qty) {
        $barang = new Item($this->nextId++, $item_id, $item_price, $item_qty);
        $this->items[] = $barang;
        $this->saveToSession();
    }   
    private function saveToSession() {
        $_SESSION['items'] = serialize($this->items);
    }
    public function getAllItem() {
        return $this->items;
    }
    public function getItemById($item_id) {
        foreach ($this->items as $items) {
            if ($items->item_id == $item_id) {
                return $items;
            }
        }
        return null;
    }
    public function updateItem($item_id, $item_name, $item_price, $item_qty) {
        foreach ($this->items as $items) {
            if ($items->item_id == $item_id) {
                $items->item_name = $item_name;
                $items->item_price = $item_price;
                $items->item_qty = $item_qty;
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }
    public function deleteItem($item_id) {
        foreach ($this->items as $key => $items) {
            if ($items->item_id == $item_id) {
                unset($this->items[$key]);
                $this->items = array_values($this->items);
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }
    public function getItemByName($item_name) {
        foreach ($this->items as $items) {
            if ($items->item_name == $item_name) {
                return $items;
            }
        }
        return null;
    }
}
?>