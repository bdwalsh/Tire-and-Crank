<?php

require_once('init.php');
loadScripts();

    $data = array("status" => "not set!");

    if(Utils::isPOST()) {
        // post means either to delete or add a user
        $parameters = new Parameters("POST");

        $action = $parameters->getValue('action');
        $prodID = $parameters->getValue('prodID');

        //$data = array("action" => $action, "user_name" => $user_name);
        if($action == 'delete' && !empty($prodID)) {

            $um = new ProductManager();
            $um->deleteProduct($prodID);
            $data = array("status" => "success", "msg" => "Product '$prodID' deleted.");
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;

        } else if($action == 'update' && !empty($prodID)) {
            $editedDesc = $parameters->getValue('editedDesc');
            $editedPrice = $parameters->getValue('editedPrice');
            
            if(!empty($editedDesc) && !empty($editedPrice)) {

                $um = new ProductManager();
                $count = $um->updateProduct($prodID, $editedDesc, $editedPrice);
                if($count > 0) {
                    $data = array("status" => "success", "msg" =>
                        "User '$prodID' updated with new Description ('$editedDesc').");
                } else {
                    $data = array("status" => "fail", "msg" =>
                        "User '$prodID' was NOT updated with new Description ('$editedDesc').");
                }
            } else {
                $data = array("status" => "fail", "msg" =>
                    "New Description must be present - value was '$editedDesc' for '$prodID'.");

            }
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;

        } else if($action == 'add') {
            $newDescription = $parameters->getValue('newDescription');
            $newPrice = $parameters->getValue('newPrice');
            $newSKU = $parameters->getValue('newSKU');

            if(!empty($newDescription) && !empty($newPrice) && !empty($newSKU)) {
                $data = array("status" => "success", "msg" => "User added.");
                $um = new ProductManager();
                $um->addProduct($newDescription, $newPrice, $newSKU);

            } else {
                $data = array("status" => "fail", "msg" => "Description, Price, and SKU cannot be empty.");
            }
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;

        }else {
            $data = array("status" => "fail", "msg" => "Action not understood.");
        }

        echo json_encode($data, JSON_FORCE_OBJECT);
        return;

    } else if(Utils::isGET()) {
        // get means get the list of users
        $um = new ProductManager();
        $rows = $um->listProducts();
        $html = "";
        if($rows != null) {

            foreach($rows as $row) {
                $description = $row['description'];
                $item_price = $row['item_price'];
                $SKU = $row['SKU'];
                $ID = $row['ID'];
                $html .= "<tr>
                  <td class='description'><span>$description</span></td>
                  <td class='price'><span>$item_price</span></td>
                  <td class='SKU'><span>$SKU</span></td>
                  <td><input id='d-$ID' class='delete warning button' type='button' value='Delete'/></td>
                  <td><input id='u-$ID' class='update button' type='button' value='Update'/></td>
                  <td><input id='i-$ID' class='inventory button' type='number' value='5'/><button id='$ID' class='addInv button'>Add</button></td>
                 
                  </tr>";
            }
            echo $html;

        } else {
            // shouldn't be but ...
            echo 'The returned rows is "null". No product table perhaps?';
        }

        return;

    } else {
        $data = array("status" => "error", "msg" => "Only GET and POST allowed.");
        echo json_encode($data, JSON_FORCE_OBJECT);
    }



?>
