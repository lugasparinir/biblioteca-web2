<?php
require_once './app/controllers/librocontroller.php';
require_once './app/controllers/authcontroller.php';

//creo constante con la url base (define base)
// server name = variable superglobal de PHP que contiene el nombre del host del servidor
//server port= contiene el puerto del servidor web
// php self=contiene la ruta y nombre del archivo actual que se está ejecutando
define('base_url','//'.$_SERVER['server_name'].':'.$_SERVER['server_port'].dirname($_SERVER['php_self']).'/');

$action='listar' //accion por defecto

if(!empty($_GET['action'])){  
    $action=$_GET['action'];  //si no esta vacia la accion le asigno ese valor sino listeo
}

$params=explode('/', $action); //parsea accion (obtiee id de accion)

switch($params[0]){
    case 'listarlibros':
        $Lcontroller=new librocontroller();
        $Lcontroller->showlibros();
        break;
    case 'agregarlibro':
        $Lcontroller=new librocontroller();
        $Lcontroller->addlibro();
        break;
    case 'borrarlibro':
        $Lcontroller=new librocontroller();
        $Lcontroller->deletelibro(); 
    case 'mostrarlibro':
         $Lcontroller=new librocontroller();
         $Lcontroller->showlibro();
    case 'editar':
          $Lcontroller=new librocontroller();
          $Lcontroller->updateLibro();
    case 'login':
        $Acontroller=new authcontroller();
        $Acontroller->showlogin();
    case 'verifylogin':
        $Acontroller=new authcontroller();
        $Acontroller->verifylogin();
}
