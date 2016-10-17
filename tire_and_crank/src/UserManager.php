<?php

//require_once('./DBConnector.php');

//$um = new UserManager();

// Facade
class UserManager {

    private $db;
    private $salt = "3eb6e&*!H)ma";

    public function __construct() {
        $this->db = DBConnector::getInstance();
    }

    public function getUserProfile($userName = "") {

        $rows = $this->db->query("select * from user where user_name = :name",
            array(':name' => $userName));
        //var_dump($rows[0]);
        if(count($rows) == 1) {
            return $rows[0];
        }
        // otherwise
        return null;
    }

    public function findUser($usr = "", $pwd = "") {

        $str = $this->checkHash($pwd);
        $params = array(":usr" => $usr, ":pwd" => $str);

        
        $sql = "SELECT * FROM user WHERE user_name = :usr AND password = :pwd";

        $rows = $this->db->query($sql, $params);
        if(count($rows) > 0) {
            return $rows[0];
        }

        return null;
    }

    //password encrytion check with md5 + salt

    private function checkHash($pwd) {
        //add salt
        $pwd = $this->salt . $pwd;

        //get the hash value, if the password plus the salt equals the same hash value, pwd is correct.
        return md5($pwd);
    }

}

?>
