<?php

class generomodel {
    protected $db;
    
    public function __construct() {
        if (!defined('MYSQL_HOST')) { 
            require_once ROOT_DIR . 'app/models/config.php'; 
        }
        
        try {
            $this->db = new PDO("mysql:host=".MYSQL_HOST.';dbname='.MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    function getallgeneros() {
        $query = $this->db->prepare("SELECT * FROM genero ORDER BY nombre ASC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    function getgenerobyid($id_genero) {
        $query = $this->db->prepare("SELECT * FROM genero WHERE id_genero = ?");
        $query->execute([$id_genero]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function insertgenero($nombre, $descripcion) { 
        $query = $this->db->prepare("INSERT INTO genero (nombre, descripcion) VALUES (?, ?)");
        $query->execute([$nombre, $descripcion]); 
        return $this->db->lastInsertId();
    }

    function deletegenero($id_genero) {
        $query = $this->db->prepare('DELETE FROM genero WHERE id_genero = ?');
        $query->execute([$id_genero]);
    }
    
    function updategenero($id_genero, $nombre, $descripcion) { 
        $query = $this->db->prepare('UPDATE genero SET nombre = ?, descripcion = ? WHERE id_genero = ?');
        $query->execute([$nombre, $descripcion, $id_genero]);
    }
}
