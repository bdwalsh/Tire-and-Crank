<?php
require_once('init.php');
loadScripts();

   if(Utils::isPOST()) {
      
        $parameters = new Parameters("POST");

        $action = $parameters->getValue('action');
        $im = new inventoryManager();
        if($action == 'getInventory'){

            $rows = $im->getInventory();
            $data = array(); 
            foreach($rows as $row) {
                if($row['inventory'] < 3){ 
                    $low = $row['ID'];
                    array_push($data, $row);
                 } 
            }
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;
           
        }
       
      if($action == 'getallInventory'){ 
          
          $SKU = "sk-327623z";
          $data = $im->getInventoryBySKU($SKU);
          echo json_encode($data, JSON_FORCE_OBJECT);
          return;
      }   
     
      if($action == 'addInventory'){ 
          $im->addInventory();
      }
       
      if($action == 'reduceInventory'){ 
          $im->reduceInventory();
      }
       
    }

?>

