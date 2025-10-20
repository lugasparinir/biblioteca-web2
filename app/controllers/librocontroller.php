<?php
require_once 'app/models/libromodel.php';
require_once 'app/views/libroview.php';
require_once 'app/models/generomodel.php';


class librocontroller{
    private $model;
    private $view;



   
    public function __construct(){
        $this->model=new libromodel();
        $this->view=new libroview();
        
    }

    public function showlibros($request){ //llama 'listarlibros' en router.php
       $libros=$this->model->getalllibros();
       $this->view->showlibros($libros,$request->user);  //le paso los datos a la vista del libro y del user para el login
        }
        
    public function showlibro($request){ 
       $libro = $this->model->getlibrobyId($request->id); 
       $this->view->showlibro($libro, $request->user); 
    }

     function addlibro(){
        authhelper::checkLogged();
    
      
        $tittle=$_POST['titulo'];
        $autor=$_POST['autor'];
        $idgenero=$_POST['genero'];

       $this->model->insertarLibro($nombre, $autor, $descrip, $idgenero);
             header("location:".BASE_URL."listarlibros"); 
             return;
    }

    function deletelibro($request){
        authhelper::checkLogged();
        $this->model->deletelibro($request->id); 
        header("location:".BASE_URL."listarlibros"); 
        return;
    }
     

    public function updatelibro(){ 
        authhelper::checkLogged();
       $libros=$this->model->getalllibrobyid();
       $this->view->updatelibro($libro);  
        }    
    
}
