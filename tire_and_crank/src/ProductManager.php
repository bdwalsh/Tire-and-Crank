<?php

//require_once('./DBConnector.php');

//$um = new UserManager();

// Facade
class ProductManager {

    private $db;

    public function __construct() {
        $this->db = DBConnector::getInstance();
    }

    public function listProducts() {
        $sql = "SELECT SKU, item_price, description, ID, imgURL FROM product";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function updateProduct($prodID, $editedDesc, $editedPrice) {
        $sql = "UPDATE product SET description = '$editedDesc', item_price = '$editedPrice' WHERE id = '$prodID'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function deleteProduct($ID) {
        $sql = "DELETE FROM product WHERE ID = '$ID'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function addProduct($newDescription, $newPrice, $newSKU) {

        $sql = "INSERT INTO product (description, item_price, SKU)
            VALUES ('$newDescription', '$newPrice', '$newSKU')";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function findProduct($usr, $pwd) {
        $params = array(":usr" => $usr, ":pwd" => $pwd);
        $sql = "SELECT * FROM user WHERE user_name = :usr AND password = :pwd";

        $rows = $this->db->query($sql, $params);
        if(count($rows) > 0) {
            return $rows[0];
        }

        return null;
    }


}

?>
