<?php

namespace App\Controllers;

use App\Helpers\StringsTrait;

use App\Http\Requests\Request;
use App\Http\Responses\Json\JsonResponse;

use App\Models\User;

class PasswordsController extends Controller {

    use StringsTrait;

    public function __construct( Request $request ) {
        parent::__construct( $request );
    }

    protected function _initResponse() : void {
        switch( $this->_request->getMethod() ) {
            case "POST":
                // pessimistic assumption
                $failed = true;
                if ( 
                    $this->_request->isValid() 
                    && isset( $this->_request->getBody()["email"] )
                    && $this->sanitizeStringInput( $this->_request->getBody()["email"] ) != ""
                    && User::exists( $this->_request->getBody()["email"] )
                ) {
                    $user = new User( $this->_request->getBody()["email"] );
                    if ( $user->id && $user->generateNewPassword() ) {
                        $failed = false;
                        $mailContents = "
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
                        // sending the password reset email
                        $this->sendEmailAndSetResponse( 
                            $_ENV["MAIL_FROM_NAME"] , 
                            "Your new password for Top Mafia!", 
                            $user->getEmail(),
                            $mailContents,
                            "Your password has been reset",
                            "There was an issue delivering your email. Please try again later." 
                        );
                    }
                } 
                $failed ?? 
                    $this->_response = new JsonResponse( 
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