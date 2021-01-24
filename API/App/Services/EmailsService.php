<?php

namespace App\Services;

use App\Models\AppToken;
use App\Models\User;

use App\Notifications\Email;

class EmailsService {

    // sending the account verification link email
    public function sendAccountVerificationEmail( User $user ) : bool {
        $token  = ( new AppToken() )->create( $user->id(), "accountverification" );
        $mailContents = "
            <html>
                <body>
                    <h2>Your login details for Top Mafia!</h2>
                    <p>Your username is "
                        ."<strong>".$user->username."</strong>"
                    ."</p>"
                    ."<p>"
                        ."<a href='".$_ENV["APP_URL"]."/apptokens?token=".$token."&type=accountverification"."'>Click here to verify email</a>"
                    ."</p>
                </body>
            </html> 
        ";
        return Email::sendEmail(
            $_ENV["MAIL_FROM_NAME"] , 
            "Verify your Top Mafia account!", 
            $user->getEmail(),
            $mailContents
        );
    }

    public function sendContactFormEmailToAdmin( string $contactFormSenderEmailAddress, string $message ) : bool {
        $mailContents = "
          <html>
          <body>
            <h2>You've received a message below:</h2>
            <p>Email: ".$contactFormSenderEmailAddress."
            <p>".$message."</p>
          </body>
          </html>
        ";
        return Email::sendEmail(
            $_ENV["MAIL_FROM_NAME"], 
            "Top Mafia contact form", 
            $_ENV["APP_ADMIN_EMAIL"],
            $mailContents
        );
    }

    public function sendPasswordResetEmail( User $user ) : bool {
        $token  = ( new AppToken() )->create( $user->id(), "passwordreset" );
        $mailContents = "
            <html>
                <body>
                    <h2>Password reset request for Top Mafia!</h2>
                    <p>You receive this mail because a request to reset password has been sent for this account.</p>
                    <p>If you did not request this, you can safely ignore this email.</p>
                    .<p>"
                        ."<a href='".$_ENV["APP_URL"]
                        ."/reset-password?token=".$token."&type=passwordreset&userid=".$user->id()
                        ."'>Click here to reset password</a>"
                    ."</p>
                </body>
            </html>
        ";
        return Email::sendEmail(
            $_ENV["MAIL_FROM_NAME"] , 
            "Top Mafia password reset", 
            $user->getEmail(),
            $mailContents
        );
    }
    
}