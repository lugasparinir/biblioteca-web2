<?php

class usermodel{
    protected $db;
    
    public function __construct() {
        if (!defined('MYSQL_HOST')) { 
            require_once 'app/models/config.php';
        }
        
        $this->db = new PDO("mysql:host=".MYSQL_HOST.';dbname='.MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getbyemail($email){
        $query = $this->db->prepare("SELECT * FROM `user` WHERE email = ?"); 
        $query->execute([$email]);

        $user = $query-> fetch (PDO::FETCH_OBJ);

        return $user;
    }
}

