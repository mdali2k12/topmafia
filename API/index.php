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
use App\Http\Requests\PatchRequest;
use App\Http\Requests\PostRequest;
// TODO
// use App\Http\Requests\DeleteRequest;

// loading app' controllers
use App\Controllers\EmailsController;
use App\Controllers\HomeController; 
use App\Controllers\NotFoundController;
use App\Controllers\Resources\AppTokensController;
use App\Controllers\Resources\BannedIPsController;
use App\Controllers\Resources\SessionsController;
use App\Controllers\Resources\UsersController;

// we set the default timezone
date_default_timezone_set( $_ENV["APP_TIMEZONE"] ); 

// we create the relevant request object here
$requestClass =  "App\Http\Requests\\".ucfirst( strtolower( $_SERVER['REQUEST_METHOD'] ) )."Request";
$requestRef   = new ReflectionClass( $requestClass );
$request      = $requestRef->newInstance();

$controllerClassName = "App\Controllers\\"; // will be concatenated with the right controller after processing

// we check if we're dealing with a banned IP address
$bipc = new BannedIPsController();
if ( 
   ( isset( $_SERVER["REMOTE_ADDR"] ) && $bipc->ipIsBanned( $_SERVER["REMOTE_ADDR"] ) ) 
    ||
   ( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) && $bipc->ipIsBanned( $_SERVER["HTTP_X_FORWARDED_FOR"] ) )
) {
    $bipc->setBannedIpResponseAndExit();
}

/**
 * 
 * SO router endpoints;
 * based on the request headers we'll get either a JSON response or a web response;
 * sleep(1) is used on selected routes as an in-house anti brute force attacks throttling :);
 * we will define the right controller based on the requested route
 * 
 */
if ( isset( $request->getHeaders()["json"] ) &&  $request->getHeaders()["json"] == "true" ) { // API routes
    switch ( $request->getEndpoint() ) {
        case "/":
            $controllerClassName .= "Home";
            break;
        case "/apptokens":
            $controllerClassName .= "Resources\\AppTokens";
            break;
        case "/emails":
            $controllerClassName .= "Emails";
            break;
        case "/sessions":
            sleep( 1 );
            $controllerClassName .= "Resources\\Sessions";
            break;
        case "/users":
            sleep( 1 );
            $controllerClassName .= "Resources\\Users";
            break;
        default:
            $controllerClassName .= "NotFound";
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
    ( new ReflectionClass( $controllerClassName."Controller" ) )
        ->newInstanceArgs( [$request] )
        ->handleRequest()
        ->send();
} else { // web routes
    switch ( $request->getEndpoint() ) {
        // TODO load Angular web app' here
        case "/contact":
            require_once getcwd()."/views/templates/contact.php";
            break;
        case "/forgot-password":
            require_once getcwd()."/views/templates/forgot_password.php";
            break;
        case "/game-rules":
            require_once getcwd()."/views/templates/game_rules.php";
            break;
        case "/privacy-policy":
            require_once getcwd()."/views/templates/privacy_policy.php";
            break;
        case "/reset-password":
            require_once getcwd()."/views/templates/reset_password.php";
            break;
        case "/":
        default :
            require_once getcwd()."/views/templates/home.php";
            break;
    }
}


// we release the output
echo ob_get_clean();