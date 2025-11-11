<?php

define('BASE_URL', '/bibliotecaweb2/'); 
define('ROOT_DIR', __DIR__ . '/'); 

require_once ROOT_DIR . 'app/models/config.php';
require_once ROOT_DIR . 'app/controllers/librocontroller.php';
require_once ROOT_DIR . 'app/controllers/generocontroller.php';
require_once ROOT_DIR . 'app/controllers/authcontroller.php';
require_once ROOT_DIR . 'app/middlewares/sessionmiddleware.php'; 
require_once ROOT_DIR . 'app/middlewares/guardmiddleware.php'; 


$action = $_GET['action'] ?? 'listarlibros'; 
$params = explode('/', $action);
$request = new StdClass();


$request = (new sessionmiddleware())->run($request); 


$Gcontroller = new GeneroController(); 

switch($params[0]){


    case 'login':
        (new AuthController())->showlogin($request);
        break;
    case 'auth':
       
        (new AuthController())->authenticate($request); 
        break;
    case 'logout':
        (new AuthController())->logout($request);
        break;
        
    
    case 'listarlibros':
        (new librocontroller())->showlibros($request);
        break;

    case 'mostrarlibro':
        $request->id = $params[1] ?? null;
        (new librocontroller())->showlibro($request);
        break;

    case 'librosporgenero':
        $request->id = $params[1] ?? null;
        (new librocontroller())->showLibrosByGenero($request);
        break;

    
    case 'agregarlibro': 
        $request = (new guardmiddleware())->run($request); 
        (new librocontroller())->showAddForm($request); 
        break;
        
    case 'editar': 
        $request = (new guardmiddleware())->run($request); 
        $request->id = $params[1] ?? null;
        (new librocontroller())->updatelibro($request);
        break;
        
    case 'savelibro': 
        $request = (new guardmiddleware())->run($request);
        (new librocontroller())->saveLibro($request);
        break;
        
    case 'borrarlibro':
        $request = (new guardmiddleware())->run($request); 
        $request->id = $params[1] ?? null;
        (new librocontroller())->deletelibro($request);
        break;
        
   
    
    case 'listargeneros': 
        (new GeneroController())->showGeneros($request);
        break;
        
  
    case 'agregargenero': 
        $request = (new guardmiddleware())->run($request); 
        (new GeneroController())->showForm($request); 
        break;
        
    case 'editargenero': 
        $request = (new guardmiddleware())->run($request); 
        $request->id = $params[1] ?? null;
        (new GeneroController())->showForm($request);
        break;

    case 'savegenero': 
        $request = (new guardmiddleware())->run($request); 
        (new GeneroController())->saveGenero($request); 
        break;
        
    case 'borrargenero':
        $request = (new guardmiddleware())->run($request); 
        $request->id = $params[1] ?? null;
        (new GeneroController())->deleteGenero($request);
        break;
        
    default:
        header("Location: " . BASE_URL . "listarlibros");
        break;
}