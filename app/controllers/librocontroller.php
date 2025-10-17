<?php
require_once 'models/libromodel.php';
require_once 'views/libroview.php';
require_once 'helpers/authelper.php'; //control de acceso

class librocontroller{
    private $model;
    private $view;
    private $personamodel


   
    public function __construct(){
        $this->model=new libromodel();
        $this->view=new libroview();
        $this->personaModel = new personaModel();
    }

    public function showlibros(){ //llama 'listar' en router.php
       $libros=$this->model->getalllibros();
       $this->view->showlibros($libros);  //le paso los datos a la vista
        }

     function addlibro(){
        authhelper::checkLogged();
        $tittle=$_POST['nombre'];
        $autor=$_POST['autor'];
        $descrip=$_POST['descripcion'];
        $idpersona=$_POST['idpersona'];

       $id=$this->model->insertlibro($tittle,$autor,$descrip,$idpersona);
    
        header("location:".base_url."listar");
    }

    function deletelibro($id){
        authhelper::checkLogged();
        $this->model->deletelibro($id);
        header("location:".base_url ."listar");
    }
     
    public function showlibro(){ 
       $libros=$this->model->getallibrobyid();
       $this->view->showlibro($libro);  
        }

    public function updatelibro(){ 
        authhelper::checkLogged();
       $libros=$this->model->getalllibrobyid();
       $this->view->updatelibro($libro);  
        }    
    
}
