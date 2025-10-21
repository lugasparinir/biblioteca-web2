<?php


require_once 'app/models/libromodel.php';
require_once 'app/views/libroview.php';
require_once 'app/models/generomodel.php'; // asumo que existe


class librocontroller{
    private $model;
    private $view;


    
    public function __construct(){
        $this->model=new libromodel();
        $this->view=new libroview();
        
    }

    public function showlibros($request){ 
        $libros=$this->model->getalllibros();
        $this->view->showlibros($libros,$request->user); 
        }
        
    public function showlibro($request){ 
        $libro = $this->model->getlibrobyId($request->id); 
        $this->view->showlibro($libro, $request->user); 
    }



function addlibro($request){
    
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $tittle = $_POST['titulo'] ?? null;
        $autor = $_POST['autor'] ?? null;
        $idgenero = $_POST['genero'] ?? null;
        $descrip = $_POST['descripcion'] ?? null;
        
     
        if ($tittle && $autor && $idgenero) {
            $this->model->insertarLibro($tittle, $autor, $descrip, $idgenero);
            header("location:".BASE_URL."listarlibros"); 
            return;
        } else {
        
            header("location:".BASE_URL."agregarlibro"); 
            return;
        }
    } 
    
  
    else {
       
        $this->view->showform(null, $request->user);
    }
}

    function deletelibro($request){

        $this->model->deletelibro($request->id); 
        header("location:".BASE_URL."listarlibros"); 
        return;
    }


  public function updatelibro($request){ 
    $libro = $this->model->getlibrobyId($request->id); 
    $this->view->showform($libro, $request->user); 
}
    
}