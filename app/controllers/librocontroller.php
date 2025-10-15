<?php
require_once 'models/libromodel.php';
require_once 'views/libroview.php';

class librocontroller{
    private $model;
    private $view;


   
    public function __construct(){
        $this->$model=new libromodel();
        $this->view=new libroview();
    }

    public function showlibros(){ //llama 'listar' en router.php
       $libros=$this->model->getalllibros();
       $this->view->showlibros();
    }

     function adddlibro(){
        
        $tittle=$_POST['nombre'];
        $autor=$_POST['autor'];
        $descrip=$_POST['descripcion'];
        $idpersona=$_POST['idpersona']

       $id=$this->model->insertlibro($tittle,$autor,$descrip,$idpersona);
    
        header("location:".base_url);
    }

    function deletelibro($id){
        $this->model->deletelibro($id);
        header("location:".base_url);
    }
    
}
