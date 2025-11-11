<?php

require_once ROOT_DIR . 'app/models/libromodel.php';
require_once ROOT_DIR . 'app/views/libroview.php';
require_once ROOT_DIR . 'app/models/generomodel.php';

class librocontroller{
    private $model;
    private $view;
    private $generoModel; 

    public function __construct(){
        $this->model = new libromodel();
        $this->view = new libroview();
        $this->generoModel = new generomodel(); 
    }

    public function showlibros($request){ 
        $libros = $this->model->getalllibros();
        $this->view->showlibros($libros, $request->user); 
    }
    
    public function showLibrosByGenero($request) { 
        $libros = $this->model->getLibrosByGenero($request->id); 
        $this->view->showlibros($libros, $request->user); 
    }

    public function showlibro($request){ 
        $libro = $this->model->getlibrobyId($request->id); 
        $this->view->showlibro($libro, $request->user, null); 
    }

    public function showAddForm($request) { 
        $generos = $this->generoModel->getAllGeneros(); 
        $this->view->showform(null, $generos, $request->user); 
    }

    public function updatelibro($request){ 
        $libro = $this->model->getlibrobyId($request->id); 
        $generos = $this->generoModel->getAllGeneros(); 
        $this->view->showform($libro, $generos, $request->user); 
    }
    
    // POST para guardar Alta y Edición
    public function saveLibro($request){
        $id = $_POST['id'] ?? null; 
        $titulo = $_POST['titulo'] ?? null; // Usar 'titulo'
        $autor = $_POST['autor'] ?? null;
        $idgenero = $_POST['genero'] ?? null;
        $descrip = $_POST['descripcion'] ?? null;

        if (!$titulo || !$autor || !$idgenero) {
            $error = "Faltan campos obligatorios.";
            $generos = $this->generoModel->getAllGeneros();
            $libro_data = (object)['id' => $id, 'titulo' => $titulo, 'autor' => $autor, 'descripcion' => $descrip, 'id_genero' => $idgenero];
            return $this->view->showform($libro_data, $generos, $request->user, $error);
        }

        if ($id) {
            $this->model->updateLibro($id, $titulo, $autor, $descrip, $idgenero);
            $redirect_id = $id;
        } else {
            $redirect_id = $this->model->insertarlibro($titulo, $autor, $descrip, $idgenero);
        }
        
        header("Location: " . BASE_URL . "mostrarlibro/$redirect_id"); 
    }

    function deletelibro($request){
        $this->model->deletelibro($request->id); 
        header("Location: " . BASE_URL . "listarlibros"); 
    }
}
