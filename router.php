<?php
require_once './app/middleware/sessionmiddleware.php';
require_once './app/middleware/guardmiddleware.php';
require_once './app/controllers/librocontroller.php';
require_once './app/controllers/authcontroller.php';

define('ROOT_PATH', __DIR__ . '/');
if (isset($_SERVER['SERVER_NAME']) && isset($_SERVER['SERVER_PORT']) && isset($_SERVER['PHP_SELF'])) {
    define('base_url','//'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].dirname($_SERVER['PHP_SELF']).'/');
}

$action='listarlibros'; //accion por defecto

if(!empty($_GET['action'])){  
    $action=$_GET['action'];  //si no esta vacia la accion le asigno ese valor sino listeo
}


$params=explode('/', $action); //parsea accion (obtiee id de accion)

$request = new StdClass();
$request = (new SessionMiddleware())->run($request);


switch($params[0]){
    case 'listarlibros':
        $Lcontroller = new librocontroller();
        $Lcontroller->showlibros($request);
        break;
    case 'agregarlibro':
        $request = (new GuardMiddleware())->run($request);
        $Lcontroller = new librocontroller();
        $Lcontroller->addlibro($request);
        break;
    case 'borrarlibro':
        $request = (new GuardMiddleware())->run($request);
        $Lcontroller = new librocontroller();
        $request->id = $params[1];
        $Lcontroller->deletelibro($request);
        break;
    case 'mostrarlibro':
         $request = (new GuardMiddleware())->run($request);
        $Lcontroller = new librocontroller();
        $request->id = $params[1];
        $Lcontroller->showlibro($request);
        break;
    case 'editar':
        $request = (new GuardMiddleware())->run($request);
        $Lcontroller = new librocontroller();
        $request->id = $params[1];
        $Lcontroller->updateLibro($request);
        break;
     case 'login':
        $Acontroller = new authController();
        $Acontroller->showlogin($request);
        break;
    case 'verifylogin':
        $Acontroller = new authController();
        $Acontroller->verifylogin($request);
        break;

}