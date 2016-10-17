<?php
//require_once('./DBConnector.php'); 

class inventoryManager{
    
    private $db;
    
    public function __construct() {
        $this->db = DBConnector::getInstance();
    }
    
    public function getInventory() {
        $sql = "SELECT ID, inventory,description FROM product";
        $rows = $this->db->query($sql);
        return $rows;
    }
    
    public function getInventoryBySKU($SKU){
        $sql = "SELECT inventory FROM product WHERE SKU = '$SKU'";
        $rows = $this->db->query($sql);
        return $rows;
    }
    
     public function getDescriptionBySKU($SKU){
        $sql = "SELECT description FROM product WHERE SKU = '$SKU'";
        $rows = $this->db->query($sql);
        return $rows;
    }
    
    
    public function checkStock($items) {
    $result = array("status" => "", "items" => "");
    $lowItems = "";    
        foreach($items as $item){
            $quantity = $item['qty'];
            $SKU = $item['sku'];
          
            $inventory = $this->getInventoryBySKU($SKU);
            
            if($quantity < $inventory[0]['inventory']){
                $result['status'] = true;
            } else {
                $result['status'] = false;
                $currentItem = $this->getDescriptionBySKU($SKU);
                $lowItems .= " " . $currentItem[0]['description'];
                $result['items'] = $lowItems;
            }
            
        }
        return $result;
    }
    
 
    public function addInventory(){
        $sql = "UPDATE product SET inventory = inventory + '".$_POST['addInv']."' WHERE ID = '".$_POST['ID']."'";
        $rows = $this->db->query($sql);
        return $rows;
        
    }
    
    public function reduceInventory($items){
        foreach($items as $item){
            $sql = "UPDATE product SET inventory = inventory - '".$item['qty']."' WHERE SKU = '".$item['sku']."'";
            $rows = $this->db->query($sql);
            return $rows;
        }
    }

}
//$query = "UPDATE users SET username = '".$_POST['newname']."' WHERE username = '".$_POST['username']."'";
?>