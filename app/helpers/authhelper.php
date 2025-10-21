<?php

class Authhelper {
    
    
    public static function startsession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function islogged() {
        self::startsession(); 
        if (isset($_SESSION['IS_LOGGED']) && $_SESSION['IS_LOGGED'] === true) {
            return true;
        }
        return false;
    }

    public static function checklogged() {
        self::startsession(); 
        
        if (!self::islogged()) {
             
             if (!defined('BASE_URL')) {
                 
                 require_once 'app/models/config.php'; 
             }
             header("Location: " . BASE_URL . "login");
             die();
        }
    }
}