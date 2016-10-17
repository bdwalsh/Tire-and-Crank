<?php


// No real design pattern here although I suppose you could categorize it as
// a Helper Class; but it's more of a utilities class with a bunch of
// helper methods in it - a "catch all" really
class Utils {

    public static function isAJAX() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public static function isPOST() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function isGET() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public static function goToPage($newURL) {
        header('Location: '. $newURL);
    }

    public static function setResponseTypeToJSON() {
        header('Content-type: application/json');
    }

    public static function setResponseTypeToHTML() {
        header('Content-type: text/html');
    }

}


?>
