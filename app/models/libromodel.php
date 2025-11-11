<?php
class libroModel {
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
    
    public function getalllibros() {
        $query = $this->db->prepare('SELECT l.*, g.nombre AS nombre_genero FROM libro l JOIN genero g ON l.id_genero = g.id_genero ORDER BY l.titulo ASC'); 
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getlibrobyId($id) {
        $query = $this->db->prepare('SELECT l.*, g.nombre AS nombre_genero FROM libro l JOIN genero g ON l.id_genero = g.id_genero WHERE l.id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    
    function insertarlibro($titulo, $autor, $descripcion, $idgenero) { 
        $query = $this->db->prepare("INSERT INTO libro (titulo, autor, descripcion, id_genero) VALUES(?,?,?,?)");
        $query->execute([$titulo, $autor, $descripcion, $idgenero]); 
        return $this->db->lastInsertId();
    }
    
    function deleteLibro($id) {
        $query = $this->db->prepare('DELETE from libro where id = ?');
        $query->execute([$id]);
    }

   
    function updatelibro($id, $titulo, $autor, $descripcion, $idgenero) { 
        $query = $this->db->prepare('UPDATE libro SET titulo = ?, autor = ?, descripcion = ?, id_genero = ? WHERE id = ?');
        $query->execute([$titulo, $autor, $descripcion, $idgenero, $id]);
    }

    public function getlibrosbygenero($id_genero) {
        $query = $this->db->prepare('SELECT l.*, g.nombre AS nombre_genero FROM libro l JOIN genero g ON l.id_genero = g.id_genero WHERE l.id_genero = ?');
        $query->execute([$id_genero]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}



    


