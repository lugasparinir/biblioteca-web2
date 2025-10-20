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

    public function showlibros(){ //llama 'listarlibros' en router.php
       $libros=$this->model->getalllibros();
       $this->view->showlibros($libros);  //le paso los datos a la vista
        }
        
        public function showlibro(){ 
       $libros=$this->model->getallibrobyid();
       $this->view->showlibro($libro);  
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
     

    public function updatelibro(){ 
        authhelper::checkLogged();
       $libros=$this->model->getalllibrobyid();
       $this->view->updatelibro($libro);  
        }    
    
}
