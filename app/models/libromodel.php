

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
    
    
    public function getAllLibros() {
        $query = $this->db->prepare("SELECT l.id, l.nombre, l.autor, l.descripcion, l.`id-persona`,p.nombre AS nombre_persona FROM libro  INNER JOIN persona p ON l.`id-persona` = p.id" ""); 
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    
    
    
    public function addLibro($titulo, $autor, $descripcion, $idpersona) {
        $query = $this->db->prepare(("INSERT INTO libro (nombre, autor, descripcion, `id-persona`) VALUES (?, ?, ?, ?)"));
        $query->execute([$titulo, $autor, $descripcion, $idpategoria]);
        return $this->db->lastInsertId();
    }
    
    public function deleteLibro($id) {
        $query = $this->db->prepare("DELETE FROM libro WHERE id = ?");
        $query->execute([$id]);
    }

   public function getLibroById($id) { //join para obtener nombre persona
    $query = $this->db->prepare (" SELECT l.id, l.nombre, l.autor, l.descripcion, l.`id-persona`, p.nombre AS nombre_persona FROM libro l INNER JOIN persona p ON l.`id-persona` = p.id ");

    $query->execute([$id]);
.
    return $query->fetch(PDO::FETCH_OBJ);
}
    public function updateLibro($id, $titulo, $autor, $descripcion, $idpersona) {
    $query = $this->db->prepare("UPDATE libro SET nombre = ?, autor = ?, descripcion = ?, `id-persona` = ? WHERE id = ?";"");
    $query->execute([
         $titulo,$autor,$descripcion,$idpersona,$id           
    ]);
}
} 
    
