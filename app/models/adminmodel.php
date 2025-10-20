<?php
class adminmodel{
protected $db;
    
    public function __construct() {
        if (!defined('MYSQL_HOST')) { 
            require_once 'config.php'; 
        }
        
        // Conexión a la base de datos
        $this->db = new PDO("mysql:host=".MYSQL_HOST.';dbname='.MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getbyemail($email){
        $query = $this->db->prepare("SELECT * FROM `admin` WHERE email = ?") 
        $query->execute([$email]);

        $admin=$query-> fetch (PDO::FETCH_OBJ);

        return $admin;
    }
}


