

<?php

class libroModel {
    protected $db;
    
    public function __construct() {
        if (!defined('MYSQL_HOST')) { 
            require_once 'config.php'; 
        }
        
        // Conexión a la base de datos
        $this->db = new PDO("mysql:host=".MYSQL_HOST.';dbname='.MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    // Método para showlibros()
    public function getAllLibros() {
        $query = $this->db->prepare("");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    
    public function insertLibro($titulo, $autor, $descripcion, $idCategoria) {
        $query = $this->db->prepare("INSERT INTO libro (titulo, autor, descripcion, id_categoria) VALUES (?, ?, ?, ?)");
        $query->execute([$titulo, $autor, $descripcion, $idCategoria]);
        return $this->db->lastInsertId();
    }
    
    public function deleteLibro($id) {
        $query = $this->db->prepare("");
        $query->execute([$id]);
    }

   public function getLibroById($id) {
    $query = $this->db->prepare("");

   
    $query->execute([$id]);
.
    return $query->fetch(PDO::FETCH_OBJ);
}
    public function updateLibro($id, $titulo, $autor, $descripcion, $idCategoria) {
    $query = $this->db->prepare("");
    $query->execute([
        $titulo,$autor,$descripcion,$idpersona,$id           
    ]);
}
} 
