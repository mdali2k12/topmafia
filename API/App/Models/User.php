<?php

namespace App\Models;

use App\Database\UserDAO;
use App\Helpers\StringsTrait;

use App\Services\UsersService;

use App\Validators\StringsValidator;

class User {

    use StringsTrait;
    use StringsValidator;

    private int          $_id = 0; // id 0 means user model has not been hydrated
    private UserDAO      $_dao;
    private string       $_email;
    private string       $_gender;
    private string       $_password;
    private array        $_sponsorshipData;
    private string       $_unhashedPassword = "";
    private UsersService $_usersService;
    public  string       $username; 

    public function __construct( $identifier ) {
        $this->_dao = new UserDAO();
        $this->_inflate( $identifier );
    }

    private function _delete(): void {
        $this->_dao->deleteUser( $this->_id );
    }

    private function _inflate( $identifier ) {
        $fetched = $this->_dao->get( $identifier );
        if ( $fetched["rowCount"] > 0 ) {
            $this->_id       = $fetched["id"];
            $this->_email    = $fetched["email"];
            $this->_gender   = $fetched["gender"];
            $this->_password = $fetched["password"];
            $this->username  = $fetched["username"];
        }
    }

    private function _setSponsorshipData(): void {
        $this->_sponsorshipData = $this->_dao->checkInSponsorship( $this->_id );
    }

    /**
     * 
     * checks if user is a sponsor or if he's sponsored,
     * if so it checks if his counterpart has a verified account,
     * if so it updates the verified status of the sponsorship to true;
     * the function is executed in the verifyAccount( method 
     * during the account verification flow
     * 
     */
    private function _verifySponsorships() : void {
        $this->_setSponsorshipData();
        if ( count( $this->_sponsorshipData ) > 0 ) {
            foreach ($this->_sponsorshipData as $sponsorship ) {
                $counterPartId = 
                    $this->_usersService->extractCounterpartInSponsorshipRelationship( $sponsorship, $this->_id );
                if ( $this->isVerified( $counterPartId ) )
                    $this->_dao->updateSponsorshipStatus( (int) $sponsorship["id"] );
            }
        }
    }

    public function generateNewPassword() : bool {
        $this->_unhashedPassword = $this->generateHumanReadablePassword();
        $hash                    = $this->appHash( $this->_unhashedPassword );
        return $this->_dao->updateUserPassword( $this->_id, $hash );
    }

    public function getEmail(): string {
        return $this->_email;
    }

    public function getHashedPassword() : string {
        return $this->_password;
    }

    public function getId(): int {
        return $this->_id;
    }

    public function getUnhashedPassword(): string {
        return $this->_unhashedPassword;
    }

    public function nullifyUnhashedPassword() : void {
        $this->_unhashedPassword = " ";
    }

    public function isVerified( int $userId ) : bool {
        return $this->_dao->checkIsVerified( $userId );
    }

    public function read() : array {
        $payload = [];
        $payload["user"] = [
            "id"       => $this->_id,
            "email"    => $this->_email,
            "gender"   => $this->_gender,
            "username" => $this->username
        ];
        return $payload;
    }

    public function signUp( array $userPayload, $sponsorId = null ) : bool {
        // business logic validation rounds
        if (
            $this->validatePassword( $userPayload["password"] )
            && $this->validateGender( $userPayload["gender"] )
        ) {
            $userPayload["password"] = $this->appHash( $userPayload["password"] );
            $this->_dao->signUp( $userPayload );
            $this->_inflate( $userPayload["username"] );
        }
        return $this->_id != 0; // id would be equal to 0 is user is not inserted in db
    }

    public function updatePassword( string $password ): bool {
        $hash    = $this->appHash( $password);
        return $this->_dao->updateUserPassword( $this->_id, $hash );
    }

    /**
     * 
     * given an existing IP in the sponsorships table,
     * when a new sponsorship is inserted using the same IP,
     * then no sponsorship record is inserted,
     * and user making the request is deleted
     * 
     */
    public function undergoesSponsorshipRequestProcedure( int $sponsorId, string $ipAddress, string $userAgent ) : bool {
        if ( 
            $this->_dao->sponsorshipIpExists( $ipAddress )
        ) {
            $this->_delete( $this->_id );
            return false;
        } else {
            $this->_dao->insertSponsorship( $this->_id, $sponsorId, $ipAddress, $userAgent );
            return true;
        } 
    }

    // SO business logic input validation
    public function validateGender( string $genderInput ): bool {
        return in_array( $this->sanitizeStringInput( $genderInput ), ["Male", "Female"] );
    }
    public function validatePassword( string $passwordInput ) {
        $passwordInput = $this->sanitizeStringInput( $passwordInput );
        return $this->validateStringInputLength( $passwordInput, 8, 254 );
    }
    public function validateUserEmail( string $emailInput ): bool {
        $emailInput = $this->sanitizeStringInput( $emailInput );
        return !$this->_usersService->exists( $emailInput );
    }
    public function validateUserEmailIsNotBanned( string $emailInput ): bool {
        $emailInput = $this->sanitizeStringInput( $emailInput );
        return !$this->_dao->emailIsBanned( $emailInput );
    }
    public function validateUsername( string $usernameInput ) : bool {
        return !$this->_usersService->exists( $usernameInput );
    }
    public function validateUsernameLength( string $usernameInput ) : bool {
        return $this->validateStringInputLength( $usernameInput, 6, 15 ); 
    }
    // EO business logic specific validation

    public function verifyAccount() : bool {
        $success = $this->_dao->updateIsVerifiedField( $this->_id ) ? true : false;
        if ( $success ) // we update sponsorships if any
            $this->_verifySponsorships();
        return $success;
    }

}