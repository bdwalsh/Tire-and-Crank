<?php

//require_once('./Messages.php');

// Secure Session Manager
class Session {

    public static function init() {
        // can add a message here if need be
        //Messages::addMessage("info", "Creating session");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function get($key) {
        self::init();
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    public static function set($key, $value) {
        self::init();
        $_SESSION[$key] = $value;
    }

    public static function has($key) {
        return isset($_SESSION[$key]);
    }

    public static function remove($key) {
        self::init();
        if(isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function clearAll() {
        self::init();
        session_unset();
    }

    public static function closeSession() {
      self::init();
        session_unset();
        session_destroy();
    }
}

?>
