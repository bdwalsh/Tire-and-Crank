<?php

// http://www.eventhelix.com/RealtimeMantra/PatternCatalog/message_factory_and_interface_pattern.htm
// Notification
class Messages {

    // static AKA class variable - belongs to the class not the object
    private static $messageList = array();


    public static function addMessage($type, $text) {
        $msg = new Message($type, $text);
        array_push(self::$messageList, $msg);
    }

    public static function hasMessages() {
        return count(self::$messageList) > 0;
    }

    public static function getMessages() {
        return self::$messageList;
    }

    public static function getAllMessagesHTMLList() {
        $html = "<ul>";
        foreach(self::$messageList as $msg) {
            $html .= "<li>[" .$msg->type . "] " .  $msg->text . "</li>";
        }
        $html .= "</ul>";

        return $html;
    }

}

class Message {

    public $text;
    public $type;

    function __construct($type, $text) {
        $this->text = $text;
        $this->type = $type;
    }


}

?>
