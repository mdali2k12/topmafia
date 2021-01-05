<?php

// starting output buffering
ob_start();

$anErrorHasOcurred = false;

// init. dependencies & environment
require_once "./vendor/autoload.php";
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable( __DIR__ );
$dotenv->load();

// SO loading all required Controllers, Response objects and Services
use App\Http\Requests\GetRequest;
use App\Http\Requests\PatchRequest;
use App\Http\Requests\PostRequest;
use App\Http\Requests\DeleteRequest;

use App\Controllers\DefaultController; 
use App\Controllers\NotFoundController;

use App\DAOs\MariaDBDriver;
use App\Controllers\Entities\ContactFormsController;
use App\Controllers\Entities\ContentItemsController;
use App\Controllers\Entities\SessionsController;
use App\Controllers\Entities\UsersController;

use App\Http\Responses\Json\ErrorResponse as ErrorResponse;

use App\Services\AuthService as AuthService;
// EO loading all required Controllers, Response objects and Services

// we set the default timezone
date_default_timezone_set( "Europe/Berlin" );

if ( $_SERVER['REQUEST_METHOD'] !== "OPTIONS" ) {

    // we create the relevant request object here
    $requestClass =  "App\Http\Requests\\".ucfirst( strtolower( $_SERVER['REQUEST_METHOD'] ) )."Request";
    $requestRef   = new ReflectionClass( $requestClass );
    $request      = $requestRef->newInstance();

    // generic error response case URL is not valid
    if ( !$request->isValid() ) {
        ( new ErrorResponse( 400, ["invalid url"] ) )->send();
        $anErrorHasOcurred = true;
    }

    // database access object initialization
    $dbDriverName = "App\DAOs\\".$_ENV["DB_DRIVER"]."Driver";
    $dbDriverRef  = new ReflectionClass( $dbDriverName );
    $dbDriver     = $dbDriverRef->newInstance();

    // we instanciate auth service here
    $authService = AuthService::getInstance( $dbDriver );

    /**
     * 
     * SO router
     * sleep(1) is used on selected routes as an in-house anti brute force attacks throttling :)
     * TODO admin route and funnel
     * 
     */
    $controllerClass = "App\Controllers\\";
    // we route to web app' if requested
    if ( str_starts_with( $request->getEndpoint(), "/webapp" ) ) {
        header( "Cache-Control: no-store" );
        include_once( "webapp.php" );
    } else {
        // we define the right controller based on the requested route
        /**
        * 
        * SO content delivery reoute
        * 
        * the actual implementation of serving static content
        * like articles, thumbnails, etc.
        * is based on the CONTENT_URL key in your .env file,
        * so please make sure the route to your content has the same value 
        * than your main directory under the aformentioned CONTENT_URL key
        * 
        */
        if ( str_starts_with( $request->getEndpoint(), "/content" ) )
           $controllerClass .= "ContentDelivery";
        // EO content delivery route
        else
            // SO API endpoints that are not content delivery or webapp'
            switch ( $request->getEndpoint() ) {
                case "/":
                    $controllerClass .= "Default";
                    break;
                case "/blog":
                    $controllerClass .= "Entities\\ContentItems";
                    break;
                case "/contact_forms":
                    $controllerClass .= "Entities\\ContactForms";
                    break;
                case "/forms": 
                    sleep( 1 );
                    $controllerClass .= "ServerSideValidation";
                    break;
                case "/sessions":
                    sleep( 1 );
                    $controllerClass .= "Entities\\Sessions";
                    break;
                case "/users":
                    sleep( 1 );
                    $controllerClass .= "Entities\\Users";
                    break;
                default:
                    $controllerClass .= "NotFound";
                    break;
            } // EO switch API routes router 
        // instanciating the right controller and then handling the request, which returns a response, which is in turn sent
        if ( !$anErrorHasOcurred )
            ( new ReflectionClass( $controllerClass."Controller" ) )->newInstanceArgs( [$request] )->handleRequest()->send();
    } // EO API routes
} 
else { // OPTIONS preflight requests
    header( 'Access-Control-Allow-Headers: Content-Type, Allow-Origin, Authorization' );
    header( 'Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS' );
    header( 'Access-Control-Max-Age: 86400' );
    http_response_code( 200 );
}

// we release the output
echo ob_get_clean();