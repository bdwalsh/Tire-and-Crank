<?php

require_once('init.php');
loadScripts();

    $data = array("status" => "not set!");

    if(Utils::isGET()) {
        $pm = new ProductManager();
        $rows = $pm->listProducts();

        $html = "";
        foreach($rows as $row) {
            
            if($row['imgURL'] != null) {
                $imgURL = "./img/products/" . $row['imgURL'];
            } else {
                $imgURL = "./img/products/product_default.jpg";
            }
            $sku = $row['SKU'];
            $ID = $row['ID'];
            $price = $row['item_price'];
            $desc = $row['description'];
            $inventory = $row['inventory'];
            $html .= "<tr>
                        <td class='hide-for-small-only'><img class='thumbnail' src='$imgURL' height='150px' width='150px'>
                        <td data-sku-desc='$sku'>$desc</td>
                        <td><input data-sku-qty='$sku' type='number' value='1' min='1' max='10' step='1'/></td>
                        <td data-sku-price='$sku'>$price</td>
                        <td><input data-sku-add='$sku' type='button' class='button' value='Add'/></td>
                        <td data-sku-ID='$ID'></td>
                      </tr>";
        }
        echo $html;
        return;

    } else {
        $data = array("status" => "error", "msg" => "Only GET allowed.");

    }

    echo json_encode($data, JSON_FORCE_OBJECT);

?>
