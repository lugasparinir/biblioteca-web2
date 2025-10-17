<?php
class Authhelper {
    
    public static function islogged() {
        self::startsession();
        if (isset($_SESSION['IS_LOGGED']) && $_SESSION['IS_LOGGED'] === true) {
            
            return true;
        }
        return false;
    }

    public static function checklogged() {
        if (!self::logged()) {
            header("Location: " . self::$BASE_URL . "login");
            die();
        }
    }
    
}