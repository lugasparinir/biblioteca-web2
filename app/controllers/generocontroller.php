<?php

require_once ROOT_DIR . 'app/models/generomodel.php';
require_once ROOT_DIR . 'app/views/generoview.php'; 

class GeneroController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new GeneroModel();
        $this->view = new GeneroView();
    }

    public function showGeneros($request) {
        $generos = $this->model->getAllGeneros();
        $this->view->showGeneros($generos, $request->user); 
    }
    
    public function showForm($request) {
        $genero = null;
        $error = null;
        if (isset($request->id) && is_numeric($request->id)) {
            $genero = $this->model->getGeneroById($request->id);
            if (!$genero) {
                header("Location: " . BASE_URL . "listargeneros"); 
                return;
            }
        }
        $this->view->showForm($genero, $request->user, $error);
    }

    public function saveGenero($request) {
        $id = $_POST['id'] ?? null;
        $nombre = $_POST['nombre'] ?? null;
        $descripcion = $_POST['descripcion'] ?? ''; 
        
        if (empty($nombre)) {
            $error = "El nombre del género es obligatorio.";
            $genero_data = (object)['id_genero' => $id, 'nombre' => $nombre, 'descripcion' => $descripcion];
            return $this->view->showForm($genero_data, $request->user, $error);
        }

        if ($id) {
            $this->model->updateGenero($id, $nombre, $descripcion);
        } else {
            $this->model->insertGenero($nombre, $descripcion);
        }

        header("Location: " . BASE_URL . "listargeneros");
        return;
    }

public function deleteGenero($request) {
    $id_genero = $request->id;
    
    if ($id_genero) {
        $this->model->deleteGenero($id_genero);
    }
    
    header("Location: " . BASE_URL . "listargeneros");
    return;
}
}