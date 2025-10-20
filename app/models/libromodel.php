

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
    

   
    
    public function getalllibros() {
    $query = $this->db->prepare('SELECT l.*, g.nombre AS nombre_genero FROM libro l JOIN genero g ON l.id_genero = g.id_genero'); //JOIN para obtener nombre genero (categoria)
    $query->execute();
    $libros = $query->fetchAll(PDO::FETCH_OBJ);
    return $libros;
}
public function getlibrobyId($id) {
    $query = $this->db->prepare('SELECT l.*, g.nombre AS nombre_genero FROM libro l JOIN genero g ON l.id_genero = g.id_genero WHERE l.id = ?');
    $query->execute([$id]);
    $libro = $query->fetch(PDO::FETCH_OBJ);
    return $libro;
}

function insertarlibro($nombre, $autor, $descripcion, $idgenero) { 
    
    $query = $this->db->prepare("INSERT INTO libro (nombre, autor, descripcion, id_genero) VALUES(?,?,?,?)");
    $query->execute([$nombre, $autor, $descripcion, $idgenero]); 

    
}
    function deleteLibro($id) {
        $query = $this->db->prepare('DELETE from libro where id = ?');
        $query->execute([$id]);

        
    }

  function updatelibro($id, $nombre, $autor, $descripcion, $idgenero) { 
    $query = $this->db->prepare('UPDATE libro SET nombre = ?, autor = ?, descripcion = ?, id_genero = ? WHERE id = ?');
    $query->execute([$nombre, $autor, $descripcion, $idgenero, $id]);
}
}


    


