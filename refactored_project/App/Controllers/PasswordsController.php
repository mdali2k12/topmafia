<?php

namespace App\Controllers;

use App\Http\Requests\Request;
use App\Http\Responses\Json\JsonResponse;
use App\Models\User;
use App\Notifications\Email;

class PasswordsController extends Controller {

    public function __construct( Request $request ) {
        parent::__construct( $request );
    }

    protected function _initResponse() : void {
        switch( $this->_request->getMethod() ) {
            case "POST":
                if ( 
                    $this->_request->isValid() 
                    && isset( $this->_request->getBody()["email"] )
                    && User::exists( $this->_request->getBody()["email"] )
                ) {
                    $user = new User( $this->_request->getBody()["email"] );
                    if ( $user->id && $user->generateNewPassword() ) {
                        $mailContent = "
                            <html>
                                <body>
                                    <h2>We've reset your password!</h2>
                                    <p>Your username is <strong>".$user->username."</strong></p>
                                    <p>Your new password is <strong>".$user->getUnhashedPassword()."</strong>.</p>
                                </body>
                            </html>
                        ";
                        // nullifying unencrypted password since we're not using it again
                        $user->nullifyUnhashedPassword();
                        Email::sendEmail(
                            $user->username,
                            "Your new password for Top Mafia!",
                            $user->getEmail(),
                            $mailContent
                        ) ?
                            $this->_response = new JsonResponse( 
                                200, 
                                ["your password has been reset"],
                                true
                            )
                            :
                            $this->_setServerErrorResponse( "There was an issue delivering your email. Please try again later." );
                    }
                    else $this->_setServerErrorResponse( "There was an issue delivering your email. Please try again later." );
                } 
                else $this->_response = new JsonResponse( 
                    200, 
                    ["Email is incorrect or invalid!"],
                    false
                );
                break;
            default:
                $this->_setBadRequestResponse();
                break;
        }
    } 

} // EO class