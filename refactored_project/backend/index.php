<?php

// starting output buffering
ob_start();

// init. dependencies & environment
require_once "./vendor/autoload.php";
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable( __DIR__ );
$dotenv->load();

// loading HTTP verbs-related objects
use App\Http\Requests\GetRequest;
// TODO
// use App\Http\Requests\PatchRequest;
// use App\Http\Requests\PostRequest;
// use App\Http\Requests\DeleteRequest;

// loading app' controllers
use App\Controllers\HomeController; 
use App\Controllers\NotFoundController;
// TODO
// use App\Controllers\Entities\SessionsController;
// use App\Controllers\Entities\UsersController;

// we set the default timezone
date_default_timezone_set( $_ENV["APP_TIMEZONE"] ); 

// we create the relevant request object here
$requestClass =  "App\Http\Requests\\".ucfirst( strtolower( $_SERVER['REQUEST_METHOD'] ) )."Request";
$requestRef   = new ReflectionClass( $requestClass );
$request      = $requestRef->newInstance();

$controllerClass = "App\Controllers\\"; // will be concatenated with the right controller after processing

/**
 * 
 * SO router endpoints;
 * sleep(1) is used on selected routes as an in-house anti brute force attacks throttling :);
 * we will define the right controller based on the requested route
 * 
 */
switch ( $request->getEndpoint() ) {
    case "/":
        $controllerClass .= "Home";
        break;
    // TODO
    // case "/sessions":
    //     sleep( 1 );
    //     $controllerClass .= "Entities\\Sessions";
    //     break;
    // case "/users":
    //     sleep( 1 );
    //     $controllerClass .= "Entities\\Users";
    //     break;
    default:
        $controllerClass .= "NotFound";
        break;
} 
/**
 * 
 * instanciating the right controller 
 * after having defined it in the previous switch block,
 * and then handling the request,
 * which returns a response, 
 * which is in turn sent
 * 
 */
( new ReflectionClass( $controllerClass."Controller" ) )->newInstanceArgs( [$request] )->handleRequest()->send();

// we release the output
echo ob_get_clean();