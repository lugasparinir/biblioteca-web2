<?php

require_once './app/middleware/sessionmiddleware.php';
require_once './app/middleware/guardmiddleware.php';
require_once './app/controllers/librocontroller.php';
require_once './app/controllers/authcontroller.php';

define('ROOT_PATH', __DIR__ . '/'); 

if (isset($_SERVER['SERVER_NAME']) && isset($_SERVER['SERVER_PORT']) && isset($_SERVER['PHP_SELF'])) {
    define('BASE_URL','//'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].dirname($_SERVER['PHP_SELF']).'/');
}


$action='listarlibros'; //accion por defecto

if(!empty($_GET['action'])){ 
    $action=$_GET['action']; 
}


$params=explode('/', $action);

$request = new StdClass();
$request = (new SessionMiddleware())->run($request); // Inicia sesión y setea $request->user


switch($params[0]){
    case 'listarlibros':
        $Lcontroller = new librocontroller();
        $Lcontroller->showlibros($request);
        break;
    case 'agregarlibro':
        $request = (new guardmiddleware())->run($request);
        $Lcontroller = new librocontroller();
        $Lcontroller->addlibro($request);
        break;
    case 'borrarlibro':
        $request = (new guardmiddleware())->run($request);
        $Lcontroller = new librocontroller();
        $request->id = $params[1];
        $Lcontroller->deletelibro($request);
        break;
    case 'mostrarlibro':
        $Lcontroller = new librocontroller(); 
        $request->id = $params[1];
        $Lcontroller->showlibro($request);
        break;
    case 'editar':
        $request = (new guardmiddleware())->run($request);
        $Lcontroller = new librocontroller();
        $request->id = $params[1];
        $Lcontroller->updateLibro($request);
        break;
    case 'login':
        $Acontroller = new authcontroller();
        $Acontroller->showlogin($request);
        break;
    case 'verifylogin':
        $Acontroller = new authcontroller();
        $Acontroller->verifylogin($request);
        break;
    case 'logout': // Agregado el caso de logout
        $Acontroller = new authcontroller();
        $Acontroller->logout($request);
        break;
}