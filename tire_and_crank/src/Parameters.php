<?php

// https://sourcemaking.com/refactoring/introduce-parameter-object
// Parameter Object
class Parameters {

    private $values = array();

    public function __construct($method = "GET") {

        if($method === "GET") {

            foreach ($_GET as $key => $value){
                $this->values[$key] = $value;
            }

        } else if ($method === "POST") {

            foreach ($_POST as $key => $value){
                $this->values[$key] = $value;
            }

        }
        return $this->values;
    }

    public function getValue($key) {
        if(isset($key)) {
            return $this->values[$key];
        }
        return null;
    }

    public function values() {
        return $this->values;
    }

    public function valuesAsString($delimiter = " ") {
        return implode($delimiter, $this->data);
    }

}

?>
