<?php
require_once 'models/libromodel.php';
require_once 'views/libroview.php';

class librocontroller{
    private $model;
    private $view;


   
    public function __construct(){
        $this->model=new libromodel();
        $this->view=new libroview();
    }

    public function showlibros(){ //llama 'listar' en router.php
       $libros=$this->model->getalllibros();
       $this->view->showlibros($libros);  //le paso los datos a la vista
        }

     function addlibro(){
        
        $tittle=$_POST['nombre'];
        $autor=$_POST['autor'];
        $descrip=$_POST['descripcion'];
        $idpersona=$_POST['idpersona'];

       $id=$this->model->insertlibro($tittle,$autor,$descrip,$idpersona);
    
        header("location:".base_url."listar");
    }

    function deletelibro($id){
        $this->model->deletelibro($id);
        header("location:".base_url)."listar";
    }
     
    public function showlibro(){ 
       $libros=$this->model->getalllibrobyid();
       $this->view->showlibro($libro);  
        }

    public function updatelibro(){ 
       $libros=$this->model->getalllibrobyid();
       $this->view->updatelibro($libro);  
        }    
    
}
